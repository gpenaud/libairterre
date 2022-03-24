<?php

/**
 * Gestion de l'affichage conditionnelle des saisies.
 * Partie spécifique php
 *
 * @package SPIP\Saisies\Afficher_si_php
**/

// Sécurité
if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

include_spip('inc/saisies_afficher_si_commun');

/**
 * Traitement des saisies ayant l'option `afficher_si`.
 *
 * Lorsque qu'on affiche les saisies avec `#VOIR_SAISIES`,
 * ou lorsqu'on les vérifie avec saisies_verifier().
 * Si les conditions d'affichage d'une saisie n'est pas remplie :
 *	- On la retire du tableau de saisies, SAUF SI l'une des trois conditions suivantes est remplie:
 *		- l'option de la saisie individuelle `afficher_si_avec_post` est activée;
 *		- l'option globale `afficher_si_avec_post` est activée;
 *		- l'option de la saisie individuelle `afficher_si_remplissage_uniquement` est activée.
 *  - On modifie le résultat de `_request()` pour avoir une chaîne vide (`''`), SAUF SI l'une des deux conditions suivantes est remplie:
 *		- l'option `afficher_si_avec_post` est activée;
 *		- l'option globale `afficher_si_avec_post` est activée.
 * Sur le détail des usages des différentes options, voir
 * https://contrib.spip.net/5081#Options-supplementaires
 *
 * Note : pour des raisons de compatibilité historique, on supporte encore l'option globale poster_afficher_si synonyme de afficher_si_avec_post.
 * @param array      $saisies
 *                            Tableau de descriptions de saisies
 * @param array|null $env
 *                            Tableau d'environnement transmis dans inclure/voir_saisies.html,
 *                            NULL si on doit rechercher dans _request (pour saisies_verifier()).
 * @param array $saisies_toutes_par_nom ensemble des saisies du formulaire courant, quelque soit le niveau de profondeur dans l'arborescence des saisies. A passer uniquement lorsque la fonction s'appelle elle-même, pour gérer la récursion
 * @return array
 *               Tableau de descriptions de saisies
 */
function saisies_verifier_afficher_si($saisies, $env = null, $saisies_toutes_par_nom = array()) {
	if (!$saisies_toutes_par_nom) {
		$saisies = pipeline('saisies_afficher_si_saisies', $saisies);
		$saisies_toutes_par_nom = saisies_lister_par_nom($saisies);
	}
	// compat historique
	if (isset($saisies['options']['poster_afficher_si']) and !isset($saisies['options']['afficher_si_avec_post'])) {
		$saisies['options']['afficher_si_avec_post'] = $saisies['options']['poster_afficher_si'];
	}

	// eviter une erreur par maladresse d'appel :)
	if (!is_array($saisies)) {
		return array();
	}
	foreach ($saisies as $cle => $saisie) {
		if (
			isset($saisie['options']['afficher_si'])
		) {
			$condition = $saisie['options']['afficher_si'];
			// Est-ce uniquement au remplissage?
			if (isset($saisie['options']['afficher_si_remplissage_uniquement'])
				and $saisie['options']['afficher_si_remplissage_uniquement']=='on'){
				$remplissage_uniquement = true;
			} else {
				$remplissage_uniquement = false;
			}

			// On transforme en une condition PHP valide
			$ok = saisies_evaluer_afficher_si($condition, $env, $saisies_toutes_par_nom);
			if (!$ok) {
				saisies_afficher_si_liste_masquees('set', $saisie);//Retenir que la saisie a été masquée
				if ($remplissage_uniquement == false or is_null($env)) {
					unset($saisies[$cle]);
				}
				if (is_null($env)) {
					if ($saisie['saisie'] == 'explication') {//Une saisie explication masquée par afficher_si ne devrait rien retourner dans les syntaxe @truc@ dans formidable. Sans doute des choses à ameliorer pour que formidable ne soit pas obligé de faire un appel direct à saisies_verifier_afficher_si(). A voir lorsque la question se posera en pratique.
						unset($saisies[$cle]);
					} else {
						if (
							empty($saisies['options']['poster_afficher_si']) // option globale
							and empty($saisie['options']['afficher_si_avec_post']) // option de la saisie
						) {
							saisies_set_request_recursivement($saisie, '');
						}
					}
				}
			}
		}
		if (isset($saisies[$cle]['saisies'])) {
			// S'il s'agit d'un fieldset ou equivalent, verifier les sous-saisies
			$a_merger = isset($saisies['options']) ? array('options'=>$saisies['options']) : array();
			$saisies[$cle]['saisies'] = saisies_verifier_afficher_si(
				array_merge(
					$saisies[$cle]['saisies'],
					$a_merger),
				$env,
				$saisies_toutes_par_nom
			);
		}
	}
	return $saisies;
}



/**
 * Pose un set_request sur une saisie et toute ses sous-saisies.
 * Utiliser notamment pour annuler toutes les sous saisies d'un fieldeset
 * si le fieldset est masquée à cause d'un afficher_si.
 * @param array $saisie
 * @param null|str|array (defaut `''`)
**/
function saisies_set_request_recursivement($saisie, $val = '') {
	// Attention, tout champ peut être un sous-tableau !
	saisies_set_request($saisie['options']['nom'], $val);

	if (isset($saisie['saisies'])) {
		foreach ($saisie['saisies'] as $sous_saisie) {
			saisies_set_request_recursivement($sous_saisie, $val);
		}
	}
}

/**
 * Récupère la valeur d'un champ à tester avec afficher_si
 * Si le champ est de type @config:xx@, alors prend la valeur de la config
 * sinon en _request() ou en $env["valeurs"]
 * @param string $champ
 * @param null|array $env
 * @param array $saisies_par_nom
 *   Les saisies déjà classées par nom de champ
 * @return  la valeur du champ ou de la config
 **/
