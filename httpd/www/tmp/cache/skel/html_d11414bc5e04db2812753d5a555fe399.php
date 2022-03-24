<?php

/*
 * Squelette : plugins/html5up_editorial/head/sommaire.html
 * Date :      Fri, 04 Jun 2021 14:01:59 GMT
 * Compile :   Fri, 04 Jun 2021 14:34:28 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette plugins/html5up_editorial/head/sommaire.html
// Temps de compilation total: 0.317 ms
//

function html_d11414bc5e04db2812753d5a555fe399($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'
<title>' .
interdire_scripts(textebrut(typo(typo($GLOBALS['meta']['nom_site'], "TYPO", $connect, $Pile[0])))) .
(($t1 = strval(interdire_scripts(textebrut(typo(typo($GLOBALS['meta']['slogan_site'], "TYPO", $connect, $Pile[0]))))))!=='' ?
		(' - ' . $t1) :
		'') .
'</title>
' .
(($t1 = strval(interdire_scripts(attribut_html(textebrut(couper(propre($GLOBALS['meta']['descriptif_site'], $connect, $Pile[0]),'150'))))))!=='' ?
		('<meta name="description" content="' . $t1 . '" />') :
		'') .
'
' .
(($t1 = strval(url_absolue_si(find_in_path('favicon.ico'))))!=='' ?
		('<link rel="icon" type="image/x-icon" href="' . $t1 . (	'" />
' .
	(($t2 = strval(url_absolue_si(find_in_path('favicon.ico'))))!=='' ?
			('<link rel="shortcut icon" type="image/x-icon" href="' . $t2 . '" />') :
			''))) :
		'') .
'
');

	return analyse_resultat_skel('html_d11414bc5e04db2812753d5a555fe399', $Cache, $page, 'plugins/html5up_editorial/head/sommaire.html');
}
?>