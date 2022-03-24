<?php

/*
 * Squelette : plugins-dist/filtres_images/favicon.ico.html
 * Date :      Fri, 04 Jun 2021 14:01:59 GMT
 * Compile :   Fri, 04 Jun 2021 14:34:36 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette plugins-dist/filtres_images/favicon.ico.html
// Temps de compilation total: 0.645 ms
//

function html_8612e800d883ec61dd3c7a6679add6ac($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'<'.'?php header(' . _q('Content-Type: image/x-icon') . '); ?'.'>' .
'<'.'?php header(' . _q('Content-Transfer-Encoding: binary') . '); ?'.'><?php
$file="' .
((($a = ((($a = find_in_path('favicon.ico')) OR (is_string($a) AND strlen($a))) ? $a : extraire_attribut(filtrer('image_graver', filtrer('image_format',filtrer('image_recadre',filtrer('image_passe_partout',
((!is_array($l = quete_logo('id_syndic', 'ON', "'0'",'', 0))) ? '':
 ("<img class=\"spip_logo spip_logos\" alt=\"\" src=\"$l[0]\"" . $l[2] .  ($l[1] ? " onmouseover=\"this.src='$l[1]'\" onmouseout=\"this.src='$l[0]'\"" : "") . ' />')),'32','32'),'32','32','center'),'ico')),'src'))) OR (is_string($a) AND strlen($a))) ? $a : find_in_path('spip.ico')) .
'";
if ($cl = filesize($file=preg_replace(\',[?].*$,\',\'\',$file)))
	header("Content-Length: ". $cl);

readfile($file);
?>');

	return analyse_resultat_skel('html_8612e800d883ec61dd3c7a6679add6ac', $Cache, $page, 'plugins-dist/filtres_images/favicon.ico.html');
}
?>