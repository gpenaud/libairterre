<?php

/**
 * Gestion de l'affichage des saisies.
 *
 * @return SPIP\Saisies\Manipuler
 **/

// Sécurité
if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

/**
 * Supprimer une saisie dont on donne l'identifiant, le nom ou le chemin.
 *
 * @param array        $saisies             Tableau des descriptions de saisies
 * @param string|array $id_ou_nom_ou_chemin
 *     L'identifiant unique
 *     ou le nom de la saisie à supprimer
 *     ou son chemin sous forme d'une liste de clés
 *
 * @return array
 *               Tableau modifié décrivant les saisies
 */
function saisies_supprimer($saisies, $id_ou_nom_ou_chemin) {
	// On enlève les options générales avant de manipuler
	if (isset($saisies['options'])) {
		$options_generales = $saisies['options'];
		unset($saisies['options']);
	}

	// Si la saisie n'existe pas, on ne fait rien
	if ($chemin = saisies_chercher($saisies, $id_ou_nom_ou_chemin, true)) {
		// La position finale de la saisie
		$position = array_pop($chemin);

		// On va chercher le parent par référence pour pouvoir le modifier
		$parent = &$saisies;
		foreach ($chemin as $cle) {
			$parent = &$parent[$cle];
		}

		// On supprime et réordonne
		unset($parent[$position]);
		$parent = array_values($parent);
	}

	// On remet les options générales après avoir manipulé
	if (isset($options_generales)) {
		$saisies['options'] = $options_generales;
	}

	return $saisies;
}

/**
 * Insère une saisie à une position donnée dans un tableau de donnée
 *		- soit en lui passant un chemin
 *		- soit en lui passant une saisie devant laquelle se placer
 * @param array $saisies     Tableau des descriptions de saisies
 * @param array $saisie     Description de la saisie à insérer
 * @param array|string $id_ou_nom_ou_chemin
 *	- Si array c'est un chemin
 *     Position complète où insérer la saisie
 *				- Si directement à la racine du tableau : array(<index_où_inserer>)
 *				- Si au sein d'un fieldset ou assimilé : array(<index_du _fieldset>, 'saisies', <index_où_inserer_au_sein_du_fieldset>)
 *	- Si string
 *		- Si entre crochets, ca veut dire qu'on insère à la fin d'un fieldset `[fieldset]`
 *		- Si entre crochets, suivis d'un entier entre crochet, on insère à une position données dans le fieldset `[fieldset][0]`
 *		- Si pas de crochet, on insère avant la saisie `saisie`
 *  - En absence, insère la saisie à la fin.
 * @return array
 *     Tableau des saisies complété de la saisie insérée
 **/
function saisies_inserer($saisies, $saisie, $id_ou_nom_ou_chemin = array()) {
	if (is_string($id_ou_nom_ou_chemin) and $id_ou_nom_ou_chemin) {//Est-ce qu'on n'a un nom ou un id ?
		if (preg_match('/^\[(@?[\w]*)\](\[([\d])*\])*$/', $id_ou_nom_ou_chemin, $match)) {//Si [fieldset], inserer à la fin du fieldset, si [fieldset][X] inserer à la position X dans le fieldset
			if (isset($match[3])) {
				$position = $match[3];
			} else {
				$position = 10000000;
			}
			$parent = saisies_chercher($saisies, $match[1], true);
			$chemin = array_merge($parent, array('saisies', $position));
			$saisies = saisies_inserer_selon_chemin($saisies, $saisie, $chemin);
		} else {
			$saisies = saisies_inserer_avant($saisies, $saisie, $id_ou_nom_ou_chemin); //saisies_inserer_avant($saisies, $saisie, $id_ou_nom_ou_chemin);
		}
	}	else {
		$saisies = saisies_inserer_selon_chemin($saisies, $saisie, $id_ou_nom_ou_chemin);
	}
	return $saisies;
}

/**
 * Insère une saisie avant une autre saisie.
 *
 * @param array $saisies     Tableau des descriptions de saisies
 * @param array $saisie     Description de la saisie à insérer
 * @param array $id_ou_nom_ou_chemin identifiant ou nom ou chemin de la saisie devant laquelle inserer
 * @return array
 *     Tableau des saisies complété de la saisie insérée
 */
function saisies_inserer_avant($saisies, $saisie, $id_ou_nom_ou_chemin) {
	if (is_array($id_ou_nom_ou_chemin)) {
		$chemin = $id_ou_nom_ou_chemin;
	} else {
		$chemin = saisies_chercher($saisies, $id_ou_nom_ou_chemin, true);
	}
	$saisies = saisies_inserer_selon_chemin($saisies, $saisie, $chemin);
	return $saisies;
}

