<?php

/*
 * Squelette : squelettes-dist/inclure/forum.html
 * Date :      Thu, 24 Mar 2022 09:53:23 GMT
 * Compile :   Thu, 24 Mar 2022 16:25:58 GMT
 * Boucles :   _doc, _doc2, _comments-fils, _comments
 */ 

function BOUCLE_dochtml_0acfb1d6fd08461a6c83485d03693d0d(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

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
		$command['id'] = '_doc';
		$command['from'] = array('documents' => 'spip_documents','L1' => 'spip_documents_liens');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("documents.extension",
		"documents.id_document",
		"documents.id_document");
		$command['orderby'] = array();
		$command['join'] = array('L1' => array('documents','id_document'));
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	$command['where'] = 
			array(
quete_condition_statut('documents.statut','publie,prop,prepa','publie',''), 
quete_condition_postdates('documents.date_publication',''), 
			array('IN', 'documents.mode', '(\'image\',\'document\')'), 
			array('(documents.taille > 0 OR documents.distant=\'oui\')'), 
			array('=', 'L1.id_objet', sql_quote($Pile[$SP]['id_forum'], '','bigint(21) NOT NULL DEFAULT 0')), 
			array('=', 'L1.objet', sql_quote('forum')), array('OR',
	array('IN','documents.id_document','(SELECT * FROM('.sql_get_select('zzzd.id_document','spip_documents_liens as zzzd',array(array('OR',array('OR',array('OR',array('OR',array('AND','zzzd.objet=\'rubrique\'',sql_in('zzzd.id_objet', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), 'NOT')),array('AND','zzzd.objet=\'article\'',array('AND', array('NOT IN','zzzd.id_objet','(SELECT * FROM('.sql_get_select('zzza.id_article','spip_articles as zzza',sql_in('zzza.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), ''), '', '', '', '',$connect).') AS subquery)'), sql_in('zzzd.id_objet', accesrestreint_liste_objets_exclus('articles', !test_espace_prive()), 'not')))),array('AND','zzzd.objet=\'breve\'',array('AND', array('NOT IN','zzzd.id_objet','(SELECT * FROM('.sql_get_select('zzzb.id_breve','spip_breves as zzzb',sql_in('zzzb.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), ''), '', '', '', '',$connect).') AS subquery)'), sql_in('zzzd.id_objet', accesrestreint_liste_objets_exclus('breves', !test_espace_prive()), 'not')))),array('AND','zzzd.objet=\'forum\'',array('IN','zzzd.id_objet','(SELECT * FROM('.sql_get_select('zzzf.id_forum','spip_forum as zzzf',array(array('OR',array('OR',array('OR',array('AND','zzzf.objet=\'rubrique\'',sql_in('zzzf.id_objet', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), 'NOT')),array('AND','zzzf.objet=\'article\'',array('AND', array('NOT IN','zzzf.id_objet','(SELECT * FROM('.sql_get_select('zzza.id_article','spip_articles as zzza',sql_in('zzza.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), ''), '', '', '', '',$connect).') AS subquery)'), sql_in('zzzf.id_objet', accesrestreint_liste_objets_exclus('articles', !test_espace_prive()), 'not')))),array('AND','zzzf.objet=\'breve\'',array('AND', array('NOT IN','zzzf.id_objet','(SELECT * FROM('.sql_get_select('zzzb.id_breve','spip_breves as zzzb',sql_in('zzzb.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), ''), '', '', '', '',$connect).') AS subquery)'), sql_in('zzzf.id_objet', accesrestreint_liste_objets_exclus('breves', !test_espace_prive()), 'not')))),sql_in('zzzf.objet',array('rubrique','article','breve'),'NOT',$connect))),'','','','',$connect).') AS subquery)'))),sql_in('zzzd.objet',array('rubrique','article','breve','forum'),'NOT',$connect))),'','','','',$connect).') AS subquery)'),
	array('NOT IN','documents.id_document','(SELECT * FROM('.sql_get_select('zzzd.id_document','spip_documents_liens as zzzd','','','','','',$connect).') AS subquery)')
	));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('squelettes-dist/inclure/forum.html','html_0acfb1d6fd08461a6c83485d03693d0d','_doc',25,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$t0 .= (
'
				' .
interdire_scripts((match($Pile[$SP]['extension'],'^(gif|jpg|png)$') ? (	filtrer('image_graver',filtrer('image_reduire',
	((($recurs=(isset($Pile[0]['recurs'])?$Pile[0]['recurs']:0))>=5)? '' :
	recuperer_fond('modeles/emb', array('lang' => $GLOBALS["spip_lang"] ,
	'id_document'=>$Pile[$SP]['id_document'],
	'id'=>$Pile[$SP]['id_document'],
	'recurs'=>(++$recurs)), array('compil'=>array('squelettes-dist/inclure/forum.html','html_0acfb1d6fd08461a6c83485d03693d0d','_doc',27,$GLOBALS['spip_lang']), 'trim'=>true), ''))
,'672','*')) .
	'
				'):quete_logo_document(quete_document($Pile[$SP]['id_document'], ''), vider_url(urlencode_1738(generer_url_entite($Pile[$SP]['id_document'], 'document', '', '', true))), '', '', 0, 0, ''))) .
'
				');
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_doc @ squelettes-dist/inclure/forum.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLE_doc2html_0acfb1d6fd08461a6c83485d03693d0d(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

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
		$command['id'] = '_doc2';
		$command['from'] = array('documents' => 'spip_documents','L1' => 'spip_documents_liens');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("documents.extension",
		"documents.id_document",
		"documents.id_document");
		$command['orderby'] = array();
		$command['join'] = array('L1' => array('documents','id_document'));
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	$command['where'] = 
			array(
quete_condition_statut('documents.statut','publie,prop,prepa','publie',''), 
quete_condition_postdates('documents.date_publication',''), 
			array('IN', 'documents.mode', '(\'image\',\'document\')'), 
			array('(documents.taille > 0 OR documents.distant=\'oui\')'), 
			array('=', 'L1.id_objet', sql_quote($Pile[$SP]['id_forum'], '','bigint(21) NOT NULL DEFAULT 0')), 
			array('=', 'L1.objet', sql_quote('forum')), array('OR',
	array('IN','documents.id_document','(SELECT * FROM('.sql_get_select('zzzd.id_document','spip_documents_liens as zzzd',array(array('OR',array('OR',array('OR',array('OR',array('AND','zzzd.objet=\'rubrique\'',sql_in('zzzd.id_objet', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), 'NOT')),array('AND','zzzd.objet=\'article\'',array('AND', array('NOT IN','zzzd.id_objet','(SELECT * FROM('.sql_get_select('zzza.id_article','spip_articles as zzza',sql_in('zzza.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), ''), '', '', '', '',$connect).') AS subquery)'), sql_in('zzzd.id_objet', accesrestreint_liste_objets_exclus('articles', !test_espace_prive()), 'not')))),array('AND','zzzd.objet=\'breve\'',array('AND', array('NOT IN','zzzd.id_objet','(SELECT * FROM('.sql_get_select('zzzb.id_breve','spip_breves as zzzb',sql_in('zzzb.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), ''), '', '', '', '',$connect).') AS subquery)'), sql_in('zzzd.id_objet', accesrestreint_liste_objets_exclus('breves', !test_espace_prive()), 'not')))),array('AND','zzzd.objet=\'forum\'',array('IN','zzzd.id_objet','(SELECT * FROM('.sql_get_select('zzzf.id_forum','spip_forum as zzzf',array(array('OR',array('OR',array('OR',array('AND','zzzf.objet=\'rubrique\'',sql_in('zzzf.id_objet', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), 'NOT')),array('AND','zzzf.objet=\'article\'',array('AND', array('NOT IN','zzzf.id_objet','(SELECT * FROM('.sql_get_select('zzza.id_article','spip_articles as zzza',sql_in('zzza.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), ''), '', '', '', '',$connect).') AS subquery)'), sql_in('zzzf.id_objet', accesrestreint_liste_objets_exclus('articles', !test_espace_prive()), 'not')))),array('AND','zzzf.objet=\'breve\'',array('AND', array('NOT IN','zzzf.id_objet','(SELECT * FROM('.sql_get_select('zzzb.id_breve','spip_breves as zzzb',sql_in('zzzb.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), ''), '', '', '', '',$connect).') AS subquery)'), sql_in('zzzf.id_objet', accesrestreint_liste_objets_exclus('breves', !test_espace_prive()), 'not')))),sql_in('zzzf.objet',array('rubrique','article','breve'),'NOT',$connect))),'','','','',$connect).') AS subquery)'))),sql_in('zzzd.objet',array('rubrique','article','breve','forum'),'NOT',$connect))),'','','','',$connect).') AS subquery)'),
	array('NOT IN','documents.id_document','(SELECT * FROM('.sql_get_select('zzzd.id_document','spip_documents_liens as zzzd','','','','','',$connect).') AS subquery)')
	));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('squelettes-dist/inclure/forum.html','html_0acfb1d6fd08461a6c83485d03693d0d','_doc2',50,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$t0 .= (
'
						' .
interdire_scripts((match($Pile[$SP]['extension'],'^(gif|jpg|png)$') ? (	filtrer('image_graver',filtrer('image_reduire',
	((($recurs=(isset($Pile[0]['recurs'])?$Pile[0]['recurs']:0))>=5)? '' :
	recuperer_fond('modeles/emb', array('lang' => $GLOBALS["spip_lang"] ,
	'id_document'=>$Pile[$SP]['id_document'],
	'id'=>$Pile[$SP]['id_document'],
	'recurs'=>(++$recurs)), array('compil'=>array('squelettes-dist/inclure/forum.html','html_0acfb1d6fd08461a6c83485d03693d0d','_doc2',52,$GLOBALS['spip_lang']), 'trim'=>true), ''))
,'672','*')) .
	'
						'):quete_logo_document(quete_document($Pile[$SP]['id_document'], ''), vider_url(urlencode_1738(generer_url_entite($Pile[$SP]['id_document'], 'document', '', '', true))), '', '', 0, 0, ''))) .
'
						');
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_doc2 @ squelettes-dist/inclure/forum.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLE_comments_filshtml_0acfb1d6fd08461a6c83485d03693d0d(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';if (!defined('_DIR_PLUGIN_ACCESRESTREINT')) {
			$link_empty = generer_url_ecrire('admin_vider'); $link_plugin = generer_url_ecrire('admin_plugin');
			$message_fr = 'La restriction d\'acc&egrave;s a ete desactiv&eacute;e. <a href="'.$link_plugin.'">Corriger le probl&egrave;me</a> ou <a href="'.$link_empty.'">vider le cache</a> pour supprimer les restrictions.';
			$message_en = 'Acces Restriction is now unusable. <a href="'.$link_plugin.'">Correct this trouble</a> or <a href="'.generer_url_ecrire('admin_vider').'">empty the cache</a> to finish restriction removal.';
			die($message_fr.'<br />'.$message_en);
			}
	if (!isset($command['table'])) {
		$command['table'] = 'forum';
		$command['id'] = '_comments-fils';
		$command['from'] = array('forum' => 'spip_forum');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("forum.id_forum",
		"forum.date_heure",
		"forum.titre",
		"forum.date_heure AS date",
		"forum.auteur AS nom",
		"forum.texte",
		"forum.url_site",
		"forum.nom_site",
		"forum.id_forum");
		$command['orderby'] = array('forum.date_heure');
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	$command['where'] = 
			array(
quete_condition_statut('forum.statut','publie,prop','publie',''), 
			array('=', 'forum.id_thread', sql_quote($Pile[$SP]['id_thread'], '','bigint(21) NOT NULL DEFAULT 0')), 
			array('NOT', 
			array('=', 'forum.id_forum', sql_quote($Pile[$SP]['id_forum'], '', 'bigint(21) NOT NULL AUTO_INCREMENT'))), array('IN','forum.id_forum','(SELECT * FROM('.sql_get_select('zzzf.id_forum','spip_forum as zzzf',array(array('OR',array('OR',array('OR',array('AND','zzzf.objet=\'rubrique\'',sql_in('zzzf.id_objet', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), 'NOT')),array('AND','zzzf.objet=\'article\'',array('AND', array('NOT IN','zzzf.id_objet','(SELECT * FROM('.sql_get_select('zzza.id_article','spip_articles as zzza',sql_in('zzza.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), ''), '', '', '', '',$connect).') AS subquery)'), sql_in('zzzf.id_objet', accesrestreint_liste_objets_exclus('articles', !test_espace_prive()), 'not')))),array('AND','zzzf.objet=\'breve\'',array('AND', array('NOT IN','zzzf.id_objet','(SELECT * FROM('.sql_get_select('zzzb.id_breve','spip_breves as zzzb',sql_in('zzzb.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), ''), '', '', '', '',$connect).') AS subquery)'), sql_in('zzzf.id_objet', accesrestreint_liste_objets_exclus('breves', !test_espace_prive()), 'not')))),sql_in('zzzf.objet',array('rubrique','article','breve'),'NOT',$connect))),'','','','',$connect).') AS subquery)'));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('squelettes-dist/inclure/forum.html','html_0acfb1d6fd08461a6c83485d03693d0d','_comments-fils',34,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	
	// COMPTEUR
	$Numrows['_comments-fils']['compteur_boucle'] = 0;
	$Numrows['_comments-fils']['total'] = @intval($iter->count());
	
	$l1 = _T('forum:forum_permalink');
	$l2 = _T('public|spip|ecrire:par_auteur');
	$l3 = _T('public|spip|ecrire:voir_en_ligne');$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$Numrows['_comments-fils']['compteur_boucle']++;
		$t0 .= (
'
			<li class="comment-item comment-fil' .
((($Numrows['_comments-fils']['compteur_boucle'] == '1'))  ?
		(' ' . ' ' . 'first') :
		'') .
((($Numrows['_comments-fils']['compteur_boucle'] == $Numrows['_comments-fils']['total']))  ?
		(' ' . ' ' . 'last') :
		'') .
'">
				<div class="comment hreview">
					<a href="#comment' .
$Pile[$SP]['id_forum'] .
'" name="comment' .
$Pile[$SP]['id_forum'] .
'" id="comment' .
$Pile[$SP]['id_forum'] .
'"></a>
					<a href="#forum' .
$Pile[$SP]['id_forum'] .
'" name="forum' .
$Pile[$SP]['id_forum'] .
'" id="forum' .
$Pile[$SP]['id_forum'] .
'"></a>
					<p class="comment-meta">
						<a rel="self bookmark" href="#forum' .
$Pile[$SP]['id_forum'] .
'" title="' .
$l1 .
' ' .
$Pile[$SP]['id_forum'] .
'" class="permalink">' .
(($t1 = strval(interdire_scripts(((((include_spip('inc/config')?lire_config('forums_titre',null,false):'') != 'non')) ?' ' :''))))!=='' ?
		($t1 . (	'<span class="permalink">' .
	$Numrows['_comments-fils']['compteur_boucle'] .
	'.</span>
						<strong class="comment-titre">' .
	(($t2 = strval(interdire_scripts(liens_nofollow(safehtml(typo(interdit_html($Pile[$SP]['titre']), "TYPO", $connect, $Pile[0]))))))!=='' ?
			($t2 . ', ') :
			'') .
	'</strong>')) :
		'') .
'
						<small><abbr class="dtreviewed"' .
(($t1 = strval(interdire_scripts(date_iso(normaliser_date($Pile[$SP]['date'])))))!=='' ?
		(' title="' . $t1 . '"') :
		'') .
'>' .
interdire_scripts(affdate_jourcourt(normaliser_date($Pile[$SP]['date']))) .
(($t1 = strval(interdire_scripts(heures(normaliser_date($Pile[$SP]['date'])))))!=='' ?
		(', ' . $t1) :
		'') .
(($t1 = strval(interdire_scripts(minutes(normaliser_date($Pile[$SP]['date'])))))!=='' ?
		(':' . $t1) :
		'') .
'</abbr>' .
(($t1 = strval(interdire_scripts(couper(supprimer_numero(typo($Pile[$SP]['nom']), "TYPO", $connect, $Pile[0]),'80'))))!=='' ?
		((	'<span class="sep">, </span>' .
	$l2 .
	' <span class="">') . $t1 . '</span>') :
		'') .
'</small></a>
					</p>
					<div class="comment-content description">
						' .
interdire_scripts(lignes_longues(liens_nofollow(safehtml(propre(interdit_html($Pile[$SP]['texte']), $connect, $Pile[0]))))) .
'
						' .
(($t1 = strval(interdire_scripts(lignes_longues(safehtml(liens_nofollow(safehtml(propre(interdit_html(calculer_notes()), $connect, $Pile[0]))))))))!=='' ?
		('<div class="comment-notes">' . $t1 . '</div>') :
		'') .
'
						' .
(($t1 = strval(safehtml(vider_url(calculer_url($Pile[$SP]['url_site'],'','url', $connect)))))!=='' ?
		((	'<p class="hyperlien">' .
	$l3 .
	' : <a href="') . $t1 . (	'" class="spip_out">' .
	interdire_scripts(((($a = liens_nofollow(safehtml(typo(interdit_html(supprimer_numero(calculer_url($Pile[$SP]['url_site'],$Pile[$SP]['nom_site'], 'titre', $connect, false))), "TYPO", $connect, $Pile[0])))) OR (is_string($a) AND strlen($a))) ? $a : couper(safehtml(vider_url(calculer_url($Pile[$SP]['url_site'],'','url', $connect))),'80'))) .
	'</a></p>')) :
		'') .
'
						' .
(($t1 = BOUCLE_doc2html_0acfb1d6fd08461a6c83485d03693d0d($Cache, $Pile, $doublons, $Numrows, $SP))!=='' ?
		('<div class="comment-doc">' . $t1 . '</div>') :
		'') .
'
					</div>
				</div>
			</li>
			');
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_comments-fils @ squelettes-dist/inclure/forum.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLE_commentshtml_0acfb1d6fd08461a6c83485d03693d0d(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	$in = array();
	if (!(is_array($a = (@$Pile[0]['id_rubrique']))))
		$in[]= $a;
	else $in = array_merge($in, $a);
	$in1 = array();
	if (!(is_array($a = (@$Pile[0]['id_article']))))
		$in1[]= $a;
	else $in1 = array_merge($in1, $a);
	$in2 = array();
	if (!(is_array($a = (@$Pile[0]['id_breve']))))
		$in2[]= $a;
	else $in2 = array_merge($in2, $a);
	$in3 = array();
	if (!(is_array($a = (@$Pile[0]['id_syndic']))))
		$in3[]= $a;
	else $in3 = array_merge($in3, $a);if (!defined('_DIR_PLUGIN_ACCESRESTREINT')) {
			$link_empty = generer_url_ecrire('admin_vider'); $link_plugin = generer_url_ecrire('admin_plugin');
			$message_fr = 'La restriction d\'acc&egrave;s a ete desactiv&eacute;e. <a href="'.$link_plugin.'">Corriger le probl&egrave;me</a> ou <a href="'.$link_empty.'">vider le cache</a> pour supprimer les restrictions.';
			$message_en = 'Acces Restriction is now unusable. <a href="'.$link_plugin.'">Correct this trouble</a> or <a href="'.generer_url_ecrire('admin_vider').'">empty the cache</a> to finish restriction removal.';
			die($message_fr.'<br />'.$message_en);
			}
	if (!isset($command['table'])) {
		$command['table'] = 'forum';
		$command['id'] = '_comments';
		$command['from'] = array('forum' => 'spip_forum');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("forum.id_forum",
		"forum.id_thread",
		"forum.date_heure",
		"forum.titre",
		"forum.date_heure AS date",
		"forum.auteur AS nom",
		"forum.texte",
		"forum.url_site",
		"forum.nom_site",
		"forum.id_forum");
		$command['orderby'] = array('forum.date_heure');
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	$command['where'] = 
			array(
quete_condition_statut('forum.statut','publie,prop','publie',''), 
			array('=', 'forum.id_parent', 0), (!(is_array(@$Pile[0]['id_rubrique'])?count(@$Pile[0]['id_rubrique']):strlen(@$Pile[0]['id_rubrique'])) ? '' : ((is_array(@$Pile[0]['id_rubrique'])) ? sql_in('forum.id_objet',sql_quote($in)) : 
			array('=', 'forum.id_objet', sql_quote(@$Pile[0]['id_rubrique'], '','bigint(21) NOT NULL DEFAULT 0')))), (!(is_array(@$Pile[0]['id_rubrique'])?count(@$Pile[0]['id_rubrique']):strlen(@$Pile[0]['id_rubrique'])) ? '' : 
			array('=', 'forum.objet', sql_quote('rubrique'))), (!(is_array(@$Pile[0]['id_article'])?count(@$Pile[0]['id_article']):strlen(@$Pile[0]['id_article'])) ? '' : ((is_array(@$Pile[0]['id_article'])) ? sql_in('forum.id_objet',sql_quote($in1)) : 
			array('=', 'forum.id_objet', sql_quote(@$Pile[0]['id_article'], '','bigint(21) NOT NULL DEFAULT 0')))), (!(is_array(@$Pile[0]['id_article'])?count(@$Pile[0]['id_article']):strlen(@$Pile[0]['id_article'])) ? '' : 
			array('=', 'forum.objet', sql_quote('article'))), (!(is_array(@$Pile[0]['id_breve'])?count(@$Pile[0]['id_breve']):strlen(@$Pile[0]['id_breve'])) ? '' : ((is_array(@$Pile[0]['id_breve'])) ? sql_in('forum.id_objet',sql_quote($in2)) : 
			array('=', 'forum.id_objet', sql_quote(@$Pile[0]['id_breve'], '','bigint(21) NOT NULL DEFAULT 0')))), (!(is_array(@$Pile[0]['id_breve'])?count(@$Pile[0]['id_breve']):strlen(@$Pile[0]['id_breve'])) ? '' : 
			array('=', 'forum.objet', sql_quote('breve'))), (!(is_array(@$Pile[0]['id_syndic'])?count(@$Pile[0]['id_syndic']):strlen(@$Pile[0]['id_syndic'])) ? '' : ((is_array(@$Pile[0]['id_syndic'])) ? sql_in('forum.id_objet',sql_quote($in3)) : 
			array('=', 'forum.id_objet', sql_quote(@$Pile[0]['id_syndic'], '','bigint(21) NOT NULL DEFAULT 0')))), (!(is_array(@$Pile[0]['id_syndic'])?count(@$Pile[0]['id_syndic']):strlen(@$Pile[0]['id_syndic'])) ? '' : 
			array('=', 'forum.objet', sql_quote('site'))), array('IN','forum.id_forum','(SELECT * FROM('.sql_get_select('zzzf.id_forum','spip_forum as zzzf',array(array('OR',array('OR',array('OR',array('AND','zzzf.objet=\'rubrique\'',sql_in('zzzf.id_objet', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), 'NOT')),array('AND','zzzf.objet=\'article\'',array('AND', array('NOT IN','zzzf.id_objet','(SELECT * FROM('.sql_get_select('zzza.id_article','spip_articles as zzza',sql_in('zzza.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), ''), '', '', '', '',$connect).') AS subquery)'), sql_in('zzzf.id_objet', accesrestreint_liste_objets_exclus('articles', !test_espace_prive()), 'not')))),array('AND','zzzf.objet=\'breve\'',array('AND', array('NOT IN','zzzf.id_objet','(SELECT * FROM('.sql_get_select('zzzb.id_breve','spip_breves as zzzb',sql_in('zzzb.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), ''), '', '', '', '',$connect).') AS subquery)'), sql_in('zzzf.id_objet', accesrestreint_liste_objets_exclus('breves', !test_espace_prive()), 'not')))),sql_in('zzzf.objet',array('rubrique','article','breve'),'NOT',$connect))),'','','','',$connect).') AS subquery)'));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('squelettes-dist/inclure/forum.html','html_0acfb1d6fd08461a6c83485d03693d0d','_comments',6,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	
	// COMPTEUR
	$Numrows['_comments']['compteur_boucle'] = 0;
	$Numrows['_comments']['total'] = @intval($iter->count());
	
	$l1 = _T('forum:forum_permalink');
	$l2 = _T('public|spip|ecrire:par_auteur');
	$l3 = _T('public|spip|ecrire:voir_en_ligne');$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$Numrows['_comments']['compteur_boucle']++;
		$t0 .= (
'
	<li class="comment-item comment-fil' .
(($t1 = strval(alterner($Numrows['_comments']['compteur_boucle'],'odd','even')))!=='' ?
		(' ' . $t1) :
		'') .
((($Numrows['_comments']['compteur_boucle'] == '1'))  ?
		(' ' . ' ' . 'first') :
		'') .
((($Numrows['_comments']['compteur_boucle'] == $Numrows['_comments']['total']))  ?
		(' ' . ' ' . 'last') :
		'') .
(calcul_exposer($Pile[$SP]['id_forum'], 'id_forum', $Pile[0], 0, 'id_forum', '')  ?
		(' ' . 'on') :
		'') .
'">
		<div class="comment hreview">
			<a href="#comment' .
$Pile[$SP]['id_forum'] .
'" name="comment' .
$Pile[$SP]['id_forum'] .
'" id="comment' .
$Pile[$SP]['id_forum'] .
'"></a>
			<a href="#forum' .
$Pile[$SP]['id_forum'] .
'" name="forum' .
$Pile[$SP]['id_forum'] .
'" id="forum' .
$Pile[$SP]['id_forum'] .
'"></a>
			<p class="comment-meta">
				<a rel="self bookmark" href="#forum' .
$Pile[$SP]['id_forum'] .
'" title="' .
$l1 .
' ' .
$Pile[$SP]['id_forum'] .
'" class="permalink">' .
(($t1 = strval(interdire_scripts(((((include_spip('inc/config')?lire_config('forums_titre',null,false):'') != 'non')) ?' ' :''))))!=='' ?
		($t1 . (	'<span class="permalink">' .
	$Numrows['_comments']['compteur_boucle'] .
	'.</span>
				<strong class="comment-titre">' .
	(($t2 = strval(interdire_scripts(liens_nofollow(safehtml(typo(interdit_html($Pile[$SP]['titre']), "TYPO", $connect, $Pile[0]))))))!=='' ?
			($t2 . ', ') :
			'') .
	'</strong>')) :
		'') .
'
				<small><abbr class="dtreviewed"' .
(($t1 = strval(interdire_scripts(date_iso(normaliser_date($Pile[$SP]['date'])))))!=='' ?
		(' title="' . $t1 . '"') :
		'') .
'>' .
interdire_scripts(affdate_jourcourt(normaliser_date($Pile[$SP]['date']))) .
(($t1 = strval(interdire_scripts(heures(normaliser_date($Pile[$SP]['date'])))))!=='' ?
		(', ' . $t1) :
		'') .
(($t1 = strval(interdire_scripts(minutes(normaliser_date($Pile[$SP]['date'])))))!=='' ?
		(':' . $t1) :
		'') .
'</abbr>' .
(($t1 = strval(interdire_scripts(couper(supprimer_numero(typo($Pile[$SP]['nom']), "TYPO", $connect, $Pile[0]),'80'))))!=='' ?
		((	'<span class="sep">, </span>' .
	$l2 .
	' <span class="">') . $t1 . '</span>') :
		'') .
'</small></a>
			</p>
			<div class="comment-content description">
				' .
interdire_scripts(lignes_longues(liens_nofollow(safehtml(propre(interdit_html($Pile[$SP]['texte']), $connect, $Pile[0]))))) .
'
				' .
(($t1 = strval(interdire_scripts(lignes_longues(safehtml(liens_nofollow(safehtml(propre(interdit_html(calculer_notes()), $connect, $Pile[0]))))))))!=='' ?
		('<div class="comment-notes">' . $t1 . '</div>') :
		'') .
'
				' .
(($t1 = strval(safehtml(vider_url(calculer_url($Pile[$SP]['url_site'],'','url', $connect)))))!=='' ?
		((	'<p class="hyperlien">' .
	$l3 .
	' : <a href="') . $t1 . (	'" class="spip_out">' .
	interdire_scripts(((($a = liens_nofollow(safehtml(typo(interdit_html(supprimer_numero(calculer_url($Pile[$SP]['url_site'],$Pile[$SP]['nom_site'], 'titre', $connect, false))), "TYPO", $connect, $Pile[0])))) OR (is_string($a) AND strlen($a))) ? $a : couper(safehtml(vider_url(calculer_url($Pile[$SP]['url_site'],'','url', $connect))),'80'))) .
	'</a></p>')) :
		'') .
'
				' .
(($t1 = BOUCLE_dochtml_0acfb1d6fd08461a6c83485d03693d0d($Cache, $Pile, $doublons, $Numrows, $SP))!=='' ?
		('<div class="comment-doc">' . $t1 . '</div>') :
		'') .
'
			</div>
		</div>
		' .
(($t1 = BOUCLE_comments_filshtml_0acfb1d6fd08461a6c83485d03693d0d($Cache, $Pile, $doublons, $Numrows, $SP))!=='' ?
		('
		<ul class="comments-items">
			' . $t1 . '
		</ul>
		') :
		'') .
'
	</li>
	');
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_comments @ squelettes-dist/inclure/forum.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}

//
// Fonction principale du squelette squelettes-dist/inclure/forum.html
// Temps de compilation total: 4.795 ms
//

function html_0acfb1d6fd08461a6c83485d03693d0d($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'
' .
(spip_htmlspecialchars(
		// refus des forums ?
		(quete_accepter_forum(@$Pile[0]['id_article'])=="non" OR
		($GLOBALS["meta"]["forums_publics"] == "non"
		AND quete_accepter_forum(@$Pile[0]['id_article']) == ""))
		? "" : // sinon:
		(calcul_parametres_forum($Pile[0],null,null,null).
	(($lien = (_request("retour") ? _request("retour") : str_replace("&amp;", "&", ''))) ? "&retour=".rawurlencode($lien) : ""))) ? '':'') .
'
<a href="#forum" name="forum" id="forum"></a>

' .
(($t1 = BOUCLE_commentshtml_0acfb1d6fd08461a6c83485d03693d0d($Cache, $Pile, $doublons, $Numrows, $SP))!=='' ?
		((	'
<div class="comments comments-thread comments-thread-1">
<h2>' .
		_T('public|spip|ecrire:messages_forum') .
		'</h2>
<ul class="comments-items">

	') . $t1 . '

</ul>
</div>
') :
		'') .
'
');

	return analyse_resultat_skel('html_0acfb1d6fd08461a6c83485d03693d0d', $Cache, $page, 'squelettes-dist/inclure/forum.html');
}
?>