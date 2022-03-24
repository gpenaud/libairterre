<?php

/**
 * Oautils pour faciliter la construction de formulaires CVT sous formes de listes de saisies
 *
 * @package SPIP\Saisies\Saisies
**/

// Sécurité
if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}


/**
 * Cherche la description des saisies d'un formulaire CVT dont on donne le nom
 *
 * @param string $form Nom du formulaire dont on cherche les saisies
 * @param array $args Tableau d'arguments du formulaire
 * @return array Retourne les saisies du formulaire sinon false
 */
function saisies_chercher_formulaire($form, $args, $je_suis_poste=false) {
	$saisies = array();

	if ($fonction_saisies = charger_fonction('saisies', 'formulaires/'.$form, true)) {
		$saisies = call_user_func_array($fonction_saisies, $args);
	}

	// Si on a toujours un tableau, on passe les saisies dans un pipeline normé comme pour CVT
	if (is_array($saisies)) {
		$saisies = pipeline(
			'formulaire_saisies',
			array(
				'args' => array('form' => $form, 'args' => $args, 'je_suis_poste' => $je_suis_poste),
				'data' => $saisies
			)
		);
	}

	if (!is_array($saisies)) {
		$saisies = false;
	}

	return $saisies;
}


/**
 * Génère un nom unique pour un champ d'un formulaire donné
 *
 * @param array $formulaire
 *     Le formulaire à analyser
 * @param string $type_saisie
 *     Le type de champ dont on veut un identifiant
 * @return string
 *     Un nom unique par rapport aux autres champs du formulaire
 */
function saisies_generer_nom($formulaire, $type_saisie) {
	$champs = saisies_lister_champs($formulaire);

	// Tant que type_numero existe, on incrémente le compteur
	$compteur = 1;
	while (array_search($type_saisie.'_'.$compteur, $champs) !== false) {
		$compteur++;
	}

	// On a alors un compteur unique pour ce formulaire
	return $type_saisie.'_'.$compteur;
}


