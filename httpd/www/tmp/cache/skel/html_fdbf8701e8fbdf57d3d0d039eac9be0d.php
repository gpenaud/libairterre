<?php

/*
 * Squelette : plugins/html5up_editorial/header/dist.html
 * Date :      Fri, 04 Jun 2021 14:01:59 GMT
 * Compile :   Fri, 04 Jun 2021 14:34:28 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette plugins/html5up_editorial/header/dist.html
// Temps de compilation total: 0.611 ms
//

function html_fdbf8701e8fbdf57d3d0d039eac9be0d($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'<div class="accueil">
	' .
(($t1 = strval(((((
	(($zp='sommaire') AND isset($Pile[0][_SPIP_PAGE]) AND ($Pile[0][_SPIP_PAGE]==$zp))
	OR (isset($Pile[0]['type-page']) AND $Pile[0]['type-page']==$zp)
	OR (isset($Pile[0]['composition']) AND $Pile[0]['composition']==$zp AND $Pile[0]['type-page']=='page'))?' ':'')
) ?'' :' ')))!=='' ?
		($t1 . (	'<a rel="start home" href="' .
	spip_htmlspecialchars(sinon($GLOBALS['meta']['adresse_site'],'.')) .
	'/" title="' .
	_T('public|spip|ecrire:accueil_site') .
	'"
	>')) :
		'') .
'<h1 id="logo_site_spip" class="logo">' .
(($t1 = strval(inserer_attribut(filtrer('image_graver', filtrer('image_reduire',
((!is_array($l = quete_logo('id_syndic', 'ON', "'0'",'', 0))) ? '':
 ("<img class=\"spip_logo spip_logos\" alt=\"\" src=\"$l[0]\"" . $l[2] .  ($l[1] ? " onmouseover=\"this.src='$l[1]'\" onmouseout=\"this.src='$l[0]'\"" : "") . ' />')),'50','50')),'class','spip_logo_left')))!=='' ?
		($t1 . ' ') :
		'') .
'<span class="nom_site_spip ">' .
interdire_scripts(typo($GLOBALS['meta']['nom_site'], "TYPO", $connect, $Pile[0])) .
'</span>
	</h1>' .
(($t1 = strval(((((
	(($zp='sommaire') AND isset($Pile[0][_SPIP_PAGE]) AND ($Pile[0][_SPIP_PAGE]==$zp))
	OR (isset($Pile[0]['type-page']) AND $Pile[0]['type-page']==$zp)
	OR (isset($Pile[0]['composition']) AND $Pile[0]['composition']==$zp AND $Pile[0]['type-page']=='page'))?' ':'')
) ?'' :' ')))!=='' ?
		($t1 . '</a>') :
		'') .
'
</div>');

	return analyse_resultat_skel('html_fdbf8701e8fbdf57d3d0d039eac9be0d', $Cache, $page, 'plugins/html5up_editorial/header/dist.html');
}
?>