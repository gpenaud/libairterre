<?php

/*
 * Squelette : prive/formulaires/inc-logo_auteur.html
 * Date :      Fri, 04 Jun 2021 14:01:59 GMT
 * Compile :   Fri, 04 Jun 2021 14:34:47 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette prive/formulaires/inc-logo_auteur.html
// Temps de compilation total: 0.494 ms
//

function html_7a30b382bd3d925a734be1b2cd8bb117($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'<'.'?php header(' . _q((	'Content-type:text/html;charset=' .
	interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'charset', null),true)))) . '); ?'.'>' .
filtrer('image_graver',filtrer('image_recadre',filtrer('image_passe_partout',
((!is_array($l = quete_logo('id_auteur', 'ON', @$Pile[0]['id_auteur'],'', 0))) ? '':
 ("<img class=\"spip_logo spip_logos\" alt=\"\" src=\"$l[0]\"" . $l[2] .  ($l[1] ? " onmouseover=\"this.src='$l[1]'\" onmouseout=\"this.src='$l[0]'\"" : "") . ' />')),'48','48'),'48','48')) .
'
');

	return analyse_resultat_skel('html_7a30b382bd3d925a734be1b2cd8bb117', $Cache, $page, 'prive/formulaires/inc-logo_auteur.html');
}
?>