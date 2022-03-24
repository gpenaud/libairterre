<?php

/**
 * Gestion de l'aide des saisies
 *
 * @package SPIP\Saisies\Aide
**/

// Sécurité
if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}


/**
 * Génère une page d'aide listant toutes les saisies et leurs options
 *
 * Retourne le résultat du squelette `inclure/saisies_aide` auquel
 * on a transmis toutes les saisies connues.
 *
 * @return string Code HTML
 */
function saisies_generer_aide() {
	// On a déjà la liste par saisie
	$saisies = saisies_lister_disponibles('saisies',false);

	// On construit une liste par options
	$options = array();
	foreach ($saisies as $type_saisie => $saisie) {
		$options_saisie = saisies_lister_par_nom($saisie['options'], false);
		if (isset($options_saisie['datas'])) {
			$options_saisie['data'] = $options_saisie['datas'];
			unset($options_saisie['datas']);
		}
		foreach ($options_saisie as $nom => $option) {
			if (isset($option['options']['datas'])) {
				$option['options']['data'] = $option['options']['datas'];
				unset($option['options']['datas']);
			}
			// Si l'option n'existe pas encore
			if (!isset($options[$nom])) {
				$options[$nom] = _T_ou_typo($option['options']);
			}
			// On ajoute toujours par qui c'est utilisé
			$options[$nom]['utilisee_par'][] = $type_saisie;
		}
		ksort($options_saisie);
		$saisies[$type_saisie]['options'] = $options_saisie;
	}
	ksort($options);

	return recuperer_fond(
		'inclure/saisies_aide',
		array(
			'saisies' => saisies_regrouper_disponibles_par_categories($saisies),
			'options' => $options
		)
	);
}

