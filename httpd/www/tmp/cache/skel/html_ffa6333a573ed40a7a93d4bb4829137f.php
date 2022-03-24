<?php

/*
 * Squelette : plugins/html5up_editorial/breadcrumb/inc-objet.html
 * Date :      Fri, 04 Jun 2021 14:01:59 GMT
 * Compile :   Sat, 05 Jun 2021 07:58:14 GMT
 * Boucles :   _ariane_hier, _contexte_rubrique
 */ 

function BOUCLE_ariane_hierhtml_ffa6333a573ed40a7a93d4bb4829137f(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	if (!($id_rubrique = intval($Pile[$SP]['id_rubrique'])))
		return '';
	include_spip('inc/rubriques');
	$hierarchie = calcul_hierarchie_in($id_rubrique,true);
	if (!$hierarchie) return "";
	if (!defined('_DIR_PLUGIN_ACCESRESTREINT')) {
			$link_empty = generer_url_ecrire('admin_vider'); $link_plugin = generer_url_ecrire('admin_plugin');
			$message_fr = 'La restriction d\'acc&egrave;s a ete desactiv&eacute;e. <a href="'.$link_plugin.'">Corriger le probl&egrave;me</a> ou <a href="'.$link_empty.'">vider le cache</a> pour supprimer les restrictions.';
			$message_en = 'Acces Restriction is now unusable. <a href="'.$link_plugin.'">Correct this trouble</a> or <a href="'.generer_url_ecrire('admin_vider').'">empty the cache</a> to finish restriction removal.';
			die($message_fr.'<br />'.$message_en);
			}
	if (!isset($command['table'])) {
		$command['table'] = 'rubriques';
		$command['id'] = '_ariane_hier';
		$command['from'] = array('rubriques' => 'spip_rubriques');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("rubriques.id_rubrique",
		"rubriques.titre",
		"rubriques.id_rubrique",
		"rubriques.id_rubrique",
		"rubriques.lang");
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	$command['orderby'] = array("FIELD(rubriques.id_rubrique, $hierarchie)");
	$command['where'] = 
			array(sql_in('rubriques.id_rubrique', accesrestreint_liste_objets_exclus('rubriques', !test_espace_prive()), 'NOT'), 
			array('IN', 'rubriques.id_rubrique', "($hierarchie)"));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('plugins/html5up_editorial/breadcrumb/inc-objet.html','html_ffa6333a573ed40a7a93d4bb4829137f','_ariane_hier',3,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	lang_select($GLOBALS['spip_lang']);
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		lang_select_public($Pile[$SP]['lang'], '', $Pile[$SP]['titre']);
		$t0 .= (
'
<a href="' .
courtcircuit_calculer_balise_URL_RUBRIQUE ($Pile[$SP]['id_rubrique']) .
'">' .
interdire_scripts(couper(supprimer_numero(typo($Pile[$SP]['titre']), "TYPO", $connect, $Pile[0]),'80')) .
'</a><span class="divider"> &gt; </span>
');
		lang_select();
	}
	lang_select();
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_ariane_hier @ plugins/html5up_editorial/breadcrumb/inc-objet.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLE_contexte_rubriquehtml_ffa6333a573ed40a7a93d4bb4829137f(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

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
		$command['id'] = '_contexte_rubrique';
		$command['from'] = array('rubriques' => 'spip_rubriques');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("rubriques.id_rubrique",
		"rubriques.id_rubrique",
		"rubriques.lang",
		"rubriques.titre");
		$command['orderby'] = array();
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	$command['where'] = 
			array(
quete_condition_statut('rubriques.statut','!','publie',''), 
			array('=', 'rubriques.id_rubrique', sql_quote(interdire_scripts(((@$Pile[0]['objet'] == 'rubrique') ? interdire_scripts(generer_info_entite(@$Pile[0]['id_objet'], interdire_scripts(@$Pile[0]['objet']), 'id_parent')):interdire_scripts(generer_info_entite(@$Pile[0]['id_objet'], interdire_scripts(@$Pile[0]['objet']), 'id_rubrique')))), '', 'bigint(21) NOT NULL AUTO_INCREMENT')), sql_in('rubriques.id_rubrique', accesrestreint_liste_rubriques_exclues(!test_espace_prive()), 'NOT'));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('plugins/html5up_editorial/breadcrumb/inc-objet.html','html_ffa6333a573ed40a7a93d4bb4829137f','_contexte_rubrique',2,$GLOBALS['spip_lang'])
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
BOUCLE_ariane_hierhtml_ffa6333a573ed40a7a93d4bb4829137f($Cache, $Pile, $doublons, $Numrows, $SP) .
'
');
		lang_select();
	}
	lang_select();
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_contexte_rubrique @ plugins/html5up_editorial/breadcrumb/inc-objet.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}

//
// Fonction principale du squelette plugins/html5up_editorial/breadcrumb/inc-objet.html
// Temps de compilation total: 3.707 ms
//

function html_ffa6333a573ed40a7a93d4bb4829137f($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'<a href="' .
spip_htmlspecialchars(sinon($GLOBALS['meta']['adresse_site'],'.')) .
'/">' .
_T('public|spip|ecrire:accueil_site') .
'</a><span class="divider"> &gt; </span>
' .
BOUCLE_contexte_rubriquehtml_ffa6333a573ed40a7a93d4bb4829137f($Cache, $Pile, $doublons, $Numrows, $SP) .
'
<span' .
(($t1 = strval(interdire_scripts(((entites_html(sinon(table_valeur(@$Pile[0], (string)'expose', null), ' '),true)) ?' ' :''))))!=='' ?
		($t1 . 'class="active"') :
		'') .
'>' .
lien_ou_expose(generer_url_entite(@$Pile[0]['id_objet'],interdire_scripts(@$Pile[0]['objet'])),interdire_scripts(couper(((($a = generer_info_entite(@$Pile[0]['id_objet'], interdire_scripts(@$Pile[0]['objet']), 'titre')) OR (is_string($a) AND strlen($a))) ? $a : '?'),'80')),interdire_scripts((entites_html(sinon(table_valeur(@$Pile[0], (string)'expose', null), ' '),true) ? 'span':''))) .
'</span>' .
(($t1 = strval(interdire_scripts(((entites_html(sinon(table_valeur(@$Pile[0], (string)'expose', null), ' '),true)) ?'' :' '))))!=='' ?
		('<span class="divider">' . $t1 . '&gt; </span>') :
		''));

	return analyse_resultat_skel('html_ffa6333a573ed40a7a93d4bb4829137f', $Cache, $page, 'plugins/html5up_editorial/breadcrumb/inc-objet.html');
}
?>