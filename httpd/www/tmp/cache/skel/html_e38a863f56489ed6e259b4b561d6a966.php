<?php

/*
 * Squelette : plugins/html5up_editorial/body.html
 * Date :      Fri, 04 Jun 2021 14:01:59 GMT
 * Compile :   Fri, 04 Jun 2021 14:34:28 GMT
 * Boucles :   _langues
 */ 

function BOUCLE_langueshtml_e38a863f56489ed6e259b4b561d6a966(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

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
		$command['id'] = '_langues';
		$command['from'] = array('articles' => 'spip_articles');
		$command['type'] = array();
		$command['groupby'] = array("lang");
		$command['select'] = array("lang",
		"articles.lang",
		"articles.id_rubrique",
		"articles.id_article",
		"articles.titre");
		$command['orderby'] = array('articles.lang');
		$command['where'] = 
			array(
quete_condition_statut('articles.statut','publie,prop,prepa/auteur','publie',''), 
quete_condition_postdates('articles.date',''), 
			array('>', 'articles.id_rubrique', '"0"'), sql_in('articles.id_article', accesrestreint_liste_objets_exclus('articles', !test_espace_prive()), 'NOT'), sql_in('articles.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), 'NOT'));
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('plugins/html5up_editorial/body.html','html_e38a863f56489ed6e259b4b561d6a966','_langues',9,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	$Numrows['_langues']['total'] = @intval($iter->count());
	lang_select($GLOBALS['spip_lang']);
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		lang_select_public($Pile[$SP]['lang'], '', $Pile[$SP]['titre']);
		$t1 = ((($Numrows['_langues']['total'] > '1'))  ?
		(' ' . (	'
						<a class="lang" href="' .
	spip_htmlspecialchars(sinon($GLOBALS['meta']['adresse_site'],'.')) .
	'/?lang=' .
	spip_htmlentities($Pile[$SP]['lang'] ? $Pile[$SP]['lang'] : $GLOBALS['spip_lang']) .
	'" rel="alternate"
						hreflang="' .
	spip_htmlentities($Pile[$SP]['lang'] ? $Pile[$SP]['lang'] : $GLOBALS['spip_lang']) .
	'" dir="' .
	lang_dir($Pile[$SP]['lang'], 'ltr','rtl') .
	'" lang="' .
	spip_htmlentities($Pile[$SP]['lang'] ? $Pile[$SP]['lang'] : $GLOBALS['spip_lang']) .
	'"
						class="' .
	((spip_htmlentities($Pile[$SP]['lang'] ? $Pile[$SP]['lang'] : $GLOBALS['spip_lang']) == interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'lang', null),true))) ? 'on':'') .
	'"
						>' .
	spip_htmlentities($Pile[$SP]['lang'] ? $Pile[$SP]['lang'] : $GLOBALS['spip_lang']) .
	'</a>
						')) :
		'');
		$t0 .= ((strlen($t1) && strlen($t0)) ? ' | ' : '') . $t1;
		lang_select();
	}
	lang_select();
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_langues @ plugins/html5up_editorial/body.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}

//
// Fonction principale du squelette plugins/html5up_editorial/body.html
// Temps de compilation total: 1.451 ms
//

function html_e38a863f56489ed6e259b4b561d6a966($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'<body>
	<div id="wrapper">
		<div id="main">
			<div class="inner">
				<header id="header"' .
(($t1 = strval(interdire_scripts((((entites_html(table_valeur(@$Pile[0], (string)'type-page', null),true) == 'sommaire')) ?' ' :''))))!=='' ?
		($t1 . ' class="alt"') :
		'') .
'>
					' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette((	'header/' .
	interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'type-page', null),true)))) . ', array_merge('.var_export($Pile[0],1).',array(\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . ')), array("compil"=>array(\'plugins/html5up_editorial/body.html\',\'html_e38a863f56489ed6e259b4b561d6a966\',\'\',6,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>
					' .
(($t1 = strval(interdire_scripts(((filtre_info_plugin_dist("sociaux", "est_actif")) ?' ' :''))))!=='' ?
		($t1 . 
'<'.'?php echo recuperer_fond( ' . argumenter_squelette('inclure/rezo') . ', array(\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . '), array("compil"=>array(\'plugins/html5up_editorial/body.html\',\'html_e38a863f56489ed6e259b4b561d6a966\',\'\',7,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>') :
		'') .
'
					
					' .
(($t1 = BOUCLE_langueshtml_e38a863f56489ed6e259b4b561d6a966($Cache, $Pile, $doublons, $Numrows, $SP))!=='' ?
		('<p class="langues">
						' . $t1 . '
					</p>') :
		'') .
'
				</header>
				
				' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette((	'breadcrumb/' .
	interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'type-page', null),true)))) . ', array_merge('.var_export($Pile[0],1).',array(\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . ')), array("compil"=>array(\'plugins/html5up_editorial/body.html\',\'html_e38a863f56489ed6e259b4b561d6a966\',\'\',19,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>
				' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette((	'content/' .
	interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'type-page', null),true)))) . ', array_merge('.var_export($Pile[0],1).',array(\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . ')), array("compil"=>array(\'plugins/html5up_editorial/body.html\',\'html_e38a863f56489ed6e259b4b561d6a966\',\'\',20,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>
				
			</div><!-- .inner -->
		</div><!-- .main -->
		<div id="sidebar">
			' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette('inclure/sidebar') . ', array_merge('.var_export($Pile[0],1).',array(\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . ')), array("compil"=>array(\'plugins/html5up_editorial/body.html\',\'html_e38a863f56489ed6e259b4b561d6a966\',\'\',25,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>
		</div><!-- .sidebar -->
	</div><!-- .wrapper -->
</body>');

	return analyse_resultat_skel('html_e38a863f56489ed6e259b4b561d6a966', $Cache, $page, 'plugins/html5up_editorial/body.html');
}
?>