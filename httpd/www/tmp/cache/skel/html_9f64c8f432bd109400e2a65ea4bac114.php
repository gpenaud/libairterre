<?php

/*
 * Squelette : plugins-dist/medias/modeles/image.html
 * Date :      Fri, 04 Jun 2021 14:01:59 GMT
 * Compile :   Fri, 04 Jun 2021 14:34:28 GMT
 * Boucles :   _tous
 */ 

function BOUCLE_toushtml_9f64c8f432bd109400e2a65ea4bac114(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

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
		$command['id'] = '_tous';
		$command['from'] = array('documents' => 'spip_documents','L1' => 'spip_types_documents');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("L1.inclus",
		"documents.id_document",
		"documents.largeur",
		"documents.hauteur",
		"documents.titre",
		"L1.titre AS type_document",
		"documents.taille",
		"documents.descriptif",
		"documents.id_document");
		$command['orderby'] = array();
		$command['join'] = array('L1' => array('documents','extension'));
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	$command['where'] = 
			array(
			array('(documents.taille > 0 OR documents.distant=\'oui\')'), 
			array('=', 'documents.id_document', sql_quote(interdire_scripts(@$Pile[0]['id']), '', 'bigint(21) NOT NULL AUTO_INCREMENT')), array('OR',
	array('IN','documents.id_document','(SELECT * FROM('.sql_get_select('zzzd.id_document','spip_documents_liens as zzzd',array(array('OR',array('OR',array('OR',array('OR',array('AND','zzzd.objet=\'rubrique\'',sql_in('zzzd.id_objet', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), 'NOT')),array('AND','zzzd.objet=\'article\'',array('AND', array('NOT IN','zzzd.id_objet','(SELECT * FROM('.sql_get_select('zzza.id_article','spip_articles as zzza',sql_in('zzza.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), ''), '', '', '', '',$connect).') AS subquery)'), sql_in('zzzd.id_objet', accesrestreint_liste_objets_exclus('articles', !test_espace_prive()), 'not')))),array('AND','zzzd.objet=\'breve\'',array('AND', array('NOT IN','zzzd.id_objet','(SELECT * FROM('.sql_get_select('zzzb.id_breve','spip_breves as zzzb',sql_in('zzzb.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), ''), '', '', '', '',$connect).') AS subquery)'), sql_in('zzzd.id_objet', accesrestreint_liste_objets_exclus('breves', !test_espace_prive()), 'not')))),array('AND','zzzd.objet=\'forum\'',array('IN','zzzd.id_objet','(SELECT * FROM('.sql_get_select('zzzf.id_forum','spip_forum as zzzf',array(array('OR',array('OR',array('OR',array('AND','zzzf.objet=\'rubrique\'',sql_in('zzzf.id_objet', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), 'NOT')),array('AND','zzzf.objet=\'article\'',array('AND', array('NOT IN','zzzf.id_objet','(SELECT * FROM('.sql_get_select('zzza.id_article','spip_articles as zzza',sql_in('zzza.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), ''), '', '', '', '',$connect).') AS subquery)'), sql_in('zzzf.id_objet', accesrestreint_liste_objets_exclus('articles', !test_espace_prive()), 'not')))),array('AND','zzzf.objet=\'breve\'',array('AND', array('NOT IN','zzzf.id_objet','(SELECT * FROM('.sql_get_select('zzzb.id_breve','spip_breves as zzzb',sql_in('zzzb.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), ''), '', '', '', '',$connect).') AS subquery)'), sql_in('zzzf.id_objet', accesrestreint_liste_objets_exclus('breves', !test_espace_prive()), 'not')))),sql_in('zzzf.objet',array('rubrique','article','breve'),'NOT',$connect))),'','','','',$connect).') AS subquery)'))),sql_in('zzzd.objet',array('rubrique','article','breve','forum'),'NOT',$connect))),'','','','',$connect).') AS subquery)'),
	array('NOT IN','documents.id_document','(SELECT * FROM('.sql_get_select('zzzd.id_document','spip_documents_liens as zzzd','','','','','',$connect).') AS subquery)')
	));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('plugins-dist/medias/modeles/image.html','html_9f64c8f432bd109400e2a65ea4bac114','_tous',1,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$t0 .= (
(($t1 = strval(interdire_scripts((((((($Pile[$SP]['inclus'] == 'image')) AND (interdire_scripts(((entites_html(sinon(table_valeur(@$Pile[0], (string)'emb', null), ''),true)) ?'' :' ')))) ?' ' :'')) ?' ' :''))))!=='' ?
		($t1 . (	'
<span class=\'spip_document_' .
	$Pile[$SP]['id_document'] .
	' spip_documents' .
	(($t2 = strval(interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'align', null),true))))!=='' ?
			(' spip_documents_' . $t2) :
			'') .
	(($t2 = strval(interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'class', null),true))))!=='' ?
			(' ' . $t2) :
			'') .
	' spip_lien_ok\'' .
	(($t2 = strval(interdire_scripts(match(entites_html(table_valeur(@$Pile[0], (string)'align', null),true),'left|right'))))!=='' ?
			('
	 style=\'float:' . $t2 . ';\'') :
			'') .
	'>' .
	(($t2 = strval(interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'lien', null),true))))!=='' ?
			('
	<a href="' . $t2 . (	'"' .
		(($t3 = strval(interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'lien_class', null),true))))!=='' ?
				('
		class="' . $t3 . '"') :
				'') .
		'>')) :
			'') .
	'<img src=\'' .
	vider_url(urlencode_1738(generer_url_entite($Pile[$SP]['id_document'], 'document', '', '', true))) .
	'\'' .
	(($t2 = strval(interdire_scripts(($Pile[$SP]['largeur'] ? interdire_scripts($Pile[$SP]['largeur']):''))))!=='' ?
			('
		width="' . $t2 . '"') :
			'') .
	(($t2 = strval(interdire_scripts(($Pile[$SP]['hauteur'] ? interdire_scripts($Pile[$SP]['hauteur']):''))))!=='' ?
			('
		height="' . $t2 . '"') :
			'') .
	(($t2 = strval(interdire_scripts(attribut_html(supprimer_numero(typo($Pile[$SP]['titre']), "TYPO", $connect, $Pile[0])))))!=='' ?
			('
		title="' . $t2 . '"') :
			'') .
	'
		alt="' .
	interdire_scripts(attribut_html(supprimer_numero(typo($Pile[$SP]['titre']), "TYPO", $connect, $Pile[0]))) .
	'" />' .
	interdire_scripts((entites_html(table_valeur(@$Pile[0], (string)'lien', null),true) ? '</a>':'')) .
	'</span>
')) :
		'') .
(($t1 = strval(interdire_scripts((((((($Pile[$SP]['inclus'] == 'image')) AND (interdire_scripts(((entites_html(sinon(table_valeur(@$Pile[0], (string)'emb', null), ''),true)) ?' ' :'')))) ?' ' :'')) ?' ' :''))))!=='' ?
		($t1 . (	'
' .
	vide($Pile['vars'][$_zzz=(string)'fichier'] = vider_url(urlencode_1738(generer_url_entite($Pile[$SP]['id_document'], 'document', '', '', true)))) .
	vide($Pile['vars'][$_zzz=(string)'width'] = interdire_scripts($Pile[$SP]['largeur'])) .
	vide($Pile['vars'][$_zzz=(string)'height'] = interdire_scripts($Pile[$SP]['hauteur'])) .
	vide($Pile['vars'][$_zzz=(string)'url'] = interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'lien', null),true))) .
	'<dl class=\'spip_document_' .
	$Pile[$SP]['id_document'] .
	' spip_documents' .
	(($t2 = strval(interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'align', null),true))))!=='' ?
			(' spip_documents_' . $t2) :
			'') .
	(($t2 = strval(interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'class', null),true))))!=='' ?
			(' ' . $t2) :
			'') .
	' spip_lien_ok\'' .
	(($t2 = strval(interdire_scripts(match(entites_html(table_valeur(@$Pile[0], (string)'align', null),true),'left|right'))))!=='' ?
			('
			style=\'float:' . $t2 . (	';' .
		(($t3 = strval(max(table_valeur($Pile["vars"], (string)'width', null),'120')))!=='' ?
				('width:' . $t3) :
				'') .
		'px;\'')) :
			'') .
	'>
<dt>' .
	(($t2 = strval(table_valeur($Pile["vars"], (string)'url', null)))!=='' ?
			('<a href="' . $t2 . (	'"' .
		(($t3 = strval(interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'lien_class', null),true))))!=='' ?
				(' class="' . $t3 . '"') :
				'') .
		' title=\'' .
		interdire_scripts($Pile[$SP]['type_document']) .
		' - ' .
		interdire_scripts(texte_backend(taille_en_octets($Pile[$SP]['taille']))) .
		'\'' .
		(($t3 = strval(interdire_scripts((entites_html(table_valeur(@$Pile[0], (string)'lien', null),true) ? interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'lien_mime', null),true)):interdire_scripts(mime_type_oembed($Pile[$SP]['id_document']))))))!=='' ?
				(' type="' . $t3 . '"') :
				'') .
		'>')) :
			'') .
	'<img src=\'' .
	table_valeur($Pile["vars"], (string)'fichier', null) .
	'\' width=\'' .
	table_valeur($Pile["vars"], (string)'width', null) .
	'\' height=\'' .
	table_valeur($Pile["vars"], (string)'height', null) .
	'\' alt=\'\' />' .
	(table_valeur($Pile["vars"], (string)'url', null) ? '</a>':'') .
	'</dt>' .
	(($t2 = strval(interdire_scripts(supprimer_numero(typo($Pile[$SP]['titre']), "TYPO", $connect, $Pile[0]))))!=='' ?
			((	'
<dt class=\'' .
		'spip_doc_titre\'' .
		(($t3 = strval(max(min(table_valeur($Pile["vars"], (string)'width', null),'350'),'120')))!=='' ?
				(' style=\'width:' . $t3 . 'px;\'') :
				'') .
		'><strong>') . $t2 . '</strong></dt>') :
			'') .
	(($t2 = strval(interdire_scripts(PtoBR(propre($Pile[$SP]['descriptif'], $connect, $Pile[0])))))!=='' ?
			((	'
<dd class=\'' .
		'spip_doc_descriptif\'' .
		(($t3 = strval(max(min(table_valeur($Pile["vars"], (string)'width', null),'350'),'120')))!=='' ?
				(' style=\'width:' . $t3 . 'px;\'') :
				'') .
		'>') . $t2 . (	interdire_scripts(PtoBR(calculer_notes())) .
		'</dd>')) :
			'') .
	'
</dl>
')) :
		'') .
