<?php

// Sécurité
if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}


/**
 * Formulaire permettant de construire un formulaire  ! En agençant des champs
 * Chargement.
 * @param string $identifiant identifiant unique du formulaire
 * @param array $formulaires_initial, formulaire initial (par exemple si on modifie un formulaire déjà construit)
 * @param array $options tableau d'options
 *		- array options_globales : proposer des options globales pour le formulaire, liste de ces options
 *		- array saisies_exclues : liste des saisies à ne pas proposer (= à exclure du choix)
 *		- bool uniquement_sql : ne proposer que les saisies qui permettent de remplir un champ sql
 * @return array $contexte
**/
function formulaires_construire_formulaire_charger($identifiant, $formulaire_initial = array(), $options = array()) {
	include_spip('inc/saisies');
	$contexte = array();

	// On ajoute un préfixe devant l'identifiant, pour être sûr
	$identifiant = 'constructeur_formulaire_'.$identifiant;
	$contexte['_identifiant_session'] = $identifiant;

	// On vérifie ce qui a été passé en paramètre
	if (!is_array($formulaire_initial)) {
		$formulaire_initial = array();
	}

	// On s'assure que toutes les saisies ont un identifiant (en cas de bug lors de la création, par ex.)
	$formulaire_initial = saisies_identifier($formulaire_initial);

	// Construire le md5 du paramètre $formulaire_initial, et trouver celui qu'on avait stocké
	$md5_formulaire_initial = md5(serialize($formulaire_initial));
	$md5_precedent_formulaire_initial = session_get($identifiant.'_md5_formulaire_initial');

	// Si pas de session, on prend le formulaire initial comme formulaire actuel,
	// ou bien si la session est trop trop veille, on prend le formulaire initial comme formulaire
	if (
		is_null($formulaire_actuel = session_get($identifiant))
		or
		($md5_precedent_formulaire_initial
		and
		$md5_formulaire_initial != $md5_precedent_formulaire_initial and $_SERVER['REQUEST_METHOD'] === 'GET')
	) {
		session_set($identifiant, $formulaire_initial);
		session_set($identifiant.'_md5_formulaire_initial', $md5_formulaire_initial);
		$formulaire_actuel = $formulaire_initial;
	}

	// Si le formulaire actuel est différent du formulaire initial on agite un drapeau pour le dire
	if ($formulaire_actuel != $formulaire_initial) {
		$contexte['formulaire_modifie'] = true;
	}
	$contexte['_message_attention'] = _T('saisies:construire_attention_modifie');

	// On passe ça pour l'affichage
	$contexte['_contenu'] = $formulaire_actuel;

	// On passe ça pour la récup plus facile des champs
	$contexte['_saisies_par_nom'] = saisies_lister_par_nom($formulaire_actuel);
	// Pour déclarer les champs modifiables à CVT
	foreach (array_keys($contexte['_saisies_par_nom']) as $nom) {
		$contexte["saisie_modifiee_$nom"] = array();
	}

	// La liste des options globales qu'on peut configurer, si elles existent
	if (isset($options['options_globales']) and is_array($options['options_globales'])) {
		$contexte['_activer_options_globales'] = true;
		if (isset($formulaire_actuel['options'])) {
			$contexte['options_globales'] = $formulaire_actuel['options'];
		}
		else {
			$contexte['options_globales'] = array();
		}
	}

	// La liste des saisies
	if (isset($options['uniquement_sql']) and $options['uniquement_sql']) {
		$saisies_disponibles = saisies_lister_disponibles_sql('saisies',false);
	} else {
		$saisies_disponibles = saisies_lister_disponibles('saisies', false);
	}
	if (isset($options['saisies_exclues']) and  is_array($options['saisies_exclues'])) {
		$saisies_disponibles = array_diff_key($saisies_disponibles, array_flip($options['saisies_exclues']));
	}
	$contexte['_saisies_disponibles_par_categories'] = saisies_regrouper_disponibles_par_categories($saisies_disponibles);

	// La liste des groupes de saisies
	$saisies_groupes_disponibles = saisies_groupes_lister_disponibles('saisies/groupes');
	$contexte['_saisies_groupes_disponibles'] = $saisies_groupes_disponibles;

	$contexte['fond_generer'] = 'formulaires/inc-generer_saisies_configurables';

	// On cherche jquery UI pour savoir si on pourra glisser-déplacer
	$contexte['_jquery_ui_all'] = false;

	// SPIP 3.2
	if ($jquery_ui_all = find_in_path('javascript/ui/jquery-ui.js')) {
		$contexte['_jquery_ui_all'] = $jquery_ui_all;
	// SPIP 3.1
	} elseif (find_in_path('javascript/ui/sortable.js') and find_in_path('javascript/ui/draggable.js')) {
		$contexte['_chemin_ui'] = 'javascript/ui/';
	// SPIP 3.0
	} elseif (find_in_path('javascript/ui/jquery.ui.sortable.js') and find_in_path('javascript/ui/jquery.ui.draggable.js')) {
		$contexte['_chemin_ui'] = 'javascript/ui/jquery.ui.';
	// Plugin jquery-ui absent.
	} else {
		$contexte['_chemin_ui'] = false;
	}

	return $contexte;
}

