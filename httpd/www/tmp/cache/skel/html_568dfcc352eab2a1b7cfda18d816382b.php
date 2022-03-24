<?php

/*
 * Squelette : plugins/html5up_editorial/breadcrumb/dist.html
 * Date :      Fri, 04 Jun 2021 14:01:59 GMT
 * Compile :   Sat, 05 Jun 2021 07:58:14 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette plugins/html5up_editorial/breadcrumb/dist.html
// Temps de compilation total: 0.591 ms
//

function html_568dfcc352eab2a1b7cfda18d816382b($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'<nav class="arbo">
	' .
vide($Pile['vars'][$_zzz=(string)'objet'] = '') .
vide($Pile['vars'][$_zzz=(string)'id_objet'] = '') .
(($t1 = strval(interdire_scripts(((entites_html(table_valeur(@$Pile[0], (string)'id_rubrique', null),true)) ?' ' :''))))!=='' ?
		($t1 . (	vide($Pile['vars'][$_zzz=(string)'objet'] = 'rubrique') .
	vide($Pile['vars'][$_zzz=(string)'id_objet'] = interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'id_rubrique', null),true))))) :
		'') .
'
	' .
(($t1 = strval(interdire_scripts(((entites_html(table_valeur(@$Pile[0], (string)'id_syndic', null),true)) ?' ' :''))))!=='' ?
		($t1 . (	vide($Pile['vars'][$_zzz=(string)'objet'] = 'site') .
	vide($Pile['vars'][$_zzz=(string)'id_objet'] = interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'id_syndic', null),true))))) :
		'') .
'
	' .
(($t1 = strval(interdire_scripts(((entites_html(table_valeur(@$Pile[0], (string)'id_breve', null),true)) ?' ' :''))))!=='' ?
		($t1 . (	vide($Pile['vars'][$_zzz=(string)'objet'] = 'breve') .
	vide($Pile['vars'][$_zzz=(string)'id_objet'] = interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'id_breve', null),true))))) :
		'') .
'
	' .
(($t1 = strval(interdire_scripts(((entites_html(table_valeur(@$Pile[0], (string)'id_article', null),true)) ?' ' :''))))!=='' ?
		($t1 . (	vide($Pile['vars'][$_zzz=(string)'objet'] = 'article') .
	vide($Pile['vars'][$_zzz=(string)'id_objet'] = interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'id_article', null),true))))) :
		'') .
'
	' .
(($t1 = strval(interdire_scripts(((entites_html(table_valeur(@$Pile[0], (string)'id_objet', null),true)) ?' ' :''))))!=='' ?
		($t1 . (	vide($Pile['vars'][$_zzz=(string)'objet'] = interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'objet', null),true))) .
	vide($Pile['vars'][$_zzz=(string)'id_objet'] = interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'id_objet', null),true))))) :
		'') .
'

	' .
((table_valeur($Pile["vars"], (string)'objet', null))  ?
		(' ' . (	'
	' .
	recuperer_fond( 'breadcrumb/inc-objet' , array('id_objet' => table_valeur($Pile["vars"], (string)'id_objet', null) ,
	'objet' => table_valeur($Pile["vars"], (string)'objet', null) ), array('compil'=>array('plugins/html5up_editorial/breadcrumb/dist.html','html_568dfcc352eab2a1b7cfda18d816382b','',11,$GLOBALS['spip_lang'])), _request('connect')))) :
		'') .
(!(table_valeur($Pile["vars"], (string)'objet', null))  ?
		(' ' . (	'
	<a href="' .
	spip_htmlspecialchars(sinon($GLOBALS['meta']['adresse_site'],'.')) .
	'/">' .
	_T('public|spip|ecrire:accueil_site') .
	'</a>
	')) :
		'') .
'
</nav>');

	return analyse_resultat_skel('html_568dfcc352eab2a1b7cfda18d816382b', $Cache, $page, 'plugins/html5up_editorial/breadcrumb/dist.html');
}
?>