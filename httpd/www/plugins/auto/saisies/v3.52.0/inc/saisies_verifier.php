<?php

/**
 * Gestion de la verification des saisies
 *
 * @package SPIP\Saisies\Verifier
**/

// Sécurité
if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}


/**
 * Vérifier tout un formulaire tel que décrit avec les Saisies
 *
 * @param array $formulaire Le formulaire à vérifier, c'est à dire un tableau de saisies, avec éventuellement une clé options
 * @param bool $saisies_empty_string Si TRUE, les saisies masquées selon afficher_si ne seront pas verifiées, leur valeur étant forcée a `''`. Cette valeur est transmise à traiter (via set_request).
 * @param array &$erreurs_fichiers pour les saisies de type fichiers, un tableau qui va stocker champs par champs, puis fichier par fichier, les erreurs de chaque fichier, pour pouvoir ensuite éventuellement supprimer les fichiers erronées de $_FILES
 * @return array Retourne un tableau d'erreurs
 */
function saisies_verifier($formulaire, $saisies_masquees_empty_string = true, &$erreurs_fichiers = array()) {
	include_spip('inc/verifier');
	$verif_fonction = charger_fonction('verifier', 'inc', true);

	if ($saisies_masquees_empty_string) {
		$saisies_par_nom = saisies_lister_par_nom(saisies_verifier_afficher_si($formulaire));
		$erreurs = saisies_verifier_obligatoire($saisies_par_nom);
	} else {
		$saisies_par_nom = saisies_lister_par_nom($formulaire);
		$erreurs = saisies_verifier_obligatoire($saisies_par_nom);
	}
	foreach ($saisies_par_nom as $saisie) {
		$champ = $saisie['options']['nom'];
		if (isset($saisie['verifier']) and $saisie['verifier']) {
			$verifier = $saisie['verifier'];
		} else {
			$verifier = false;
		}
		// On continue seulement si ya pas d'erreur d'obligation et qu'il y a une demande de verif
		if ((!isset($erreurs[$champ]) or !$erreurs[$champ]) and is_array($verifier) and $verif_fonction) {
			// Si on fait une vérification de type fichiers, il n'y a pas vraiment de normalisation, mais un retour d'erreur fichiers par fichiers
			if ($verifier['type'] == 'fichiers') {
				$normaliser = array();
			} else {
				$normaliser = null;
			}
			$valeur = saisies_get_valeur_saisie($saisie);
			$options = isset($verifier['options']) ? $verifier['options'] : array();
			if ($erreur_eventuelle = $verif_fonction($valeur, $verifier['type'], $options, $normaliser)) {
				$erreurs[$champ] = $erreur_eventuelle;
			// Si le champ n'est pas valide par rapport au test demandé, on ajoute l'erreur

				if ($verifier['type'] == 'fichiers') { // Pour les vérification/saisies de type fichiers, ajouter les erreurs détaillées par fichiers dans le tableau des erreurs détaillées par fichier
					$erreurs_fichiers[$champ] = $normaliser;
					if (isset($saisies[$champ]['options']['obligatoire'])) {
						$erreurs[$champ].= "<br />"._T('saisies:fichier_erreur_explication_renvoi_pas_alternative');
					} else {
						$erreurs[$champ].= "<br />"._T('saisies:fichier_erreur_explication_renvoi_alternative');
					}
				}

			}
			// S'il n'y a pas d'erreur et que la variable de normalisation a été remplie, on l'injecte dans le POST
			elseif (!is_null($normaliser) and $verifier['type'] != 'fichiers') {
				// Si le nom du champ est un tableau indexé, il faut parser !
				saisies_set_request($champ, $normaliser);
			}
		}
	}
	// Vérifier que les valeurs postées sont acceptables, à savoir par exemple que pour un select, ce soit ce qu'on a proposé.
	if (isset($formulaire['options']['verifier_valeurs_acceptables'])
		and $formulaire['options']['verifier_valeurs_acceptables']
	) {
		$erreurs = saisies_verifier_valeurs_acceptables($saisies_par_nom, $erreurs);
	}

	// Last but not least, on passe nos résultats à un pipeline
	$erreurs = pipeline(
		'saisies_verifier',
		array(
			'args'=>array(
				'formulaire' => $formulaire,
				'saisies' => $saisies_par_nom,
				'erreurs_fichiers' => $erreurs_fichiers,
			),
			'data' => $erreurs
		)
	);

	return $erreurs;
}

/**
 * Vérifier que les saisies obligatoires (après filtrage de celles masquées par afficher_si) sont bien remplies.
 * @param array $saisies_par_nom
 * @return array erreurs
**/
function saisies_verifier_obligatoire($saisies_par_nom) {
	unset($saisies_par_nom['options']);
	$erreurs = array();
	foreach ($saisies_par_nom as $saisie) {
		$champ = $saisie['options']['nom'];
		$valeur = saisies_get_valeur_saisie($saisie);
		$obligatoire = isset($saisie['options']['obligatoire']) ? $saisie['options']['obligatoire'] : '';
		$file = saisies_saisie_est_fichier($saisie);
		if (
			$obligatoire
			and $obligatoire != 'non'
			and (
				($file and $valeur==null)
				or (!$file and (
					is_null($valeur)
					or (is_string($valeur) and trim($valeur) == '')
					or (is_array($valeur) and count($valeur) == 0)
				))
			)
		) {
			$erreurs[$champ] =
				(isset($saisie['options']['erreur_obligatoire']) and $saisie['options']['erreur_obligatoire'])
				? _T_ou_typo($saisie['options']['erreur_obligatoire'])
				: _T('info_obligatoire');
		}
		if (isset($saisie['saisies'])) {
			$erreurs = array_merge($erreurs, saisies_verifier_obligatoire($saisie['saisies']));
		}
	}
	return $erreurs;
}


/**
 * Vérifier que les valeurs postées sont acceptables,
 * c'est-à-dire qu'elles ont été proposées lors de la conception de la saisie.
 * Typiquement pour une saisie radio, vérifier que les gens n'ont pas postée une autre fleur.
 * @param $saisies array tableau général des saisies, déjà aplati, classé par nom de champ
 * @param $erreurs array tableau des erreurs
 * @return array table des erreurs modifiés
**/
function saisies_verifier_valeurs_acceptables($saisies, $erreurs) {
	foreach ($saisies as $saisie => $description) {
		$type = $description['saisie'];

		// Pas la peine de vérifier si par ailleurs il y a déjà une erreur
		if (isset($erreurs[$saisie])) {
			continue;
		}
		//Il n'y a rien à vérifier sur une description / fieldset
		if (in_array($description['saisie'], array('explication','fieldset'))) {
			continue;
		}
		if (include_spip("saisies/$type")) {
			$f = $type.'_valeurs_acceptables';
			if (function_exists($f)) {
				$valeur = saisies_request($saisie);
				if (!$f($valeur, $description)) {
					$erreurs[$saisie] = _T("saisies:erreur_valeur_inacceptable");
					spip_log("Tentative de poste de valeur innaceptable pour $saisie de type $type. Valeur postée : ".print_r(_request($saisie), true), "saisies"._LOG_AVERTISSEMENT);
				}
			} else {
				spip_log("Pas de fonction de vérification pour la saisie $saisie de type $type", "saisies"._LOG_INFO);
			}
		} else {
			spip_log("Pas de fonction de vérification pour la saisie $saisie de type $type", "saisies"._LOG_INFO);
		}
	}
	return $erreurs;
}