function formulaires_construire_formulaire_verifier($identifiant, $formulaire_initial = array(), $options = array()) {
	include_spip('inc/saisies');
	$erreurs = array();
	// l'une ou l'autre sera presente
	$configurer_saisie = $enregistrer_saisie = '';
	$configurer_globales = '';
	$enregistrer_globales = '';
	// On ne fait rien du tout si on n'est pas dans l'un de ces cas
	if (
		!(
			$nom_ou_id = $configurer_saisie  = _request('configurer_saisie')
			or $nom_ou_id = $enregistrer_saisie = _request('enregistrer_saisie')
			or $configurer_globales = _request('configurer_globales')
			or $enregistrer_globales = _request('enregistrer_globales')
		)
	) {
		return $erreurs;
	}

	// On ajoute un préfixe devant l'identifiant
	$identifiant = 'constructeur_formulaire_'.$identifiant;
	// On récupère le formulaire à son état actuel
	$formulaire_actuel = session_get($identifiant);

	// Gestion de la config globales
	if ($configurer_globales or $enregistrer_globales) {
		$options['options_globales'] = saisies_fieldsets_en_onglets($options['options_globales'], $identifiant);
		array_walk_recursive($options['options_globales'], 'construire_formulaire_transformer_nom', 'options_globales[@valeur@]');
		array_walk_recursive($options['options_globales'], 'construire_formulaire_transformer_afficher_si', 'options_globales');
		$erreurs['configurer_globales'] = $options['options_globales'];

		if ($enregistrer_globales) {
			$vraies_erreurs = saisies_verifier($erreurs['configurer_globales']);
		}
	}
	// Sinon c'est la gestion d'une saisie précise
	else {
		// On récupère les saisies actuelles, par identifiant ou par nom
		if ($nom_ou_id[0] == '@') {
			$saisies_actuelles = saisies_lister_par_identifiant($formulaire_actuel);
			$nom = $saisies_actuelles[$nom_ou_id]['options']['nom'];
		}
		else {
			$saisies_actuelles = saisies_lister_par_nom($formulaire_actuel);
			$nom = $nom_ou_id;
		}
		$noms_autorises = array_keys($saisies_actuelles);

		// le nom (ou identifiant) doit exister
		if (!in_array($nom_ou_id, $noms_autorises)) {
			return $erreurs;
		}

		// La liste des saisies
		if (isset($options['uniquement_sql']) and $options['uniquement_sql']) {
			$saisies_disponibles = saisies_lister_disponibles_sql('saisies', false);
		} else {
			$saisies_disponibles = saisies_lister_disponibles('saisies', false);
		}
		if (isset($options['saisies_exclues']) and  is_array($options['saisies_exclues'])) {
			$saisies_disponibles = array_diff_key($saisies_disponibles, array_flip($options['saisies_exclues']));
		}

		$saisie = $saisies_actuelles[$nom_ou_id];
		$formulaire_config = $saisies_disponibles[$saisie['saisie']]['options'];
		array_walk_recursive($formulaire_config, 'construire_formulaire_transformer_nom', "saisie_modifiee_${nom}[options][@valeur@]");
		array_walk_recursive($formulaire_config, 'construire_formulaire_transformer_afficher_si', "saisie_modifiee_${nom}[options]");
		$formulaire_config = saisie_identifier(array('saisies'=>$formulaire_config));
		$formulaire_config = $formulaire_config['saisies'];

		// Si la saisie possede un identifiant, on l'ajoute
		// au formulaire de configuration pour ne pas le perdre en route
		if (isset($saisie['identifiant']) and $saisie['identifiant']) {
			$formulaire_config = saisies_inserer(
				$formulaire_config,
				array(
					'saisie' => 'hidden',
					'options' => array(
						'nom' => "saisie_modifiee_${nom}[identifiant]",
						'defaut' => $saisie['identifiant']
					),
				)
			);
		}

		// S'il y a l'option adéquat, on ajoute le champ pour modifier le nom
		if (
			isset($options['modifier_nom']) and $options['modifier_nom']
			and $chemin_nom = saisies_chercher($formulaire_config, "saisie_modifiee_${nom}[options][description]", true)
		) {
			$chemin_nom[] = 'saisies';
			$chemin_nom[] = '0';

			$formulaire_config = saisies_inserer(
				$formulaire_config,
				array(
					'saisie' => 'input',
					'options' => array(
						'nom' => "saisie_modifiee_${nom}[options][nom]",
						'label' => _T('saisies:option_nom_label'),
						'explication' => _T('saisies:option_nom_explication'),
						'obligatoire' => 'oui',
						'size' => 50
					),
					'verifier' => array(
						'type' => 'slug',
						'options' => array(
							'normaliser_suggerer' => True
						)
					)
				),
				$chemin_nom
			);
		}

		// liste des options de vérification
		$verif_options = array();

		// S'il y a un groupe "validation" alors on va construire le formulaire des vérifications
		if ($chemin_validation = saisies_chercher($formulaire_config, "saisie_modifiee_${nom}[options][validation]", true)) {
			include_spip('inc/verifier');
			$liste_verifications = verifier_lister_disponibles();

			// La vérification fichiers ne sert que pour la saisie fichiers, et réciproquement, cette saisies n'utilise que cette vérification
			if ($saisie['saisie'] == 'fichiers') {
				$liste_verifications = array('fichiers'=>$liste_verifications['fichiers']);
			} else {
				unset($liste_verifications['fichiers']);
			}
			uasort ($liste_verifications,'verifier_trier_par_titre');
			$chemin_validation[] = 'saisies';
			$chemin_validation[] = 1000000; // à la fin

			// On construit la saisie à insérer et les fieldset des options
			if ($saisie['saisie'] == 'fichiers') {
				$saisie_liste_verif = array(
					'saisie' => 'hidden',
					'options' => array(
						'nom' => "saisie_modifiee_${nom}[verifier][type]",
						'defaut' => 'fichiers'
					)
				);
			} else {
				$saisie_liste_verif = array(
					'saisie' => 'selection',
					'options' => array(
						'nom' => "saisie_modifiee_${nom}[verifier][type]",
						'label' => _T('saisies:construire_verifications_label'),
						'option_intro' => _T('saisies:construire_verifications_aucune'),
						'conteneur_class' => 'liste_verifications',
						'data' => array()
					)
				);
			}
			foreach ($liste_verifications as $type_verif => $verif) {
				$saisie_liste_verif['options']['data'][$type_verif] = $verif['titre'];
				// Si le type de vérif a des options, on ajoute un fieldset
				if (isset($verif['options']) and $verif['options'] and is_array($verif['options'])) {
					$groupe = array(
						'saisie' => 'fieldset',
						'options' => array(
							'nom' => 'options',
							'label' => $verif['titre'],
							'conteneur_class' => "$type_verif options_verifier"
						),
						'saisies' => $verif['options']
					);
					array_walk_recursive($groupe, 'construire_formulaire_transformer_nom', "saisie_modifiee_${nom}[verifier][$type_verif][@valeur@]");
					array_walk_recursive($groupe, 'construire_formulaire_transformer_afficher_si', "saisie_modifiee_${nom}[verifier][$type_verif]");
					$verif_options[$type_verif] = $groupe;
				}
			}
			$verif_options = array_merge(array($saisie_liste_verif), $verif_options);
		}

		// Permettre d'intégrer des saisies et fieldset au formulaire de configuration.
		// Si des vérifications sont à faire, elles seront prises en compte
		// lors des tests de vérifications à l'enregistrement.
		$formulaire_config = pipeline('saisies_construire_formulaire_config', array(
			'data' => $formulaire_config,
			'args' => array(
				'identifiant' => $identifiant,
				'action' => $enregistrer_saisie ? 'enregistrer' : 'configurer',
				'options' => $options,
				'nom' => $nom,
				'saisie' => $saisie,
			),
		));

		if ($enregistrer_saisie) {
			// La saisie modifié
			$saisie_modifiee = _request("saisie_modifiee_${nom}");//contient tous les paramètres de la saisie
			// On cherche les erreurs de la configuration
			$vraies_erreurs = saisies_verifier($formulaire_config);

			// Si on autorise à modifier le nom ET qu'il doit être unique : on vérifie
			if (isset($options['modifier_nom']) and $options['modifier_nom']
				and isset($options['nom_unique']) and $options['nom_unique']) {
				$nom_modifie = $saisie_modifiee['options']['nom'];
				if ($nom_modifie != $enregistrer_saisie and saisies_chercher($formulaire_actuel, $nom_modifie)) {
					$vraies_erreurs["saisie_modifiee_${nom}[options][nom]"] = _T('saisies:erreur_option_nom_unique');
				}
			}

			// On regarde s'il a été demandé un type de vérif
			if (isset($saisie_modifiee['verifier']['type'])
				and (($type_verif = $saisie_modifiee['verifier']['type']) != '')
				and $verif_options[$type_verif]) {
				// On ne vérifie que les options du type demandé
				$vraies_erreurs = array_merge($vraies_erreurs, saisies_verifier($verif_options[$type_verif]['saisies']));
			}
		}

		// On insère chaque saisie des options de verification
		if ($verif_options) {
			foreach ($verif_options as $saisie_verif) {
				$formulaire_config = saisies_inserer($formulaire_config, $saisie_verif, $chemin_validation);
			}
		}
		$erreurs['configurer_'.$nom] = $formulaire_config;
	}

	// S'il y a des vraies erreurs au final
	if ($enregistrer_globales or $enregistrer_saisie) {
		if ($vraies_erreurs) {
			$erreurs = array_merge($erreurs, $vraies_erreurs);
			$erreurs['message_erreur'] = singulier_ou_pluriel(count($vraies_erreurs), 'avis_1_erreur_saisie', 'avis_nb_erreurs_saisie');
		} else {
			$erreurs = array();
		}
	} else {
		$erreurs['message_erreur'] = ''; // on ne veut pas du message_erreur automatique
	}

	return $erreurs;
}

