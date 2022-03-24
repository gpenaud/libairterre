<?php

/**
 * Utilisation des pipelines
 *
 * @package SPIP\Saisies\Pipelines
**/

// Sécurité
if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

/**
 * Préambule, les constantes pour afficher_si
**/
if (!defined('_SAISIES_AFFICHER_SI_JS_SHOW')) {
	define ('_SAISIES_AFFICHER_SI_JS_SHOW', 'show(400)');
}
if (!defined('_SAISIES_AFFICHER_SI_JS_HIDE')) {
	define ('_SAISIES_AFFICHER_SI_JS_HIDE', 'hide(400)');
}

/**
 * Ajoute les scripts JS et CSS de saisies dans l'espace privé
 *
 * @param string $flux
 * @return string
**/
function saisies_header_prive($flux) {
	foreach (array('javascript/saisies.js', 'javascript/saisies_afficher_si.js') as $script) {
		$js = timestamp(find_in_path($script));
		$flux .= "\n<script type='text/javascript' src='$js'></script>\n";
	}
	$js = timestamp(find_in_path('javascript/saisies_textarea_counter.js'));
	$flux .= '<script type="text/javascript">saisies_caracteres_restants = "'._T('saisies:caracteres_restants').'";</script>';
	$flux .= "\n<script type='text/javascript' src='$js'></script>\n";
	$flux .= afficher_si_definir_fonctions();
	include_spip('inc/filtres');
	$css = timestamp(find_in_path('css/saisies.css'));
	$flux .= "\n<link rel='stylesheet' href='$css' type='text/css' media='all' />\n";
	$css_constructeur = timestamp(find_in_path('css/formulaires_constructeur.css'));
	$flux .= "\n<link rel='stylesheet' href='$css_constructeur' type='text/css' />\n";

	return $flux;
}

/**
 * Insérer automatiquement les scripts JS et CSS de saisies dans toutes les pages de l'espace public
 * @param array $flux
 * @return array $flux modifié
 **/
function saisies_insert_head($flux) {
	include_spip('inc/config');
	if(lire_config('saisies/assets_global')) {
		$flux .= saisies_generer_head();
	}
	return $flux;
}

/**
 * Ajoute les scripts JS et CSS de saisies dans l'espace public
 *
 * Ajoute également de quoi gérer le datepicker de la saisie date si
 * celle-ci est utilisée dans la page.
 *
 * @param string $flux
 * @return string
 **/
function saisies_affichage_final($flux) {
	include_spip('inc/config');
	if (
		!lire_config('saisies/assets_global')
		and $GLOBALS['html'] // si c'est bien du HTML
		and strpos($flux, '<!--!inserer_saisie_editer-->') !== false // et qu'on a au moins une saisie
		and strpos($flux, '<head') !== false // et qu'on a la balise <head> quelque part
	) {
		$head = saisies_generer_head($flux, true);
		$flux = str_replace('</head>', "$head</head>", $flux);
	}

	return $flux;
}

/**
 * Génère le contenu du head pour les saisies (css et js)
 * @param str $html_content le contenu html où l'on teste la présence de saisies
 * @param bool (false) $tester_saisies
 *
 * @return string
 */
