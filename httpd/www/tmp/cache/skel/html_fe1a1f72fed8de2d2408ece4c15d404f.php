<?php

/*
 * Squelette : plugins/html5up_editorial/inclure/documents.html
 * Date :      Fri, 04 Jun 2021 14:01:59 GMT
 * Compile :   Sat, 05 Jun 2021 07:58:14 GMT
 * Boucles :   _documents_portfolio, _documents_joints
 */ 

function BOUCLE_documents_portfoliohtml_fe1a1f72fed8de2d2408ece4c15d404f(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	$doublons_index = array();
	$in = array();
	if (!(is_array($a = (@$Pile[0]['id_article']))))
		$in[]= $a;
	else $in = array_merge($in, $a);
	$in1 = array();
	if (!(is_array($a = (@$Pile[0]['id_rubrique']))))
		$in1[]= $a;
	else $in1 = array_merge($in1, $a);
	$in2 = array();
	if (!(is_array($a = (@$Pile[0]['objet']))))
		$in2[]= $a;
	else $in2 = array_merge($in2, $a);
	$in3 = array();
	if (!(is_array($a = (@$Pile[0]['id_objet']))))
		$in3[]= $a;
	else $in3 = array_merge($in3, $a);
	$in4 = array();
	$in4[]= 'png';
	$in4[]= 'jpg';
	$in4[]= 'gif';

	// Initialise le(s) critère(s) doublons
	if (!isset($doublons[$d = 'documents'])) { $doublons[$d] = ''; }
if (!defined('_DIR_PLUGIN_ACCESRESTREINT')) {
			$link_empty = generer_url_ecrire('admin_vider'); $link_plugin = generer_url_ecrire('admin_plugin');
			$message_fr = 'La restriction d\'acc&egrave;s a ete desactiv&eacute;e. <a href="'.$link_plugin.'">Corriger le probl&egrave;me</a> ou <a href="'.$link_empty.'">vider le cache</a> pour supprimer les restrictions.';
			$message_en = 'Acces Restriction is now unusable. <a href="'.$link_plugin.'">Correct this trouble</a> or <a href="'.generer_url_ecrire('admin_vider').'">empty the cache</a> to finish restriction removal.';
			die($message_fr.'<br />'.$message_en);
			}
	if (!isset($command['table'])) {
		$command['table'] = 'documents';
		$command['id'] = '_documents_portfolio';
		$command['from'] = array('documents' => 'spip_documents','L1' => 'spip_documents_liens','L2' => 'spip_documents_liens','L3' => 'spip_documents_liens','L4' => 'spip_documents_liens');
		$command['type'] = array();
		$command['groupby'] = array("documents.id_document");
		$command['select'] = array("0+documents.titre AS num",
		"documents.date",
		"documents.id_document",
		"L1.id_objet AS id_article",
		"L1.id_objet AS id_rubrique",
		"documents.titre",
		"documents.fichier",
		"documents.id_document");
		$command['orderby'] = array('num', 'documents.date');
		$command['join'] = array('L1' => array('documents','id_document'), 'L2' => array('documents','id_document'), 'L3' => array('documents','id_document'), 'L4' => array('documents','id_document'));
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	$command['where'] = 
			array(
quete_condition_statut('documents.statut','publie,prop,prepa','publie',''), 
quete_condition_postdates('documents.date_publication',''), 
			array('(documents.taille > 0 OR documents.distant=\'oui\')'), (!(is_array(@$Pile[0]['id_article'])?count(@$Pile[0]['id_article']):strlen(@$Pile[0]['id_article'])) ? '' : ((is_array(@$Pile[0]['id_article'])) ? sql_in('L1.id_objet',sql_quote($in)) : 
			array('=', 'L1.id_objet', sql_quote(@$Pile[0]['id_article'], '','bigint(21) NOT NULL DEFAULT 0')))), (!(is_array(@$Pile[0]['id_article'])?count(@$Pile[0]['id_article']):strlen(@$Pile[0]['id_article'])) ? '' : 
			array('=', 'L1.objet', sql_quote('article'))), (!(is_array(@$Pile[0]['id_rubrique'])?count(@$Pile[0]['id_rubrique']):strlen(@$Pile[0]['id_rubrique'])) ? '' : ((is_array(@$Pile[0]['id_rubrique'])) ? sql_in('L2.id_objet',sql_quote($in1)) : 
			array('=', 'L2.id_objet', sql_quote(@$Pile[0]['id_rubrique'], '','bigint(21) NOT NULL DEFAULT 0')))), (!(is_array(@$Pile[0]['id_rubrique'])?count(@$Pile[0]['id_rubrique']):strlen(@$Pile[0]['id_rubrique'])) ? '' : 
			array('=', 'L2.objet', sql_quote('rubrique'))), (!(is_array(@$Pile[0]['objet'])?count(@$Pile[0]['objet']):strlen(@$Pile[0]['objet'])) ? '' : ((is_array(@$Pile[0]['objet'])) ? sql_in('L3.objet',sql_quote($in2)) : 
			array('=', 'L3.objet', sql_quote(@$Pile[0]['objet'], '','varchar(25) NOT NULL DEFAULT \'\'')))), (!(is_array(@$Pile[0]['id_objet'])?count(@$Pile[0]['id_objet']):strlen(@$Pile[0]['id_objet'])) ? '' : ((is_array(@$Pile[0]['id_objet'])) ? sql_in('L4.id_objet',sql_quote($in3)) : 
			array('=', 'L4.id_objet', sql_quote(@$Pile[0]['id_objet'], '','bigint(21) NOT NULL DEFAULT 0')))), 
			array('=', 'documents.mode', "'document'"), sql_in('documents.extension',sql_quote($in4)), 
			array('=', 'L1.vu', "'non'"), 
			array(sql_in('documents.id_document', $doublons[$doublons_index[]= ('documents')], 'NOT')), array('OR',
	array('IN','documents.id_document','(SELECT * FROM('.sql_get_select('zzzd.id_document','spip_documents_liens as zzzd',array(array('OR',array('OR',array('OR',array('OR',array('AND','zzzd.objet=\'rubrique\'',sql_in('zzzd.id_objet', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), 'NOT')),array('AND','zzzd.objet=\'article\'',array('AND', array('NOT IN','zzzd.id_objet','(SELECT * FROM('.sql_get_select('zzza.id_article','spip_articles as zzza',sql_in('zzza.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), ''), '', '', '', '',$connect).') AS subquery)'), sql_in('zzzd.id_objet', accesrestreint_liste_objets_exclus('articles', !test_espace_prive()), 'not')))),array('AND','zzzd.objet=\'breve\'',array('AND', array('NOT IN','zzzd.id_objet','(SELECT * FROM('.sql_get_select('zzzb.id_breve','spip_breves as zzzb',sql_in('zzzb.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), ''), '', '', '', '',$connect).') AS subquery)'), sql_in('zzzd.id_objet', accesrestreint_liste_objets_exclus('breves', !test_espace_prive()), 'not')))),array('AND','zzzd.objet=\'forum\'',array('IN','zzzd.id_objet','(SELECT * FROM('.sql_get_select('zzzf.id_forum','spip_forum as zzzf',array(array('OR',array('OR',array('OR',array('AND','zzzf.objet=\'rubrique\'',sql_in('zzzf.id_objet', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), 'NOT')),array('AND','zzzf.objet=\'article\'',array('AND', array('NOT IN','zzzf.id_objet','(SELECT * FROM('.sql_get_select('zzza.id_article','spip_articles as zzza',sql_in('zzza.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), ''), '', '', '', '',$connect).') AS subquery)'), sql_in('zzzf.id_objet', accesrestreint_liste_objets_exclus('articles', !test_espace_prive()), 'not')))),array('AND','zzzf.objet=\'breve\'',array('AND', array('NOT IN','zzzf.id_objet','(SELECT * FROM('.sql_get_select('zzzb.id_breve','spip_breves as zzzb',sql_in('zzzb.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), ''), '', '', '', '',$connect).') AS subquery)'), sql_in('zzzf.id_objet', accesrestreint_liste_objets_exclus('breves', !test_espace_prive()), 'not')))),sql_in('zzzf.objet',array('rubrique','article','breve'),'NOT',$connect))),'','','','',$connect).') AS subquery)'))),sql_in('zzzd.objet',array('rubrique','article','breve','forum'),'NOT',$connect))),'','','','',$connect).') AS subquery)'),
	array('NOT IN','documents.id_document','(SELECT * FROM('.sql_get_select('zzzd.id_document','spip_documents_liens as zzzd','','','','','',$connect).') AS subquery)')
	));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('plugins/html5up_editorial/inclure/documents.html','html_fe1a1f72fed8de2d2408ece4c15d404f','_documents_portfolio',2,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	
	// COMPTEUR
	$Numrows['_documents_portfolio']['compteur_boucle'] = 0;
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$Numrows['_documents_portfolio']['compteur_boucle']++;
			foreach($doublons_index as $k) $doublons[$k] .= "," . $Pile[$SP]['id_document']; // doublons

		$t0 .= (($t1 = strval(vider_url(urlencode_1738(generer_url_entite($Pile[$SP]['id_document'], 'document', '', '', true)))))!=='' ?
		((	'
		<div class="' .
	alterner($Numrows['_documents_portfolio']['compteur_boucle'],'4u','4u','4u$') .
	'">
			<a href="') . $t1 . (	'"
				class="image fit"
				type="' .
	interdire_scripts(mime_type_oembed($Pile[$SP]['id_document'])) .
	'"
				rel="documents_portfolio' .
	(($t2 = strval($Pile[$SP]['id_article']))!=='' ?
			('-a' . $t2) :
			'') .
	(($t2 = strval($Pile[$SP]['id_rubrique']))!=='' ?
			('-r' . $t2) :
			'') .
	'"
				' .
	(($t2 = strval(interdire_scripts(couper(attribut_html(traiter_doublons_documents($doublons, supprimer_numero(typo($Pile[$SP]['titre']), "TYPO", $connect, $Pile[0]))),'80'))))!=='' ?
			(' title="' . $t2 . '"') :
			'') .
	'>' .
	interdire_scripts(inserer_attribut(html5up_image_reduire(get_spip_doc($Pile[$SP]['fichier']),'300','200'),'alt',interdire_scripts(couper(attribut_html(traiter_doublons_documents($doublons, supprimer_numero(typo($Pile[$SP]['titre']), "TYPO", $connect, $Pile[0]))),'80')))) .
	'
			</a>
		</div>
	')) :
		'');
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_documents_portfolio @ plugins/html5up_editorial/inclure/documents.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLE_documents_jointshtml_fe1a1f72fed8de2d2408ece4c15d404f(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	$doublons_index = array();
	$in = array();
	if (!(is_array($a = (@$Pile[0]['id_article']))))
		$in[]= $a;
	else $in = array_merge($in, $a);
	$in1 = array();
	if (!(is_array($a = (@$Pile[0]['id_rubrique']))))
		$in1[]= $a;
	else $in1 = array_merge($in1, $a);
	$in2 = array();
	if (!(is_array($a = (@$Pile[0]['objet']))))
		$in2[]= $a;
	else $in2 = array_merge($in2, $a);
	$in3 = array();
	if (!(is_array($a = (@$Pile[0]['id_objet']))))
		$in3[]= $a;
	else $in3 = array_merge($in3, $a);
	$in4 = array();
	$in4[]= 'gif';
	$in4[]= 'jpg';
	$in4[]= 'png';

	// Initialise le(s) critère(s) doublons
	if (!isset($doublons[$d = 'documents'])) { $doublons[$d] = ''; }
if (!defined('_DIR_PLUGIN_ACCESRESTREINT')) {
			$link_empty = generer_url_ecrire('admin_vider'); $link_plugin = generer_url_ecrire('admin_plugin');
			$message_fr = 'La restriction d\'acc&egrave;s a ete desactiv&eacute;e. <a href="'.$link_plugin.'">Corriger le probl&egrave;me</a> ou <a href="'.$link_empty.'">vider le cache</a> pour supprimer les restrictions.';
			$message_en = 'Acces Restriction is now unusable. <a href="'.$link_plugin.'">Correct this trouble</a> or <a href="'.generer_url_ecrire('admin_vider').'">empty the cache</a> to finish restriction removal.';
			die($message_fr.'<br />'.$message_en);
			}
	if (!isset($command['table'])) {
		$command['table'] = 'documents';
		$command['id'] = '_documents_joints';
		$command['from'] = array('documents' => 'spip_documents','L1' => 'spip_documents_liens','L2' => 'spip_documents_liens','L3' => 'spip_documents_liens','L4' => 'spip_documents_liens');
		$command['type'] = array();
		$command['groupby'] = array("documents.id_document");
		$command['select'] = array("0+documents.titre AS num",
		"documents.date",
		"documents.id_document",
		"documents.id_document");
		$command['orderby'] = array('num', 'documents.date');
		$command['join'] = array('L1' => array('documents','id_document'), 'L2' => array('documents','id_document'), 'L3' => array('documents','id_document'), 'L4' => array('documents','id_document'));
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	$command['where'] = 
			array(
quete_condition_statut('documents.statut','publie,prop,prepa','publie',''), 
quete_condition_postdates('documents.date_publication',''), 
			array('IN', 'documents.mode', '(\'image\',\'document\')'), 
			array('(documents.taille > 0 OR documents.distant=\'oui\')'), (!(is_array(@$Pile[0]['id_article'])?count(@$Pile[0]['id_article']):strlen(@$Pile[0]['id_article'])) ? '' : ((is_array(@$Pile[0]['id_article'])) ? sql_in('L1.id_objet',sql_quote($in)) : 
			array('=', 'L1.id_objet', sql_quote(@$Pile[0]['id_article'], '','bigint(21) NOT NULL DEFAULT 0')))), (!(is_array(@$Pile[0]['id_article'])?count(@$Pile[0]['id_article']):strlen(@$Pile[0]['id_article'])) ? '' : 
			array('=', 'L1.objet', sql_quote('article'))), (!(is_array(@$Pile[0]['id_rubrique'])?count(@$Pile[0]['id_rubrique']):strlen(@$Pile[0]['id_rubrique'])) ? '' : ((is_array(@$Pile[0]['id_rubrique'])) ? sql_in('L2.id_objet',sql_quote($in1)) : 
			array('=', 'L2.id_objet', sql_quote(@$Pile[0]['id_rubrique'], '','bigint(21) NOT NULL DEFAULT 0')))), (!(is_array(@$Pile[0]['id_rubrique'])?count(@$Pile[0]['id_rubrique']):strlen(@$Pile[0]['id_rubrique'])) ? '' : 
			array('=', 'L2.objet', sql_quote('rubrique'))), (!(is_array(@$Pile[0]['objet'])?count(@$Pile[0]['objet']):strlen(@$Pile[0]['objet'])) ? '' : ((is_array(@$Pile[0]['objet'])) ? sql_in('L3.objet',sql_quote($in2)) : 
			array('=', 'L3.objet', sql_quote(@$Pile[0]['objet'], '','varchar(25) NOT NULL DEFAULT \'\'')))), (!(is_array(@$Pile[0]['id_objet'])?count(@$Pile[0]['id_objet']):strlen(@$Pile[0]['id_objet'])) ? '' : ((is_array(@$Pile[0]['id_objet'])) ? sql_in('L4.id_objet',sql_quote($in3)) : 
			array('=', 'L4.id_objet', sql_quote(@$Pile[0]['id_objet'], '','bigint(21) NOT NULL DEFAULT 0')))), sql_in('documents.extension',sql_quote($in4),'NOT'), 
			array('=', 'L1.vu', "'non'"), 
			array(sql_in('documents.id_document', $doublons[$doublons_index[]= ('documents')], 'NOT')), array('OR',
	array('IN','documents.id_document','(SELECT * FROM('.sql_get_select('zzzd.id_document','spip_documents_liens as zzzd',array(array('OR',array('OR',array('OR',array('OR',array('AND','zzzd.objet=\'rubrique\'',sql_in('zzzd.id_objet', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), 'NOT')),array('AND','zzzd.objet=\'article\'',array('AND', array('NOT IN','zzzd.id_objet','(SELECT * FROM('.sql_get_select('zzza.id_article','spip_articles as zzza',sql_in('zzza.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), ''), '', '', '', '',$connect).') AS subquery)'), sql_in('zzzd.id_objet', accesrestreint_liste_objets_exclus('articles', !test_espace_prive()), 'not')))),array('AND','zzzd.objet=\'breve\'',array('AND', array('NOT IN','zzzd.id_objet','(SELECT * FROM('.sql_get_select('zzzb.id_breve','spip_breves as zzzb',sql_in('zzzb.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), ''), '', '', '', '',$connect).') AS subquery)'), sql_in('zzzd.id_objet', accesrestreint_liste_objets_exclus('breves', !test_espace_prive()), 'not')))),array('AND','zzzd.objet=\'forum\'',array('IN','zzzd.id_objet','(SELECT * FROM('.sql_get_select('zzzf.id_forum','spip_forum as zzzf',array(array('OR',array('OR',array('OR',array('AND','zzzf.objet=\'rubrique\'',sql_in('zzzf.id_objet', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), 'NOT')),array('AND','zzzf.objet=\'article\'',array('AND', array('NOT IN','zzzf.id_objet','(SELECT * FROM('.sql_get_select('zzza.id_article','spip_articles as zzza',sql_in('zzza.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), ''), '', '', '', '',$connect).') AS subquery)'), sql_in('zzzf.id_objet', accesrestreint_liste_objets_exclus('articles', !test_espace_prive()), 'not')))),array('AND','zzzf.objet=\'breve\'',array('AND', array('NOT IN','zzzf.id_objet','(SELECT * FROM('.sql_get_select('zzzb.id_breve','spip_breves as zzzb',sql_in('zzzb.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), ''), '', '', '', '',$connect).') AS subquery)'), sql_in('zzzf.id_objet', accesrestreint_liste_objets_exclus('breves', !test_espace_prive()), 'not')))),sql_in('zzzf.objet',array('rubrique','article','breve'),'NOT',$connect))),'','','','',$connect).') AS subquery)'))),sql_in('zzzd.objet',array('rubrique','article','breve','forum'),'NOT',$connect))),'','','','',$connect).') AS subquery)'),
	array('NOT IN','documents.id_document','(SELECT * FROM('.sql_get_select('zzzd.id_document','spip_documents_liens as zzzd','','','','','',$connect).') AS subquery)')
	));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('plugins/html5up_editorial/inclure/documents.html','html_fe1a1f72fed8de2d2408ece4c15d404f','_documents_joints',28,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

			foreach($doublons_index as $k) $doublons[$k] .= "," . $Pile[$SP]['id_document']; // doublons

		$t0 .= (
'
		<li class="item box">' .
recuperer_fond( 'inclure/resume/document' , array('id_document' => $Pile[$SP]['id_document'] ), array('compil'=>array('plugins/html5up_editorial/inclure/documents.html','html_fe1a1f72fed8de2d2408ece4c15d404f','_documents_joints',33,$GLOBALS['spip_lang'])), _request('connect')) .
'</li>
		');
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_documents_joints @ plugins/html5up_editorial/inclure/documents.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}

//
// Fonction principale du squelette plugins/html5up_editorial/inclure/documents.html
// Temps de compilation total: 3.503 ms
//

function html_fe1a1f72fed8de2d2408ece4c15d404f($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'
' .
(($t1 = BOUCLE_documents_portfoliohtml_fe1a1f72fed8de2d2408ece4c15d404f($Cache, $Pile, $doublons, $Numrows, $SP))!=='' ?
		((	'
<div class="liste documents documents_portfolio">
	<h2 class="h2">' .
		_T('medias:info_portfolio') .
		'</h2>
	<div class="box alt">
		<div class="row uniform">
	') . $t1 . '
		</div>
	</div>
</div>
') :
		'') .
'



' .
(($t1 = BOUCLE_documents_jointshtml_fe1a1f72fed8de2d2408ece4c15d404f($Cache, $Pile, $doublons, $Numrows, $SP))!=='' ?
		((	'
<div class="liste documents documents_joints">
	<h2 class="h2">' .
		_T('medias:titre_documents_joints') .
		'</h2>
	<ul class="liste-items">
		') . $t1 . '
	</ul>
</div>
') :
		'') .
'
');

	return analyse_resultat_skel('html_fe1a1f72fed8de2d2408ece4c15d404f', $Cache, $page, 'plugins/html5up_editorial/inclure/documents.html');
}
?>