function formulaires_construire_formulaire_traiter($identifiant, $formulaire_initial = array(), $options = array()) {
	include_spip('inc/saisies');
	$retours = array();
	if (isset($options['uniquement_sql']) and $options['uniquement_sql']) {
		$saisies_disponibles = saisies_lister_disponibles_sql('saisies', false);
	} else {
		$saisies_disponibles = saisies_lister_disponibles('saisies', false);
	}
	if (isset($options['saisies_exclues']) and  is_array($options['saisies_exclues'])) {
		$saisies_disponibles = array_diff_key($saisies_disponibles, array_flip($options['saisies_exclues']));
	}

	// On ajoute un préfixe devant l'identifiant
	$identifiant = 'constructeur_formulaire_'.$identifiant;
	// On récupère le formulaire à son état actuel
	$formulaire_actuel = session_get($identifiant);

	// Si on demande à ajouter un groupe
	if ($ajouter_saisie = _request('ajouter_groupe_saisie')) {
		$formulaire_actuel = saisies_groupe_inserer($formulaire_actuel, $ajouter_saisie);
	}

	// Si on demande à ajouter une saisie
	if ($ajouter_saisie = _request('ajouter_saisie')) {
		$nom = saisies_generer_nom($formulaire_actuel, $ajouter_saisie);
		$saisie = array(
			'saisie' => $ajouter_saisie,
			'options' => array(
				'nom' => $nom
			)
		);
		// S'il y a des valeurs par défaut pour ce type de saisie, on les ajoute
		if (($defaut = $saisies_disponibles[$ajouter_saisie]['defaut']) and is_array($defaut)) {
			$defaut = _T_ou_typo($defaut, 'multi');

			$saisie = array_replace_recursive($saisie, $defaut);
		}
		// Si la dernière saisies est un fieldset (ou un type dérivé de fieldset, c'est à dire si peut contenir des sous saisies), inserer à la fin du fieldset, sauf si saisie a insérer fieldset
		if (!empty($formulaire_actuel)) {
			$saisie_de_fin = &$formulaire_actuel[max(array_keys($formulaire_actuel))];
		} else {
			$saisie_de_fin = array('saisie' => 'nope');
		}
		if (isset($saisie_de_fin['saisies']) and !isset($saisie['saisies'])) {
			$saisies_fielset_fin = &$saisie_de_fin['saisies'];
			$saisies_fielset_fin = saisies_inserer($saisies_fielset_fin, $saisie);
		} else {
			$formulaire_actuel = saisies_inserer($formulaire_actuel, $saisie);
		}
	}

	// Si on demande à dupliquer une saisie
	if ($dupliquer_saisie = _request('dupliquer_saisie')) {
		$formulaire_actuel = saisies_dupliquer($formulaire_actuel, $dupliquer_saisie);
	}

	// Si on demande à supprimer une saisie
	if ($supprimer_saisie = _request('supprimer_saisie')) {
		$formulaire_actuel = saisies_supprimer($formulaire_actuel, $supprimer_saisie);
	}

	// Si on enregistre la conf globale
	if (_request('enregistrer_globales')) {
		$options_globales = _request('options_globales');
		if (is_array($options_globales)) {
			spip_desinfecte($options_globales);
		}

		$formulaire_actuel['options'] = $options_globales;
	}

	// Si on enregistre la conf d'une saisie
	if ($nom = _request('enregistrer_saisie')) {
		// On récupère ce qui a été modifié
		$saisie_modifiee = _request("saisie_modifiee_$nom");

		// On regarde s'il y a une position à modifier
		if (isset($saisie_modifiee['position'])) {
			$position = $saisie_modifiee['position'];
			unset($saisie_modifiee['position']);
			// On ne déplace que si ce n'est pas la même chose
			if ($position != $nom) {
				$formulaire_actuel = saisies_deplacer($formulaire_actuel, $nom, $position);
			}
		}

		// On regarde s'il y a des options de vérification à modifier
		if (isset($saisie_modifiee['verifier']['type'])
			and ($type_verif = $saisie_modifiee['verifier']['type']) != '') {
			$saisie_modifiee['verifier'] = array(
				'type' => $type_verif,
				'options' => $saisie_modifiee['verifier'][$type_verif]
			);
		} else {
			unset($saisie_modifiee['verifier']);
		}

		// On récupère les options postées en enlevant les chaines vides
		$saisie_modifiee['options'] = array_filter($saisie_modifiee['options'], 'saisie_option_contenu_vide');
		if (isset($saisie_modifiee['verifier']['options']) and $saisie_modifiee['verifier']['options']) {
			$saisie_modifiee['verifier']['options'] = array_filter($saisie_modifiee['verifier']['options'], 'saisie_option_contenu_vide');
		}
		if (!isset($saisie_modifiee['verifier']) or !$saisie_modifiee['verifier']) {
			$saisie_modifiee['verifier'] = array();
		}

		// On désinfecte à la main
		if (is_array($saisie_modifiee['options'])) {
			spip_desinfecte($saisie_modifiee['options']);
		}

		// On modifie enfin
		$formulaire_actuel = saisies_modifier($formulaire_actuel, $nom, $saisie_modifiee);
	}

	// Si on demande à réinitialiser
	if (_request('reinitialiser') == 'oui') {
		$formulaire_actuel = $formulaire_initial;
	}

	// On enregistre en session la nouvelle version du formulaire
	session_set($identifiant, $formulaire_actuel);

	// Le formulaire reste éditable
	$retours['editable'] = true;

	return $retours;
}