/**
 * Insère une saisie après une autre saisie.
 *
 * @param array $saisies     Tableau des descriptions de saisies
 * @param array $saisie     Description de la saisie à insérer
 * @param array $id_ou_nom_ou_chemin identifiant ou nom ou chemin de la saisie devant laquelle inserer
 * @return array
 *     Tableau des saisies complété de la saisie insérée
 */
function saisies_inserer_apres($saisies, $saisie, $id_ou_nom_ou_chemin) {
	if (is_array($id_ou_nom_ou_chemin)) {
		$chemin = $id_ou_nom_ou_chemin;
	} else {
		$chemin = saisies_chercher($saisies, $id_ou_nom_ou_chemin, true);
	}
	//Augmenter de 1 le dernier element du chemin
	$chemin[count($chemin)-1]++;
	$saisies = saisies_inserer_selon_chemin($saisies, $saisie, $chemin);
	return $saisies;
}

/**
 * Insère une saisie à une position donnée, en lui passant un chemin.
 *
 * @param array $saisies     Tableau des descriptions de saisies
 * @param array $saisie     Description de la saisie à insérer
 * @param array $chemin
 *     Position complète où insérer la saisie
 *				- Si directement à la racine du tableau : array(<index_où_inserer>)
 *				- Si au sein d'un fieldset ou assimilé : array(<index_du _fieldset>, 'saisies', <index_où_inserer_au_sein_du_fieldset>)
 *     En absence, insère la saisie à la fin.
 * @return array
 *     Tableau des saisies complété de la saisie insérée
 */
function saisies_inserer_selon_chemin($saisies, $saisie, $chemin = array()) {
	// On enlève les options générales avant de manipuler
	if (isset($saisies['options'])) {
		$options_generales = $saisies['options'];
		unset($saisies['options']);
	}
	// On vérifie quand même que ce qu'on veut insérer est correct
	if ($saisie['saisie'] and $saisie['options']['nom']) {
		// ajouter un identifiant
		$saisie = saisie_identifier($saisie);

		// Par défaut le parent c'est la racine
		$parent = &$saisies;
		// S'il n'y a pas de position, on va insérer à la fin du formulaire
		if (!$chemin) {
			$position = count($parent);
		} elseif (is_array($chemin)) {
			$position = array_pop($chemin);
			foreach ($chemin as $cle) {
				// Si la clé est un conteneur de saisies "saisies" et qu'elle n'existe pas encore, on la crée
				if ($cle == 'saisies' and !isset($parent[$cle])) {
					$parent[$cle] = array();
				}
				$parent = &$parent[$cle];
			}
			// On vérifie maintenant que la position est cohérente avec le parent
			if ($position < 0) {
				$position = 0;
			} elseif ($position > count($parent)) {
				$position = count($parent);
			}
		}
		// Et enfin on insère
		array_splice($parent, $position, 0, array($saisie));
	}

	// On remet les options générales après avoir manipulé
	if (isset($options_generales)) {
		$saisies['options'] = $options_generales;
	}

	return $saisies;
}


/**
 * Duplique une saisie (ou groupe de saisies)
 * en placant la copie à la suite de la saisie d'origine.
 * Modifie automatiquement les identifiants des saisies.
 *
 * @param array        $saisies             Un tableau décrivant les saisies
 * @param unknown_type $id_ou_nom_ou_chemin L'identifiant unique ou le nom ou le chemin de la saisie a dupliquer
 *
 * @return array Retourne le tableau modifié des saisies
 */
function saisies_dupliquer($saisies, $id_ou_nom_ou_chemin) {
	// On récupère le contenu de la saisie à déplacer
	$saisie = saisies_chercher($saisies, $id_ou_nom_ou_chemin);
	if ($saisie) {
		list($clone) = saisies_transformer_noms_auto($saisies, array($saisie));
		// insertion apres quoi ?
		$chemin_validation = saisies_chercher($saisies, $id_ou_nom_ou_chemin, true);
		// 1 de plus pour mettre APRES le champ trouve
		++$chemin_validation[count($chemin_validation) - 1];
		// On ajoute "copie" après le label du champs
		$clone['options']['label'] .= ' '._T('saisies:construire_action_dupliquer_copie');

		// Création de nouveau identifiants pour le clone
		$clone = saisie_identifier($clone, true);

		$saisies = saisies_inserer($saisies, $clone, $chemin_validation);
	}

	return $saisies;
}

/**
 * Déplace une saisie existante autre part.
 *
 * @param array        $saisies             Un tableau décrivant les saisies
 * @param unknown_type $id_ou_nom_ou_chemin L'identifiant unique ou le nom ou le chemin de la saisie à déplacer
 * @param string       $ou                  Le nom de la saisie devant laquelle on déplacera OU le nom d'un conteneur entre crochets [conteneur] (et dans ce cas on déplace à la fin de conteneur)
 *
 * @return array Retourne le tableau modifié des saisies
 */
