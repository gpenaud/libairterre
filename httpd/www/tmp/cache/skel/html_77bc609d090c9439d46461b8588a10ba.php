<?php

/*
 * Squelette : plugins/html5up_editorial/formulaires/recherche.html
 * Date :      Fri, 04 Jun 2021 14:01:59 GMT
 * Compile :   Fri, 04 Jun 2021 14:34:30 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette plugins/html5up_editorial/formulaires/recherche.html
// Temps de compilation total: 0.140 ms
//

function html_77bc609d090c9439d46461b8588a10ba($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'<section id="search" class="alt">
	<form action="' .
interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'action', null),true)) .
'" method="get">
	' .
interdire_scripts(form_hidden(entites_html(table_valeur(@$Pile[0], (string)'action', null),true))) .
'
	' .
(($t1 = strval(interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'lang', null),true))))!=='' ?
		('<input type="hidden" name="lang" value="' . $t1 . '" />') :
		'') .
'
		<input class="search text" name="recherche" id="' .
interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'_id_champ', null),true)) .
'"' .
(($t1 = strval(interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'recherche', null),true))))!=='' ?
		(' value="' . $t1 . '"') :
		'') .
' accesskey="4" placeholder="' .
_T('html5up:rechercher') .
'" type="' .
('' ? 'search':'text') .
'" />
	</form>
</section>
');

	return analyse_resultat_skel('html_77bc609d090c9439d46461b8588a10ba', $Cache, $page, 'plugins/html5up_editorial/formulaires/recherche.html');
}
?>