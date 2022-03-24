<?php

/**
 * Gestion de l'affichage conditionnelle des saisies.
 * Partie spécifique js
 *
 * @package SPIP\Saisies\Afficher_si_js
**/

// Sécurité
if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

include_spip('inc/saisies_afficher_si_commun');
include_spip('inc/saisies_lister');
/**
 * Transforme une condition afficher_si en condition js
 * @param string $condition
 * @param array $saisies_form les saisies du même formulaire. Nécessaire pour savoir quel type de test js on met.
 * @return string
**/
function saisies_afficher_si_js($condition, $saisies_form = array()) {
	if (!$condition) {
		return '';
	}
	$saisies_form = pipeline('saisies_afficher_si_saisies', $saisies_form);
	$saisies_form = saisies_lister_par_nom($saisies_form);
	if ($tests = saisies_parser_condition_afficher_si($condition)) {
		if (!saisies_afficher_si_verifier_syntaxe($condition, $tests)) {
			spip_log("Afficher_si incorrect. $condition syntaxe incorrecte", "saisies"._LOG_CRITIQUE);
			return '';
		}
		foreach ($tests as $test) {
			$expression = $test['expression'];
			unset($test['expression']);// Les les fonctions saisies_afficher_si_js n'ont pas besoin de l'expression qui est deja parsée, et cela évite qu'elles l'insèrent dans le js, avec le risque du coup de remplacement recursif et du coup de saisie js invalide.
			$negation = isset($test['negation']) ? $test['negation'] : '' ;
			$champ = isset($test['champ']) ? $test['champ'] : '' ;
			$total = isset($test['total']) ? $test['total'] : '';
			$operateur = isset($test['operateur']) ? $test['operateur'] : '' ;
			$negation = isset($test['negation']) ? $test['negation'] : '';
			$booleen = isset($test['booleen']) ? $test['booleen'] : '';
			$valeur = isset($test['valeur']) ? $test['valeur'] : '' ;
			$valeur_numerique = isset($test['valeur_numerique']) ? $test['valeur_numerique'] : '' ;
			$plugin = saisies_afficher_si_evaluer_plugin($champ, $negation);
			if ($plugin !== '') {
				$condition = str_replace($expression, $plugin ? 'true' : 'false', $condition);
			} elseif (stripos($champ, 'config:') !== false) {
				$config = saisies_afficher_si_get_valeur_config($champ);
				$test_modifie = eval('return '.saisies_tester_condition_afficher_si($config, $total, $operateur, $valeur, $negation).';') ? 'true' : 'false';
				$condition = str_replace($expression, $test_modifie, $condition);
			} elseif ($booleen)  {
				$condition = $condition;
			} else { // et maintenant, on rentre dans le vif du sujet : les champs. On délégue cela à une autre fonction
				if (!isset($saisies_form[$champ])) {//La saisie conditionnante n'existe pas pour ce formulaire > on laisse tomber
					spip_log("Afficher_si incorrect. Champ $champ inexistant", "saisies"._LOG_CRITIQUE);
					$condition = '';
				} else {
					if (!$type_saisie = $saisies_form[$champ]['saisie']) {
						$type_saisie = 'defaut';
					}
					if (!$f = charger_fonction($type_saisie, 'saisies_afficher_si_js', true)) {
						$f = charger_fonction('defaut', 'saisies_afficher_si_js');
					}
					$condition = str_replace($expression, $f($test, $saisies_form), $condition);
				}
			}
		}
	} else {
		if (!saisies_afficher_si_verifier_syntaxe($condition)) {
			spip_log("Afficher_si incorrect. $condition syntaxe incorrecte", "saisies"._LOG_CRITIQUE);
			return '';
		}
	}
	return str_replace('"', "&quot;", $condition);
}

