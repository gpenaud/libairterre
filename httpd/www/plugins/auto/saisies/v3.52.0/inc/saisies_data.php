<?php

/**
 * Trouver et manipuler les data des saisies,
 * qu'elles soient sous forme tabulaire ou sous forme de liste
 *
 * @package SPIP\Saisies\Data
**/

// Sécurité
if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

/**
 * Aplatit une description chaînée, en supprimant les sous-groupes.
 * @param string $chaine La chaîne à aplatir
 * @return $chaine
 */
function saisies_aplatir_chaine($chaine) {
	return trim(preg_replace("#(?:^|\n)(\*(?:.*)|/\*)\n#i", "\n", $chaine));
}

/**
 * Transforme une chaine en tableau avec comme principe :
 *
 * - une ligne devient une case
 * - si la ligne est de la forme truc|bidule alors truc est la clé et bidule la valeur
 * - si la ligne commence par * alors on commence un sous-tableau
 * - si la ligne est égale à /*, alors on finit le sous-tableau
 *
 * @param string $chaine Une chaine à transformer
 * @param string $separateur Séparateur utilisé
 * @return array Retourne un tableau PHP
 */
function saisies_chaine2tableau($chaine, $separateur = "\n") {
	if ($chaine and is_string($chaine)) {
		$tableau = array();
		$soustab = false;

		// On découpe d'abord en lignes
		$lignes = explode($separateur, $chaine);
		foreach ($lignes as $i => $ligne) {
			$ligne = trim(trim($ligne), '|');
			// Si ce n'est pas une ligne sans rien
			if ($ligne !== '') {
				// si ca commence par * c'est qu'on va faire un sous tableau
				if (strpos($ligne, '*') === 0) {
					$soustab=true;
					$soustab_cle = _T_ou_typo(substr($ligne, 1), 'multi');
					if (!isset($tableau[$soustab_cle])) {
						$tableau[$soustab_cle] = array();
					}
				} elseif ($ligne == '/*') {//si on finit sous tableau
					$soustab=false;
				} else {
					//sinon c'est une entrée normale
					// Si on trouve un découpage dans la ligne on fait cle|valeur
					if (strpos($ligne, '|') !== false) {
						list($cle,$valeur) = explode('|', $ligne, 2);
						// permettre les traductions de valeurs au passage
						if ($soustab == true) {
							$tableau[$soustab_cle][$cle] = _T_ou_typo($valeur, 'multi');
						} else {
							$tableau[$cle] = _T_ou_typo($valeur, 'multi');
						}
					} else {
						// Sinon on génère la clé
						if ($soustab == true) {
							$tableau[$soustab_cle][$i] = _T_ou_typo($ligne, 'multi');
						} else {
							$tableau[$i] = _T_ou_typo($ligne, 'multi');
						}
					}
				}
			}
		}
		return $tableau;
	}
	elseif (is_array($chaine)) {
		// Si c'est déjà un tableau on lui applique _T_ou_typo (qui fonctionne de manière récursive avant de le renvoyer
		return _T_ou_typo($chaine, 'multi');
	}
	else {
		return array();
	}
}

/**
 * Transforme un tableau en chaine de caractères avec comme principe :
 *
 * - une case devient une ligne de la chaine
 * - chaque ligne est générée avec la forme cle|valeur
 * - si une entrée du tableau est elle même un tableau, on met une ligne de la forme *clef
 * - pour marquer que l'on quitte un sous-tableau, on met une ligne commencant par /*, sauf si on bascule dans un autre sous-tableau.
 *
 * @param array $tableau Tableau à transformer
 * @return string Texte représentant les données du tableau
 */
function saisies_tableau2chaine($tableau) {
	if ($tableau and is_array($tableau)) {
		$chaine = '';
		$avant_est_tableau = false;

		foreach ($tableau as $cle => $valeur) {
			if (is_array($valeur)) {
				$avant_est_tableau = true;
				$ligne=trim("*$cle");
				$chaine .= "$ligne\n";
				$chaine .= saisies_tableau2chaine($valeur)."\n";
			} else {
				if ($avant_est_tableau == true) {
					$avant_est_tableau = false;
					$chaine.="/*\n";
				}
				$ligne = trim("$cle|$valeur");
				$chaine .= "$ligne\n";
			}
		}
		$chaine = trim($chaine);

		return $chaine;
	}
	elseif (is_string($tableau)) {
		// Si c'est déjà une chaine on la renvoie telle quelle
		return $tableau;
	}
	else {
		return '';
	}
}