function saisies_deplacer($saisies, $id_ou_nom_ou_chemin, $ou) {
	// On récupère le contenu de la saisie à déplacer
	$saisie = saisies_chercher($saisies, $id_ou_nom_ou_chemin);

	// Si on l'a bien trouvé
	if ($saisie) {
		// On cherche l'endroit où la déplacer
		// Si $ou est vide, c'est à la fin de la racine
		if (!$ou) {
			$saisies = saisies_supprimer($saisies, $id_ou_nom_ou_chemin);
			$chemin = array(count($saisies));
		} elseif (preg_match('/^\[(@?[\w]*)\]$/', $ou, $match)) {
			// Si l'endroit est entre crochet, c'est un conteneur
			$parent = $match[1];
			// Si dans les crochets il n'y a rien, on met à la fin du formulaire
			if (!$parent) {
				$saisies = saisies_supprimer($saisies, $id_ou_nom_ou_chemin);
				$chemin = array(count($saisies));
			} elseif (saisies_chercher($saisies, $parent, true)) {
				// Sinon on vérifie que ce conteneur existe
				// S'il existe on supprime la saisie et on recherche la nouvelle position
				$saisies = saisies_supprimer($saisies, $id_ou_nom_ou_chemin);
				$parent = saisies_chercher($saisies, $parent, true);
				$chemin = array_merge($parent, array('saisies', 1000000));
			} else {
				$chemin = false;
			}
		} else {
			// Sinon ça sera devant un champ
			// On vérifie que le champ existe
			if (saisies_chercher($saisies, $ou, true)) {
				// S'il existe on supprime la saisie
				$saisies = saisies_supprimer($saisies, $id_ou_nom_ou_chemin);
				// Et on recherche la nouvelle position qui n'est plus forcément la même maintenant qu'on a supprimé une saisie
				$chemin = saisies_chercher($saisies, $ou, true);
			} else {
				$chemin = false;
			}
		}

		// Si seulement on a bien trouvé un nouvel endroit où la placer, alors on déplace
		if ($chemin) {
			$saisies = saisies_inserer($saisies, $saisie, $chemin);
		}
	}

	return $saisies;
}

/**
 * Modifie une saisie.
 *
 * @param array        $saisies             Un tableau décrivant les saisies
 * @param unknown_type $id_ou_nom_ou_chemin L'identifiant unique ou le nom ou le chemin de la saisie à modifier
 * @param array        $modifs              Le tableau des modifications à apporter à la saisie
 * @param bool				 $fusion							True si on veut simplifier rajouter des choses, sans tout remplacer
 * @return Retourne le tableau décrivant les saisies, mais modifié
 */
function saisies_modifier($saisies, $id_ou_nom_ou_chemin, $modifs, $fusion = false) {
	if ($chemin = saisies_chercher($saisies, $id_ou_nom_ou_chemin, true)) {
		$position = array_pop($chemin);
		$parent = &$saisies;
		foreach ($chemin as $cle) {
			$parent = &$parent[$cle];
		}

		// On récupère le type tel quel
		$modifs['saisie'] = $parent[$position]['saisie'];
		// On récupère le nom s'il n'y est pas
		if (!isset($modifs['options']['nom'])) {
			$modifs['options']['nom'] = $parent[$position]['options']['nom'];
		}
		// On récupère les enfants tels quels s'il n'y a pas des enfants dans la modif
		if (
			!isset($modifs['saisies'])
			and isset($parent[$position]['saisies'])
			and is_array($parent[$position]['saisies'])
		) {
			$modifs['saisies'] = $parent[$position]['saisies'];
		}
		// Pareil pour les vérifications
		if (
			!isset($modifs['verifier'])
			and isset($parent[$position]['verifier'])
			and is_array($parent[$position]['verifier'])
		) {
			$modifs['verifier'] = $parent[$position]['verifier'];
		}

		// Si 'nouveau_type_saisie' est donnee, c'est que l'on souhaite
		// peut être changer le type de saisie !
		// Notes : on maintient encore la syntaxe historique qui met cela dans 'options', mais elle n'est pas nécessaire et disparaitra en 4.0
		if (isset($modifs['nouveau_type_saisie']) and $type = $modifs['nouveau_type_saisie']) {
			$modifs['saisie'] = $type;
			unset($modifs['nouveau_type_saisie']);
		} elseif (isset($modifs['options']['nouveau_type_saisie']) and $type = $modifs['options']['nouveau_type_saisie']) {
			$modifs['saisie'] = $type;
			unset($modifs['options']['nouveau_type_saisie']);
		}
		// On remplace tout
		if (!$fusion) {
			$parent[$position] = $modifs;
		} else {
			$parent[$position] = array_replace_recursive($parent[$position], $modifs);
		}
	}

	return $saisies;
}

