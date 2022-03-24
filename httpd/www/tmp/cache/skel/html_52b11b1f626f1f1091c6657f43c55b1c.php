<?php

/*
 * Squelette : plugins/html5up_editorial/modeles/pagination_page.html
 * Date :      Fri, 04 Jun 2021 14:01:59 GMT
 * Compile :   Fri, 04 Jun 2021 14:34:30 GMT
 * Boucles :   _pages
 */ 

function BOUCLE_pageshtml_52b11b1f626f1f1091c6657f43c55b1c(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	$command['source'] = array(table_valeur($Pile["vars"], (string)'pages', null));
	$command['sourcemode'] = 'table';
	if (!isset($command['table'])) {
		$command['table'] = '';
		$command['id'] = '_pages';
		$command['from'] = array();
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array(".valeur");
		$command['orderby'] = array();
		$command['where'] = 
			array();
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"DATA",
		$command,
		array('plugins/html5up_editorial/modeles/pagination_page.html','html_52b11b1f626f1f1091c6657f43c55b1c','_pages',7,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$t0 .= (
'
		' .
vide($Pile['vars'][$_zzz=(string)'item'] = interdire_scripts(mult(moins($Pile[$SP]['valeur'],'1'),interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'pas', null),true))))) .
'
		<li>
			<a href="' .
interdire_scripts(ancre_url(parametre_url(entites_html(table_valeur(@$Pile[0], (string)'url', null),true),interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'debut', null),true)),(table_valeur($Pile["vars"], (string)'item', null) ? table_valeur($Pile["vars"], (string)'item', null):'')),interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'ancre', null),true)))) .
'" class="page ajax' .
(($t1 = strval(interdire_scripts(((($Pile[$SP]['valeur'] == interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'page_courante', null),true)))) ?' ' :''))))!=='' ?
		(' ' . $t1 . 'active') :
		'') .
'" rel="nofollow">' .
interdire_scripts($Pile[$SP]['valeur']) .
'</a>
		</li>
	');
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_pages @ plugins/html5up_editorial/modeles/pagination_page.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}

//
// Fonction principale du squelette plugins/html5up_editorial/modeles/pagination_page.html
// Temps de compilation total: 3.021 ms
//

function html_52b11b1f626f1f1091c6657f43c55b1c($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
interdire_scripts(table_valeur(@$Pile[0], (string)'bloc_ancre', null)) .
vide($Pile['vars'][$_zzz=(string)'bornes'] = interdire_scripts(filtre_bornes_pagination_dist(entites_html(table_valeur(@$Pile[0], (string)'page_courante', null),true),interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'nombre_pages', null),true)),'5'))) .
vide($Pile['vars'][$_zzz=(string)'premiere'] = filtre_reset(table_valeur($Pile["vars"], (string)'bornes', null))) .
vide($Pile['vars'][$_zzz=(string)'derniere'] = filtre_end(table_valeur($Pile["vars"], (string)'bornes', null))) .
vide($Pile['vars'][$_zzz=(string)'pages'] = range(table_valeur($Pile["vars"], (string)'premiere', null),table_valeur($Pile["vars"], (string)'derniere', null))) .
(($t1 = BOUCLE_pageshtml_52b11b1f626f1f1091c6657f43c55b1c($Cache, $Pile, $doublons, $Numrows, $SP))!=='' ?
		((	'
<ul class="pagination">

	
	' .
		((table_valeur($Pile["vars"], (string)'premiere', null) > '1')  ?
				((	'<li><a href="' .
			interdire_scripts(ancre_url(parametre_url(entites_html(table_valeur(@$Pile[0], (string)'url', null),true),interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'debut', null),true)),''),interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'ancre', null),true)))) .
			'" class="page ajax" rel="nofollow">') . '1' . '</a></li>
	<li><span>&hellip;</span></li>') :
				'') .
		'

	
	') . $t1 . (	'

	
	' .
		(($t3 = strval(((table_valeur($Pile["vars"], (string)'derniere', null) < interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'nombre_pages', null),true))) ? interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'nombre_pages', null),true)):'')))!=='' ?
				((	'<li><span>&hellip;</span></li>
	<li><a href="' .
			interdire_scripts(ancre_url(parametre_url(entites_html(table_valeur(@$Pile[0], (string)'url', null),true),interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'debut', null),true)),interdire_scripts(mult(moins(entites_html(table_valeur(@$Pile[0], (string)'nombre_pages', null),true),'1'),interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'pas', null),true))))),interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'ancre', null),true)))) .
			'" class="page ajax" rel="nofollow">') . $t3 . '</a></li>') :
				'') .
		'

</ul>
')) :
		'') .
'

');

	return analyse_resultat_skel('html_52b11b1f626f1f1091c6657f43c55b1c', $Cache, $page, 'plugins/html5up_editorial/modeles/pagination_page.html');
}
?>