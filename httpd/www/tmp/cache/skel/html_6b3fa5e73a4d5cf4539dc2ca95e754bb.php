<?php

/*
 * Squelette : plugins/auto/fullcalendar_facile/v2.5.2/modeles/agenda_fullcalendar.html
 * Date :      Thu, 24 Mar 2022 09:53:21 GMT
 * Compile :   Thu, 24 Mar 2022 14:52:46 GMT
 * Boucles :   _agenda
 */ 

function BOUCLE_agendahtml_6b3fa5e73a4d5cf4539dc2ca95e754bb(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	$command['sourcemode'] = 'json';

	$command['source'] = array(url_absolue(produire_fond_statique( 'agenda.json' , array('start' => '0' ,
	'end' => '2147483647' ,
	'_' => interdire_scripts(eval('return '.'time()'.';')) ), array('compil'=>array('','','',0,$GLOBALS['spip_lang'])), _request('connect'))));

	$command['pagination'] = array((isset($Pile[0]['debut_agenda']) ? $Pile[0]['debut_agenda'] : null), 15);
	if (!isset($command['table'])) {
		$command['table'] = '';
		$command['id'] = '_agenda';
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
		array('plugins/auto/fullcalendar_facile/v2.5.2/modeles/agenda_fullcalendar.html','html_6b3fa5e73a4d5cf4539dc2ca95e754bb','_agenda',40,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	
	// COMPTEUR
	$Numrows['_agenda']['compteur_boucle'] = 0;
	$Numrows['_agenda']['total'] = @intval($iter->count());
	$debut_boucle = isset($Pile[0]['debut_agenda']) ? $Pile[0]['debut_agenda'] : _request('debut_agenda');
	if(substr($debut_boucle,0,1)=='@'){
		$debut_boucle = $Pile[0]['debut_agenda'] = quete_debut_pagination('',$Pile[0]['@'] = substr($debut_boucle,1),15,$iter);
		$iter->seek(0);
	}
	$debut_boucle = intval($debut_boucle);
	$debut_boucle = (($tout=($debut_boucle == -1))?0:($debut_boucle));
	$debut_boucle = max(0,min($debut_boucle,floor(($Numrows['_agenda']['total']-1)/(15))*(15)));
	$debut_boucle = intval($debut_boucle);
	$fin_boucle = min(($tout ? $Numrows['_agenda']['total'] : $debut_boucle + 14), $Numrows['_agenda']['total'] - 1);
	$Numrows['_agenda']['grand_total'] = $Numrows['_agenda']['total'];
	$Numrows['_agenda']["total"] = max(0,$fin_boucle - $debut_boucle + 1);
	if ($debut_boucle>0 AND $debut_boucle < $Numrows['_agenda']['grand_total'] AND $iter->seek($debut_boucle,'continue'))
		$Numrows['_agenda']['compteur_boucle'] = $debut_boucle;
	
	
	$l1 = _T('agenda:evenement_titre');
	$l2 = _T('agenda:evenement_date');
	$l3 = _T('agenda:evenement_descriptif');$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$Numrows['_agenda']['compteur_boucle']++;
		if ($Numrows['_agenda']['compteur_boucle'] <= $debut_boucle) continue;
		if ($Numrows['_agenda']['compteur_boucle']-1 > $fin_boucle) break;
		$t0 .= (
'
    <dl>
			' .
interdire_scripts(((safehtml(table_valeur($Pile[$SP]['valeur'], 'allDay')) == 'true') ? vide($Pile['vars'][$_zzz=(string)'end'] = interdire_scripts(agenda_dateplus(safehtml(table_valeur($Pile[$SP]['valeur'], 'end')),'-1'))):vide($Pile['vars'][$_zzz=(string)'end'] = interdire_scripts(safehtml(table_valeur($Pile[$SP]['valeur'], 'end')))))) .
'
        ' .
(($t1 = strval(interdire_scripts(safehtml(table_valeur($Pile[$SP]['valeur'], 'title')))))!=='' ?
		((	'<dt>' .
	$l1 .
	'</dt>
        <dd><a href="' .
	interdire_scripts(safehtml(table_valeur($Pile[$SP]['valeur'], 'url'))) .
	'">') . $t1 . '</a></dd>') :
		'') .
'

        ' .
(($t1 = strval(interdire_scripts(Agenda_affdate_debut_fin(safehtml(table_valeur($Pile[$SP]['valeur'], 'start')),table_valeur($Pile["vars"], (string)'end', null),interdire_scripts(((safehtml(table_valeur($Pile[$SP]['valeur'], 'allDay')) == 'true') ? 'non':'oui'))))))!=='' ?
		((	'<dt>' .
	$l2 .
	'</dt>
        <dd>') . $t1 . '</dd>') :
		'') .
'

        ' .
(($t1 = strval(interdire_scripts(safehtml(table_valeur($Pile[$SP]['valeur'], 'description')))))!=='' ?
		((	'<dt>' .
	$l3 .
	'</dt>
        <dd>') . $t1 . '</dd>') :
		'') .
'
    </dl>
');
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_agenda @ plugins/auto/fullcalendar_facile/v2.5.2/modeles/agenda_fullcalendar.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}

//
// Fonction principale du squelette plugins/auto/fullcalendar_facile/v2.5.2/modeles/agenda_fullcalendar.html
// Temps de compilation total: 1.928 ms
//

function html_6b3fa5e73a4d5cf4539dc2ca95e754bb($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'<link rel=\'stylesheet\' type=\'text/css\' href=\'' .
find_in_path('lib/fullcalendar/fullcalendar.min.css') .
'\' />
<script type=\'text/javascript\' src=\'' .
find_in_path('lib/moment/moment-with-locales.min.js') .
'\'></script>
<script type=\'text/javascript\' src=\'' .
find_in_path('lib/fullcalendar/fullcalendar.min.js') .
'\'></script>
<script type=\'text/javascript\' src=\'' .
find_in_path('lib/fullcalendar/locale-all.js') .
'\'></script>
<script type="text/javascript">/*<![CDATA[*/
jQuery(function($) {
		' .
(test_espace_prive('') ? (	'$(\'#agenda\').append(\'<div id="agendafull"></div>\');
			' .
	vide($Pile['vars'][$_zzz=(string)'selecteur'] = '#agendafull')):vide($Pile['vars'][$_zzz=(string)'selecteur'] = '#agenda')) .
'
		$(\'' .
table_valeur($Pile["vars"], (string)'selecteur', null) .
'\').fullCalendar({
			locale: \'' .
strtolower(spip_htmlentities(@$Pile[0]['lang'] ? @$Pile[0]['lang'] : $GLOBALS['spip_lang'])) .
'\',
			editable: false,
			navLinks: true,
			eventLimit: true,
			firstDay: ' .
interdire_scripts((include_spip('inc/config')?lire_config('calendriermini/jour1','1',false):'')) .
',
			events: "' .
interdire_scripts(parametre_url(generer_url_public('agenda.json', ''),'couleur',interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'couleur', null),true)),'&')) .
'",
			header: {
				left: ' .
((lang_dir(@$Pile[0]['lang'], 'ltr','rtl') == 'ltr') ? '\'prevYear,prev,next,nextYear today\'':'\'listMonth,month,agendaWeek,agendaDay\'') .
',
				center: \'title\',
				right: ' .
((lang_dir(@$Pile[0]['lang'], 'ltr','rtl') == 'ltr') ? '\'agendaDay,agendaWeek,month,listMonth\'':'\'today nextYear,next,prev,prevYear\'') .
'
				},
			fixedWeekCount: false,
			eventRender: function( event, element, view ) {
				var title = element.find(\'.fc-title, .fc-list-item-title\');
				title.html(title.text());
			},
			allDayHtml:\'' .
textebrut(_T('organiseur:cal_jour_entier')) .
'\',
			loading: function(bool) {
				if (bool) $(\'#calendrier-loading\').show();
				else $(\'#calendrier-loading\').hide();
			},
	})

});
/*]]>*/</script>
<div id="agenda">
</div>
' .
(($t1 = BOUCLE_agendahtml_6b3fa5e73a4d5cf4539dc2ca95e754bb($Cache, $Pile, $doublons, $Numrows, $SP))!=='' ?
		((	'
<div id="calendrier-loading">
<p class="pagination">' .
		filtre_pagination_dist($Numrows["_agenda"]["grand_total"],
 		'_agenda',
		isset($Pile[0]['debut_agenda'])?$Pile[0]['debut_agenda']:intval(_request('debut_agenda')),
		15, true, '', '', array()) .
		'</p>
') . $t1 . (	'
<p class="pagination">' .
		filtre_pagination_dist($Numrows["_agenda"]["grand_total"],
 		'_agenda',
		isset($Pile[0]['debut_agenda'])?$Pile[0]['debut_agenda']:intval(_request('debut_agenda')),
		15, true, '', '', array()) .
		'</p>
</div>
')) :
		'') .
'
');

	return analyse_resultat_skel('html_6b3fa5e73a4d5cf4539dc2ca95e754bb', $Cache, $page, 'plugins/auto/fullcalendar_facile/v2.5.2/modeles/agenda_fullcalendar.html');
}
?>