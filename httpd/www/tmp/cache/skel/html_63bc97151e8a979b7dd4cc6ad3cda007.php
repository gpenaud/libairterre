<?php

/*
 * Squelette : plugins/z-core/page.html
 * Date :      Fri, 04 Jun 2021 14:01:59 GMT
 * Compile :   Fri, 04 Jun 2021 14:34:28 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette plugins/z-core/page.html
// Temps de compilation total: 0.206 ms
//

function html_63bc97151e8a979b7dd4cc6ad3cda007($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = 
'<'.'?php echo recuperer_fond( ' . argumenter_squelette('structure') . ', array_merge('.var_export($Pile[0],1).',array(\'type-page\' => ' . argumenter_squelette(interdire_scripts(entites_html(sinon(table_valeur(@$Pile[0], (string)'page', null), interdire_scripts(entites_html(sinon(table_valeur(@$Pile[0], (string)'type-page', null), 'sommaire'),true))),true))) . ',
	\'composition\' => ' . argumenter_squelette(interdire_scripts(entites_html(sinon(table_valeur(@$Pile[0], (string)'composition', null), ''),true))) . ',
	\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . ')), array("compil"=>array(\'plugins/z-core/page.html\',\'html_63bc97151e8a979b7dd4cc6ad3cda007\',\'\',1,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>';

	return analyse_resultat_skel('html_63bc97151e8a979b7dd4cc6ad3cda007', $Cache, $page, 'plugins/z-core/page.html');
}
?>