/**
 * Transforme une valeur en tableau d'élements si ce n'est pas déjà le cas
 *
 * @param mixed $valeur
 * @return array Tableau de valeurs
**/
function saisies_valeur2tableau($valeur, $data=array()) {
	$data = saisies_aplatir_tableau($data);
	$tableau = array();

	if (is_array($valeur)) {
		$tableau = $valeur;
	}
	elseif (strlen($valeur)) {
		$tableau = saisies_chaine2tableau($valeur);

		// Si qu'une seule valeur, c'est qu'elle a peut-être un separateur à virgule
		// et a donc une clé 0 dans ce cas la d'ailleurs
		if (count($tableau) == 1 and isset($tableau[0])) {
			$tableau = saisies_chaine2tableau($tableau[0], ',');
		}
	}

	// On vérifie la pertinence des valeurs pour s'assurer d'avoir le choix alternatif dans sa clé à part
	if (is_array($data) and $data) {
		foreach ($tableau as $cle => $valeur) {
			if (!in_array($valeur, array_keys($data))) {
				$choix_alternatif = $valeur;
				unset($tableau[$cle]);
				$tableau['choix_alternatif'] = $valeur;
			}
		}
	}

	return $tableau;
}

/**
 * Pour les saisies multiples (type checkbox) proposant un choix alternatif,
 * retrouve à partir des data de choix proposés
 * et des valeurs des choix enregistrés
 * le texte enregistré pour le choix alternatif.
 *
 * @param array $data
 * @param array $valeur
 * @return string choix_alternatif
**/
function saisies_trouver_choix_alternatif($data, $valeur) {
	if (!is_array($valeur)) {
		$valeur = saisies_valeur2tableau($valeur);
	}
	if (!is_array($data)) {
		$data = saisies_chaine2tableau($data) ;
	}

	$choix_theorique = array_keys($data);
	$choix_alternatif = array_values(array_diff($valeur, $choix_theorique));
	if (isset($choix_alternatif[0])) {
		return $choix_alternatif[0]; //on suppose que personne ne s'est amusé à proposer deux choix alternatifs
	} else {
		return '';
	}
}


/**
 * Aplatit une description tabulaire en supprimant les sous-groupes.
 * Ex : les data d'une saisie de type select
 *
 * @param array $tab            Le tableau à aplatir
 * @param bool  $montrer_groupe mettre à false pour ne pas montrer le sous-groupe dans les label humain
 *
 * @return array
 */
function saisies_aplatir_tableau($tab, $montrer_groupe = true) {
	$nouveau_tab = array();
	if (is_string($tab)) {
		$tab = saisies_chaine2tableau($tab);
	}
	if (is_array($tab)) {
		foreach ($tab as $entree => $contenu) {
			if (is_array($contenu)) {
				foreach ($contenu as $cle => $valeur) {
					if ($montrer_groupe) {
						$nouveau_tab[$cle] = _T('saisies:saisies_aplatir_tableau_montrer_groupe', array('valeur' => $valeur, 'groupe' => $entree));
					} else {
						$nouveau_tab[$cle] = $valeur;
					}
				}
			} else {
				$nouveau_tab[$entree] = $contenu;
			}
		}
	}

	return $nouveau_tab;
}


/**
 * Trouve le champ datas ou datas (pour raison historique)
 * parmis les paramètres d'une saisie
 * et le retourne après avoir l'avoir transformé en tableau si besoin
 * @param array $description description de la saisie
 * @bool $disable_choix : si true, supprime les valeurs contenu dans l'option disable_choix des data
 * @return array data
**/
function saisies_trouver_data($description, $disable_choix = false) {
	$options = $description['options'];
	if (isset($options['data'])) {
		$data = $options['data'];
	} elseif (isset($options['datas'])) {
		$data = $options['datas'];
	} else {
		$data = array();//normalement on peut pas mais bon
	}
	$data = saisies_chaine2tableau($data);

	if ($disable_choix == true and isset($options['disable_choix'])) {
		$disable_choix = array_flip(explode(',',$options['disable_choix']));
		$data = array_diff_key($data,$disable_choix);
	}
	return $data;
}
