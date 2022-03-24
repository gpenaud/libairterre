<?php

/*
 * Squelette : plugins/html5up_editorial/content/article.html
 * Date :      Thu, 24 Mar 2022 09:53:21 GMT
 * Compile :   Thu, 24 Mar 2022 16:25:58 GMT
 * Boucles :   _agenda, _article
 */ 

function BOUCLE_agendahtml_8cedb2c3e8aecafe3b0e14f0ebcb23ed(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

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
		$command['id'] = '_agenda';
		$command['from'] = array('evenements' => 'spip_evenements','L1' => 'spip_articles');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("evenements.date_debut",
		"evenements.id_article",
		"evenements.titre",
		"evenements.descriptif",
		"evenements.date_fin",
		"evenements.horaire",
		"evenements.lieu",
		"evenements.adresse",
		"evenements.id_article",
		"evenements.id_evenement");
		$command['orderby'] = array('evenements.date_debut');
		$command['join'] = array('L1' => array('evenements','id_article'));
		$command['limit'] = '0,3';
		$command['having'] = 
			array();
	}
	$command['where'] = 
			array(
quete_condition_statut('evenements.statut','!','publie',''), 
			array('=', 'L1.id_rubrique', sql_quote($Pile[$SP]['id_rubrique'], '','bigint(21) NOT NULL DEFAULT 0')), 
			array('OR', 
			array('AND', 
			array('=', 'horaire', sql_quote('oui')), 
			array('>', 'evenements.date_debut', sql_quote(date('Y-m-d H:i:00')))), 
			array('AND', 
			array('!=', 'horaire', sql_quote('oui')), 
			array('>', 'evenements.date_debut', sql_quote(date('Y-m-d 23:59:59', strtotime(date('Y-m-d H:i:00'))))))), sql_in('evenements.id_evenement', accesrestreint_liste_objets_exclus('evenements', !test_espace_prive()), 'NOT'), array('AND', array('NOT IN','evenements.id_article','(SELECT * FROM('.sql_get_select('zzza.id_article','spip_articles as zzza',sql_in('zzza.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), ''), '', '', '', '',$connect).') AS subquery)'), sql_in('evenements.id_article', accesrestreint_liste_objets_exclus('articles', !test_espace_prive()), 'not')));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('plugins/html5up_editorial/content/article.html','html_8cedb2c3e8aecafe3b0e14f0ebcb23ed','_agenda',24,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$t0 .= (
'
	<dt><b><a style="font-size: 22px" href="' .
vider_url(urlencode_1738(generer_url_entite($Pile[$SP]['id_article'], 'article', '', '', true))) .
'">' .
interdire_scripts(supprimer_numero(typo($Pile[$SP]['titre']), "TYPO", $connect, $Pile[0])) .
'</a></b></dt>
	<dd>' .
interdire_scripts(propre($Pile[$SP]['descriptif'], $connect, $Pile[0])) .
'</dd>
	<dd><b>Date</b>:  ' .
interdire_scripts(Agenda_affdate_debut_fin($Pile[$SP]['date_debut'],interdire_scripts($Pile[$SP]['date_fin']),interdire_scripts($Pile[$SP]['horaire']))) .
'</dd>
	<dd><b>Adresse</b>:  ' .
interdire_scripts(expanser_liens(typo($Pile[$SP]['lieu'], "TYPO", $connect, $Pile[0]))) .
' ' .
interdire_scripts(propre($Pile[$SP]['adresse'], $connect, $Pile[0])) .
'</dd>
	');
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_agenda @ plugins/html5up_editorial/content/article.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLE_articlehtml_8cedb2c3e8aecafe3b0e14f0ebcb23ed(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';if (!defined('_DIR_PLUGIN_ACCESRESTREINT')) {
			$link_empty = generer_url_ecrire('admin_vider'); $link_plugin = generer_url_ecrire('admin_plugin');
			$message_fr = 'La restriction d\'acc&egrave;s a ete desactiv&eacute;e. <a href="'.$link_plugin.'">Corriger le probl&egrave;me</a> ou <a href="'.$link_empty.'">vider le cache</a> pour supprimer les restrictions.';
			$message_en = 'Acces Restriction is now unusable. <a href="'.$link_plugin.'">Correct this trouble</a> or <a href="'.generer_url_ecrire('admin_vider').'">empty the cache</a> to finish restriction removal.';
			die($message_fr.'<br />'.$message_en);
			}
	if (!isset($command['table'])) {
		$command['table'] = 'articles';
		$command['id'] = '_article';
		$command['from'] = array('articles' => 'spip_articles');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("articles.id_rubrique",
		"articles.surtitre",
		"articles.titre",
		"articles.soustitre",
		"articles.chapo",
		"articles.texte",
		"articles.ps",
		"articles.id_article",
		"articles.id_rubrique",
		"articles.id_article",
		"articles.lang");
		$command['orderby'] = array();
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	$command['where'] = 
			array(
quete_condition_statut('articles.statut','publie,prop,prepa/auteur','publie',''), 
quete_condition_postdates('articles.date',''), 
			array('=', 'articles.id_article', sql_quote(@$Pile[0]['id_article'], '','bigint(21) NOT NULL AUTO_INCREMENT')), sql_in('articles.id_article', accesrestreint_liste_objets_exclus('articles', !test_espace_prive()), 'NOT'), sql_in('articles.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), 'NOT'));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('plugins/html5up_editorial/content/article.html','html_8cedb2c3e8aecafe3b0e14f0ebcb23ed','_article',1,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	lang_select($GLOBALS['spip_lang']);
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		lang_select_public($Pile[$SP]['lang'], '', $Pile[$SP]['titre']);
		$t0 .= (
'
<section>

	<header class="main">
		' .
(($t1 = strval(interdire_scripts(typo($Pile[$SP]['surtitre'], "TYPO", $connect, $Pile[0]))))!=='' ?
		((	'<p class="surtitre ">') . $t1 . '</p>') :
		'') .
'
		' .
(($t1 = strval(interdire_scripts(supprimer_numero(typo($Pile[$SP]['titre']), "TYPO", $connect, $Pile[0]))))!=='' ?
		((	'<h1 class="titre ">') . $t1 . '</h1>') :
		'') .
'
		' .
(($t1 = strval(interdire_scripts(typo($Pile[$SP]['soustitre'], "TYPO", $connect, $Pile[0]))))!=='' ?
		((	'<p class="soustitre ">') . $t1 . '</p>') :
		'') .
'
	</header>

	' .
(($t1 = strval(interdire_scripts(adaptive_images(propre($Pile[$SP]['chapo'], $connect, $Pile[0]),'1280'))))!=='' ?
		((	'<div class="chapo ">') . $t1 . '</div>') :
		'') .
'
	' .
(($t1 = strval(interdire_scripts(adaptive_images(propre($Pile[$SP]['texte'], $connect, $Pile[0])))))!=='' ?
		((	'<div class="texte ">') . $t1 . '</div>') :
		'') .
'
	' .
(($t1 = strval(interdire_scripts(adaptive_images(propre($Pile[$SP]['ps'], $connect, $Pile[0])))))!=='' ?
		((	'<div class="ps ">') . $t1 . '</div>') :
		'') .
'
	' .
(($t1 = strval(interdire_scripts(calculer_notes())))!=='' ?
		('<div class="notes">' . $t1 . '</div>') :
		'') .
'

	' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette('inclure/documents') . ', array_merge('.var_export($Pile[0],1).',array(\'id_article\' => ' . argumenter_squelette($Pile[$SP]['id_article']) . ',
	\'id_rubrique\' => ' . argumenter_squelette(interdire_scripts(@$Pile[0]['null'])) . ',
	\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . ')), array("compil"=>array(\'plugins/html5up_editorial/content/article.html\',\'html_8cedb2c3e8aecafe3b0e14f0ebcb23ed\',\'\',15,$GLOBALS[\'spip_lang\']),\'ajax\' => ($v=( ' . argumenter_squelette(@$Pile[0]['ajax']) . '))?$v:true), _request("connect"));
?'.'>

	' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette('inclure/forum') . ', array(\'id_article\' => ' . argumenter_squelette($Pile[$SP]['id_article']) . ',
	\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . '), array("compil"=>array(\'plugins/html5up_editorial/content/article.html\',\'html_8cedb2c3e8aecafe3b0e14f0ebcb23ed\',\'\',17,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>
	' .
(($t1 = strval(executer_balise_dynamique('FORMULAIRE_FORUM',
	array($Pile[$SP]['id_article'],@$Pile[0]['id_forum'],@$Pile[0]['ajouter_mot'],@$Pile[0]['ajouter_groupe'],@$Pile[0]['forcer_previsu'],$Pile[$SP]['id_article'],@$Pile[0]['id_breve'],$Pile[$SP]['id_rubrique'],@$Pile[0]['id_syndic']),
	array('plugins/html5up_editorial/content/article.html','html_8cedb2c3e8aecafe3b0e14f0ebcb23ed','_article',18,$GLOBALS['spip_lang'], 'articles',4))))!=='' ?
		((	'<h2 class="forum-titre">' .
	_T('forum:form_pet_message_commentaire') .
	'</h2>
	') . $t1) :
		'') .
'

</section>

/* BEGIN OF CHANGES By Guillaume Penaud */
' .
(($t1 = BOUCLE_agendahtml_8cedb2c3e8aecafe3b0e14f0ebcb23ed($Cache, $Pile, $doublons, $Numrows, $SP))!=='' ?
		('
<section>
	<header class="major">
	<h2>Prochainement</h2>
	</header>
	' . $t1 . '
</section>
') :
		'') .
'
/* END OF CHANGES By Guillaume Penaud */

');
		lang_select();
	}
	lang_select();
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_article @ plugins/html5up_editorial/content/article.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}

//
// Fonction principale du squelette plugins/html5up_editorial/content/article.html
// Temps de compilation total: 6.246 ms
//

function html_8cedb2c3e8aecafe3b0e14f0ebcb23ed($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
BOUCLE_articlehtml_8cedb2c3e8aecafe3b0e14f0ebcb23ed($Cache, $Pile, $doublons, $Numrows, $SP) .
'
');

	return analyse_resultat_skel('html_8cedb2c3e8aecafe3b0e14f0ebcb23ed', $Cache, $page, 'plugins/html5up_editorial/content/article.html');
}
?>