function saisies_afficher_si_get_valeur_champ($champ, $env, $saisies_par_nom) {
	$valeur = null;
	$plugin = saisies_afficher_si_evaluer_plugin($champ);
	$config = saisies_afficher_si_get_valeur_config($champ);
	$fichiers = false;
	$est_tabulaire = false;

	if (isset($saisies_par_nom[$champ])) {
		$fichiers = $saisies_par_nom[$champ]['saisie'] == 'fichiers';
		$est_tabulaire = saisies_saisie_est_tabulaire($saisies_par_nom[$champ]);
	}
	if ($plugin !== '') {
		$valeur = $plugin;
	} elseif ($config) {
		$valeur = $config;
	} elseif (is_null($env)) {
				if ($fichiers) {
					$precedent = saisies_request('cvtupload_fichiers_precedents');
					$precedent = $precedent[$champ];
					$valeur = saisies_request_property_from_FILES($champ, 'name');
				} else {
					$valeur = saisies_request($champ);
				}
	} else {
		$valeur = $env['valeurs'][$champ];
	}
	if ($fichiers) {
		if (!is_array($precedent)) {
			$precedent = array();
		}
		$valeur = array_merge($valeur, $precedent);
		$valeur = array_filter($valeur);
	}

	// On teste si on doit forcer que ce soit un tableau, suivant le type de la saisie
	if ($est_tabulaire) {
		$data = null;
		if (isset($saisies_par_nom[$champ]['options']['data'])) {
			$data = $saisies_par_nom[$champ]['options']['data'];
		} elseif (isset($saisies_par_nom[$champ]['options']['datas'])) {
			$data = $saisies_par_nom[$champ]['options']['datas'];
		}
		$valeur = saisies_valeur2tableau($valeur, $data);
	}

	return $valeur;
}


/**
 * Prend un test conditionnel,
 * le sépare en une série de sous-tests de type champ - operateur - valeur
 * remplace chacun de ces sous-tests par son résultat
 * renvoie la chaine transformé
 * @param string $condition
 * @param array|null $env
 *   Tableau d'environnement transmis dans inclure/voir_saisies.html,
 *   NULL si on doit rechercher dans _request (pour saisies_verifier()).
 * @param  array $saisies_par_nom
 *   Les saisies déjà classées par nom de champ
 * @param string|null $no_arobase une valeur à tester là où il devrait y avoir un @@
 * @return string $condition
**/
function saisies_transformer_condition_afficher_si($condition, $env = null, $saisies_par_nom = array(), $no_arobase=null) {
	if ($tests = saisies_parser_condition_afficher_si($condition, $no_arobase)) {
		if (!saisies_afficher_si_verifier_syntaxe($condition, $tests)) {
			spip_log("Afficher_si incorrect. $condition syntaxe_incorrecte", "saisies"._LOG_CRITIQUE);
			return '';
		}

		foreach ($tests as $test) {
			$expression = $test['expression'];
			if (!isset($test['booleen'])) {
				$nom_champ = $test['champ'];
				if (!$no_arobase) {
					$valeur_champ = saisies_afficher_si_get_valeur_champ($nom_champ, $env, $saisies_par_nom);
				} else {
					$valeur_champ = $no_arobase;
				}

				$total = isset($test['total']) ? $test['total'] : '';
				$operateur = isset($test['operateur']) ? $test['operateur'] : null;
				$negation = isset($test['negation']) ? $test['negation'] : '';

				if (isset($test['valeur'])) {
					$valeur = $test['valeur'];
				} else {
					$valeur = null;
				}

				if (!$saisies_par_nom or isset($saisies_par_nom[$nom_champ])) {
					$test_modifie = saisies_tester_condition_afficher_si($valeur_champ, $total, $operateur, $valeur, $negation) ? 'true' : 'false';
					$condition = str_replace($expression, $test_modifie, $condition);
				} else {
					$condition = '';// Si champ inexistant, on laisse tomber tout le tests
					spip_log("Afficher_si incorrect. Champ $nom_champ inexistant", "saisies"._LOG_CRITIQUE);
				}
			}
		}
	} else {
		if (!saisies_afficher_si_verifier_syntaxe($condition, $tests)) {
			spip_log("Afficher_si incorrect. $condition syntaxe_incorrecte", "saisies"._LOG_CRITIQUE);
			return '';
		}
	}

	return $condition;
}


/**
 * Evalue un afficher_si
 * @param string $condition (déjà checkée en terme de sécurité)
 * @param array|null $env
 *   Tableau d'environnement transmis dans inclure/voir_saisies.html,
 *   NULL si on doit rechercher dans _request (pour saisies_verifier()).
 * @param array $saisies_par_nom
 *   Les saisies déjà classées par nom de champ
 * @param string|null $no_arobase une valeur à tester là où il devrait y avoir un @@
 * @return bool le résultat du test
**/
function saisies_evaluer_afficher_si($condition, $env = null, $saisies_par_nom=array(), $no_arobase=null) {
	$condition = saisies_transformer_condition_afficher_si($condition, $env, $saisies_par_nom, $no_arobase);
	if ($condition) {
		eval('$ok = '.$condition.';');
	} else {
		$ok = true;
	}
	return $ok;
}

/**
 * Liste des saisies masquées par afficher_si dans le hit courant
 * @param str $action ('set'|'get'), defaut 'get';
 * @param array $saisie complète
 * @return array|null
**/
function saisies_afficher_si_liste_masquees($action = 'get', $saisie = '') {
	static $tableau = array();
	if ($action === 'set') {
		$tableau[] = $saisie;
	} elseif ($action === 'get') {
		return $tableau;
	}
}
