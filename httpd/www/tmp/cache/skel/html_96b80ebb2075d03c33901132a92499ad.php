<?php

/*
 * Squelette : plugins/contact/formulaires/contact.html
 * Date :      Fri, 04 Jun 2021 14:01:59 GMT
 * Compile :   Fri, 04 Jun 2021 14:34:30 GMT
 * Boucles :   _previsu_infos, _previsu_pj, _previsu, _destinataires, _tous, _choix, _infos, _pj, _editable
 */ 

function BOUCLE_previsu_infoshtml_96b80ebb2075d03c33901132a92499ad(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	$command['source'] = array(interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'_champs', null),true)));
	$command['sourcemode'] = 'table';
	if (!isset($command['table'])) {
		$command['table'] = '';
		$command['id'] = '_previsu_infos';
		$command['from'] = array();
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array(".cle",
		".valeur");
		$command['orderby'] = array();
		$command['where'] = 
			array();
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"DATA",
		$command,
		array('plugins/contact/formulaires/contact.html','html_96b80ebb2075d03c33901132a92499ad','_previsu_infos',23,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$t0 .= (
'
			' .
(($t1 = strval(interdire_scripts(((match($Pile[$SP]['cle'],'mail|sujet|texte')) ?'' :' '))))!=='' ?
		($t1 . (	'
			' .
	(($t2 = strval(interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)interdire_scripts($Pile[$SP]['cle']), null),true))))!=='' ?
			((	'<li><strong>' .
		interdire_scripts($Pile[$SP]['valeur']) .
		'</strong> : ') . $t2 . '</li>') :
			'') .
	'
			')) :
		'') .
'
			');
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_previsu_infos @ plugins/contact/formulaires/contact.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLE_previsu_pjhtml_96b80ebb2075d03c33901132a92499ad(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	$command['source'] = array(interdire_scripts(table_valeur(entites_html(table_valeur(@$Pile[0], (string)'erreurs', null),true),'infos_pj')));
	$command['sourcemode'] = 'table';
	if (!isset($command['table'])) {
		$command['table'] = '';
		$command['id'] = '_previsu_pj';
		$command['from'] = array();
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array(".cle");
		$command['orderby'] = array();
		$command['where'] = 
			array();
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"DATA",
		$command,
		array('plugins/contact/formulaires/contact.html','html_96b80ebb2075d03c33901132a92499ad','_previsu_pj',30,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$t0 .= (
'
					<li>
						' .
(($t1 = strval(interdire_scripts(extraire_attribut(filtrer('image_graver', filtrer('image_reduire',table_valeur(table_valeur(table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'infos_pj'),interdire_scripts($Pile[$SP]['cle'])),'vignette'),'32')),'src'))))!=='' ?
		('<img src="' . $t1 . (	'" ' .
	(($t2 = strval(interdire_scripts(table_valeur(table_valeur(table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'infos_pj'),interdire_scripts($Pile[$SP]['cle'])),'mime'))))!=='' ?
			('title="' . $t2 . '"') :
			'') .
	' />')) :
		'') .
'
						' .
interdire_scripts(table_valeur(table_valeur(table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'infos_pj'),interdire_scripts($Pile[$SP]['cle'])),'nom')) .
'
					</li>
				');
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_previsu_pj @ plugins/contact/formulaires/contact.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLE_previsuhtml_96b80ebb2075d03c33901132a92499ad(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	if (!isset($si_init)) { $command['si'] = array(); $si_init = true; }
	$command['si'][] = interdire_scripts(((table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'previsu')) ?' ' :''));

	if (!isset($command['table'])) {
		$command['table'] = '';
		$command['id'] = '_previsu';
		$command['from'] = array();
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("1");
		$command['orderby'] = array();
		$command['where'] = 
			array();
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"CONDITION",
		$command,
		array('plugins/contact/formulaires/contact.html','html_96b80ebb2075d03c33901132a92499ad','_previsu',18,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	
	$l1 = _T('public|spip|ecrire:previsualisation');
	$l2 = _T('contact:courriel_de');
	$l3 = _T('public|spip|ecrire:form_prop_sujet');
	$l4 = _T('public|spip|ecrire:info_texte_message');
	$l5 = _T('contact:form_pj_previsu_pluriel');
	$l6 = _T('contact:form_pj_previsu_singulier');
	$l7 = _T('public|spip|ecrire:form_prop_confirmer_envoi');$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$t0 .= (
'
	<fieldset class="previsu">
		<legend>' .
$l1 .
'</legend>
		<ul>
			' .
(($t1 = strval(interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'mail', null),true))))!=='' ?
		((	'<li><strong>' .
	$l2 .
	'</strong> : ') . $t1 . '</li>') :
		'') .
'
			' .
BOUCLE_previsu_infoshtml_96b80ebb2075d03c33901132a92499ad($Cache, $Pile, $doublons, $Numrows, $SP) .
'
			' .
(($t1 = strval(interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'sujet', null),true))))!=='' ?
		((	'<li><strong>' .
	$l3 .
	'</strong> : ') . $t1 . '</li>') :
		'') .
