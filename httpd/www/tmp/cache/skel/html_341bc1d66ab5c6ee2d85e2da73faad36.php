<?php

/*
 * Squelette : plugins/html5up_editorial/inclure/liste/rubriques.html
 * Date :      Fri, 04 Jun 2021 14:01:59 GMT
 * Compile :   Sat, 05 Jun 2021 07:59:14 GMT
 * Boucles :   _rubriques
 */ 

function BOUCLE_rubriqueshtml_341bc1d66ab5c6ee2d85e2da73faad36(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	$command['pagination'] = array((isset($Pile[0]['debut_rubriques']) ? $Pile[0]['debut_rubriques'] : null), (($a = intval(interdire_scripts(entites_html(sinon(table_valeur(@$Pile[0], (string)'parpage', null), '10'),true)))) ? $a : 10));if (!defined('_DIR_PLUGIN_ACCESRESTREINT')) {
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
		$command['select'] = array("rubriques.date",
		"rubriques.id_rubrique",
		"rubriques.id_rubrique",
		"rubriques.lang",
		"rubriques.titre");
		$command['orderby'] = array('rubriques.date DESC');
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	$command['where'] = 
			array(
quete_condition_statut('rubriques.statut','!','publie',''), 
			array('=', 'rubriques.id_parent', sql_quote(@$Pile[0]['id_rubrique'], '', 'bigint(21) NOT NULL DEFAULT 0')), sql_in('rubriques.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), 'NOT'));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('plugins/html5up_editorial/inclure/liste/rubriques.html','html_341bc1d66ab5c6ee2d85e2da73faad36','_rubriques',1,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	
	// COMPTEUR
	$Numrows['_rubriques']['compteur_boucle'] = 0;
	$Numrows['_rubriques']['total'] = @intval($iter->count());
	$debut_boucle = isset($Pile[0]['debut_rubriques']) ? $Pile[0]['debut_rubriques'] : _request('debut_rubriques');
	if(substr($debut_boucle,0,1)=='@'){
		$debut_boucle = $Pile[0]['debut_rubriques'] = quete_debut_pagination('id_rubrique',$Pile[0]['@id_rubrique'] = substr($debut_boucle,1),(($a = intval(interdire_scripts(entites_html(sinon(table_valeur(@$Pile[0], (string)'parpage', null), '10'),true)))) ? $a : 10),$iter);
		$iter->seek(0);
	}
	$debut_boucle = intval($debut_boucle);
	$debut_boucle = (($tout=($debut_boucle == -1))?0:($debut_boucle));
	$debut_boucle = max(0,min($debut_boucle,floor(($Numrows['_rubriques']['total']-1)/((($a = intval(interdire_scripts(entites_html(sinon(table_valeur(@$Pile[0], (string)'parpage', null), '10'),true)))) ? $a : 10)))*((($a = intval(interdire_scripts(entites_html(sinon(table_valeur(@$Pile[0], (string)'parpage', null), '10'),true)))) ? $a : 10))));
	$debut_boucle = intval($debut_boucle);
	$fin_boucle = min(($tout ? $Numrows['_rubriques']['total'] : $debut_boucle+(($a = intval(interdire_scripts(entites_html(sinon(table_valeur(@$Pile[0], (string)'parpage', null), '10'),true)))) ? $a : 10) - 1), $Numrows['_rubriques']['total'] - 1);
	$Numrows['_rubriques']['grand_total'] = $Numrows['_rubriques']['total'];
	$Numrows['_rubriques']["total"] = max(0,$fin_boucle - $debut_boucle + 1);
	if ($debut_boucle>0 AND $debut_boucle < $Numrows['_rubriques']['grand_total'] AND $iter->seek($debut_boucle,'continue'))
		$Numrows['_rubriques']['compteur_boucle'] = $debut_boucle;
	
	lang_select($GLOBALS['spip_lang']);
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$Numrows['_rubriques']['compteur_boucle']++;
		if ($Numrows['_rubriques']['compteur_boucle'] <= $debut_boucle) continue;
		if ($Numrows['_rubriques']['compteur_boucle']-1 > $fin_boucle) break;
		lang_select_public($Pile[$SP]['lang'], '', $Pile[$SP]['titre']);
		$t0 .= (
'
		' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette('inclure/resume/rubrique') . ', array_merge('.var_export($Pile[0],1).',array(\'id_rubrique\' => ' . argumenter_squelette($Pile[$SP]['id_rubrique']) . ',
	\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . ')), array("compil"=>array(\'plugins/html5up_editorial/inclure/liste/rubriques.html\',\'html_341bc1d66ab5c6ee2d85e2da73faad36\',\'\',8,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>
		');
		lang_select();
	}
	lang_select();
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_rubriques @ plugins/html5up_editorial/inclure/liste/rubriques.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}

//
// Fonction principale du squelette plugins/html5up_editorial/inclure/liste/rubriques.html
// Temps de compilation total: 1.447 ms
//

function html_341bc1d66ab5c6ee2d85e2da73faad36($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (($t1 = BOUCLE_rubriqueshtml_341bc1d66ab5c6ee2d85e2da73faad36($Cache, $Pile, $doublons, $Numrows, $SP))!=='' ?
		((	'
	' .
		filtre_pagination_dist($Numrows["_rubriques"]["grand_total"],
 		'_rubriques',
		isset($Pile[0]['debut_rubriques'])?$Pile[0]['debut_rubriques']:intval(_request('debut_rubriques')),
		(($a = intval(interdire_scripts(entites_html(sinon(table_valeur(@$Pile[0], (string)'parpage', null), '10'),true)))) ? $a : 10), false, '', '', array()) .
		'
	' .
		(($t3 = strval(interdire_scripts(entites_html(sinon(table_valeur(@$Pile[0], (string)'titre', null), _T('public|spip|ecrire:rubriques')),true))))!=='' ?
				('<header class="major">
		<h2>' . $t3 . '</h2>
	</header>') :
				'') .
		'
	<div class="posts">
		') . $t1 . (	'
	</div>
	' .
		filtre_pagination_dist($Numrows["_rubriques"]["grand_total"],
 		'_rubriques',
		isset($Pile[0]['debut_rubriques'])?$Pile[0]['debut_rubriques']:intval(_request('debut_rubriques')),
		(($a = intval(interdire_scripts(entites_html(sinon(table_valeur(@$Pile[0], (string)'parpage', null), '10'),true)))) ? $a : 10), true, 'page', '', array()) .
		'
')) :
		'');

	return analyse_resultat_skel('html_341bc1d66ab5c6ee2d85e2da73faad36', $Cache, $page, 'plugins/html5up_editorial/inclure/liste/rubriques.html');
}
?>