function saisies_generer_head($html_content = '', $tester_saisies = false) {

	$flux = '';
	include_spip('inc/filtres');
	// Pas de saisie alors qu'on veux tester leur présence > hop, on retourne direct
	if ($tester_saisies and strpos($html_content, '<!--!inserer_saisie_editer-->') === false) {
		return $flux;
	}

	$css = timestamp(find_in_path('css/saisies.css'));
	$ins_css = "\n<link rel='stylesheet' href='$css' type='text/css' media='all' />\n";

	if (
		(!defined('_JQUERYUI_CSS_NON') or !boolval(_JQUERYUI_CSS_NON))
		and (!$tester_saisies or strpos($html_content, 'saisie_date') !==false)
	) {
		include_spip('jqueryui_pipelines');
		if (function_exists('jqueryui_dependances')) {
			$ui_plugins = jqueryui_dependances(array('jquery.ui.datepicker'));
			$theme_css = 'jquery.ui.theme';
			$ui_css_dir = 'css';
			// compatibilité SPIP 3.1 et jQuery UI 1.11
			$version = explode('.', $GLOBALS['spip_version_branche']);
			if ($version[0] > 3 or ($version[0] == 3 and $version[1] > 0)) {
				$theme_css = 'theme';
				$ui_css_dir = 'css/ui';
			}
			array_push($ui_plugins, $theme_css);
			foreach ($ui_plugins as $ui_plug) {
				// compatibilité pour les versions < SPIP 3.2
				if ($version[0] < 3 or ($version[0] == 3 and $version[1] < 2)) {
					$ui_plug_css = find_in_path("$ui_css_dir/$ui_plug.css");
					if (strpos($flux, "$ui_css_dir/$ui_plug.css") === false) {// si pas déjà chargé
						$ins_css .= "\n<link rel='stylesheet' href='$ui_plug_css' type='text/css' media='all' />\n";
					}
				}
			}
			// compatibilité SPIP 3.2 et jQuery UI 1.12
			if ($version[0] == 3 and $version[1] > 1) {
				$ins_css .= "\n<link rel='stylesheet' type='text/css' media='all' href='" . find_in_path('css/ui/jquery-ui.css') . "' />\n";
			}
		}
	}
	$flux = $ins_css . $flux;

	// on insère le JS à la fin du <head>
	$ins_js = '';
	// JS général
	$js = timestamp(find_in_path('javascript/saisies.js'));
	$ins_js .= "\n<script type='text/javascript' src='$js'></script>\n";


	// si on a une saisie de type textarea avec maxlength, on va charger un script
	if (!$tester_saisies or (strpos($html_content, 'textarea') !==false and strpos($html_content, 'maxlength') !==false)) {
		$js = timestamp(find_in_path('javascript/saisies_textarea_counter.js'));
		$ins_js .= '<script type="text/javascript">saisies_caracteres_restants = "'._T('saisies:caracteres_restants').'";</script>';
		$ins_js .= "\n<script type='text/javascript' src='$js'></script>\n";
	}
	// Afficher_si
	if (!$tester_saisies or strpos($html_content, 'data-afficher_si') !==false) {
		$ins_js .= afficher_si_definir_fonctions();
		$js = timestamp(find_in_path('javascript/saisies_afficher_si.js'));
		$ins_js .= "\n<script type='text/javascript' src='$js'></script>\n";
	}

	$flux = $flux . $ins_js;

	return $flux;
}

/**
 * Déclarer automatiquement les champs d'un formulaire CVT qui déclare des saisies
 *
 * Recherche une fonction `formulaires_XX_saisies_dist` et l'utilise si elle
 * est présente. Cette fonction doit retourner une liste de saisies dont on se
 * sert alors pour calculer les champs utilisés dans le formulaire.
 *
 * @param array $flux
 * @return array
**/
function saisies_formulaire_charger($flux) {
	// Si le flux data est inexistant, on quitte : Le CVT d'origine a décidé de ne pas continuer
	if (!is_array($flux['data'])) {
		return $flux;
	}

	// Il faut que la fonction existe et qu'elle retourne bien un tableau
	include_spip('inc/saisies');
	$saisies = saisies_chercher_formulaire($flux['args']['form'], $flux['args']['args'], $flux['args']['je_suis_poste']);

	if ($saisies) {
		// On ajoute au contexte les champs à déclarer
		$contexte = saisies_lister_valeurs_defaut($saisies);

		// Si c'est un formulaire de config, on va chercher le contenu dans lire_config
		if (
			strpos($flux['args']['form'], 'configurer_') === 0
			and include_spip('inc/config')
			and $meta = str_replace('configurer_', '', $flux['args']['form'])
			and $config = lire_config($meta)
			and is_array($config)
		) {
			$contexte = array_merge($contexte, $config);
		}

		// On rajoute ce contexte en défaut de ce qui existe déjà (qui est prioritaire)
		$flux['data'] = array_merge($contexte, $flux['data']);

		// On cherche si on gère des étapes
		if ($etapes = saisies_lister_par_etapes($saisies)) {
			$flux['data']['_etapes'] = count($etapes);
		}

		// On ajoute le tableau complet des saisies
		$flux['data']['_saisies'] = $saisies;
	}
	return $flux;
}