// À utiliser avec un array_walk_recursive()
// Applique une transformation à la @valeur@ de tous les champs "nom" d'un formulaire, y compris loin dans l'arbo
function construire_formulaire_transformer_nom(&$valeur, $cle, $transformation) {
	if ($cle == 'nom' and is_string($valeur)) {
		$valeur = str_replace('@valeur@', $valeur, $transformation);
	}
}

// À utiliser avec un array_walk_recursive()
// Applique une transformation à la valeur de tous les champs "afficher_si" d'un formulaire, y compris loin dans l'arbo
function construire_formulaire_transformer_afficher_si(&$valeur, $cle, $transformation) {
	if ($cle == 'afficher_si' and is_string($valeur)) {
		$valeur = preg_replace("#@(.*)@#U", '@'.$transformation.'[${1}]@', $valeur);
	}
}

// Préparer une saisie pour la transformer en truc configurable
function construire_formulaire_generer_saisie_configurable($saisie, $env) {
	// On récupère le nom
	$nom = $saisie['options']['nom'];
	$identifiant = isset($saisie['identifiant']) ? $saisie['identifiant'] : '';
	// On cherche si ya un formulaire de config
	$formulaire_config = isset($env['erreurs']['configurer_'.$nom]) ? $env['erreurs']['configurer_'.$nom] : '';

	// On ajoute une classe
	if (!isset($saisie['options']['conteneur_class'])) {
		$saisie['options']['conteneur_class'] = ''; // initialisation
	}
	// Compat ancien nom li_class
	if (isset($saisie['options']['li_class'])) {
		$saisie['options']['conteneur_class'] .= ' ' . $saisie['options']['li_class']; // initialisation
	}
	$saisie['options']['conteneur_class'] .= ' configurable';

	// On ajoute l'option "tout_afficher"
	$saisie['options']['tout_afficher'] = 'oui';

	// On ajoute les boutons d'actions, mais seulement s'il n'y a pas de configuration de lancée
	if (!$env['erreurs']) {
		$saisie = saisies_inserer_html(
			$saisie,
			recuperer_fond(
				'formulaires/inc-construire_formulaire-actions',
				array(
					'nom' => $nom,
					'identifiant' => $identifiant,
					'formulaire_config' => $formulaire_config,
					'deplacable' => (!empty($env['_jquery_ui_all']) or !empty($env['_chemin_ui']))
				)
			),
			'debut'
		);
	}

	// On ajoute une ancre pour s'y déplacer
	$saisie = saisies_inserer_html(
		$saisie,
		"\n<a id=\"configurer_$nom\"></a>\n",
		'debut'
	);

	// Si ya un form de config on l'ajoute à la fin
	if (is_array($formulaire_config)) {
		// On double l'environnement
		$env2 = $env;
		// On ajoute une classe
		$saisie['options']['conteneur_class'] .= ' en_configuration';

		// Si possible on met en readonly
		$saisie['options']['readonly'] = 'oui';

		// On vire les sous-saisies s'il y en a
		if (isset($saisie['saisies']) and $saisie['saisies'] and is_array($saisie['saisies'])) {
			$nb_champs_masques = count(saisies_lister_champs($saisie['saisies']));
			$saisie['saisies'] = array(
				array(
					'saisie' => 'explication',
					'options' => array(
						'nom' => 'truc',
						'texte' => _T('saisies:construire_info_nb_champs_masques', array('nb'=>$nb_champs_masques)),
					)
				)
			);
		}

		// On va ajouter le champ pour la position
		if (!($chemin_description = saisies_chercher($formulaire_config, "saisie_modifiee_${nom}[options][description]", true))) {
			$chemin_description = array(0);
			$formulaire_config = saisies_inserer(
				$formulaire_config,
				array(
					'saisie' => 'fieldset',
					'options' => array(
						'nom' => "saisie_modifiee_${nom}[options][description]",
						'label' => _T('saisies:option_groupe_description'),
					),
					'saisies' => array()
				),
				0
			);
		}
		$chemin_description[] = 'saisies';
		$chemin_description[] = '0'; // tout au début
		$formulaire_config = saisies_inserer(
			$formulaire_config,
			array(
				'saisie' => 'position_construire_formulaire',
				'options' => array(
					'nom' => "saisie_modifiee_${nom}[position]",
					'label' => _T('saisies:construire_position_label'),
					'explication' => _T('saisies:construire_position_explication'),
					'formulaire' => $env['_contenu'],
					'saisie_a_positionner' => $nom
				)
			),
			$chemin_description
		);

		// Fieldsets racines en onglets forcés + identifiant stable
		$formulaire_config = saisies_fieldsets_en_onglets($formulaire_config, $env['_identifiant_session']);

		$env2['saisies'] = $formulaire_config;

		// Un test pour savoir si on prend le _request ou bien
		$erreurs_test = $env['erreurs'];
		unset($erreurs_test['configurer_'.$nom]);
		unset($erreurs_test['message_erreur']);

		if ($erreurs_test) {
			// Là aussi on désinfecte à la main
			if (isset($env2["saisie_modifiee_$nom"]['options']) and is_array($env2["saisie_modifiee_$nom"]['options'])) {
				spip_desinfecte($env2["saisie_modifiee_$nom"]['options']);
			}
		} else {
			$env2["saisie_modifiee_$nom"] = $env2['_saisies_par_nom'][$nom];
			// il n'y a pas toujours de verification...
			if (isset($env2["saisie_modifiee_$nom"]['verifier']) and isset($env2["saisie_modifiee_$nom"]['verifier']['type'])) {
				$env2["saisie_modifiee_$nom"]['verifier'][ $env2["saisie_modifiee_$nom"]['verifier']['type'] ]
					= $env2["saisie_modifiee_$nom"]['verifier']['options'];
			}
		}

		$env2['fond_generer'] = 'inclure/generer_saisies';
		$saisie = saisies_inserer_html(
			$saisie,
			'<div class="formulaire_configurer"><'.saisie_balise_structure_formulaire('ul').' class="editer-groupe formulaire_configurer-contenus">'
			.recuperer_fond(
				'inclure/generer_saisies',
				$env2
			)
			.'<'.saisie_balise_structure_formulaire('li').' class="boutons">
				<input type="hidden" name="enregistrer_saisie" value="'.$nom.'" />
				<button type="submit" class="submit link noscroll" name="enregistrer_saisie" value="">'._T('bouton_annuler').'</button>
				<input type="submit" class="submit noscroll" name="enregistrer" value="'._T('bouton_valider').'" />
			</'.saisie_balise_structure_formulaire('li').'>'
			.'</'.saisie_balise_structure_formulaire('ul').'></div>',
			'fin'
		);
	}

	// On effacer l'afficher_si de la saisie qu'on édite car vu qu'on l'édite on veut systématiquement la voir. En revanche, les options globales peuvent encore avoir des afficher_si.
	if (substr($saisie['options']['nom'], 0, 16) !== 'options_globales') {
		unset($saisie['options']['afficher_si']);
	}
	// On génère le HTML de la saisie
	$html = saisies_generer_html($saisie, $env);

	return $html;
}

