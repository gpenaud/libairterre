<?php

/*
 * Squelette : plugins/contact/formulaires/contact_champ_mail.html
 * Date :      Fri, 04 Jun 2021 14:01:59 GMT
 * Compile :   Fri, 04 Jun 2021 14:34:30 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette plugins/contact/formulaires/contact_champ_mail.html
// Temps de compilation total: 0.125 ms
//

function html_46074f5888ec3c272e8739b012d095e7($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'<li class=\'editer editer_mail saisie_mail obligatoire' .
(($t1 = strval(interdire_scripts(((table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'mail')) ?' ' :''))))!=='' ?
		(' ' . $t1 . 'erreur') :
		'') .
'\'>
<label for="mail">' .
_T('public|spip|ecrire:entree_adresse_email') .
' <strong>' .
_T('public|spip|ecrire:info_obligatoire_02') .
'</strong></label>
' .
(($t1 = strval(interdire_scripts(table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'mail'))))!=='' ?
		('<span class="erreur_message">' . $t1 . '</span>') :
		'') .
'
<input type="text" class="text" name="mail" id="mail" value="' .
interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'mail', null),true)) .
'" size="30" />
</li>');

	return analyse_resultat_skel('html_46074f5888ec3c272e8739b012d095e7', $Cache, $page, 'plugins/contact/formulaires/contact_champ_mail.html');
}
?>