'
			' .
(($t1 = strval(interdire_scripts(propre(entites_html(table_valeur(@$Pile[0], (string)'texte', null),true)))))!=='' ?
		((	'<li><div><strong>' .
	$l4 .
	'</strong></div>') . $t1 . '</li>') :
		'') .
'
			' .
(($t1 = BOUCLE_previsu_pjhtml_96b80ebb2075d03c33901132a92499ad($Cache, $Pile, $doublons, $Numrows, $SP))!=='' ?
		((	'
			<li>
				' .
		(($t3 = strval(interdire_scripts(((count(table_valeur(entites_html(table_valeur(@$Pile[0], (string)'erreurs', null),true),'infos_pj')) > '1') ? $l5:$l6))))!=='' ?
				('<strong>' . $t3 . '</strong>') :
				'') .
		'
				<ul>
				') . $t1 . '
				</ul>
			</li>
			') :
		'') .
'
		</ul>
		<p class="boutons"><input type="submit" class="submit" name="confirmer" value="' .
$l7 .
'" /></p>
	</fieldset>
	');
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_previsu @ plugins/contact/formulaires/contact.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLE_destinataireshtml_96b80ebb2075d03c33901132a92499ad(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	$in = array();
	if (!(is_array($a = (table_valeur(@$Pile[0], (string)'choix_destinataires', null)))))
		$in[]= $a;
	else $in = array_merge($in, $a);
	if (!isset($command['table'])) {
		$command['table'] = 'auteurs';
		$command['id'] = '_destinataires';
		$command['from'] = array('auteurs' => 'spip_auteurs');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("0+auteurs.nom AS num",
		"auteurs.nom",
		"auteurs.id_auteur");
		$command['orderby'] = array('num', 'auteurs.nom');
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	$command['where'] = 
			array(
quete_condition_statut('auteurs.statut','!5poubelle','!5poubelle',''), sql_in('auteurs.id_auteur',sql_quote($in)));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('plugins/contact/formulaires/contact.html','html_96b80ebb2075d03c33901132a92499ad','_destinataires',59,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$t0 .= (
'
						' .
(($t1 = strval(interdire_scripts(((match(entites_html(table_valeur(@$Pile[0], (string)'type_choix', null),true),'plusieurs|plusieurs_et|plusieurs_ou')) ?' ' :''))))!=='' ?
		($t1 . (	'
							<li class="choix">
								<input
									type="checkbox" class="checkbox"
									name="destinataire&#91;&#93;" id="destinataire' .
	$Pile[$SP]['id_auteur'] .
	'"
									value="' .
	$Pile[$SP]['id_auteur'] .
	'"' .
	(($t2 = strval(interdire_scripts(((entites_html(table_valeur(@$Pile[0], (string)'destinataire_selection', null),true)) ?' ' :''))))!=='' ?
			($t2 . ((in_array($Pile[$SP]['id_auteur'],interdire_scripts(sinon(table_valeur(@$Pile[0], (string)'destinataire_selection', null), array()))))  ?
				(' ' . ' ' . 'checked="checked"') :
				'')) :
			'') .
	'
									' .
	(($t2 = strval(interdire_scripts(((entites_html(table_valeur(@$Pile[0], (string)'destinataire_selection', null),true)) ?'' :' '))))!=='' ?
			($t2 . (	'
									' .
		(($t3 = strval(interdire_scripts((((include_spip('inc/config')?lire_config('contact/c',null,false):'')) ?'' :' '))))!=='' ?
				($t3 . (((((in_array($Pile[$SP]['id_auteur'],interdire_scripts(sinon(table_valeur(@$Pile[0], (string)'destinataire', null), array())))) OR (in_array($Pile[$SP]['id_auteur'],interdire_scripts(sinon(table_valeur(@$Pile[0], (string)'choix_destinataires', null), array()))))) ?' ' :''))  ?
					(' ' . ' ' . 'checked="checked"') :
					'')) :
				''))) :
			'') .
	'
								/>
								<label for="destinataire' .
	$Pile[$SP]['id_auteur'] .
	'">' .
	interdire_scripts(supprimer_numero(typo($Pile[$SP]['nom']), "TYPO", $connect, $Pile[0])) .
	'</label>
							</li>
						')) :
		'') .
'
						' .
(($t1 = strval(interdire_scripts(((match(entites_html(table_valeur(@$Pile[0], (string)'type_choix', null),true),'un|un_et|un_ou')) ?' ' :''))))!=='' ?
		($t1 . (	'
							<option value="' .
	$Pile[$SP]['id_auteur'] .
	'"' .
	((in_array($Pile[$SP]['id_auteur'],interdire_scripts(sinon(table_valeur(@$Pile[0], (string)'destinataire', null), array()))))  ?
			(' ' . ' ' . 'selected="selected"') :
			'') .
	'>' .
	interdire_scripts(supprimer_numero(typo($Pile[$SP]['nom']), "TYPO", $connect, $Pile[0])) .
	'</option>
						')) :
		'') .
'
					');
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_destinataires @ plugins/contact/formulaires/contact.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLE_toushtml_96b80ebb2075d03c33901132a92499ad(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	$command['source'] = array(interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'destinataire', null),true)));
	$command['sourcemode'] = 'table';
	if (!isset($command['table'])) {
		$command['table'] = '';
		$command['id'] = '_tous';
		$command['from'] = array();
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array(".valeur");
		$command['orderby'] = array();
		$command['where'] = 
			array();
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"DATA",
		$command,
		array('plugins/contact/formulaires/contact.html','html_96b80ebb2075d03c33901132a92499ad','_tous',54,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$t0 .= (
'
				<li style="display:none;"><input type="hidden" name="destinataire[]" value="' .
interdire_scripts($Pile[$SP]['valeur']) .
'" /></li>
				');
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_tous @ plugins/contact/formulaires/contact.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLE_choixhtml_96b80ebb2075d03c33901132a92499ad(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	if (!isset($si_init)) { $command['si'] = array(); $si_init = true; }
	$command['si'][] = interdire_scripts(((entites_html(table_valeur(@$Pile[0], (string)'choix_destinataires', null),true)) ?'' :' '));

	if (!isset($command['table'])) {
		$command['table'] = '';
		$command['id'] = '_choix';
		$command['from'] = array();
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("1");
		$command['orderby'] = array();
		$command['where'] = 
			array();
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"CONDITION",
		$command,
		array('plugins/contact/formulaires/contact.html','html_96b80ebb2075d03c33901132a92499ad','_choix',52,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$t0 .= (
'
				
				' .
BOUCLE_toushtml_96b80ebb2075d03c33901132a92499ad($Cache, $Pile, $doublons, $Numrows, $SP) .
'
			');
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_choix @ plugins/contact/formulaires/contact.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLE_infoshtml_96b80ebb2075d03c33901132a92499ad(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	$command['source'] = array(interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'_champs', null),true)));
	$command['sourcemode'] = 'table';
	if (!isset($command['table'])) {
		$command['table'] = '';
		$command['id'] = '_infos';
		$command['from'] = array();
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array(".cle",
		".valeur");
		$command['orderby'] = array();
		$command['where'] = 
			array();
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"DATA",
		$command,
		array('plugins/contact/formulaires/contact.html','html_96b80ebb2075d03c33901132a92499ad','_infos',100,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	
	$l1 = _T('public|spip|ecrire:info_obligatoire_02');$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$t0 .= (
'
			' .
vide($Pile['vars'][$_zzz=(string)'existe'] = find_in_path((	'formulaires/contact_champ_' .
		interdire_scripts($Pile[$SP]['cle']) .
		'.html'))) .
((table_valeur($Pile["vars"], (string)'existe', null))  ?
		(' ' . (	'
			' .
	recuperer_fond( (	'formulaires/contact_champ_' .
		interdire_scripts($Pile[$SP]['cle'])) , array_merge($Pile[0],array('name' => interdire_scripts($Pile[$SP]['cle']) ,
	'titre' => interdire_scripts($Pile[$SP]['valeur']) )), array('compil'=>array('plugins/contact/formulaires/contact.html','html_96b80ebb2075d03c33901132a92499ad','_infos',103,$GLOBALS['spip_lang'])), _request('connect')) .
	'
			')) :
		'') .
'
			' .
(!(table_valeur($Pile["vars"], (string)'existe', null))  ?
		(' ' . (	'
			<li class="editer editer_' .
	interdire_scripts($Pile[$SP]['cle']) .
	' saisie_' .
	interdire_scripts($Pile[$SP]['cle']) .
	(($t2 = strval(interdire_scripts(((in_array($Pile[$SP]['cle'],interdire_scripts(entites_html(sinon(table_valeur(@$Pile[0], (string)'_obligatoires', null), array()),true)))) ?' ' :''))))!=='' ?
			(' ' . $t2 . 'obligatoire') :
			'') .
	(($t2 = strval(interdire_scripts(((table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),interdire_scripts($Pile[$SP]['cle']))) ?' ' :''))))!=='' ?
			(' ' . $t2 . 'erreur') :
			'') .
	'">
				<label for="info_' .
	interdire_scripts($Pile[$SP]['cle']) .
	'">' .
	interdire_scripts($Pile[$SP]['valeur']) .
	(($t2 = strval(interdire_scripts(((in_array($Pile[$SP]['cle'],interdire_scripts(entites_html(sinon(table_valeur(@$Pile[0], (string)'_obligatoires', null), array()),true)))) ?' ' :''))))!=='' ?
			(' ' . $t2 . (	'<strong>' .
		$l1 .
		'</strong>')) :
			'') .
	'</label>
				' .
	(($t2 = strval(interdire_scripts(table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),interdire_scripts($Pile[$SP]['cle'])))))!=='' ?
			('<span class="erreur_message">' . $t2 . '</span>') :
			'') .
	'
				<input type="text" class="text" name="' .
	interdire_scripts($Pile[$SP]['cle']) .
	'" id="info_' .
	interdire_scripts($Pile[$SP]['cle']) .
	'" value="' .
	interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)interdire_scripts($Pile[$SP]['cle']), null),true)) .
	'" size="30" />
			</li>
			')) :
		'') .
'
			');
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_infos @ plugins/contact/formulaires/contact.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLE_pjhtml_96b80ebb2075d03c33901132a92499ad(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	$command['source'] = array(interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'pj_fichiers', null),true)));
	$command['sourcemode'] = 'table';
	if (!isset($command['table'])) {
		$command['table'] = '';
		$command['id'] = '_pj';
		$command['from'] = array();
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array(".cle");
		$command['orderby'] = array();
		$command['where'] = 
			array();
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"DATA",
		$command,
		array('plugins/contact/formulaires/contact.html','html_96b80ebb2075d03c33901132a92499ad','_pj',114,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	
	$l1 = _T('contact:form_pj_fichier_ajoute');
	$l2 = _T('contact:form_pj_supprimer');
	$l3 = _T('contact:form_pj_importer');$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$t0 .= (
'
						<li>
							' .
(($t1 = strval(interdire_scripts(((table_valeur(table_valeur(table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'infos_pj'),interdire_scripts($Pile[$SP]['cle'])),'message')) ?' ' :''))))!=='' ?
		($t1 . (	'
								' .
	$l1 .
	'
								' .
	(($t2 = strval(interdire_scripts(extraire_attribut(filtrer('image_graver', filtrer('image_reduire',table_valeur(table_valeur(table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'infos_pj'),interdire_scripts($Pile[$SP]['cle'])),'vignette'),'32')),'src'))))!=='' ?
			('<img src="' . $t2 . (	'" ' .
		(($t3 = strval(interdire_scripts(table_valeur(table_valeur(table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'infos_pj'),interdire_scripts($Pile[$SP]['cle'])),'mime'))))!=='' ?
				('title="' . $t3 . '"') :
				'') .
		' />')) :
			'') .
	'
								' .
	interdire_scripts(table_valeur(table_valeur(table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'infos_pj'),interdire_scripts($Pile[$SP]['cle'])),'nom')) .
	'
								<input type="hidden" name="pj_enregistrees_nomfichier&#91;' .
	interdire_scripts($Pile[$SP]['cle']) .
	'&#93;" value="' .
	interdire_scripts(table_valeur(table_valeur(table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'infos_pj'),interdire_scripts($Pile[$SP]['cle'])),'nom')) .
	'"/>
								<input type="hidden" name="pj_enregistrees_mime&#91;' .
	interdire_scripts($Pile[$SP]['cle']) .
	'&#93;" value="' .
	interdire_scripts(table_valeur(table_valeur(table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'infos_pj'),interdire_scripts($Pile[$SP]['cle'])),'mime')) .
	'"/>
								<input type="hidden" name="pj_enregistrees_extension&#91;' .
	interdire_scripts($Pile[$SP]['cle']) .
	'&#93;" value="' .
	interdire_scripts(table_valeur(table_valeur(table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'infos_pj'),interdire_scripts($Pile[$SP]['cle'])),'extension')) .
	'"/>
								<input type="hidden" name="pj_enregistrees_vignette&#91;' .
	interdire_scripts($Pile[$SP]['cle']) .
	'&#93;" value="' .
	interdire_scripts(table_valeur(table_valeur(table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'infos_pj'),interdire_scripts($Pile[$SP]['cle'])),'vignette')) .
	'"/>
								<input type="submit" name="pj_supprimer_' .
	interdire_scripts($Pile[$SP]['cle']) .
	'" value="' .
	$l2 .
	'"/>
							')) :
		'') .
'

							' .
(($t1 = strval(interdire_scripts(((table_valeur(table_valeur(table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'infos_pj'),interdire_scripts($Pile[$SP]['cle'])),'message')) ?'' :' '))))!=='' ?
		($t1 . (	'
								<input type="file" class="fichier" name="pj_fichiers&#91;' .
	interdire_scripts($Pile[$SP]['cle']) .
	'&#93;" title="' .
	$l3 .
	'" />
							')) :
		'') .
'
						</li>
					');
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_pj @ plugins/contact/formulaires/contact.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLE_editablehtml_96b80ebb2075d03c33901132a92499ad(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	if (!isset($si_init)) { $command['si'] = array(); $si_init = true; }
	$command['si'][] = interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'editable', null),true));

	if (!isset($command['table'])) {
		$command['table'] = '';
		$command['id'] = '_editable';
		$command['from'] = array();
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("1");
		$command['orderby'] = array();
		$command['where'] = 
			array();
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"CONDITION",
		$command,
		array('plugins/contact/formulaires/contact.html','html_96b80ebb2075d03c33901132a92499ad','_editable',12,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	
	$l1 = _T('public|spip|ecrire:envoyer_message');
	$l2 = _T('contact:form_destinataires');
	$l3 = _T('contact:form_destinataire');
	$l4 = _T('contact:form_pj_ajouter_pluriel');
	$l5 = _T('contact:form_pj_ajouter_singulier');
	$l6 = _T('public|spip|ecrire:antispam_champ_vide');
	$l7 = _T('public|spip|ecrire:form_prop_envoyer');$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$t0 .= (
'
<form method=\'post\' action=\'' .
interdire_scripts(ancre_url(entites_html(table_valeur(@$Pile[0], (string)'action', null),true),'formulaire_contact')) .
'\' enctype=\'multipart/form-data\'>
	
	' .
	'<div>' .
	form_hidden(interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'action', null),true))) .
	'<input name=\'formulaire_action\' type=\'hidden\'
		value=\'' . @$Pile[0]['form'] . '\' />' .
	'<input name=\'formulaire_action_args\' type=\'hidden\'
		value=\'' . @$Pile[0]['formulaire_args']. '\' />' .
	(!empty($Pile[0]['_hidden']) ? @$Pile[0]['_hidden'] : '') .
	'</div>
	' .
BOUCLE_previsuhtml_96b80ebb2075d03c33901132a92499ad($Cache, $Pile, $doublons, $Numrows, $SP) .
'

	
	<fieldset>
		<legend>' .
$l1 .
'</legend>
		<ul class="editer-groupe">
			' .
(($t1 = BOUCLE_choixhtml_96b80ebb2075d03c33901132a92499ad($Cache, $Pile, $doublons, $Numrows, $SP))!=='' ?
		$t1 :
		((	'
				
				' .
	(($t2 = BOUCLE_destinataireshtml_96b80ebb2075d03c33901132a92499ad($Cache, $Pile, $doublons, $Numrows, $SP))!=='' ?
			((	'
				<li class="editer obligatoire' .
			(($t4 = strval(interdire_scripts(((table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'destinataire')) ?' ' :''))))!=='' ?
					(' ' . $t4 . 'erreur') :
					'') .
			'">
					' .
			(($t4 = strval(interdire_scripts(((match(entites_html(table_valeur(@$Pile[0], (string)'type_choix', null),true),'plusieurs|plusieurs_et|plusieurs_ou')) ?' ' :''))))!=='' ?
					($t4 . (	'
						<label>' .
				$l2 .
				'</label>
						' .
				(($t5 = strval(interdire_scripts(table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'destinataire'))))!=='' ?
						('<span class="erreur_message">' . $t5 . '</span>') :
						'') .
				'
						<ul class="choix_mots">
					')) :
					'') .
			'
					' .
			(($t4 = strval(interdire_scripts(((match(entites_html(table_valeur(@$Pile[0], (string)'type_choix', null),true),'un|un_et|un_ou')) ?' ' :''))))!=='' ?
					($t4 . (	'
						<label for="destinataire">' .
				$l3 .
				'</label>
						' .
				(($t5 = strval(interdire_scripts(table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'destinataire'))))!=='' ?
						('<span class="erreur_message">' . $t5 . '</span>') :
						'') .
				'
						<select name="destinataire&#91;&#93;" id="destinataire">
					')) :
					'') .
			'
					') . $t2 . (	'
					' .
			(($t4 = strval(interdire_scripts(((match(entites_html(table_valeur(@$Pile[0], (string)'type_choix', null),true),'plusieurs|plusieurs_et|plusieurs_ou')) ?' ' :''))))!=='' ?
					($t4 . '
						</ul>
					') :
					'') .
			'
					' .
			(($t4 = strval(interdire_scripts(((match(entites_html(table_valeur(@$Pile[0], (string)'type_choix', null),true),'un|un_et|un_ou')) ?' ' :''))))!=='' ?
					($t4 . '
						</select>
					') :
					'') .
			'
				</li>
				')) :
			('
				BUG
				')) .
	'
			'))) .
'

			' .
BOUCLE_infoshtml_96b80ebb2075d03c33901132a92499ad($Cache, $Pile, $doublons, $Numrows, $SP) .
'

			' .
(($t1 = BOUCLE_pjhtml_96b80ebb2075d03c33901132a92499ad($Cache, $Pile, $doublons, $Numrows, $SP))!=='' ?
		((	'
			<li class =\'editer pieces_jointes\'>
				<label>' .
		interdire_scripts(((entites_html(table_valeur(@$Pile[0], (string)'nb_max_pj', null),true) > '1') ? $l4:$l5)) .
		'</label>
				<ul>
					') . $t1 . '
				</ul>
			</li>
			') :
		'') .
'
		</ul>
	</fieldset>

	
	<p style="display:none;">
		<label for="contact_nobot">' .
$l6 .
'</label>
		<input type="text" class="text" name="nobot" id="contact_nobot" value="' .
interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'nobot', null),true)) .
'" size="10" />
	</p>

	<p class="boutons"><input type="submit" class="submit" name="valide" value="' .
$l7 .
'" /></p>
</form>
');
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_editable @ plugins/contact/formulaires/contact.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}

//
// Fonction principale du squelette plugins/contact/formulaires/contact.html
// Temps de compilation total: 3.119 ms
//

function html_96b80ebb2075d03c33901132a92499ad($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'<'.'?php header("X-Spip-Cache: 0"); ?'.'>'.'<'.'?php header("Cache-Control: no-cache, must-revalidate"); ?'.'><'.'?php header("Pragma: no-cache"); ?'.'>' .
'<div class="formulaire_spip formulaire_contact formulaire_editer_message_contact" id="formulaire_contact">

<br class=\'bugajaxie\' />

' .
(($t1 = strval(interdire_scripts(propre((include_spip('inc/config')?lire_config('contact/texte',null,false):'')))))!=='' ?
		('<div class="texte">' . $t1 . '</div>') :
		'') .
'

' .
(($t1 = strval(interdire_scripts(table_valeur(@$Pile[0], (string)'message_ok', null))))!=='' ?
		('<p class="reponse_formulaire reponse_formulaire_ok">' . $t1 . '</p>') :
		'') .
'
' .
(($t1 = strval(interdire_scripts(table_valeur(@$Pile[0], (string)'message_erreur', null))))!=='' ?
		('<p class="reponse_formulaire reponse_formulaire_erreur">' . $t1 . '</p>') :
		'') .
'

' .
BOUCLE_editablehtml_96b80ebb2075d03c33901132a92499ad($Cache, $Pile, $doublons, $Numrows, $SP) .
'
</div>
');

	return analyse_resultat_skel('html_96b80ebb2075d03c33901132a92499ad', $Cache, $page, 'plugins/contact/formulaires/contact.html');
}
?>