/**
 * Callback d'array_filter()
 * Permet de retourner tout ce qui n'est pas un contenu vide.
 * La valeur '0' est par contre retournée.
 *
 * @param $var La variable a tester
 * @return bool L'accepte-t-on ?
**/
function saisie_option_contenu_vide($var) {
	if (!$var) {
		if (is_string($var) and strlen($var)) {
			return true;
		}
		return false;
	}
	return true;
}

function saisies_groupe_inserer($formulaire_actuel, $saisie) {
	include_spip('inclure/configurer_saisie_fonctions');

	//le groupe de saisies
	$saisies_charger_infos = saisies_charger_infos($saisie, $saisies_repertoire = 'saisies/groupes');

	//le tableau est-il en options ou en saisies ?
	$classique_yaml=count($saisies_charger_infos['options']);
	$formidable_yaml=count($saisies_charger_infos['saisies']);
	if ($classique_yaml>0) {
		$champ_options = 'options';
	}
	if ($formidable_yaml>0) {
		$champ_options = 'saisies';
	}

	//les champs du groupe
	foreach ($saisies_charger_infos[$champ_options] as $info_saisie) {
		unset($info_saisie['identifiant']);
		$construire_nom = $info_saisie[$champ_options]['nom'] ? $info_saisie[$champ_options]['nom'] : $info_saisie['saisie'];
		$nom = $info_saisie[$champ_options]['nom'] = saisies_generer_nom($formulaire_actuel, $construire_nom);

		$formulaire_actuel = saisies_inserer($formulaire_actuel, $info_saisie);
	}

	return $formulaire_actuel;
}


//Compatibilite PHP<5.3.0
//source : http://www.php.net/manual/en/function.array-replace-recursive.php#92574
if (!function_exists('array_replace_recursive')) {
	function array_replace_recursive($array, $array1) {
		function recurse($array, $array1) {
			foreach ($array1 as $key => $value) {
				// create new key in $array, if it is empty or not an array
				if (!isset($array[$key]) || (isset($array[$key]) && !is_array($array[$key]))) {
					$array[$key] = array();
				}
				// overwrite the value in the base array
				if (is_array($value)) {
					$value = recurse($array[$key], $value);
				}
				$array[$key] = $value;
			}
			return $array;
		}

		// handle the arguments, merge one by one
		$args = func_get_args();
		$array = $args[0];
		if (!is_array($array)) {
			return $array;
		}
		for ($i = 1; $i < count($args); $i++) {
			if (is_array($args[$i])) {
				$array = recurse($array, $args[$i]);
			}
		}
		return $array;
	}
}
