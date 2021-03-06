<?php
/**
 * Plugin Spip-Bonux
 * Le plugin qui lave plus SPIP que SPIP
 * (c) 2008 Mathieu Marcillaud, Cedric Morin, Tetue
 * Licence GPL
 *
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

// Proposer array_column
if (!function_exists('array_column')) {
	function array_column($input = null, $columnKey = null, $indexKey = null) {
		if (!function_exists('_array_column')) {
			include_spip('lib/array_column/_array_column');
		}
		return _array_column($input, $columnKey, $indexKey);
	}
}


if (!defined('_PREVISU_TEMPORAIRE_ACTIVE')) {
	define('_PREVISU_TEMPORAIRE_ACTIVE', true);
}

if (_request('var_mode')=='preview'
	and _PREVISU_TEMPORAIRE_ACTIVE
	and $cle = _request('var_relecture')
) {
	include_spip('spip_bonux_fonctions');
	if (previsu_verifier_cle_temporaire($cle)) {
		include_spip('inc/autoriser');
		autoriser_exception('previsualiser', '', 0);
		define('_VAR_PREVIEW_EXCEPTION', true);
	}
}

function spip_bonux_affichage_final($flux) {
	if (_PREVISU_TEMPORAIRE_ACTIVE and defined('_VAR_PREVIEW') and _VAR_PREVIEW and !empty($GLOBALS['html'])) {
		$p = stripos($flux, '</body>');
		$url_relecture = parametre_url(self(), 'var_mode', 'preview', '&');
		$js = '';
		if (!defined('_VAR_PREVIEW_EXCEPTION')) {
			include_spip('plugins/installer');
			if (spip_version_compare($GLOBALS['spip_version_branche'], '3.2.0-beta3', '>=')) {
				include_spip('inc/securiser_action');
				$url_relecture = parametre_url($url_relecture, 'var_previewtoken', calculer_token_previsu(url_absolue($url_relecture)), '&');
			} else {
				$url_relecture = parametre_url($url_relecture, 'var_relecture', previsu_cle_temporaire(), '&');
			}
			$label = 'Relecture temporaire';
		} else {
			$label = _T('previsualisation');
			$js = "jQuery('.spip-previsu').html('Relecture temporaire');";
		}
		$js .= "jQuery('#spip-admin').append('<a class=\"spip-admin-boutons review_link\" href=\"$url_relecture\">$label</a>');";
		$js = "jQuery(function(){ $js });";
		$js = "<script>$js</script>";
		$flux = substr_replace($flux, $js, $p, 0);
	}
	return $flux;
}

if (!function_exists('_T_ou_typo')) {
	/**
	 * une fonction qui regarde si $texte est une chaine de langue
	 * de la forme <:qqch:>
	 * si oui applique _T()
	 * si non applique typo() suivant le mode choisi
	 *
	 * @param mixed $valeur
	 *     Une valeur ?? tester. Si c'est un tableau, la fonction s'appliquera r??cursivement dessus.
	 * @param string $mode_typo
	 *     Le mode d'application de la fonction typo(), avec trois valeurs possibles "toujours", "jamais" ou "multi".
	 * @return mixed
	 *     Retourne la valeur ??ventuellement modifi??e.
	 */
	function _T_ou_typo($valeur, $mode_typo = 'toujours') {
		if (!in_array($mode_typo, array('toujours', 'multi', 'jamais'))) {
			$mode_typo = 'toujours';
		}

		// Si la valeur est bien une chaine (et pas non plus un entier d??guis??)
		if (is_string($valeur) and !is_numeric($valeur)) {
			// Si on est en >=3.2, on peut extraire les <:chaine:>
			$version = explode('.',$GLOBALS['spip_version_branche']);
			$extraction_chaines = (($version[0] > 3 or $version[1] >= 2) ? true : false);
			// Si la chaine est du type <:truc:> on passe ?? _T()
			if (strpos($valeur, '<:') !== false
			  and preg_match('/^\<:([^>]*?):\>$/', $valeur, $match)) {
				$valeur = _T($match[1]);
			} else {
				// Sinon on la passe a typo() si c'est pertinent
				if (
					$mode_typo === 'toujours'
					or ($mode_typo === 'multi' and strpos($valeur, '<multi>') !== false)
					or ($extraction_chaines
					  and $mode_typo === 'multi'
					  and strpos($valeur, '<:') !== false
					  and include_spip('inc/filtres')
					  and preg_match(_EXTRAIRE_IDIOME, $valeur))
				) {
					include_spip('inc/texte');
					$valeur = typo($valeur);
				}
			}
		}
		// Si c'est un tableau, on r??applique la fonction r??cursivement
		elseif (is_array($valeur)) {
			foreach ($valeur as $cle => $valeur2) {
				$valeur[$cle] = _T_ou_typo($valeur2, $mode_typo);
			}
		}

		return $valeur;
	}
}
/**
 * Ins??re toutes les valeurs du tableau $arr2 apr??s (ou avant) $cle dans le tableau $arr1.
 * Si $cle n'est pas trouv??, les valeurs de $arr2 seront ajout??s ?? la fin de $arr1.
 *
 * La fonction garde autant que possible les associations entre les cl??s. Elle fonctionnera donc aussi bien
 * avec des tableaux ?? index num??rique que des tableaux associatifs.
 * Attention tout de m??me, elle utilise array_merge() donc les valeurs de cl??s ??tant en conflits seront ??cras??es.
 *
 * @param array $arr1 Tableau dans lequel se fera l'insertion
 * @param unknown_type $cle Cl?? de $arr1 apr??s (ou avant) laquelle se fera l'insertion
 * @param array $arr2 Tableau contenant les valeurs ?? ins??rer
 * @param bool $avant Indique si l'insertion se fait avant la cl?? (par d??faut c'est apr??s)
 * @return array Retourne le tableau avec l'insertion
 */
