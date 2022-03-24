<?php

/*
 * Squelette : plugins/html5up_editorial/content/rubrique.html
 * Date :      Fri, 04 Jun 2021 14:01:59 GMT
 * Compile :   Sat, 05 Jun 2021 07:58:14 GMT
 * Boucles :   _agenda, _rubrique
 */ 

function BOUCLE_agendahtml_231ada33246e9221f90a0004eb4dea66(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

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
		"evenements.date_fin",
		"evenements.horaire",
		"evenements.lieu",
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
		array('plugins/html5up_editorial/content/rubrique.html','html_231ada33246e9221f90a0004eb4dea66','_agenda',13,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$t0 .= (
'
	<dt><b><a href="' .
vider_url(urlencode_1738(generer_url_entite($Pile[$SP]['id_article'], 'article', '', '', true))) .
'">' .
interdire_scripts(supprimer_numero(typo($Pile[$SP]['titre']), "TYPO", $connect, $Pile[0])) .
'</a></b></dt>
	<dd><b>Date</b>:  ' .
interdire_scripts(Agenda_affdate_debut_fin($Pile[$SP]['date_debut'],interdire_scripts($Pile[$SP]['date_fin']),interdire_scripts($Pile[$SP]['horaire']))) .
'</dd>
	<dd><b>Lieu</b>:  ' .
interdire_scripts(expanser_liens(typo($Pile[$SP]['lieu'], "TYPO", $connect, $Pile[0]))) .
'</dd><br>
	');
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_agenda @ plugins/html5up_editorial/content/rubrique.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLE_rubriquehtml_231ada33246e9221f90a0004eb4dea66(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

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
		$command['id'] = '_rubrique';
		$command['from'] = array('rubriques' => 'spip_rubriques');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("rubriques.id_rubrique",
		"rubriques.titre",
		"rubriques.texte",
		"rubriques.id_rubrique",
		"rubriques.lang");
		$command['orderby'] = array();
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	$command['where'] = 
			array(
quete_condition_statut('rubriques.statut','!','publie',''), 
			array('=', 'rubriques.id_rubrique', sql_quote(@$Pile[0]['id_rubrique'], '','bigint(21) NOT NULL AUTO_INCREMENT')), sql_in('rubriques.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), 'NOT'));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('plugins/html5up_editorial/content/rubrique.html','html_231ada33246e9221f90a0004eb4dea66','_rubrique',1,$GLOBALS['spip_lang'])
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
(($t1 = strval(interdire_scripts(supprimer_numero(typo($Pile[$SP]['titre']), "TYPO", $connect, $Pile[0]))))!=='' ?
		((	'<h1 class="">') . $t1 . '</h1>') :
		'') .
'
	</header>

	' .
(($t1 = strval(interdire_scripts(adaptive_images(propre($Pile[$SP]['texte'], $connect, $Pile[0])))))!=='' ?
		((	'<div class="texte ">') . $t1 . '</div>') :
		'') .
'
	' .
(($t1 = strval(interdire_scripts(calculer_notes())))!=='' ?
		('<div class="notes">' . $t1 . '</div>') :
		'') .
'

	' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette('inclure/documents') . ', array_merge('.var_export($Pile[0],1).',array(\'id_rubrique\' => ' . argumenter_squelette($Pile[$SP]['id_rubrique']) . ',
	\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . ')), array("compil"=>array(\'plugins/html5up_editorial/content/rubrique.html\',\'html_231ada33246e9221f90a0004eb4dea66\',\'\',10,$GLOBALS[\'spip_lang\']),\'ajax\' => ($v=( ' . argumenter_squelette(@$Pile[0]['ajax']) . '))?$v:true), _request("connect"));
?'.'>
</section>

' .
(($t1 = BOUCLE_agendahtml_231ada33246e9221f90a0004eb4dea66($Cache, $Pile, $doublons, $Numrows, $SP))!=='' ?
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

<section>
	' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette('inclure/liste/articles') . ', array_merge('.var_export($Pile[0],1).',array(\'id_rubrique\' => ' . argumenter_squelette($Pile[$SP]['id_rubrique']) . ',
	\'parpage\' => ' . argumenter_squelette('6') . ',
	\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . ')), array("compil"=>array(\'plugins/html5up_editorial/content/rubrique.html\',\'html_231ada33246e9221f90a0004eb4dea66\',\'\',27,$GLOBALS[\'spip_lang\']),\'ajax\' => ($v=( ' . argumenter_squelette(@$Pile[0]['ajax']) . '))?$v:true), _request("connect"));
?'.'>
</section>
<section>
	' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette('inclure/liste/rubriques') . ', array_merge('.var_export($Pile[0],1).',array(\'id_rubrique\' => ' . argumenter_squelette($Pile[$SP]['id_rubrique']) . ',
	\'parpage\' => ' . argumenter_squelette('6') . ',
	\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . ')), array("compil"=>array(\'plugins/html5up_editorial/content/rubrique.html\',\'html_231ada33246e9221f90a0004eb4dea66\',\'\',30,$GLOBALS[\'spip_lang\']),\'ajax\' => ($v=( ' . argumenter_squelette(@$Pile[0]['ajax']) . '))?$v:true), _request("connect"));
?'.'>
</section>
');
		lang_select();
	}
	lang_select();
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_rubrique @ plugins/html5up_editorial/content/rubrique.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}

//
// Fonction principale du squelette plugins/html5up_editorial/content/rubrique.html
// Temps de compilation total: 4.007 ms
//

function html_231ada33246e9221f90a0004eb4dea66($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
BOUCLE_rubriquehtml_231ada33246e9221f90a0004eb4dea66($Cache, $Pile, $doublons, $Numrows, $SP) .
'
');

	return analyse_resultat_skel('html_231ada33246e9221f90a0004eb4dea66', $Cache, $page, 'plugins/html5up_editorial/content/rubrique.html');
}
?>