(($t1 = strval(interdire_scripts(((($Pile[$SP]['inclus'] == 'embed')) ?' ' :''))))!=='' ?
		('
' . $t1 . (	'
<div class=\'spip_document_' .
	$Pile[$SP]['id_document'] .
	' spip_documents' .
	(($t2 = strval(interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'align', null),true))))!=='' ?
			(' spip_documents_' . $t2) :
			'') .
	'\'' .
	(($t2 = strval(interdire_scripts(((entites_html(sinon(table_valeur(@$Pile[0], (string)'align', null), 'center'),true) == 'center') ? '':' '))))!=='' ?
			((	'
style=\'' .
		(($t3 = strval(interdire_scripts((match(entites_html(table_valeur(@$Pile[0], (string)'align', null),true),'^(left|right)$') ? ' ':''))))!=='' ?
				($t3 . (	'float:' .
			interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'align', null),true)) .
			';')) :
				'') .
		' ') . $t2 . '\'') :
			'') .
	'>
<object	data=\'' .
	vider_url(urlencode_1738(generer_url_entite($Pile[$SP]['id_document'], 'document', '', '', true))) .
	'\' 
	type=\'' .
	interdire_scripts(mime_type_oembed($Pile[$SP]['id_document'])) .
	'\'' .
	(($t2 = strval(interdire_scripts((entites_html(table_valeur(@$Pile[0], (string)'largeur', null),true) ? '':interdire_scripts($Pile[$SP]['largeur'])))))!=='' ?
			('
	width=\'' . $t2 . '\'') :
			'') .
	(($t2 = strval(interdire_scripts((entites_html(table_valeur(@$Pile[0], (string)'hauteur', null),true) ? '':interdire_scripts($Pile[$SP]['hauteur'])))))!=='' ?
			('
	height=\'' . $t2 . '\'') :
			'') .
	'
	' .
	interdire_scripts(env_to_attributs(@serialize($Pile[0]))) .
	' >
	<param name=\'src\' value=\'' .
	vider_url(urlencode_1738(generer_url_entite($Pile[$SP]['id_document'], 'document', '', '', true))) .
	'\' />
	' .
	appliquer_filtre($Pile[$SP]['id_document'],interdire_scripts(mime_type_oembed($Pile[$SP]['id_document']))) .
	'
