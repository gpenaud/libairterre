<?php
/**
 * Plugin oEmbed
 * Licence GPL3
 *
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

function oembed_input_posttraite_twitter_dist($data) {

	$data['html'] = trim(preg_replace(',<script[^>]*></script>,i', '', $data['html']));
	if (!function_exists('recuperer_url')) {
		include_spip('inc/distant');
	}

	// verifier l'URL du tweet version mobile,
	// si on peut trouver une image
	// pour afficher en tete de card
	$url_mobile = str_replace(parse_url($data['url'], PHP_URL_HOST), 'mobile.twitter.com', $data['url']);
	if ($res = recuperer_url($url_mobile, array('taille_max'=>16384))
	  and $res['page']) {

		if (!function_exists('extraire_balises')) {
			include_spip('inc/filtres');
		}

		$links = extraire_balises($res['page'], 'a');

		$author_thumbnail = '';
		foreach ($links as $link) {
			if (strpos($link, "<img")
			  and strpos($link, $data['author_name'])
			  and strpos($link, 'profile_images')
			  and !$author_thumbnail) {
				$img = extraire_balise($link, 'img');
				$author_thumbnail = extraire_attribut($img, 'src');
			}
		}

		$content = explode('tweet-content', $res['page'], 2);
		$content = end($content);
		$imgs = extraire_balises($content, 'img');

		$enclosure = '';
		$enclosure_type = '';
		$has_image = false;
		foreach ($imgs as $img) {
			$src = extraire_attribut($img, 'src');
			$p = strpos($src, '://');
			if (strpos($src, ':', $p) !== false) {
				$src = explode(':', $src);
				if (in_array(end($src), ['large', 'small'])) {
					$has_image = true;
					array_pop($src);
					if (preg_match(",.(\w+)$,", end($src), $m)) {
						$enclosure_type = sql_getfetsel('mime_type', 'spip_types_documents', 'extension = ' . sql_quote($m[1]));
					}
					$src = implode(':', $src) . ':medium';
					$enclosure = $src;
					break;
				}
			}
		}

		if ($has_image and $src) {
			//$src = str_replace(':large', ':small', $src);
			$data['html'] = "<img src='$src' class='thumbnail p' />" . $data['html'];
		}

		// on va essayer de recuperer plus d'infos et de generer un tweet propre si on y arrive
		$metadata = explode('metadata', $content, 2);
		$links = extraire_balises(end($metadata), 'a');
		$link = reset($links);
		$link = strip_tags($link); // 5:14 AM - 3 Mar 2017
		$link = explode('-', $link);
		$link = array_reverse($link);
		$link = implode(' ', $link);
		$published_w_h = strtotime($link);


		$content = extraire_balise($data['html'], 'blockquote');
		$content = explode('&mdash;', $content);
		$published = extraire_balise(end($content), 'a');
		$published = strip_tags($published);
		$published = strtotime($published);
		if ($published_w_h and abs($published_w_h - $published)<24*3600) {
			$published = $published_w_h;
		}
		$content = reset($content);
		$content = explode('>', $content, 2);
		$content = end($content);

		if ($content and $author_thumbnail and $published) {
			include_spip('oembed/input/posttraite_mastodon');
			$need_emoji = false;
			$screen_name = emojify($data['author_name'], $need_emoji);
			$content = emojify($content, $need_emoji);
			if ($enclosure) {
				$content .= "<img src='$enclosure' class='thumbnail p' />";
			}
			$contexte = array(
				'url' => $data['oembed_url_source'],
				'width' => max($data['width'],600),
				'height' => $data['height'],
				'author_screen_name' => $screen_name,
				'author_url' => $data['author_url'],
				'author_name' => '@' . ltrim(basename($data['author_url']), '@') . '@twitter.com',

				// A renseigner
				'author_thumbnail' => $author_thumbnail,
				'author_thumbnail_width' => '',
				'author_thumbnail_height' => '',
				'content' => $content,
				'published' => date('Y-m-d H:i:s', $published),
				'enclosure' => '',
				'enclosure_type' => '',
			);
			$contexte['need_emoji'] = $need_emoji;
			$data['html'] = recuperer_fond('modeles/toot', $contexte);

		}

	}

	return $data;
}
