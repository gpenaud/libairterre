<?php

/*
 * Squelette : plugins/z-core/head_js/dist.html
 * Date :      Fri, 04 Jun 2021 14:01:59 GMT
 * Compile :   Fri, 04 Jun 2021 14:34:28 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette plugins/z-core/head_js/dist.html
// Temps de compilation total: 0.031 ms
//

function html_e785ad3e53290942394c58a4721257a4($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = '
';

	return analyse_resultat_skel('html_e785ad3e53290942394c58a4721257a4', $Cache, $page, 'plugins/z-core/head_js/dist.html');
}
?>