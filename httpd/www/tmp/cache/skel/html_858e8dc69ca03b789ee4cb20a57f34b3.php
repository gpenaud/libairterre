<?php

/*
 * Squelette : plugins/html5up_editorial/inclure/head.html
 * Date :      Fri, 04 Jun 2021 14:01:59 GMT
 * Compile :   Fri, 04 Jun 2021 14:34:28 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette plugins/html5up_editorial/inclure/head.html
// Temps de compilation total: 0.977 ms
//

function html_858e8dc69ca03b789ee4cb20a57f34b3($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'
<meta name="generator" content="SPIP' .
(($t1 = strval(spip_version()))!=='' ?
		(' ' . $t1) :
		'') .
'" />


<meta name="viewport" content="width=device-width, initial-scale=1" />


' .
(($t1 = strval(interdire_scripts(generer_url_public('backend', ''))))!=='' ?
		((	'<link rel="alternate" type="application/rss+xml" title="' .
	_T('public|spip|ecrire:syndiquer_site') .
	'" href="') . $t1 . '" />') :
		'') .
'

' .
(($t1 = strval(timestamp(direction_css(scss_select_css('css/main.css')))))!=='' ?
		('<link rel="stylesheet" href="' . $t1 . '" type="text/css" />') :
		'') .
'
' .
(($t1 = strval(timestamp(direction_css(scss_select_css('css/ie8.css')))))!=='' ?
		('<!--[if IE 8]><link rel="stylesheet" href="' . $t1 . '" /><![endif]-->') :
		'') .
'
' .
(($t1 = strval(timestamp(direction_css(scss_select_css('css/ie9.css')))))!=='' ?
		('<!--[if IE 9]><link rel="stylesheet" href="' . $t1 . '" /><![endif]-->') :
		'') .
'

' .
(($t1 = strval(timestamp(direction_css(scss_select_css('css/spip.css')))))!=='' ?
		('<link rel="stylesheet" href="' . $t1 . '" type="text/css" />') :
		'') .
'
' .
(($t1 = strval(timestamp(direction_css(scss_select_css('css/spip.form.css')))))!=='' ?
		('<link rel="stylesheet" href="' . $t1 . '" type="text/css" />') :
		'') .
'
' .
(($t1 = strval(timestamp(direction_css(scss_select_css('css/spip.comment.css')))))!=='' ?
		('<link rel="stylesheet" href="' . $t1 . '" type="text/css" />') :
		'') .
'
' .
(($t1 = strval(timestamp(direction_css(scss_select_css('css/spip.list.css')))))!=='' ?
		('<link rel="stylesheet" href="' . $t1 . '" type="text/css" />') :
		'') .
'
' .
(($t1 = strval(timestamp(direction_css(scss_select_css('css/spip.petition.css')))))!=='' ?
		('<link rel="stylesheet" href="' . $t1 . '" type="text/css" />') :
		'') .
'
' .
(($t1 = strval(timestamp(direction_css(scss_select_css('css/spip.pagination.css')))))!=='' ?
		('<link rel="stylesheet" href="' . $t1 . '" type="text/css" />') :
		'') .
'
' .
(($t1 = strval(timestamp(direction_css(scss_select_css('css/spip.portfolio.css')))))!=='' ?
		('<link rel="stylesheet" href="' . $t1 . '" type="text/css" />') :
		'') .
'


' .
pipeline('insert_head_css','<!-- insert_head_css -->') .
'


' .
(($t1 = strval(timestamp(direction_css(scss_select_css('css/theme.css')))))!=='' ?
		('<link rel="stylesheet" href="' . $t1 . '" type="text/css" />') :
		'') .
'


' .
(($t1 = strval(timestamp(direction_css(scss_select_css('css/print.css')))))!=='' ?
		('<link rel="stylesheet" href="' . $t1 . '" type="text/css" media="print" />') :
		'') .
'

' .
((find_in_path('inc-theme-head.html'))  ?
		(' ' . (	'
	' .
	recuperer_fond( 'inc-theme-head' , array_merge($Pile[0],array()), array('compil'=>array('plugins/html5up_editorial/inclure/head.html','html_858e8dc69ca03b789ee4cb20a57f34b3','',31,$GLOBALS['spip_lang'])), _request('connect')))) :
		'') .
'


' .
(($t1 = strval(timestamp(direction_css(scss_select_css('css/perso.css')))))!=='' ?
		('<link rel="stylesheet" href="' . $t1 . '" type="text/css" />') :
		'') .
'


' .
'<'.'?php header("X-Spip-Filtre: insert_head_css_conditionnel"); ?'.'>'. pipeline('insert_head','<!-- insert_head -->') .
'


' .
(($t1 = strval(find_in_path('javascript/skel.min.js')))!=='' ?
		('<script src="' . $t1 . '" type="text/javascript"></script>') :
		'') .
'
' .
(($t1 = strval(find_in_path('javascript/util.js')))!=='' ?
		('<script src="' . $t1 . '" type="text/javascript"></script>') :
		'') .
'
' .
(($t1 = strval(find_in_path('javascript/main.js')))!=='' ?
		('<script src="' . $t1 . '" type="text/javascript"></script>') :
		'') .
'
<!--[if lt IE 9]>
' .
(($t1 = strval(find_in_path('javascript/ie/html5shiv.js')))!=='' ?
		('<script type=\'text/javascript\' src="' . $t1 . '"></script>') :
		'') .
'
<![endif]-->

' .
(($t1 = strval(find_in_path('javascript/perso.js')))!=='' ?
		('<script src="' . $t1 . '" type="text/javascript"></script>') :
		''));

	return analyse_resultat_skel('html_858e8dc69ca03b789ee4cb20a57f34b3', $Cache, $page, 'plugins/html5up_editorial/inclure/head.html');
}
?>