/**
 * Aiguiller CVT vers un squelette propre à Saisies lorsqu'on a déclaré des saisies et qu'il n'y a pas déjà un HTML
 *
 * Dans le cadre d'un formulaire CVT demandé, si ce formulaire a déclaré des saisies, et
 * qu'il n'y a pas de squelette spécifique pour afficher le HTML du formulaire,
 * alors on utilise le formulaire générique intégré au plugin saisie, qui calculera le HTML
 * à partir de la déclaration des saisies indiquées.
 *
 * @see saisies_formulaire_charger()
 *
 * @param array $flux
 * @return array
**/
function saisies_styliser($flux) {
	if (
		// Si on cherche un squelette de formulaire
		strncmp($flux['args']['fond'], 'formulaires/', 12) == 0
		// Et que ce n'est pas une inclusion (on teste ça pour l'instant mais c'est pas très générique)
		and strpos($flux['args']['fond'], 'inc-', 12) === false
		// Et qu'il y a des saisies dans le contexte
		and isset($flux['args']['contexte']['_saisies'])
		// Et que le fichier choisi est vide ou n'existe pas
		and include_spip('inc/flock')
		and $ext = $flux['args']['ext']
		and lire_fichier($flux['data'].'.'.$ext, $contenu_squelette)
		and !trim($contenu_squelette)
	) {
		$flux['data'] = preg_replace("/\.$ext$/", '', find_in_path("formulaires/inc-saisies-cvt.$ext"));
	}

	return $flux;
}

/**
 * Ajouter les vérifications déclarées dans la fonction "saisies" du CVT
 *
 * Si un formulaire CVT a déclaré des saisies, on utilise sa déclaration
 * pour effectuer les vérifications du formulaire.
 *
 * @see saisies_formulaire_charger()
 * @uses saisies_verifier()
 *
 * @param array $flux
 *     Liste des erreurs du formulaire
 * @return array
 *     iste des erreurs
 */
function saisies_formulaire_verifier($flux) {
	// Il faut que la fonction existe et qu'elle retourne bien un tableau
	include_spip('inc/saisies');
	$saisies = saisies_chercher_formulaire($flux['args']['form'], $flux['args']['args'], true);
	if ($saisies and !saisies_lister_par_etapes($saisies)) {
		$erreurs = saisies_verifier($saisies);

		if ($erreurs and !isset($erreurs['message_erreur'])) {
			$erreurs['message_erreur'] = _T('saisies:erreur_generique');
		}
		if (!is_array($flux['data'])) {
			$flux['data'] = array();
		}

		$flux['data'] = array_merge($erreurs, $flux['data']);
	}

	return $flux;
}

/**
 * Ajouter les vérifications déclarées dans la fonction "saisies" du CVT mais pour les étapes
 *
 * @see saisies_formulaire_charger()
 * @uses saisies_verifier()
 *
 * @param array $flux
 *     Liste des erreurs du formulaire
 * @return array
 *     iste des erreurs
 */
function saisies_formulaire_verifier_etape($flux) {
	// Il faut que la fonction existe et qu'elle retourne bien un tableau
	include_spip('inc/saisies');
	$saisies = saisies_chercher_formulaire($flux['args']['form'], $flux['args']['args'], true);
	if ($saisies and $etapes = saisies_lister_par_etapes($saisies)) {
		// On récupère les sous-saisies de cette étape précise
		$saisies_etape = $etapes[$flux['args']['etape']]['saisies'];

		$erreurs = saisies_verifier($saisies_etape);

		$flux['data'] = array_merge($erreurs, $flux['data']);
	}

	return $flux;
}

/**
 * Retourne une chaine renvoyant les functions js de masquage/affiche
**/
function afficher_si_definir_fonctions() {
	return '<script>
		function afficher_si_show(src) {
			src.'._SAISIES_AFFICHER_SI_JS_SHOW.';
		}
		function afficher_si_hide(src) {
			src.'._SAISIES_AFFICHER_SI_JS_HIDE.';
		}
	</script>';
}

/*
 * Compatibilite historique
 * le pipeline saisies_afficher_si_js_saisies_form
 * a été renommé en saisies_afficher_si_saisies
 * On pourra supprimer cela dans la version 4.0 du plugin
**/
function saisies_saisies_afficher_si_saisies($flux) {
	return pipeline('saisies_afficher_si_js_saisies_form', $flux);
}