/**
 * Transforme tous les noms du formulaire avec un preg_replace.
 *
 * @param array  $saisies      Un tableau décrivant les saisies
 * @param string $masque       Ce que l'on doit chercher dans le nom
 * @param string $remplacement Ce par quoi on doit remplacer
 *
 * @return array               Retourne le tableau modifié des saisies
 */
function saisies_transformer_noms($saisies, $masque, $remplacement) {
	if (is_array($saisies)) {
		foreach ($saisies as $cle => $saisie) {
			$saisies[$cle]['options']['nom'] = preg_replace($masque, $remplacement, $saisie['options']['nom']);
			if (isset($saisie['saisies']) and is_array($saisie['saisies'])) {
				$saisies[$cle]['saisies'] = saisies_transformer_noms($saisie['saisies'], $masque, $remplacement);
			}
		}
	}

	return $saisies;
}

/**
 * Transforme toutes les options textuelles d'un certain nom, avec un preg_replace.
 *
 * @param $saisies
 *     Tableau décrivant les saisies
 * @param $option
 *     Nom de l'option à transformer (par ex "nom", ou "afficher_si")
 * @param $masque
 *     Ce que l'on doit chercher dans le texte
 * @param $remplacement
 *     Ce par quoi on doit remplacer
 * @return array
 * 		Retourne le tableau modifié des saisies
 */
function saisies_transformer_option($saisies, $option, $masque, $remplacement) {
	if (is_array($saisies)) {
		foreach ($saisies as $cle => $saisie) {
			// Seulement si l'option demandée est bien textuelle
			if (is_string($saisie['options'][$option])) {
				$saisies[$cle]['options'][$option] = preg_replace($masque, $remplacement, $saisie['options'][$option]);
			}

			// On parcourt récursivement toutes les saisies enfants
			if (isset($saisie['saisies']) and is_array($saisie['saisies'])) {
				$saisies[$cle]['saisies'] = saisies_transformer_option($saisie['saisies'], $option, $masque, $remplacement);
			}
		}
	}

	return $saisies;
}

/**
 * Transforme les noms d'une liste de saisies pour qu'ils soient
 * uniques dans le formulaire donné.
 *
 * @param array $formulaire  Le formulaire à analyser
 * @param array $saisies     Un tableau décrivant les saisies.
 *
 * @return array
 *     Retourne le tableau modifié des saisies
 */
function saisies_transformer_noms_auto($formulaire, $saisies) {
	if (is_array($saisies)) {
		foreach ($saisies as $cle => $saisie) {
			$saisies[$cle]['options']['nom'] = saisies_generer_nom($formulaire, $saisie['saisie']);
			// il faut prendre en compte dans $formulaire les saisies modifiees
			// sinon on aurait potentiellement 2 champs successifs avec le meme nom.
			// on n'ajoute pas les saisies dont les noms ne sont pas encore calculees.
			$new = $saisies[$cle];
			unset($new['saisies']);
			$formulaire[] = $new;

			if (isset($saisie['saisies']) and is_array($saisie['saisies'])) {
				$saisies[$cle]['saisies'] = saisies_transformer_noms_auto($formulaire, $saisie['saisies']);
			}
		}
	}

	return $saisies;
}

/**
 * Insère du HTML au début ou à la fin d'une saisie.
 *
 * @param array  $saisie    La description d'une seule saisie
 * @param string $insertion Du code HTML à insérer dans la saisie
 * @param string $ou        L'endroit où insérer le HTML : "debut" ou "fin"
 *
 * @return array            Retourne la description de la saisie modifiée
 */
function saisies_inserer_html($saisie, $insertion, $ou = 'fin') {
	if (!in_array($ou, array('debut', 'fin'))) {
		$ou = 'fin';
	}

	if ($ou == 'debut') {
		$saisie['options']['inserer_debut'] =
			$insertion.(isset($saisie['options']['inserer_debut']) ? $saisie['options']['inserer_debut'] : '');
	} elseif ($ou == 'fin') {
		$saisie['options']['inserer_fin'] =
			(isset($saisie['options']['inserer_fin']) ? $saisie['options']['inserer_fin'] : '').$insertion;
	}

	return $saisie;
}

/**
 * Ajoute l'option onglet aux fieldset de premier niveau dans un tableau de $saisie
 * Ajoute également un identifiant unique, éventuellement préfixé
 * @param array $saisies
 * @param string $identifiant_prefixe
 * @return array $saisies modifiées
**/
function saisies_fieldsets_en_onglets($saisies, $identifiant_prefixe = '') {
	foreach ($saisies as &$saisie) {
		if ($saisie['saisie'] == 'fieldset') {
			$saisie['options']['onglet'] = 'on';
			$saisie['identifiant'] = $identifiant_prefixe.'_'.saisie_nom2classe($saisie['options']['nom']);
		}
	}
	return $saisies;
}
