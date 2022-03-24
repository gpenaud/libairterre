<?php

/*
 * Squelette : plugins/z-core/structure.html
 * Date :      Fri, 04 Jun 2021 14:01:59 GMT
 * Compile :   Fri, 04 Jun 2021 14:34:28 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette plugins/z-core/structure.html
// Temps de compilation total: 0.690 ms
//

function html_f529efc319e3abec51b34df3dcb4fa63($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
((($a = (defined('_Z_DOCTYPE') ? constant('_Z_DOCTYPE'):'')) OR (is_string($a) AND strlen($a))) ? $a : '<!DOCTYPE HTML>') .
(($t1 = strval(vide($Pile['vars'][$_zzz=(string)'class'] = (	(($t2 = strval(interdire_scripts(entites_html(sinon(table_valeur(@$Pile[0], (string)'type-page', null), 'page'),true))))!=='' ?
			('page_' . $t2 . (($t3 = strval(interdire_scripts(entites_html(sinon(table_valeur(@$Pile[0], (string)'composition', null), ''),true))))!=='' ?
				((	' ' .
			interdire_scripts(entites_html(sinon(table_valeur(@$Pile[0], (string)'type-page', null), 'page'),true)) .
			'_') . $t3) :
				'')) :
			'') .
	(($t2 = strval(interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'composition', null),true))))!=='' ?
			(' composition_' . $t2) :
			'')))))!=='' ?
		('
' . $t1) :
		'') .
'
<!--[if lt IE 7 ]> <html class="' .
table_valeur($Pile["vars"], (string)'class', null) .
(($t1 = strval(lang_dir(@$Pile[0]['lang'], 'ltr','rtl')))!=='' ?
		(' ' . $t1) :
		'') .
(($t1 = strval(spip_htmlentities(@$Pile[0]['lang'] ? @$Pile[0]['lang'] : $GLOBALS['spip_lang'])))!=='' ?
		(' ' . $t1) :
		'') .
' no-js ie ie6 lte9 lte8 lte7" xmlns="http://www.w3.org/1999/xhtml" xml:lang="' .
spip_htmlentities(@$Pile[0]['lang'] ? @$Pile[0]['lang'] : $GLOBALS['spip_lang']) .
'" lang="' .
spip_htmlentities(@$Pile[0]['lang'] ? @$Pile[0]['lang'] : $GLOBALS['spip_lang']) .
'" dir="' .
lang_dir(@$Pile[0]['lang'], 'ltr','rtl') .
'"> <![endif]-->
<!--[if IE 7 ]>    <html class="' .
table_valeur($Pile["vars"], (string)'class', null) .
(($t1 = strval(lang_dir(@$Pile[0]['lang'], 'ltr','rtl')))!=='' ?
		(' ' . $t1) :
		'') .
(($t1 = strval(spip_htmlentities(@$Pile[0]['lang'] ? @$Pile[0]['lang'] : $GLOBALS['spip_lang'])))!=='' ?
		(' ' . $t1) :
		'') .
' no-js ie ie7 lte9 lte8 lte7" xmlns="http://www.w3.org/1999/xhtml" xml:lang="' .
spip_htmlentities(@$Pile[0]['lang'] ? @$Pile[0]['lang'] : $GLOBALS['spip_lang']) .
'" lang="' .
spip_htmlentities(@$Pile[0]['lang'] ? @$Pile[0]['lang'] : $GLOBALS['spip_lang']) .
'" dir="' .
lang_dir(@$Pile[0]['lang'], 'ltr','rtl') .
'"> <![endif]-->
<!--[if IE 8 ]>    <html class="' .
table_valeur($Pile["vars"], (string)'class', null) .
(($t1 = strval(lang_dir(@$Pile[0]['lang'], 'ltr','rtl')))!=='' ?
		(' ' . $t1) :
		'') .
(($t1 = strval(spip_htmlentities(@$Pile[0]['lang'] ? @$Pile[0]['lang'] : $GLOBALS['spip_lang'])))!=='' ?
		(' ' . $t1) :
		'') .
' no-js ie ie8 lte9 lte8" xmlns="http://www.w3.org/1999/xhtml" xml:lang="' .
spip_htmlentities(@$Pile[0]['lang'] ? @$Pile[0]['lang'] : $GLOBALS['spip_lang']) .
'" lang="' .
spip_htmlentities(@$Pile[0]['lang'] ? @$Pile[0]['lang'] : $GLOBALS['spip_lang']) .
'" dir="' .
lang_dir(@$Pile[0]['lang'], 'ltr','rtl') .
'"> <![endif]-->
<!--[if IE 9 ]>    <html class="' .
table_valeur($Pile["vars"], (string)'class', null) .
(($t1 = strval(lang_dir(@$Pile[0]['lang'], 'ltr','rtl')))!=='' ?
		(' ' . $t1) :
		'') .
(($t1 = strval(spip_htmlentities(@$Pile[0]['lang'] ? @$Pile[0]['lang'] : $GLOBALS['spip_lang'])))!=='' ?
		(' ' . $t1) :
		'') .
' no-js ie ie9 lte9" xmlns="http://www.w3.org/1999/xhtml" xml:lang="' .
spip_htmlentities(@$Pile[0]['lang'] ? @$Pile[0]['lang'] : $GLOBALS['spip_lang']) .
'" lang="' .
spip_htmlentities(@$Pile[0]['lang'] ? @$Pile[0]['lang'] : $GLOBALS['spip_lang']) .
'" dir="' .
lang_dir(@$Pile[0]['lang'], 'ltr','rtl') .
'"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html class="' .
table_valeur($Pile["vars"], (string)'class', null) .
(($t1 = strval(lang_dir(@$Pile[0]['lang'], 'ltr','rtl')))!=='' ?
		(' ' . $t1) :
		'') .
(($t1 = strval(spip_htmlentities(@$Pile[0]['lang'] ? @$Pile[0]['lang'] : $GLOBALS['spip_lang'])))!=='' ?
		(' ' . $t1) :
		'') .
' no-js" xmlns="http://www.w3.org/1999/xhtml" xml:lang="' .
spip_htmlentities(@$Pile[0]['lang'] ? @$Pile[0]['lang'] : $GLOBALS['spip_lang']) .
'" lang="' .
spip_htmlentities(@$Pile[0]['lang'] ? @$Pile[0]['lang'] : $GLOBALS['spip_lang']) .
'" dir="' .
lang_dir(@$Pile[0]['lang'], 'ltr','rtl') .
'">
<!--<![endif]-->
	<head>
		<script type=\'text/javascript\'>/*<![CDATA[*/(function(H){H.className=H.className.replace(/\\bno-js\\b/,\'js\')})(document.documentElement);/*]]>*/</script>
		
		<meta http-equiv="Content-Type" content="text/html; charset=' .
interdire_scripts($GLOBALS['meta']['charset']) .
'" />

		' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette((	'head/' .
	interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'type-page', null),true)))) . ', array_merge('.var_export($Pile[0],1).',array(\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . ')), array("compil"=>array(\'plugins/z-core/structure.html\',\'html_f529efc319e3abec51b34df3dcb4fa63\',\'\',14,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette('inclure/head') . ', array(\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . '), array("compil"=>array(\'plugins/z-core/structure.html\',\'html_f529efc319e3abec51b34df3dcb4fa63\',\'\',14,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette((	'head_js/' .
	interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'type-page', null),true)))) . ', array_merge('.var_export($Pile[0],1).',array(\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . ')), array("compil"=>array(\'plugins/z-core/structure.html\',\'html_f529efc319e3abec51b34df3dcb4fa63\',\'\',14,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>
	</head>
	' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette('body') . ', array_merge('.var_export($Pile[0],1).',array(\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . ')), array("compil"=>array(\'plugins/z-core/structure.html\',\'html_f529efc319e3abec51b34df3dcb4fa63\',\'\',16,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>
</html>
');

	return analyse_resultat_skel('html_f529efc319e3abec51b34df3dcb4fa63', $Cache, $page, 'plugins/z-core/structure.html');
}
?>