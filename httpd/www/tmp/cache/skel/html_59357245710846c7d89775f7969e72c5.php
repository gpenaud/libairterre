<?php

/*
 * Squelette : prive/login.html
 * Date :      Fri, 04 Jun 2021 14:01:59 GMT
 * Compile :   Fri, 04 Jun 2021 14:34:47 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette prive/login.html
// Temps de compilation total: 1.921 ms
//

function html_59357245710846c7d89775f7969e72c5($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'<' . '?php header("X-Spip-Filtre: '.'compacte_head' . '"); ?'.'>
' .
'<'.'?php header(' . _q((	'Content-Type: text/html; charset=' .
	interdire_scripts($GLOBALS['meta']['charset']))) . '); ?'.'><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="' .
spip_htmlentities(@$Pile[0]['lang'] ? @$Pile[0]['lang'] : $GLOBALS['spip_lang']) .
'" lang="' .
spip_htmlentities(@$Pile[0]['lang'] ? @$Pile[0]['lang'] : $GLOBALS['spip_lang']) .
'" dir="' .
lang_dir(@$Pile[0]['lang'], 'ltr','rtl') .
'">
<head>
<title>' .
interdire_scripts(textebrut(typo($GLOBALS['meta']['nom_site'], "TYPO", $connect, $Pile[0]))) .
'</title>
<meta http-equiv="Content-Type" content="text/html; charset=' .
interdire_scripts($GLOBALS['meta']['charset']) .
'" />
<meta name="robots" content="none" />
<meta name="viewport" content="width=device-width" />
<link rel="stylesheet" href="' .
direction_css(find_in_theme('reset.css')) .
'" type="text/css" />
<link rel="stylesheet" href="' .
direction_css(find_in_theme('clear.css')) .
'" type="text/css" />
<link rel="stylesheet" href="' .
direction_css(find_in_theme('minipres.css')) .
'" type="text/css" />
' .
'<'.'?php header("X-Spip-Filtre: insert_head_css_conditionnel"); ?'.'>'. pipeline('insert_head','<!-- insert_head -->') .
'
<script type=\'text/javascript\'><!--
jQuery(function(){ jQuery(\'input#var_login\').focus();
jQuery(\'a#spip_pass\').click(function(){window.open(this.href, \'spip_pass\', \'scrollbars=yes, resizable=yes, width=480, height=380\'); return false;});
});
// --></script>
<meta name="generator" content="SPIP' .
(($t1 = strval(spip_version()))!=='' ?
		(' ' . $t1) :
		'') .
'" />
</head>
<body class="page_login">

<div id="minipres">

	<h1>' .
interdire_scripts(typo($GLOBALS['meta']['nom_site'], "TYPO", $connect, $Pile[0])) .
'</h1>
	' .
(($t1 = strval((((((table_valeur(@$Pile[0], (string)'url', null)) ?'' :' ')) OR (match(table_valeur(@$Pile[0], (string)'url', null),(	'^/?(.*/)?' .
		(defined('_DIR_RESTREINT_ABS')?constant('_DIR_RESTREINT_ABS'):''))))) ?' ' :'')))!=='' ?
		('
	' . $t1 . (	'
	<h3 class="spip">' .
	_T('public|spip|ecrire:login_acces_prive') .
	'</h3>
	' .
	executer_balise_dynamique('MENU_LANG_ECRIRE',
	array(spip_htmlentities(@$Pile[0]['lang'] ? @$Pile[0]['lang'] : $GLOBALS['spip_lang'])),
	array('prive/login.html','html_59357245710846c7d89775f7969e72c5','',31,$GLOBALS['spip_lang'])) .
	'
	')) :
		'') .
'
	
	' .
executer_balise_dynamique('FORMULAIRE_LOGIN',
	array(interdire_scripts(((($a = entites_html(table_valeur(@$Pile[0], (string)'url', null),true)) OR (is_string($a) AND strlen($a))) ? $a : generer_url_ecrire('accueil')))),
	array('prive/login.html','html_59357245710846c7d89775f7969e72c5','',14,$GLOBALS['spip_lang'])) .
'
	<p class="retour">
		' .
(($t1 = strval(tester_config(spip_htmlspecialchars(sinon($GLOBALS['meta']['adresse_site'],'.')),'1comite')))!=='' ?
		((	'<a href="' .
	interdire_scripts(generer_url_public('identifiants', 'focus=nom_inscription')) .
	'&amp;mode=') . $t1 . (	'">' .
	_T('public|spip|ecrire:login_sinscrire') .
	'</a> | ')) :
		'') .
'
		<a href="' .
spip_htmlspecialchars(sinon($GLOBALS['meta']['adresse_site'],'.')) .
'/">' .
_T('public|spip|ecrire:login_retoursitepublic') .
'</a>
	</p>
	' .
(($t1 = strval(interdire_scripts(filtre_balise_img_dist(chemin_image('spip.png')))))!=='' ?
		((	'<p class="generator">
		<a href="http://www.spip.net/" title="' .
	_T('public|spip|ecrire:site_realise_avec_spip') .
	'">') . $t1 . '</a>
	</p>') :
		'') .
'
	
</div><!--#minipres-->

</body>
</html>');

	return analyse_resultat_skel('html_59357245710846c7d89775f7969e72c5', $Cache, $page, 'prive/login.html');
}
?>