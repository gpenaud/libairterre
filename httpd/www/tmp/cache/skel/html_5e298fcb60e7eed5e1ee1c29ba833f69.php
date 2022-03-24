<?php

/*
 * Squelette : plugins/html5up_editorial/inclure/rezo.html
 * Date :      Fri, 04 Jun 2021 14:01:59 GMT
 * Compile :   Fri, 04 Jun 2021 14:34:28 GMT
 * Boucles :   _sociaux
 */ 

function BOUCLE_sociauxhtml_5e298fcb60e7eed5e1ee1c29ba833f69(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	$in = array();
	$in[]= 'mail';
	$command['sourcemode'] = 'tableau';

	$command['source'] = array(table_valeur($Pile["vars"], (string)'rezo', null));

	if (!isset($command['table'])) {
		$command['table'] = '';
		$command['id'] = '_sociaux';
		$command['from'] = array();
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array(".valeur",
		".cle");
		$command['orderby'] = array();
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	$command['where'] = 
			array(sql_in('cle',sql_quote($in),'NOT'));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"DATA",
		$command,
		array('plugins/html5up_editorial/inclure/rezo.html','html_5e298fcb60e7eed5e1ee1c29ba833f69','_sociaux',3,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$t0 .= (
'
	' .
vide($Pile['vars'][$_zzz=(string)'icone'] = (	'fa-' .
	interdire_scripts(safehtml($Pile[$SP]['cle'])))) .
interdire_scripts(((safehtml($Pile[$SP]['cle']) == 'googleplus') ? vide($Pile['vars'][$_zzz=(string)'icone'] = 'fa-google-plus'):'')) .
'
	' .
(($t1 = strval(interdire_scripts((include_spip('inc/config')?lire_config((	'sociaux/' .
	interdire_scripts(safehtml($Pile[$SP]['cle']))),null,false):''))))!=='' ?
		((	'<li><a class="icon ' .
	table_valeur($Pile["vars"], (string)'icone', null) .
	'" href="') . $t1 . (	'"><span class="label">' .
	interdire_scripts(safehtml($Pile[$SP]['valeur'])) .
	'</span></a></li>')) :
		'') .
'
');
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_sociaux @ plugins/html5up_editorial/inclure/rezo.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}

//
// Fonction principale du squelette plugins/html5up_editorial/inclure/rezo.html
// Temps de compilation total: 1.369 ms
//

function html_5e298fcb60e7eed5e1ee1c29ba833f69($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'
' .
vide($Pile['vars'][$_zzz=(string)'rezo'] = pipeline( 'sociaux_lister' , array('args' => array('skel' => 'plugins/html5up_editorial/inclure/rezo.html', 'date' => table_valeur(@$Pile[0], (string)'date', null)), 'data' => array()) )) .
'
' .
(($t1 = BOUCLE_sociauxhtml_5e298fcb60e7eed5e1ee1c29ba833f69($Cache, $Pile, $doublons, $Numrows, $SP))!=='' ?
		('<ul class="icons">
' . $t1 . '
</ul>') :
		''));

	return analyse_resultat_skel('html_5e298fcb60e7eed5e1ee1c29ba833f69', $Cache, $page, 'plugins/html5up_editorial/inclure/rezo.html');
}
?>