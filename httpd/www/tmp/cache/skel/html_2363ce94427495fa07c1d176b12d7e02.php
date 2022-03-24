<?php

/*
 * Squelette : plugins/html5up_editorial/breadcrumb/sommaire.html
 * Date :      Fri, 04 Jun 2021 14:01:59 GMT
 * Compile :   Fri, 04 Jun 2021 14:34:28 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette plugins/html5up_editorial/breadcrumb/sommaire.html
// Temps de compilation total: 0.012 ms
//

function html_2363ce94427495fa07c1d176b12d7e02($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = '';

	return analyse_resultat_skel('html_2363ce94427495fa07c1d176b12d7e02', $Cache, $page, 'plugins/html5up_editorial/breadcrumb/sommaire.html');
}
?>