<?php
/**
 * Plugin Acces Restreint 3.0 pour Spip 2.0
 * Licence GPL (c) 2006-2008 Cedric Morin
 *
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

/**
 * on essaye de poser un htaccess rewrite global sur IMG/
 * si fonctionne on gardera des ulrs de document permanente
 * si ne fonctionne pas on se rabat sur creer_htaccess du core
 * qui pose un deny sur chaque sous repertoire de IMG/
 *
 * https://code.spip.net/@gerer_htaccess
 *
 * @param bool $active
 * @return bool
 */
function accesrestreint_gerer_htaccess($active = true) {
	include_spip('inc/acces');
	if (!$active) {
		spip_unlink(_DIR_IMG . _ACCESS_FILE_NAME);
		effacer_meta('creer_htaccess');
		// effacer les xx/.htaccess crees eventuellement par le core
		gerer_htaccess();
		return false;
	} else {
		$rewrite = <<<rewrite
RewriteEngine On
RewriteCond %{QUERY_STRING} ^(\d+/[\da-f]+)$
RewriteRule ^\w+/.*$     ../spip.php?action=api_docrestreint&arg=%1/$0 [skip=100]
RewriteRule ^\w+/.*$     ../spip.php?action=api_docrestreint&arg=0/0/$0 [skip=100]
rewrite;

		// On cherche si le dossier racine a un RewriteBase plus long que "/"
		if (file_exists(_DIR_RACINE._ACCESS_FILE_NAME)) {
			$ht = '';
			lire_fichier(_DIR_RACINE._ACCESS_FILE_NAME, $ht);
			if ($ht and preg_match('|^RewriteBase\s+/.+$|m', $ht, $rewritebase)) {
				$rewritebase = rtrim(trim($rewritebase[0]), '/').'/'._NOM_PERMANENTS_ACCESSIBLES;
				$rewrite = $rewritebase."\n".$rewrite;
			}
		}

		ecrire_fichier(_DIR_IMG . _ACCESS_FILE_NAME, $rewrite);

		// pour tester il faut enlever les fichiers deny des sous-repertoires
		effacer_meta('creer_htaccess');
		gerer_htaccess();

		// puis verifier sur l'url de test
		include_spip('inc/distant');
		$url_test = url_absolue(_DIR_IMG . 'test_acces/.restreint?0/1');
		$test = recuperer_page($url_test);

		spip_log("Resultat test IMG/.htaccess : $url_test renvoie :$test:",'accesrestreint'._LOG_DEBUG);
		// si l'url de test renvoie bien "OK" alors rewrite rule fonctionne et on peut baser la protection de document sur ce shema
		if ($test == 'OK') {
			// on est bon, rien a faire
		} else {
			// sinon on se rabat sur un deny et on generera des urls moches
			spip_unlink(_DIR_IMG . _ACCESS_FILE_NAME);
			ecrire_meta('creer_htaccess', 'oui');
		}
		// dans tous les cas on passe par gerer_htaccess pour enlever ou mettre les .htaccess dans les sous rep
		gerer_htaccess();

		return true;
	}
}
