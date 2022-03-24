<?php

/**
 * Gestion de l'identification pérenne des saisies
 *
 * @package SPIP\Saisies\Identifiants
**/

// Sécurité
if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}


/**
 * Crée un identifiant Unique
 * pour la saisie donnee si elle n'en a pas
 * (et pour ses sous saisies éventuels)
 *
 * @param Array $saisie Tableau d'une saisie
 * @param Bool $regenerer Régénère un nouvel identifiant pour la saisie ?
 * @return Array Tableau de la saisie complété de l'identifiant
**/
function saisie_identifier($saisie, $regenerer = false) {
	if (!isset($saisie['identifiant']) or !$saisie['identifiant']) {
		$saisie['identifiant'] = uniqid('@');
	} elseif ($regenerer) {
		$saisie['identifiant'] = uniqid('@');
	}
	if (isset($saisie['saisies']) and is_array($saisie['saisies'])) {
		$saisie['saisies'] = saisies_identifier($saisie['saisies'], $regenerer);
	}

	return $saisie;
}


/**
 * Crée un identifiant Unique
 * pour toutes les saisies donnees qui n'en ont pas
 *
 * @param Array $saisies Tableau de saisies
 * @param Bool $regenerer Régénère un nouvel identifiant pour toutes les saisies ?
 * @return Array Tableau de saisies complété des identifiants
 */
function saisies_identifier($saisies, $regenerer = false) {
	if (!is_array($saisies)) {
		return array();
	}

	foreach ($saisies as $k => $saisie) {
		if ($k !== 'options') {
			$saisies[$k] = saisie_identifier($saisie, $regenerer);
		}
	}

	return $saisies;
}



/**
 * Supprimer récursivement les identifiants d'un tableau de saisie
 * Seul usage probable : pour les test uniaires
 * pour la saisie donnee si elle n'en a pas
 * (et pour ses sous saisies éventuels)
 *
 * @param Array $saisie Tableau d'une saisie
 * @return Array Tableau de la saisie sans les identifiant
**/
function saisies_supprimer_identifiants($saisies) {
	unset($saisies['identifiant']);
	foreach ($saisies as $cle => $valeur) {
		if (is_array($valeur)) {
			$saisies[$cle] = saisies_supprimer_identifiants($valeur);
		}
	}
	return $saisies;
}
