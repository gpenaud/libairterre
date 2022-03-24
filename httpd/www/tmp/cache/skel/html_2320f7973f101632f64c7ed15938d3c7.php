<?php

/*
 * Squelette : plugins/html5up_editorial/footer/dist.html
 * Date :      Fri, 04 Jun 2021 14:01:59 GMT
 * Compile :   Fri, 04 Jun 2021 14:34:30 GMT
 * Boucles :   _annee
 */ 

function BOUCLE_anneehtml_2320f7973f101632f64c7ed15938d3c7(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

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
		$command['id'] = '_annee';
		$command['from'] = array('articles' => 'spip_articles');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("articles.date",
		"articles.id_rubrique",
		"articles.id_article",
		"articles.lang",
		"articles.titre");
		$command['orderby'] = array('articles.date');
		$command['where'] = 
			array(
quete_condition_statut('articles.statut','publie,prop,prepa/auteur','publie',''), 
quete_condition_postdates('articles.date',''), 
			array('>', 'articles.id_rubrique', '"0"'), sql_in('articles.id_article', accesrestreint_liste_objets_exclus('articles', !test_espace_prive()), 'NOT'), sql_in('articles.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), 'NOT'));
		$command['join'] = array();
		$command['limit'] = '0,1';
		$command['having'] = 
			array();
	}
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('plugins/html5up_editorial/footer/dist.html','html_2320f7973f101632f64c7ed15938d3c7','_annee',2,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	lang_select($GLOBALS['spip_lang']);
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		lang_select_public($Pile[$SP]['lang'], '', $Pile[$SP]['titre']);
		$t0 .= (($t1 = strval(interdire_scripts((((annee(normaliser_date($Pile[$SP]['date'])) != date('Y'))) ?' ' :''))))!=='' ?
		($t1 . interdire_scripts(annee(normaliser_date($Pile[$SP]['date'])))) :
		'');
		lang_select();
	}
	lang_select();
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_annee @ plugins/html5up_editorial/footer/dist.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}

//
// Fonction principale du squelette plugins/html5up_editorial/footer/dist.html
// Temps de compilation total: 0.592 ms
//

function html_2320f7973f101632f64c7ed15938d3c7($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'<p class="copyright">
	' .
(($t1 = BOUCLE_anneehtml_2320f7973f101632f64c7ed15938d3c7($Cache, $Pile, $doublons, $Numrows, $SP))!=='' ?
		($t1 . '-') :
		'') .
'
	' .
(($t1 = strval(interdire_scripts(annee(normaliser_date(@$Pile[0]['date'])))))!=='' ?
		($t1 . ' ') :
		'') .
' &mdash; ' .
interdire_scripts(typo($GLOBALS['meta']['nom_site'], "TYPO", $connect, $Pile[0])) .
' | 
	<a rel="contents" href="' .
interdire_scripts(generer_url_public('plan', '')) .
'">' .
_T('public|spip|ecrire:plan_site') .
'</a> | 
	<?php
if (isset($GLOBALS[\'visiteur_session\'][\'id_auteur\']) AND $GLOBALS[\'visiteur_session\'][\'id_auteur\']) {
?>	<a href="' .
executer_balise_dynamique('URL_LOGOUT',
	array(),
	array('plugins/html5up_editorial/footer/dist.html','html_2320f7973f101632f64c7ed15938d3c7','',7,$GLOBALS['spip_lang'])) .
'" rel="nofollow">' .
_T('public|spip|ecrire:icone_deconnecter') .
'</a> | 
	<?php
	if (include_spip(\'inc/autoriser\') AND autoriser(\'ecrire\')) {
?>	<a href="' .
interdire_scripts(eval('return '.'_DIR_RESTREINT_ABS'.';')) .
'">' .
_T('public|spip|ecrire:espace_prive') .
'</a> | 
	<?php
	}
} else {
?>	<a href="' .
interdire_scripts(parametre_url(generer_url_public('login', ''),'url',parametre_url(self(),'url',''))) .
'" rel="nofollow" class=\'login_modal\'>' .
_T('public|spip|ecrire:lien_connecter') .
'</a> | 
	<?php
}
?>	<a href="https://html5up.net/editorial" title="' .
attribut_html(_T('public|spip|ecrire:theme_graphique_par_html5up')) .
'" class="spip_out">HTML5 UP</a> | 
	<small class="generator">
		<a href="https://www.spip.net/" rel="generator" title="' .
attribut_html(_T('public|spip|ecrire:site_realise_avec_spip')) .
'" class="spip_out">
			' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette('inclure/logospip') . ', array(\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . '), array("compil"=>array(\'plugins/html5up_editorial/footer/dist.html\',\'html_2320f7973f101632f64c7ed15938d3c7\',\'\',20,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>
		</a>
	</small>
</p>');

	return analyse_resultat_skel('html_2320f7973f101632f64c7ed15938d3c7', $Cache, $page, 'plugins/html5up_editorial/footer/dist.html');
}
?>