</object>' .
	(($t2 = strval(interdire_scripts(supprimer_numero(typo($Pile[$SP]['titre']), "TYPO", $connect, $Pile[0]))))!=='' ?
			((	'
<div class=\'' .
		'spip_doc_titre\'><strong>') . $t2 . '</strong></div>
') :
			'') .
	(($t2 = strval(interdire_scripts(PtoBR(propre($Pile[$SP]['descriptif'], $connect, $Pile[0])))))!=='' ?
			((	'
<div class=\'' .
		'spip_doc_descriptif\'>') . $t2 . (	interdire_scripts(PtoBR(calculer_notes())) .
		'</div>
')) :
			'') .
	'</div>')) :
		'') .
'
');
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_tous @ plugins-dist/medias/modeles/image.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}

//
// Fonction principale du squelette plugins-dist/medias/modeles/image.html
// Temps de compilation total: 2.308 ms
//

function html_9f64c8f432bd109400e2a65ea4bac114($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
BOUCLE_toushtml_9f64c8f432bd109400e2a65ea4bac114($Cache, $Pile, $doublons, $Numrows, $SP) .
'
');

	return analyse_resultat_skel('html_9f64c8f432bd109400e2a65ea4bac114', $Cache, $page, 'plugins-dist/medias/modeles/image.html');
}
?>