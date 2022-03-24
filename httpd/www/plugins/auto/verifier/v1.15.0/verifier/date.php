<?php
/**
 * API de vérification : vérification de la validité d'une date
 *
 * @plugin     verifier
 * @copyright  2018
 * @author     Les Développements Durables
 * @licence    GNU/GPL
 */

// Sécurité
if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

/**
 * Une date au format JJ/MM/AAAA (avec séparateurs souples : espace / - .)
 * Options :
 * - format : permet de préciser le format de la date  jma pour jour/mois/année (par défaut), mja (pour mois / jour / année), amj (année/mois/jour)
 *
 * @param string|array $valeur
 *   La valeur à vérifier, en chaîne pour une date seule, en tableau contenant deux entrées "date" et "heure" si on veut aussi l'heure
 * @param array $options
 *   tableau d'options.
 * @param null $valeur_normalisee
 *   Si normalisation a faire, la variable sera rempli par la date normalisee.
 * @return string
 *   Retourne une chaine vide si c'est valide, sinon une chaine expliquant l'erreur.
 */
function verifier_date_dist($valeur, $options = array(), &$valeur_normalisee = null) {
	$erreur = _T('verifier:erreur_date_format');
	$horaire = false; // par défaut on ne teste qu'une date

	// Si ce n'est ni une chaîne ni un tableau : pas le bon format
	if (!is_string($valeur) and !is_array($valeur)) {
		return $erreur;
	}
	// Format par defaut
	if (!isset($options['format'])) {
		$options['format'] = 'jma';
	}
	$format_php = verifier_date_format_spip2php($options['format']);

	// Cela se trouve, ca a deja été normalisé à l'étape précédente en CVT-multietape
	if (
		isset($options['normaliser'])
		and $options['normaliser'] == 'datetime'
		and $valeur === normaliser_date_datetime_dist($valeur, $options, $on_sen_fiche)
		)	{
		return '';
	}
	// Si c'est un tableau
	if (is_array($valeur)) {
		// S'il y a l'heure sans la date principale, c'est directement erreur
		if (!isset($valeur['date']) and isset($valeur['heure'])) {
			return _T('verifier:erreur_date_format_date_vide');
		}
		// S'il y a au moins la date ok
		elseif (isset($valeur['date']) and is_string($valeur['date'])) {
			$horaire = true; // on détecte une vérif avec horaire uniquement dans ce cas

			// Si on trouve une heure donnée
			if (isset($valeur['heure']) and is_string($valeur['heure'])) {
				$options['heure'] = $valeur['heure']; // l'heure pour la fonction de normalisation
			}
			// Sinon on met l'heure à minuit
			else {
				$options['heure'] = '00:00';
			}

			$valeur = $valeur['date']; // valeur principale pour la date
		}
		// Sinon c'est une date vide, et on a tout à fait le droit !
		// (sinon on aurait mis "obligatoire", et c'est pris en compte par Saisies avant)
		else {
			$valeur = null;
		}
	}

	// On ne fait tout la suite que s'il y a une date
	// car comme on peut vouloir normaliser, il est possible d'être dans cette fonction avec une date vide
	if ($valeur) {
		$valeur = preg_replace('#\.|/| #i', '-', $valeur);
		if (!$date = DateTime::createFromFormat($format_php, $valeur)) {//On arrive pas à créer l'objet, c'est que ce n'est pas le bon format
			return $erreur;
		}
		if ($date->format($format_php) !== $valeur) {//Ce petit coquin de PHP peut avoir transformé 2021-22-03 en 2021-10-22
			return _T('verifier:erreur_date');;
		}

		if ($horaire) {
			// Format de l'heure
			$options['heure'] = str_replace(array('h','m','min'), array(':','',''), $options['heure']);
			if (!preg_match('#^([0-9]{1,2}):([0-9]{1,2})$#', $options['heure'], $hetm)) {
				return _T('verifier:erreur_heure_format');
			} else {
				// Si c'est le bon format, on teste si les nombres donnés peuvent exister
				$heures = intval($hetm[1]);
				$minutes = intval($hetm[2]);
				if ($heures < 0 or $heures > 23 or $minutes < 0 or $minutes > 59) {
					return _T('verifier:erreur_heure');
				} else {
					// Si tout est bon pour l'heure, on recompose en ajoutant des 0 si besoin
					$options['heure'] = sprintf('%02d:%02d', $heures, $minutes);
				}
			}
		}
	}

	// Normaliser si demandé
	$ok = '';
	if (isset($options['normaliser']) and $options['normaliser'] == 'datetime') {
		$valeur_normalisee = normaliser_date_datetime_dist($valeur, $options, $ok);
	}

	return $ok;
}

/**
 * Convertir une date en datetime
 *
**/
function normaliser_date_datetime_dist($valeur, $options, &$erreur) {
	$defaut = '0000-00-00 00:00:00';
	if (!$valeur or $valeur==array('date'=>'','heure'=>'')) {
		return $defaut;
	}
	// Sécurité, ca se trouve ca a deja été normalisé
	if (!is_array($valeur)) {
		if (DateTime::createFromFormat('Y-m-d H:i:s', $valeur)) {
			return $valeur;
		}  elseif ($date = DateTime::createFromFormat('Y-m-d', $valeur)) {
			return $date->format('Y-m-d H:i:s');
		}
	}

	$date = str_replace('/', '-', $valeur); // formater avec -, pour les premiers tests
	if (isset($options['heure'])) {
		$date .= (' ' . $options['heure'] . ':00');
	} elseif (isset($options['fin_de_journee'])) {
		$date .= ' 23:59:59';
	}
	else {
		$date .= ' 00:00:00';
	}
	$format_php_input = verifier_date_format_spip2php($options['format']).' H:i:s';

	if(!$date = DateTime::createFromFormat($format_php_input, $date)) {
		$erreur = "Impossible d'extraire la date de $valeur";
		return false;
	}

	$date = $date->format('Y-m-d H:i:s');

	include_spip('inc/filtres');
	$date = vider_date($date); // enlever les valeurs considerees comme nulles (1 1 1970, etc...)

	if (!$date) {
		$date = $defaut;
	}

	return $date;
}

/**
 * Convertir une description de format SPIP en description de format PHP
 * @param str $format
 * @return str
**/
function verifier_date_format_spip2php($format) {
	$equivalence = array(
		'jma' => 'd-m-Y',
		'mja' => 'm-d-Y',
		'amj' => 'Y-m-d'
	);
	return $equivalence[$format];
}
