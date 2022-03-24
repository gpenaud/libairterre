<?php

/*
 * Squelette : plugins/html5up_editorial/content/sommaire.html
 * Date :      Fri, 04 Jun 2021 14:01:59 GMT
 * Compile :   Fri, 04 Jun 2021 14:34:28 GMT
 * Boucles :   _hero, _major, _heroside
 */ 

function BOUCLE_herohtml_0aea1cee90549ab467d658a1bdc5edb3(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	$in = array();
	if (!(is_array($a = (interdire_scripts(picker_selected((include_spip('inc/config')?lire_config('html5up/hero',null,false):''),'article'))))))
		$in[]= $a;
	else $in = array_merge($in, $a);if (!defined('_DIR_PLUGIN_ACCESRESTREINT')) {
			$link_empty = generer_url_ecrire('admin_vider'); $link_plugin = generer_url_ecrire('admin_plugin');
			$message_fr = 'La restriction d\'acc&egrave;s a ete desactiv&eacute;e. <a href="'.$link_plugin.'">Corriger le probl&egrave;me</a> ou <a href="'.$link_empty.'">vider le cache</a> pour supprimer les restrictions.';
			$message_en = 'Acces Restriction is now unusable. <a href="'.$link_plugin.'">Correct this trouble</a> or <a href="'.generer_url_ecrire('admin_vider').'">empty the cache</a> to finish restriction removal.';
			die($message_fr.'<br />'.$message_en);
			}
	if (!isset($command['table'])) {
		$command['table'] = 'articles';
		$command['id'] = '_hero';
		$command['from'] = array('articles' => 'spip_articles');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("articles.id_article",
		"articles.id_rubrique",
		"articles.id_article",
		"articles.lang",
		"articles.titre");
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	$command['orderby'] = array(((!sql_quote($in) OR sql_quote($in)==="''") ? 0 : ('FIELD(articles.id_article,' . sql_quote($in) . ')')));
	$command['where'] = 
			array(
quete_condition_statut('articles.statut','publie,prop,prepa/auteur','publie',''), 
quete_condition_postdates('articles.date',''), sql_in('articles.id_article',sql_quote($in)), sql_in('articles.id_article', accesrestreint_liste_objets_exclus('articles', !test_espace_prive()), 'NOT'), sql_in('articles.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), 'NOT'));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('plugins/html5up_editorial/content/sommaire.html','html_0aea1cee90549ab467d658a1bdc5edb3','_hero',3,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	lang_select($GLOBALS['spip_lang']);
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		lang_select_public($Pile[$SP]['lang'], '', $Pile[$SP]['titre']);
		$t0 .= (
'
	' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette('inclure/article-hero') . ', array(\'id_article\' => ' . argumenter_squelette($Pile[$SP]['id_article']) . ',
	\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . '), array("compil"=>array(\'plugins/html5up_editorial/content/sommaire.html\',\'html_0aea1cee90549ab467d658a1bdc5edb3\',\'\',6,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>' .
vide($Pile['vars'][$_zzz=(string)'exclus'] = filtre_push(table_valeur($Pile["vars"], (string)'exclus', null),$Pile[$SP]['id_article'])));
		lang_select();
	}
	lang_select();
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_hero @ plugins/html5up_editorial/content/sommaire.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLE_majorhtml_0aea1cee90549ab467d658a1bdc5edb3(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	$in = array();
	if (!(is_array($a = (interdire_scripts(picker_selected((include_spip('inc/config')?lire_config('html5up/major',null,false):''),'article'))))))
		$in[]= $a;
	else $in = array_merge($in, $a);if (!defined('_DIR_PLUGIN_ACCESRESTREINT')) {
			$link_empty = generer_url_ecrire('admin_vider'); $link_plugin = generer_url_ecrire('admin_plugin');
			$message_fr = 'La restriction d\'acc&egrave;s a ete desactiv&eacute;e. <a href="'.$link_plugin.'">Corriger le probl&egrave;me</a> ou <a href="'.$link_empty.'">vider le cache</a> pour supprimer les restrictions.';
			$message_en = 'Acces Restriction is now unusable. <a href="'.$link_plugin.'">Correct this trouble</a> or <a href="'.generer_url_ecrire('admin_vider').'">empty the cache</a> to finish restriction removal.';
			die($message_fr.'<br />'.$message_en);
			}
	if (!isset($command['table'])) {
		$command['table'] = 'articles';
		$command['id'] = '_major';
		$command['from'] = array('articles' => 'spip_articles');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("articles.titre",
		"articles.texte",
		"articles.descriptif",
		"articles.chapo",
		"articles.id_article",
		"articles.id_rubrique",
		"articles.id_article",
		"articles.lang");
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	$command['orderby'] = array(((!sql_quote($in) OR sql_quote($in)==="''") ? 0 : ('FIELD(articles.id_article,' . sql_quote($in) . ')')));
	$command['where'] = 
			array(
quete_condition_statut('articles.statut','publie,prop,prepa/auteur','publie',''), 
quete_condition_postdates('articles.date',''), sql_in('articles.id_article',sql_quote($in)), sql_in('articles.id_article', accesrestreint_liste_objets_exclus('articles', !test_espace_prive()), 'NOT'), sql_in('articles.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), 'NOT'));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('plugins/html5up_editorial/content/sommaire.html','html_0aea1cee90549ab467d658a1bdc5edb3','_major',11,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	lang_select($GLOBALS['spip_lang']);
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		lang_select_public($Pile[$SP]['lang'], '', $Pile[$SP]['titre']);
		$t0 .= (
'
	' .
(($t1 = strval(interdire_scripts(supprimer_numero(typo($Pile[$SP]['titre']), "TYPO", $connect, $Pile[0]))))!=='' ?
		((	'<header class="major">
		<h2 class="">') . $t1 . '</h2>
	</header>') :
		'') .
'
	' .
(($t1 = strval(interdire_scripts(filtre_introduction($Pile[$SP]['descriptif'], (strlen($Pile[$SP]['descriptif']))
		? ''
		: $Pile[$SP]['chapo'] . "\n\n" . $Pile[$SP]['texte'], 500, $connect, null))))!=='' ?
		((	'<div class="chapo ">
		') . $t1 . '
	</div>') :
		'') .
vide($Pile['vars'][$_zzz=(string)'exclus'] = filtre_push(table_valeur($Pile["vars"], (string)'exclus', null),$Pile[$SP]['id_article'])));
		lang_select();
	}
	lang_select();
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_major @ plugins/html5up_editorial/content/sommaire.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLE_herosidehtml_0aea1cee90549ab467d658a1bdc5edb3(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	$in = array();
	if (!(is_array($a = (interdire_scripts(picker_selected((include_spip('inc/config')?lire_config('html5up/heroside',null,false):''),'article'))))))
		$in[]= $a;
	else $in = array_merge($in, $a);if (!defined('_DIR_PLUGIN_ACCESRESTREINT')) {
			$link_empty = generer_url_ecrire('admin_vider'); $link_plugin = generer_url_ecrire('admin_plugin');
			$message_fr = 'La restriction d\'acc&egrave;s a ete desactiv&eacute;e. <a href="'.$link_plugin.'">Corriger le probl&egrave;me</a> ou <a href="'.$link_empty.'">vider le cache</a> pour supprimer les restrictions.';
			$message_en = 'Acces Restriction is now unusable. <a href="'.$link_plugin.'">Correct this trouble</a> or <a href="'.generer_url_ecrire('admin_vider').'">empty the cache</a> to finish restriction removal.';
			die($message_fr.'<br />'.$message_en);
			}
	if (!isset($command['table'])) {
		$command['table'] = 'articles';
		$command['id'] = '_heroside';
		$command['from'] = array('articles' => 'spip_articles');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("articles.id_article",
		"articles.id_rubrique",
		"articles.id_article",
		"articles.lang",
		"articles.titre");
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	$command['orderby'] = array(((!sql_quote($in) OR sql_quote($in)==="''") ? 0 : ('FIELD(articles.id_article,' . sql_quote($in) . ')')));
	$command['where'] = 
			array(
quete_condition_statut('articles.statut','publie,prop,prepa/auteur','publie',''), 
quete_condition_postdates('articles.date',''), sql_in('articles.id_article',sql_quote($in)), sql_in('articles.id_article', accesrestreint_liste_objets_exclus('articles', !test_espace_prive()), 'NOT'), sql_in('articles.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), 'NOT'));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('plugins/html5up_editorial/content/sommaire.html','html_0aea1cee90549ab467d658a1bdc5edb3','_heroside',23,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	lang_select($GLOBALS['spip_lang']);
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		lang_select_public($Pile[$SP]['lang'], '', $Pile[$SP]['titre']);
		$t0 .= (
'
' .
vide($Pile['vars'][$_zzz=(string)'exclus'] = filtre_push(table_valeur($Pile["vars"], (string)'exclus', null),$Pile[$SP]['id_article'])));
		lang_select();
	}
	lang_select();
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_heroside @ plugins/html5up_editorial/content/sommaire.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}

//
// Fonction principale du squelette plugins/html5up_editorial/content/sommaire.html
// Temps de compilation total: 0.996 ms
//

function html_0aea1cee90549ab467d658a1bdc5edb3($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
(($t1 = strval(interdire_scripts(typo($GLOBALS['meta']['slogan_site'], "TYPO", $connect, $Pile[0]))))!=='' ?
		('<p id="slogan_site_spip">' . $t1 . '</p>') :
		'') .
'
' .
vide($Pile['vars'][$_zzz=(string)'exclus'] = array()) .
(($t1 = BOUCLE_herohtml_0aea1cee90549ab467d658a1bdc5edb3($Cache, $Pile, $doublons, $Numrows, $SP))!=='' ?
		('
<section id="banner">
	' . $t1 . '
</section>
') :
		'') .
'

' .
(($t1 = BOUCLE_majorhtml_0aea1cee90549ab467d658a1bdc5edb3($Cache, $Pile, $doublons, $Numrows, $SP))!=='' ?
		('
<section>
	' . $t1 . '
</section>
') :
		'') .
'
' .
BOUCLE_herosidehtml_0aea1cee90549ab467d658a1bdc5edb3($Cache, $Pile, $doublons, $Numrows, $SP) .
'

<section>
	' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette('inclure/liste/articles') . ', array_merge('.var_export($Pile[0],1).',array(\'parpage\' => ' . argumenter_squelette(interdire_scripts((include_spip('inc/config')?lire_config('html5up/suivants_parpage','6',false):''))) . ',
	\'exclus\' => ' . argumenter_squelette(table_valeur($Pile["vars"], (string)'exclus', null)) . ',
	\'total\' => ' . argumenter_squelette(interdire_scripts((include_spip('inc/config')?lire_config('html5up/suivants_total','12',false):''))) . ',
	\'titre\' => ' . argumenter_squelette(interdire_scripts((include_spip('inc/config')?lire_config('html5up/suivants_titre',null,false):''))) . ',
	\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . ')), array("compil"=>array(\'plugins/html5up_editorial/content/sommaire.html\',\'html_0aea1cee90549ab467d658a1bdc5edb3\',\'\',28,$GLOBALS[\'spip_lang\']),\'ajax\' => ($v=( ' . argumenter_squelette(@$Pile[0]['ajax']) . '))?$v:true), _request("connect"));
?'.'>
</section>
');

	return analyse_resultat_skel('html_0aea1cee90549ab467d658a1bdc5edb3', $Cache, $page, 'plugins/html5up_editorial/content/sommaire.html');
}
?>