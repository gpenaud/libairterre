<?php

/*
 * Squelette : plugins/auto/fullcalendar_facile/v2.5.2/agenda.json.html
 * Date :      Thu, 24 Mar 2022 09:53:21 GMT
 * Compile :   Thu, 24 Mar 2022 14:52:46 GMT
 * Boucles :   _mots, _evenements
 */ 

function BOUCLE_motshtml_c62d5b18ded70b7a44ecd3025fd27850(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	if (!isset($si_init)) { $command['si'] = array(); $si_init = true; }
	$command['si'][] = interdire_scripts((((entites_html(table_valeur(@$Pile[0], (string)'couleur', null),true) == 'mot')) ?' ' :''));

	if (!isset($command['table'])) {
		$command['table'] = 'mots';
		$command['id'] = '_mots';
		$command['from'] = array('mots' => 'spip_mots','L1' => 'spip_mots_liens');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("mots.id_mot");
		$command['orderby'] = array('mots.id_mot');
		$command['join'] = array('L1' => array('mots','id_mot'));
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	$command['where'] = 
			array(
			array('=', 'L1.id_objet', sql_quote($Pile[$SP]['id_evenement'], '','bigint(21) NOT NULL DEFAULT 0')), 
			array('=', 'L1.objet', sql_quote('evenement')));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('plugins/auto/fullcalendar_facile/v2.5.2/agenda.json.html','html_c62d5b18ded70b7a44ecd3025fd27850','_mots',34,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$t0 .= (
'
' .
(($t1 = strval(interdire_scripts(((objet_couleur('mots', $Pile[$SP]['id_mot'], false, false)) ?' ' :''))))!=='' ?
		($t1 . (	'
	' .
	vide($Pile['vars'][$_zzz=(string)'tableau'] = array_merge(table_valeur($Pile["vars"], (string)'tableau', null),array('color' => recuperer_fond( 'inc-couleur-objet' , array('objet' => 'mot' ,
	'id_objet' => $Pile[$SP]['id_mot'] ), array('compil'=>array('plugins/auto/fullcalendar_facile/v2.5.2/agenda.json.html','html_c62d5b18ded70b7a44ecd3025fd27850','_mots',0,$GLOBALS['spip_lang'])), _request('connect'))))))) :
		'') .
'
');
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_mots @ plugins/auto/fullcalendar_facile/v2.5.2/agenda.json.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLE_evenementshtml_c62d5b18ded70b7a44ecd3025fd27850(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';if (!defined('_DIR_PLUGIN_ACCESRESTREINT')) {
			$link_empty = generer_url_ecrire('admin_vider'); $link_plugin = generer_url_ecrire('admin_plugin');
			$message_fr = 'La restriction d\'acc&egrave;s a ete desactiv&eacute;e. <a href="'.$link_plugin.'">Corriger le probl&egrave;me</a> ou <a href="'.$link_empty.'">vider le cache</a> pour supprimer les restrictions.';
			$message_en = 'Acces Restriction is now unusable. <a href="'.$link_plugin.'">Correct this trouble</a> or <a href="'.generer_url_ecrire('admin_vider').'">empty the cache</a> to finish restriction removal.';
			die($message_fr.'<br />'.$message_en);
			}
	if (!isset($command['table'])) {
		$command['table'] = 'evenements';
		$command['id'] = '_evenements';
		$command['from'] = array('evenements' => 'spip_evenements','L1' => 'spip_articles');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("evenements.id_evenement",
		"evenements.date_debut",
		"evenements.horaire",
		"evenements.date_fin",
		"evenements.titre",
		"evenements.id_article",
		"evenements.descriptif",
		"L1.id_rubrique",
		"evenements.id_article",
		"evenements.id_evenement");
		$command['orderby'] = array('evenements.date_debut');
		$command['join'] = array('L1' => array('evenements','id_article'));
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	$command['where'] = 
			array(
quete_condition_statut('evenements.statut','!','publie',''), 
			array('OR', 
			array('AND', 
			array('=', 'horaire', sql_quote('oui')), 
			array('>=', 'evenements.date_fin', sql_quote(interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'start', null),true))))), 
			array('AND', 
			array('!=', 'horaire', sql_quote('oui')), 
			array('>=', 'evenements.date_fin', sql_quote(date('Y-m-d 00:00:00', strtotime(interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'start', null),true)))))))), 
			array('OR', 
			array('AND', 
			array('=', 'horaire', sql_quote('oui')), 
			array('<=', 'evenements.date_debut', sql_quote(interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'end', null),true))))), 
			array('AND', 
			array('!=', 'horaire', sql_quote('oui')), 
			array('<=', 'evenements.date_debut', sql_quote(date('Y-m-d 23:59:59', strtotime(interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'end', null),true)))))))), sql_in('evenements.id_evenement', accesrestreint_liste_objets_exclus('evenements', !test_espace_prive()), 'NOT'), array('AND', array('NOT IN','evenements.id_article','(SELECT * FROM('.sql_get_select('zzza.id_article','spip_articles as zzza',sql_in('zzza.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), ''), '', '', '', '',$connect).') AS subquery)'), sql_in('evenements.id_article', accesrestreint_liste_objets_exclus('articles', !test_espace_prive()), 'not')));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('plugins/auto/fullcalendar_facile/v2.5.2/agenda.json.html','html_c62d5b18ded70b7a44ecd3025fd27850','_evenements',2,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$t1 = (
'
	' .
interdire_scripts((($Pile[$SP]['horaire'] == 'non') ? vide($Pile['vars'][$_zzz=(string)'date_fin'] = interdire_scripts(full_calendar_jplusun($Pile[$SP]['date_fin']))):vide($Pile['vars'][$_zzz=(string)'date_fin'] = interdire_scripts($Pile[$SP]['date_fin'])))) .
'
	' .
vide($Pile['vars'][$_zzz=(string)'tableau'] = array('id' => $Pile[$SP]['id_evenement'], 'title' => interdire_scripts(unicode2charset(html2unicode(supprimer_numero(typo($Pile[$SP]['titre']), "TYPO", $connect, $Pile[0])))), 'allDay' => interdire_scripts((($Pile[$SP]['horaire'] == 'non') ? interdire_scripts(eval('return '.'true'.';')):interdire_scripts(eval('return '.'false'.';')))), 'start' => interdire_scripts($Pile[$SP]['date_debut']), 'end' => table_valeur($Pile["vars"], (string)'date_fin', null), 'url' => vider_url(urlencode_1738(generer_url_entite($Pile[$SP]['id_article'], 'article', '', '', true))), 'description' => interdire_scripts(unicode2charset(html2unicode(propre($Pile[$SP]['descriptif'], $connect, $Pile[0])))))) .
(($t1 = strval(interdire_scripts((((entites_html(table_valeur(@$Pile[0], (string)'couleur', null),true) == 'rubrique')) ?' ' :''))))!=='' ?
		($t1 . (	'
' .
	vide($Pile['vars'][$_zzz=(string)'tableau'] = array_merge(table_valeur($Pile["vars"], (string)'tableau', null),array('color' => recuperer_fond( 'inc-couleur-objet' , array('objet' => 'rubrique' ,
	'id_objet' => $Pile[$SP]['id_rubrique'] ), array('compil'=>array('plugins/auto/fullcalendar_facile/v2.5.2/agenda.json.html','html_c62d5b18ded70b7a44ecd3025fd27850','_evenements',0,$GLOBALS['spip_lang'])), _request('connect'))))))) :
		'') .
'
' .
(($t1 = strval(interdire_scripts((((entites_html(table_valeur(@$Pile[0], (string)'couleur', null),true) == 'article')) ?' ' :''))))!=='' ?
		($t1 . (	'
' .
	vide($Pile['vars'][$_zzz=(string)'tableau'] = array_merge(table_valeur($Pile["vars"], (string)'tableau', null),array('color' => recuperer_fond( 'inc-couleur-objet' , array('objet' => 'article' ,
	'id_objet' => $Pile[$SP]['id_article'] ), array('compil'=>array('plugins/auto/fullcalendar_facile/v2.5.2/agenda.json.html','html_c62d5b18ded70b7a44ecd3025fd27850','_evenements',0,$GLOBALS['spip_lang'])), _request('connect'))))))) :
		'') .
'
' .
(($t1 = strval(interdire_scripts((((entites_html(table_valeur(@$Pile[0], (string)'couleur', null),true) == 'evenement')) ?' ' :''))))!=='' ?
		($t1 . (	'
' .
	vide($Pile['vars'][$_zzz=(string)'tableau'] = array_merge(table_valeur($Pile["vars"], (string)'tableau', null),array('color' => recuperer_fond( 'inc-couleur-objet' , array('objet' => 'evenement' ,
	'id_objet' => $Pile[$SP]['id_evenement'] ), array('compil'=>array('plugins/auto/fullcalendar_facile/v2.5.2/agenda.json.html','html_c62d5b18ded70b7a44ecd3025fd27850','_evenements',0,$GLOBALS['spip_lang'])), _request('connect'))))))) :
		'') .
'
' .
BOUCLE_motshtml_c62d5b18ded70b7a44ecd3025fd27850($Cache, $Pile, $doublons, $Numrows, $SP) .
'
' .
json_encode(table_valeur($Pile["vars"], (string)'tableau', null)) .
'
');
		$t0 .= ((strlen($t1) && strlen($t0)) ? ', ' : '') . $t1;
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_evenements @ plugins/auto/fullcalendar_facile/v2.5.2/agenda.json.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}

//
// Fonction principale du squelette plugins/auto/fullcalendar_facile/v2.5.2/agenda.json.html
// Temps de compilation total: 1.890 ms
//

function html_c62d5b18ded70b7a44ecd3025fd27850($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'<'.'?php header(' . _q((	'Content-type:application/json;charset=' .
	interdire_scripts($GLOBALS['meta']['charset']))) . '); ?'.'>[' .
BOUCLE_evenementshtml_c62d5b18ded70b7a44ecd3025fd27850($Cache, $Pile, $doublons, $Numrows, $SP) .
']
');

	return analyse_resultat_skel('html_c62d5b18ded70b7a44ecd3025fd27850', $Cache, $page, 'plugins/auto/fullcalendar_facile/v2.5.2/agenda.json.html');
}
?>