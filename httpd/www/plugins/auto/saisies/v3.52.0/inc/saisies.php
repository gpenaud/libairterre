<?php

/**
 * Gestion des saisies
 *
 * @package SPIP\Saisies\Saisies
**/

// Sécurité
if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

// Différentes méthodes pour trouver les saisies
include_spip('inc/saisies_lister');

// Différentes méthodes pour trouver les saisies avec un .yaml
include_spip('inc/saisies_lister_disponibles');

// Différentes méthodes pour manipuler une liste de saisies
include_spip('inc/saisies_manipuler');

// Les outils pour identifier les saisies de manière stables
include_spip('inc/saisies_identifiants');

// Les outils pour vérifier les saisies
include_spip('inc/saisies_verifier');

// Les outils pour trouver la valeur d'un champ posté depuis une saisies
include_spip('inc/saisies_request');

// Les outils pour afficher les saisies et leur vue
include_spip('inc/saisies_afficher');

// Les outils pour manipuler les options data
include_spip('inc/saisies_data');

// Les outils pour l'affichage conditionnelle des saisies
include_spip('inc/saisies_afficher_si_php');

// Les outils pour l'aide
include_spip('inc/saisies_aide');

// Les outils pour faciliter la construction de formulaires CVT sous formes de listes de saisies
include_spip('inc/saisies_formulaire');




