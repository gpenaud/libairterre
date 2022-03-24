<?php

/*
 * Squelette : plugins-dist/medias/modeles/emb.html
 * Date :      Fri, 04 Jun 2021 14:01:59 GMT
 * Compile :   Fri, 04 Jun 2021 14:34:28 GMT
 * Boucles :   _ext
 */ 

function BOUCLE_exthtml_ffee1fb84461d85c7cca731f72395470(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';if (!defined('_DIR_PLUGIN_ACCESRESTREINT')) {
			$link_empty = generer_url_ecrire('admin_vider'); $link_plugin = generer_url_ecrire('admin_plugin');
			$message_fr = 'La restriction d\'acc&egrave;s a ete desactiv&eacute;e. <a href="'.$link_plugin.'">Corriger le probl&egrave;me</a> ou <a href="'.$link_empty.'">vider le cache</a> pour supprimer les restrictions.';
			$message_en = 'Acces Restriction is now unusable. <a href="'.$link_plugin.'">Correct this trouble</a> or <a href="'.generer_url_ecrire('admin_vider').'">empty the cache</a> to finish restriction removal.';
			die($message_fr.'<br />'.$message_en);
			}
	if (!isset($command['table'])) {
		$command['table'] = 'documents';
		$command['id'] = '_ext';
		$command['from'] = array('documents' => 'spip_documents');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("documents.id_document",
		"documents.extension",
		"documents.id_document");
		$command['orderby'] = array();
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	$command['where'] = 
			array(
			array('(documents.taille > 0 OR documents.distant=\'oui\')'), 
			array('=', 'documents.id_document', sql_quote(@$Pile[0]['id_document'], '','bigint(21) NOT NULL AUTO_INCREMENT')), array('OR',
	array('IN','documents.id_document','(SELECT * FROM('.sql_get_select('zzzd.id_document','spip_documents_liens as zzzd',array(array('OR',array('OR',array('OR',array('OR',array('AND','zzzd.objet=\'rubrique\'',sql_in('zzzd.id_objet', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), 'NOT')),array('AND','zzzd.objet=\'article\'',array('AND', array('NOT IN','zzzd.id_objet','(SELECT * FROM('.sql_get_select('zzza.id_article','spip_articles as zzza',sql_in('zzza.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), ''), '', '', '', '',$connect).') AS subquery)'), sql_in('zzzd.id_objet', accesrestreint_liste_objets_exclus('articles', !test_espace_prive()), 'not')))),array('AND','zzzd.objet=\'breve\'',array('AND', array('NOT IN','zzzd.id_objet','(SELECT * FROM('.sql_get_select('zzzb.id_breve','spip_breves as zzzb',sql_in('zzzb.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), ''), '', '', '', '',$connect).') AS subquery)'), sql_in('zzzd.id_objet', accesrestreint_liste_objets_exclus('breves', !test_espace_prive()), 'not')))),array('AND','zzzd.objet=\'forum\'',array('IN','zzzd.id_objet','(SELECT * FROM('.sql_get_select('zzzf.id_forum','spip_forum as zzzf',array(array('OR',array('OR',array('OR',array('AND','zzzf.objet=\'rubrique\'',sql_in('zzzf.id_objet', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), 'NOT')),array('AND','zzzf.objet=\'article\'',array('AND', array('NOT IN','zzzf.id_objet','(SELECT * FROM('.sql_get_select('zzza.id_article','spip_articles as zzza',sql_in('zzza.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), ''), '', '', '', '',$connect).') AS subquery)'), sql_in('zzzf.id_objet', accesrestreint_liste_objets_exclus('articles', !test_espace_prive()), 'not')))),array('AND','zzzf.objet=\'breve\'',array('AND', array('NOT IN','zzzf.id_objet','(SELECT * FROM('.sql_get_select('zzzb.id_breve','spip_breves as zzzb',sql_in('zzzb.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), ''), '', '', '', '',$connect).') AS subquery)'), sql_in('zzzf.id_objet', accesrestreint_liste_objets_exclus('breves', !test_espace_prive()), 'not')))),sql_in('zzzf.objet',array('rubrique','article','breve'),'NOT',$connect))),'','','','',$connect).') AS subquery)'))),sql_in('zzzd.objet',array('rubrique','article','breve','forum'),'NOT',$connect))),'','','','',$connect).') AS subquery)'),
	array('NOT IN','documents.id_document','(SELECT * FROM('.sql_get_select('zzzd.id_document','spip_documents_liens as zzzd','','','','','',$connect).') AS subquery)')
	));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('plugins-dist/medias/modeles/emb.html','html_ffee1fb84461d85c7cca731f72395470','_ext',1,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$t0 .= (
'
' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette((	'modeles/' .
	interdire_scripts(trouver_modele_emb($Pile[$SP]['extension'],interdire_scripts(mime_type_oembed($Pile[$SP]['id_document'])))))) . ', array_merge('.var_export($Pile[0],1).',array(\'id\' => ' . argumenter_squelette($Pile[$SP]['id_document']) . ',
	\'emb\' => ' . argumenter_squelette(' ') . ',
	\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . ')), array("compil"=>array(\'plugins-dist/medias/modeles/emb.html\',\'html_ffee1fb84461d85c7cca731f72395470\',\'\',2,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>
');
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_ext @ plugins-dist/medias/modeles/emb.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}

//
// Fonction principale du squelette plugins-dist/medias/modeles/emb.html
// Temps de compilation total: 5.127 ms
//

function html_ffee1fb84461d85c7cca731f72395470($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
BOUCLE_exthtml_ffee1fb84461d85c7cca731f72395470($Cache, $Pile, $doublons, $Numrows, $SP) .
'
');

	return analyse_resultat_skel('html_ffee1fb84461d85c7cca731f72395470', $Cache, $page, 'plugins-dist/medias/modeles/emb.html');
}
?>