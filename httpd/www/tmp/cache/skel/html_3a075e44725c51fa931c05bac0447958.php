<?php

/*
 * Squelette : squelettes/inclure/sidemenu.html
 * Date :      Fri, 04 Jun 2021 14:01:59 GMT
 * Compile :   Fri, 04 Jun 2021 14:34:30 GMT
 * Boucles :   _test_rubriques, _rubriques
 */ 

function BOUCLE_test_rubriqueshtml_3a075e44725c51fa931c05bac0447958(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';if (!defined('_DIR_PLUGIN_ACCESRESTREINT')) {
			$link_empty = generer_url_ecrire('admin_vider'); $link_plugin = generer_url_ecrire('admin_plugin');
			$message_fr = 'La restriction d\'acc&egrave;s a ete desactiv&eacute;e. <a href="'.$link_plugin.'">Corriger le probl&egrave;me</a> ou <a href="'.$link_empty.'">vider le cache</a> pour supprimer les restrictions.';
			$message_en = 'Acces Restriction is now unusable. <a href="'.$link_plugin.'">Correct this trouble</a> or <a href="'.generer_url_ecrire('admin_vider').'">empty the cache</a> to finish restriction removal.';
			die($message_fr.'<br />'.$message_en);
			}
	if (!isset($command['table'])) {
		$command['table'] = 'rubriques';
		$command['id'] = '_test_rubriques';
		$command['from'] = array('rubriques' => 'spip_rubriques');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("rubriques.id_rubrique");
		$command['orderby'] = array();
		$command['join'] = array();
		$command['limit'] = '0,1';
		$command['having'] = 
			array();
	}
	$command['where'] = 
			array(
quete_condition_statut('rubriques.statut','!','publie',''), 
			array('=', 'rubriques.id_parent', sql_quote($Pile[$SP]['id_rubrique'], '','bigint(21) NOT NULL DEFAULT 0')), sql_in('rubriques.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), 'NOT'));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('squelettes/inclure/sidemenu.html','html_3a075e44725c51fa931c05bac0447958','_test_rubriques',19,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	$Numrows['_test_rubriques']['total'] = @intval($iter->count());
	$SP++;
	// RESULTATS
	
	$t0 = str_repeat('
			', $Numrows['_test_rubriques']['total']);
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_test_rubriques @ squelettes/inclure/sidemenu.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLE_rubriqueshtml_3a075e44725c51fa931c05bac0447958(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';if (!defined('_DIR_PLUGIN_ACCESRESTREINT')) {
			$link_empty = generer_url_ecrire('admin_vider'); $link_plugin = generer_url_ecrire('admin_plugin');
			$message_fr = 'La restriction d\'acc&egrave;s a ete desactiv&eacute;e. <a href="'.$link_plugin.'">Corriger le probl&egrave;me</a> ou <a href="'.$link_empty.'">vider le cache</a> pour supprimer les restrictions.';
			$message_en = 'Acces Restriction is now unusable. <a href="'.$link_plugin.'">Correct this trouble</a> or <a href="'.generer_url_ecrire('admin_vider').'">empty the cache</a> to finish restriction removal.';
			die($message_fr.'<br />'.$message_en);
			}
	if (!isset($command['table'])) {
		$command['table'] = 'rubriques';
		$command['id'] = '_rubriques';
		$command['from'] = array('rubriques' => 'spip_rubriques');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("rubriques.id_rubrique",
		"0+rubriques.titre AS num",
		"rubriques.titre",
		"rubriques.id_rubrique",
		"rubriques.lang");
		$command['orderby'] = array('num', 'rubriques.titre');
		$command['where'] = 
			array(
quete_condition_statut('rubriques.statut','!','publie',''), 
			array('=', 'rubriques.id_parent', 0), sql_in('rubriques.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), 'NOT'));
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
		array('squelettes/inclure/sidemenu.html','html_3a075e44725c51fa931c05bac0447958','_rubriques',6,$GLOBALS['spip_lang'])
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
vide($Pile['vars'][$_zzz=(string)(	'smenu' .
	$Pile[$SP]['id_rubrique'])] = 'non') .
(($t1 = BOUCLE_test_rubriqueshtml_3a075e44725c51fa931c05bac0447958($Cache, $Pile, $doublons, $Numrows, $SP))!=='' ?
		($t1 . vide($Pile['vars'][$_zzz=(string)(	'smenu' .
			$Pile[$SP]['id_rubrique'])] = 'oui')) :
		'') .
'
			
		<li>
			' .
(($t1 = strval((((table_valeur($Pile["vars"], (string)(	'smenu' .
	$Pile[$SP]['id_rubrique']), null) == 'oui')) ?'' :' ')))!=='' ?
		($t1 . (	'
			<a href="' .
	courtcircuit_calculer_balise_URL_RUBRIQUE ($Pile[$SP]['id_rubrique']) .
	'"' .
	(calcul_exposer($Pile[$SP]['id_rubrique'], 'id_rubrique', $Pile[0], 0, 'id_rubrique', '')  ?
			(' class="' . 'on' . '"') :
			'') .
	'>' .
	interdire_scripts(supprimer_numero(typo($Pile[$SP]['titre']), "TYPO", $connect, $Pile[0])) .
	'</a>')) :
		'') .
'
			' .
(($t1 = strval((((table_valeur($Pile["vars"], (string)(	'smenu' .
	$Pile[$SP]['id_rubrique']), null) == 'oui')) ?' ' :'')))!=='' ?
		($t1 . (	'
			<span class="opener' .
	(calcul_exposer($Pile[$SP]['id_rubrique'], 'id_rubrique', $Pile[0], 0, 'id_rubrique', '')  ?
			(' ' . 'on' . ' active') :
			'') .
	'">' .
	interdire_scripts(supprimer_numero(typo($Pile[$SP]['titre']), "TYPO", $connect, $Pile[0])) .
	'</span>
			<ul>
				' .
	
'<'.'?php echo recuperer_fond( ' . argumenter_squelette('inclure/sidemenu-articles') . ', array_merge('.var_export($Pile[0],1).',array(\'id_rubrique\' => ' . argumenter_squelette($Pile[$SP]['id_rubrique']) . ',
	\'id_article\' => ' . argumenter_squelette(@$Pile[0]['id_article']) . ',
	\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . ')), array("compil"=>array(\'squelettes/inclure/sidemenu.html\',\'html_3a075e44725c51fa931c05bac0447958\',\'\',27,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>
				' .
	
'<'.'?php echo recuperer_fond( ' . argumenter_squelette('inclure/sidemenu-rubriques') . ', array_merge('.var_export($Pile[0],1).',array(\'id_rubrique\' => ' . argumenter_squelette($Pile[$SP]['id_rubrique']) . ',
	\'rubrique_on\' => ' . argumenter_squelette(@$Pile[0]['rubrique_on']) . ',
	\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . ')), array("compil"=>array(\'squelettes/inclure/sidemenu.html\',\'html_3a075e44725c51fa931c05bac0447958\',\'\',28,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>
				
			</ul>')) :
		'') .
'
		</li>
		');
		lang_select();
	}
	lang_select();
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_rubriques @ squelettes/inclure/sidemenu.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}

//
// Fonction principale du squelette squelettes/inclure/sidemenu.html
// Temps de compilation total: 0.728 ms
//

function html_3a075e44725c51fa931c05bac0447958($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'
' .
(($t1 = BOUCLE_rubriqueshtml_3a075e44725c51fa931c05bac0447958($Cache, $Pile, $doublons, $Numrows, $SP))!=='' ?
		((	'
<nav id="menu">
	<header class="major">
	<center><em>Bienvenue sur le site du LibAirTerre</em></center></br>
	</header>
	
	<ul>
		<li><a class="accueil" href="' .
		spip_htmlspecialchars(sinon($GLOBALS['meta']['adresse_site'],'.')) .
		'">' .
		_T('public|spip|ecrire:accueil_site') .
		'</a></li>
	
		') . $t1 . '
	
	</ul>
	
</nav>
') :
		''));

	return analyse_resultat_skel('html_3a075e44725c51fa931c05bac0447958', $Cache, $page, 'squelettes/inclure/sidemenu.html');
}
?>