if (!function_exists('spip_array_insert')) {
function spip_array_insert($arr1, $cle, $arr2, $avant = false) {
	$index = array_search($cle, array_keys($arr1));
	if ($index === false) {
		$index = count($arr1); // insert @ end of array if $key not found
	} else {
		if (!$avant) {
			$index++;
		}
	}
	$fin = array_splice($arr1, $index);
	return array_merge($arr1, $arr2, $fin);
}
}

/*
 * Une fonction extr??mement pratique, mais qui n'est disponible qu'?? partir de PHP 5.3 !
 * cf. http://www.php.net/manual/fr/function.array-replace-recursive.php
 */
if (!function_exists('array_replace_recursive')) {
	function array_replace_recursive($array, $array1) {
		function recurse($array, $array1) {
			foreach ($array1 as $key => $value) {
				// create new key in $array, if it is empty or not an array
				if (!isset($array[$key]) || (isset($array[$key]) && !is_array($array[$key]))) {
					$array[$key] = array();
				}
				// overwrite the value in the base array
				if (is_array($value)) {
					$value = recurse($array[$key], $value);
				}
				$array[$key] = $value;
			}
			return $array;
		}

		// handle the arguments, merge one by one
		$args = func_get_args();
		$array = $args[0];
		if (!is_array($array)) {
			return $array;
		}

		for ($i = 1; $i < count($args); $i++) {
			if (is_array($args[$i])) {
				$array = recurse($array, $args[$i]);
			}
		}
		return $array;
	}
}

if (!function_exists('text_truncate')) {
/**
* Truncates text.
*
* Cuts a string to the length of $length and replaces the last characters
* with the ending if the text is longer than length.
*
* ### Options:
*
* - `ending` Will be used as Ending and appended to the trimmed string
* - `exact` If false, $text will not be cut mid-word
* - `html` If true, HTML tags would be handled correctly
*
* @param string  $text String to truncate.
* @param integer $length Length of returned string, including ellipsis.
* @param array $options An array of html attributes and options.
* @return string Trimmed string.
* @access public
* @link https://api.cakephp.org/4.0/class-Cake.Utility.Text.html#truncate
*/
function text_truncate($text, $length = 100, $options = array()) {
	$default = array(
		'ending' => '...', 'exact' => true, 'html' => false
	);
	$options = array_merge($default, $options);
	extract($options);

	if ($html) {
		if (mb_strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
			return $text;
		}
		$totalLength = mb_strlen(strip_tags($ending));
		$openTags = array();
		$truncate = '';

		preg_match_all('/(<\/?([\w+]+)[^>]*>)?([^<>]*)/', $text, $tags, PREG_SET_ORDER);
		foreach ($tags as $tag) {
			if (!preg_match('/img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param/s', $tag[2])) {
				if (preg_match('/<[\w]+[^>]*>/s', $tag[0])) {
					array_unshift($openTags, $tag[2]);
				} else if (preg_match('/<\/([\w]+)[^>]*>/s', $tag[0], $closeTag)) {
					$pos = array_search($closeTag[1], $openTags);
					if ($pos !== false) {
						array_splice($openTags, $pos, 1);
					}
				}
			}
			$truncate .= $tag[1];

			$contentLength = mb_strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', ' ', $tag[3]));
			if ($contentLength + $totalLength > $length) {
				$left = $length - $totalLength;
				$entitiesLength = 0;
				if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', $tag[3], $entities, PREG_OFFSET_CAPTURE)) {
					foreach ($entities[0] as $entity) {
						if ($entity[1] + 1 - $entitiesLength <= $left) {
							$left--;
							$entitiesLength += mb_strlen($entity[0]);
						} else {
							break;
						}
					}
				}
				$truncate .= mb_substr($tag[3], 0, $left + $entitiesLength);
				break;
			} else {
				$truncate .= $tag[3];
				$totalLength += $contentLength;
			}
			if ($totalLength >= $length) {
				break;
			}
		}
	} else {
		if (mb_strlen($text) <= $length) {
			return $text;
		} else {
			$truncate = mb_substr($text, 0, $length - mb_strlen($ending));
		}
	}
	if (!$exact) {
		$spacepos = mb_strrpos($truncate, ' ');
		if (isset($spacepos)) {
			if ($html) {
				$bits = mb_substr($truncate, $spacepos);
				preg_match_all('/<\/([a-z]+)>/', $bits, $droppedTags, PREG_SET_ORDER);
				if (!empty($droppedTags)) {
					foreach ($droppedTags as $closingTag) {
						if (!in_array($closingTag[1], $openTags)) {
							array_unshift($openTags, $closingTag[1]);
						}
					}
				}
			}
			$truncate = mb_substr($truncate, 0, $spacepos);
		}
	}
	$truncate .= $ending;

	if ($html) {
		foreach ($openTags as $tag) {
			$truncate .= '</'.$tag.'>';
		}
	}

	return $truncate;
}
}
