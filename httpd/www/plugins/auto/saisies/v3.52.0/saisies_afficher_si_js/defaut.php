<?php

/** Gestion de l'affichage conditionnelle des saisies.
 * Partie spécifique js
 *
 * @package SPIP\Saisies\afficher_si_js\defaut
 **/


if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}
/**
 * Generation du js d'afficher_si par défaut
 * @param array $parse analyse syntaxique du tests à effectuer (sous tableau de résultat de saisies_parser_condition_afficher_si())
 * @param array $saisies_form ensemble des saisies du formulaire, listées par nom
**/
function saisies_afficher_si_js_defaut($parse, $saisies_form) {
	// Etape 1 : nettoyer parse pour ne pas garder les clés numérique, mais uniquement les clés string, qui permettent reellement de savoir ce qu'il faut faire.
	$negation = $parse['negation'];
	unset($parse['negation']);

	// Compatibilité historique de syntaxe, avant que l'on mette tout en JSON, on envoyait directement RegExp(valeur), il fallait donc que les // soitsentsdans valeur. Mais désormais on envoie en JSON, donc on a un string, donc il faut enlever les slashs avant d'envoyer au JS
	if (isset($parse['operateur'])
		and
		($parse['operateur'] === 'MATCH' or $parse['operateur'] === '!MATCH')
	) {
		include_spip('inc/saisies_afficher_si_commun');

		$m = afficher_si_parser_valeur_MATCH($parse['valeur']);

		$parse['valeur'] = $m['regexp'];
		$parse['regexp_modif'] = $m['regexp_modif'];
	}
	$parse = json_encode($parse);
	return $negation.'afficher_si('.$parse.')';
}
