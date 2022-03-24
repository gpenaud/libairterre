<?php

/*
 * Squelette : plugins/html5up_editorial/inclure/sidebar.html
 * Date :      Fri, 04 Jun 2021 14:01:59 GMT
 * Compile :   Fri, 04 Jun 2021 14:34:30 GMT
 * Boucles :   _heroside
 */ 

function BOUCLE_herosidehtml_67b09ea0b10a169d12dc68a182b0d9a9(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

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
		array('plugins/html5up_editorial/inclure/sidebar.html','html_67b09ea0b10a169d12dc68a182b0d9a9','_heroside',8,$GLOBALS['spip_lang'])
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
			<h2>') . $t1 . '</h2>
		</header>') :
		'') .
'
		' .
(($t1 = strval(interdire_scripts(filtre_introduction($Pile[$SP]['descriptif'], (strlen($Pile[$SP]['descriptif']))
		? ''
		: $Pile[$SP]['chapo'] . "\n\n" . $Pile[$SP]['texte'], 500, $connect, null))))!=='' ?
		((	'<div class="mini-posts texte ">
			') . $t1 . '
		</div>') :
		'') .
'
		<ul class="actions">
			<li><a href="' .
vider_url(urlencode_1738(generer_url_entite($Pile[$SP]['id_article'], 'article', '', '', true))) .
'" class="button">' .
_T('zcore:lire_la_suite') .
'</a></li>
		</ul>
		');
		lang_select();
	}
	lang_select();
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_heroside @ plugins/html5up_editorial/inclure/sidebar.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}

//
// Fonction principale du squelette plugins/html5up_editorial/inclure/sidebar.html
// Temps de compilation total: 1.678 ms
//

function html_67b09ea0b10a169d12dc68a182b0d9a9($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'<div class="inner">
	<section id="search" class="alt">
		' .
executer_balise_dynamique('FORMULAIRE_RECHERCHE',
	array(),
	array('plugins/html5up_editorial/inclure/sidebar.html','html_67b09ea0b10a169d12dc68a182b0d9a9','',3,$GLOBALS['spip_lang'])) .
'
	</section>
	
	' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette('inclure/sidemenu') . ', array_merge('.var_export($Pile[0],1).',array(\'rubrique_on\' => ' . argumenter_squelette(interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'id_rubrique', null),true))) . ',
	\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . ')), array("compil"=>array(\'plugins/html5up_editorial/inclure/sidebar.html\',\'html_67b09ea0b10a169d12dc68a182b0d9a9\',\'\',6,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>
	
	' .
(($t1 = BOUCLE_herosidehtml_67b09ea0b10a169d12dc68a182b0d9a9($Cache, $Pile, $doublons, $Numrows, $SP))!=='' ?
		('
	<section>
		' . $t1 . '
	</section>
	') :
		'') .
'
	' .
(($t1 = strval(interdire_scripts((((((((((((((((include_spip('inc/config')?lire_config('sociaux/mail',null,false):'')) OR (interdire_scripts((include_spip('inc/config')?lire_config('html5up/contact_telephone',null,false):'')))) ?' ' :'')) OR (interdire_scripts((include_spip('inc/config')?lire_config('html5up/contact_adresse',null,false):'')))) ?' ' :'')) OR (interdire_scripts((include_spip('inc/config')?lire_config('html5up/contact_complement',null,false):'')))) ?' ' :'')) OR (interdire_scripts(filtre_info_plugin_dist("contact", "est_actif")))) ?' ' :'')) ?' ' :''))))!=='' ?
		($t1 . (	'
	<section>
		<header class="major">
			<h2>' .
	_T('html5up:contact') .
	'</h2>
		</header>
		
		<ul class="contact">
			' .
	(($t2 = strval(interdire_scripts((include_spip('inc/config')?lire_config('sociaux/mail',null,false):''))))!=='' ?
			((	'<li class="fa-envelope-o"><a href="mailto:' .
		interdire_scripts((include_spip('inc/config')?lire_config('sociaux/mail',null,false):'')) .
		'">') . $t2 . '</a></li>') :
			'') .
	'
			' .
	(($t2 = strval(interdire_scripts((include_spip('inc/config')?lire_config('html5up/contact_telephone',null,false):''))))!=='' ?
			('<li class="fa-phone">' . $t2 . '</li>') :
			'') .
	'
			' .
	(($t2 = strval(interdire_scripts(ptobr(propre((include_spip('inc/config')?lire_config('html5up/contact_adresse',null,false):''))))))!=='' ?
			('<li class="fa-home">' . $t2 . '</li>') :
			'') .
	'
			' .
	(($t2 = strval(interdire_scripts(ptobr(propre((include_spip('inc/config')?lire_config('html5up/contact_complement',null,false):''))))))!=='' ?
			('<li class="fa-clock-o">' . $t2 . '</li>') :
			'') .
	'
			' .
	(($t2 = strval(interdire_scripts(((filtre_info_plugin_dist("contact", "est_actif")) ?' ' :''))))!=='' ?
			($t2 . (	'
			<li class="contact_form fa-share">
				<div class="ajax">
				' .
		executer_balise_dynamique('FORMULAIRE_CONTACT',
	array(),
	array('plugins/html5up_editorial/inclure/sidebar.html','html_67b09ea0b10a169d12dc68a182b0d9a9','',37,$GLOBALS['spip_lang'])) .
		'
				</div>
			</li>
			')) :
			'') .
	'
		</ul>
		
	</section>')) :
		'') .
'
	<footer id="footer">
		' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette((	'footer/' .
	interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'type-page', null),true)))) . ', array_merge('.var_export($Pile[0],1).',array(\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . ')), array("compil"=>array(\'plugins/html5up_editorial/inclure/sidebar.html\',\'html_67b09ea0b10a169d12dc68a182b0d9a9\',\'\',25,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>
	</footer>
</div><!-- .inner -->');

	return analyse_resultat_skel('html_67b09ea0b10a169d12dc68a182b0d9a9', $Cache, $page, 'plugins/html5up_editorial/inclure/sidebar.html');
}
?>