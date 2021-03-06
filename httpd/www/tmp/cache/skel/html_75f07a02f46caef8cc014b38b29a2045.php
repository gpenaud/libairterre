<?php

/*
 * Squelette : prive/formulaires/login.html
 * Date :      Fri, 04 Jun 2021 14:01:59 GMT
 * Compile :   Fri, 04 Jun 2021 14:34:47 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette prive/formulaires/login.html
// Temps de compilation total: 0.549 ms
//

function html_75f07a02f46caef8cc014b38b29a2045($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'<'.'?php header(' . _q('Cache-Control: no-store, no-cache, must-revalidate') . '); ?'.'>' .
'<'.'?php header(' . _q('Pragma: no-cache') . '); ?'.'>' .
'<div class=\'formulaire_spip formulaire_login\'>
	' .
(($t1 = strval(interdire_scripts(table_valeur(@$Pile[0], (string)'_deja_loge', null))))!=='' ?
		('<p class="reponse_formulaire reponse_formulaire_ok">' . $t1 . '</p>') :
		'') .
'
	' .
(($t1 = strval(interdire_scripts(table_valeur(@$Pile[0], (string)'message_ok', null))))!=='' ?
		('<p class="reponse_formulaire reponse_formulaire_ok">' . $t1 . '</p>') :
		'') .
'
	' .
(($t1 = strval(interdire_scripts(table_valeur(@$Pile[0], (string)'message_erreur', null))))!=='' ?
		('<p class=\'reponse_formulaire reponse_formulaire_erreur\'>' . $t1 . '</p>') :
		'') .
'

	' .
(($t1 = strval(interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'echec_cookie', null),true))))!=='' ?
		($t1 . (	'
	<fieldset class=\'reponse_formulaire reponse_formulaire_erreur\'>
		<h2>' .
	_T('public|spip|ecrire:avis_erreur_cookie') .
	'</h2>
		<p class="erreur_message">' .
	_T('public|spip|ecrire:login_cookie_oblige') .
	'<br />' .
	_T('public|spip|ecrire:login_cookie_accepte') .
	'</p>
	</fieldset>')) :
		'') .
'

	' .
(($t1 = strval(interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'editable', null),true))))!=='' ?
		($t1 . (	'
	<form id=\'formulaire_login\' method=\'post\' action=\'' .
	interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'action', null),true)) .
	'\'>
	
	' .
		'<div>' .
	form_hidden(@$Pile[0]['action']) .
	'<input name=\'formulaire_action\' type=\'hidden\'
		value=\'' . @$Pile[0]['form'] . '\' />' .
	'<input name=\'formulaire_action_args\' type=\'hidden\'
		value=\'' . @$Pile[0]['formulaire_args']. '\' />' .
	(!empty($Pile[0]['_hidden']) ? @$Pile[0]['_hidden'] : '') .
	'</div>
	<fieldset>
		<legend>' .
	_T('public|spip|ecrire:form_forum_identifiants') .
	'</legend>
		<div class="editer-groupe">
			<div class="editer editer_login obligatoire' .
	((table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'var_login'))  ?
			(' ' . 'erreur') :
			'') .
	'">
				<label for="var_login">' .
	_T('public|spip|ecrire:login_login2') .
	'</label>' .
	(($t2 = strval(table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'var_login')))!=='' ?
			('
				<span class="erreur_message">' . $t2 . '</span>
				') :
			'') .
	'<input type=\'text\' class=\'text ' .
	(($t2 = strval(interdire_scripts(((table_valeur(@$Pile[0], (string)'_logo', null)) ?' ' :''))))!=='' ?
			($t2 . 'avec_spip_logo_auteur') :
			'') .
	'\' name=\'var_login\' id=\'var_login\' value="' .
	table_valeur(@$Pile[0], (string)'var_login', null) .
	'" size=\'40\' autocapitalize="off" autocorrect="off" />' .
	(($t2 = strval(interdire_scripts(sinon(table_valeur(@$Pile[0], (string)'_logo', null), ''))))!=='' ?
			('
				<span id="spip_logo_auteur">' . $t2 . '</span>') :
			'') .
	'
			</div>
			<div class="editer editer_password obligatoire' .
	((table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'password'))  ?
			(' ' . 'erreur') :
			'') .
	'">
				<label for="password">' .
	_T('public|spip|ecrire:login_pass2') .
	'</label>' .
	(($t2 = strval(table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'password')))!=='' ?
			('
				<span class="erreur_message">' . $t2 . '</span>
				') :
			'') .
	'<input type=\'password\' class=\'text password\' name=\'password\' id=\'password\' value="" size=\'40\' autocapitalize="off" autocorrect="off" />
				<p class=\'details\'><a href="' .
	interdire_scripts(parametre_url(generer_url_public('spip_pass', ''),'lang',spip_htmlentities(@$Pile[0]['lang'] ? @$Pile[0]['lang'] : $GLOBALS['spip_lang']))) .
	'" id=\'spip_pass\'>' .
	_T('public|spip|ecrire:login_motpasseoublie') .
	'</a></p>
			</div>
			' .
	(($t2 = strval(interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'rester_connecte', null),true))))!=='' ?
			($t2 . (	'
			<div class="editer editer_session"><div class=\'choix\'>
				<input type="checkbox" class="checkbox" name="session_remember" id="session_remember" value="oui" ' .
		(table_valeur(@$Pile[0], (string)'cnx', null)  ?
				(' ' . 'checked="checked"') :
				'') .
		' onchange="jQuery(this).addClass(\'modifie\');" />
				<label class=\'nofx\' for="session_remember">' .
		_T('public|spip|ecrire:login_rester_identifie') .
		'</label>
			</div></div>')) :
			'') .
	'
		</div>
	</fieldset>
	<p class="boutons"><input type="submit" class="submit" value="' .
	attribut_html(_T('public|spip|ecrire:bouton_valider')) .
	'" /></p>
	</form>
	')) :
		'') .
'
	
	' .
(($t1 = strval(interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'auth_http', null),true))))!=='' ?
		('<form action="' . $t1 . (	'" method="get">' .
	(($t2 = strval(interdire_scripts(form_hidden(entites_html(table_valeur(@$Pile[0], (string)'auth_http', null),true)))))!=='' ?
			('
	' . $t2 . '
	') :
			'') .
	'
	<fieldset>
		<legend>' .
	_T('public|spip|ecrire:login_sans_cookie') .
	'</legend>
		' .
	_T('public|spip|ecrire:login_preferez_refuser') .
	'
		<input type="hidden" name="essai_auth_http" value="oui"/>
		' .
	(($t2 = strval(interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'url', null),true))))!=='' ?
			('<input type="hidden" name="url" value="' . $t2 . '"/>') :
			'') .
	'
		<p class="boutons"><input type="submit" class="submit" value="' .
	attribut_html(_T('public|spip|ecrire:login_sans_cookie')) .
	'"/></p>
	</fieldset>
	</form>
	')) :
		'') .
'
</div>
');

	return analyse_resultat_skel('html_75f07a02f46caef8cc014b38b29a2045', $Cache, $page, 'prive/formulaires/login.html');
}
?>