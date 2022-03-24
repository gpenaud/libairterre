<?php

/**
 * Gestion des request (get/set) avec saisies
 * Tenir compte notamment de :
 *  - name tabulaire du style `toto[truc][bidule]`
 *  - saisies fichiers où il faut chercher dans _$FILES
 *
 * @package SPIP\Saisies\Saisies_request
**/

// Sécurité
if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}



/**
 * Trouve le résultat d'une saisie (_request())
 * en tenant compte du fait que la saisie peut être décrit sous forme de sous entrées d'un tableau
 *
 * @todo Prendre en compte aussi la notation champ/index/index
 * @param string $champ
 * 		Nom du champ de la saisie, y compris avec crochets pour sous entrées
 * @param null|array $tableau
 *		Tableau où chercher, à defaut get/post
 * @return string|array
 * 		Résultat du _request()
**/
function saisies_request($champ, $tableau = null) {
	if (preg_match('/([\w]+)((\[[\w]+\])+)/', $champ, $separe)) {
		if ($tableau) {
			$valeur = $tableau[$separe[1]];
		} else {
			$valeur = _request($separe[1]);
		}
		preg_match_all('/\[([\w]+)\]/', $separe[2], $index);
		// On va chercher au fond du tableau
		foreach ($index[1] as $cle) {
			$valeur = isset($valeur[$cle]) ? $valeur[$cle] : null;
		}
	} else {
		// Sinon la valeur est juste celle du champ
		if ($tableau) {
			$valeur = $tableau[$champ];
		} else {
			$valeur = _request($champ);
		}
	}

	return $valeur;
}

/**
 * Trouve le sous tableau de $_FILES correspondant à champ,
 * en prenant en compte CVT-Upload
 * @param string $champ
 * @return array|null
**/
function saisies_request_from_FILES($champ) {

	$infos_fichiers_precedents = _request('cvtupload_fichiers_precedents');
	if (isset($infos_fichiers_precedents[$champ])) { // si on a déjà envoyé des infos avants
		$valeur = $_FILES[$champ]; // on ne met pas true, car il faudra aussi vérifier les nouveaux fichiers du même champ qui viennent d'être envoyés.
	}
	elseif (isset($_FILES[$champ]['error'])) {//si jamais on a déja envoyé quelque chose dans le précédent envoi = ok
		$valeur = null; //On considère que par défaut on a envoyé aucun fichiers

		// Si c'est un champ unique
		if (!is_array($_FILES[$champ]['error']) and $_FILES[$champ]['error'] != 4) {
			$valeur = $_FILES[$champ];
		}
		elseif (is_array($_FILES[$champ]['error'])) {
			foreach ($_FILES[$champ]['error'] as $err) {
				if ($err != 4) {
					//Si un seul fichier a été envoyé, même avec une erreur,
					// on considère que le critère obligatoire est rempli.
					// Il faudrait que verifier/fichiers.php vérifier les autres types d'erreurs.
					// Voir http://php.net/manual/fr/features.file-upload.errors.php
					$valeur = $_FILES[$champ];
					break;
				}
			}
		}
	}
	elseif (!isset($_FILES[$champ])) {
		$valeur = null;
	}
	return $valeur;
}

/**
 * Trouve une propriété d'un fichier uploadé au sein d'un $_FILES
 * en tenant compte du fait que la saisie peut être décrit sous forme de sous entrées d'un tableau ET que dans ce cas la structure PHP de $_FILES est totalement aberrant
 *
 * @todo Prendre en compte aussi la notation champ/index/index
 * @param string $champ
 * 		Nom du champ de la saisie, y compris avec crochets pour sous entrées
 * @param string $property
 * @return string|array
 * 		Résultat du _request()
 **/
function saisies_request_property_from_FILES($champ, $property = 'name') {
	// Si le nom du champ est un tableau indexé, il faut parser !
	if (preg_match('/([\w]+)((\[[\w]+\])+)/', $champ, $separe)) {
		$files = saisies_request($champ, array($separe[1] => $_FILES[$separe[1]][$property]));
		if (is_null($files)) {
			$files = array();
		}
	} else {
		$files = isset($_FILES[$champ][$property]) ? $_FILES[$champ][$property] : array();
	}
	return $files;
}

/**
 * Modifie la valeur d'un saisie postée en tenant compte que ça puisse être un tableau
 *
 * @todo Prendre en compte aussi la notation champ/index/index
 * @todo Prendre un arg en plus pour enregistrer la valeur dans un autre tableau que le GET/POST
 * @param string $nom
 * 		Nom du champ
 * @param $valeur
 * 		Valeur à remplir dans le request
 * @return void
 */
function saisies_set_request($champ, $valeur) {
	// Si on détecte que c'est un tableau[index][index]
	if (preg_match('/([\w]+)((\[[\w]+\])+)/', $champ, $separe)) {
		$nom_champ_principal = $separe[1];
		$champ_principal  = _request($nom_champ_principal);
		$enfant = &$champ_principal;

		// On va chercher au fond du tableau
		preg_match_all('/\[([\w]+)\]/', $separe[2], $index);
		foreach ($index[1] as $cle) {
			$enfant = &$enfant[$cle];
		}
		// Une fois descendu tout en bas, on met la valeur
		$enfant = $valeur;
		// Et on reinjecte le tout
		saisies_liste_set_request('get', $nom_champ_principal, $champ_principal);
		set_request($nom_champ_principal, $champ_principal);
	}
	// Sinon la valeur est juste celle du nom
	else {
		saisies_liste_set_request('get', $champ, $champ);
		set_request($champ, $valeur);
	}
}

/**
 * Pour chaque champ, sauvegarde l'historique de ses valeurs avant que set_request
 * Utilisé notamment par formidable pour trouver les saisies qui été mises à ''
 * @param string $action 'set|get'
 * @param string $champ
 * @param string $nouvelle_valeur
 * @return (si action = get) un tableau associatif
 *	- '<champ>' => ['valeur_initiale', 'valeur_modifiee1', 'valeur_modifiee2'
**/
function saisies_liste_set_request($action = 'set', $champ = 'null', $nouvelle_valeur = '') {
	static $cache = array();
	if ($action === 'get') {
		return $cache;
	} else {
		if (!isset($cache[$champ])) {
			$cache[$champ] = saisies_request($champ);
		}
		$cache[$champ] = array_merge($cache[$champ], array($nouvelle_valeur));
	}
}


/**
 * Chercher la valeur d'une saisie, en tenant compte du fait que potentiellement c'est une saisies fichiers
 * @param array $saisie
 * @return string|array $valeur
 **/
function saisies_get_valeur_saisie($saisie) {
	$champ = $saisie['options']['nom'];
	$file = saisies_saisie_est_fichier($saisie);

	// Cas de la saisie 'fichiers':
	if ($file) {
		$valeur = saisies_request_from_FILES($champ);
	}
	// Tout type de saisie, sauf fichiers
	else {
		$valeur = saisies_request($champ);
		// Filtrer les tableaux. Ex d'application:
		// - saisie date/heure qui envoi des input texte en tableau > il faut pas que les champs envoyés soient vides
		// - saisie destinataire, qui pourrait avoir une première option vide
		if (is_array($valeur)) {
			$valeur = array_filter($valeur);
		}
	}
	return $valeur;
}
