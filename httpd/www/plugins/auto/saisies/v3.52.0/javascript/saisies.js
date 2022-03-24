jQuery(function(){
	saisies_fieldset_pliable();
	saisies_fieldset_onglet();
	saisies_multi_novalidate();
	onAjaxLoad(saisies_fieldset_pliable);
	onAjaxLoad(saisies_fieldset_onglet);
	onAjaxLoad(saisies_multi_novalidate);
});

/**
 * Rend certains fieldsets pliables
 *
 * Il s'agit des fieldsets portant les classes "fieldset.pliable"
 * Non cumulable avec les fieldsets en onglets.
 */
function saisies_fieldset_pliable(){
	// On cherche les groupes de champs pliables
	jQuery('.fieldset.pliable')
		.each(function(){
			var fieldset = jQuery(this);
			var groupe = jQuery(this).find('> fieldset > .editer-groupe');
			var legend = jQuery(this).find('> fieldset > .legend');

			// On éviter de plier un fieldset qui contient des erreurs lors de
			// l'initialisation.
			if (fieldset.find('.erreur').length > 0) {
				fieldset.removeClass('plie');
			}

			// S'il est déjà plié on cache le contenu
			if (fieldset.is('.plie'))
				groupe.hide();

			// Ensuite on ajoute une action sur le titre
			legend
				.unbind('click')
				.click(
					function(){
						fieldset.toggleClass('plie');
						if (groupe.is(':hidden'))
							groupe.show();
						else
							groupe.hide();
					}
				);
		});
};

/**
 * Tranforme certains fieldsets en onglets
 *
 * - Ceux portant les classes "fieldset.fieldset_onglet".
 * - Accessible à l'exception de la navigation au clavier.
 * - Les onglets sont persistants si les fieldsets possèdent un id ou un data-id.
 * - Non cumulable avec les fieldsets pliables.
 *
 * Markup inspiré de https://van11y.net/fr/onglets-accessibles/
 */
function saisies_fieldset_onglet() {

	// Classes utilisées
	var classes = {
		// conteneur général
		wrapper:         'saisies-onglets',
		// Menu
		tablist:       'saisies-menu-onglets',
		tablist_items: 'saisies-menu-onglets__items',
		tablist_item:  'saisies-menu-onglets__item',
		tablist_link:  'saisies-menu-onglets__lien',
		active:        'actif',
		error:         'erreur',
		scrollable:    'scrollable',
		// contenus (les fieldsets)
		tabscontents:  'saisies-contenus-onglets',
		tabcontent:    'saisies-contenu-onglet', // en complément de .fieldset_onglet
	}
	var selecteur_fieldset = '.fieldset.fieldset_onglet:not(.pliable)';
	var storage = window.sessionStorage;

	// Générer les onglets
	var init = function() {
		$.each(collections_fieldsets(), function(i, $fieldsets) {
			var
				$parent       = $fieldsets.first().parent(),
				$conteneur    = $('<div class="'+classes.wrapper+'"></div>'),
				$menu         = $('<nav class="'+classes.tablist+'"><ul class="'+classes.tablist_items+'" role="tablist"></ul></nav>'),
				$contenus     = $('<div class="'+classes.tabscontents+'"></div>'),
				ids_contenus  = [],
				id_menu       = null;

			// On insère un conteneur général au début du parent,
			// puis celui des contenus à l'intérieur.
			$conteneur.append($contenus).prependTo($parent);

			// On parcourt la série de fieldsets pour préparer
			// les entrées du menu, les interactions et les contenus
			$fieldsets.each(function() {

				var
					$contenu      = $(this),
					id_persistant = $contenu.attr('id') || $contenu.attr('data-id'),
					id_contenu    = id_persistant || randomId(),
					id_onglet     = 'onglet-' + id_contenu;

				// On ajoute les attributs nécessaire : id, classe, role et aria
				// puis on le cache d'office et on le déplace dans le conteneur.
				$contenu
					.attr('id', id_contenu)
					.addClass(classes.tabcontent)
					.attr('role', 'tabpanel')
					.attr('labelledby', id_onglet)
					.attr('data-saisies-onglet', true) // pour s'assurer de ne pas passer plusieurs fois
					.hide().attr('hidden', '')
					.appendTo($contenus);

				// On récupère le titre et on le cache
				var titre = $contenu.find('> fieldset > legend','> legend').first().hide().text();

				// On crée l'onglet avec son interaction
				var $onglet = $('<li class="'+classes.tablist_item+'"><a class="'+classes.tablist_link+'" href="#'+id_contenu+'" id="'+id_onglet+'" aria-controls="'+id_contenu+'">'+titre+'</a></li>');
				$onglet
					.click(function() {
						activer_onglet($(this).find('.'+classes.tablist_link));
						$(this).siblings().each(function() {
							desactiver_onglet($(this).find('.'+classes.tablist_link));
						});
						return false;
					});

				// On note l'id persistant
				if (id_persistant) {
					ids_contenus.push(id_persistant);
				}

				// S'il y a des erreurs dans cette partie du contenu, on met une classe "erreur" à l'onglet aussi
				if ($contenu.find('.editer.erreur').length) {
					$onglet.children('a').addClass(classes.error);
				}

				// On ajoute l'onglet au menu
				$menu.find('.'+classes.tablist_items).append($onglet);
			});

			// On insère le menu dans le DOM.
			// Si *tous* les fieldsets on un id persistant, on peut s'en servir pour celui du menu,
			// ce qui permet la navigation persistante.
			// l'id du menu sera utilisé comme clé dans la session, on le simplifie avec un hash.
			if (ids_contenus.length === $fieldsets.length) {
				id_menu = 'onglets-'+hashCode(ids_contenus.join(''));
				$menu.attr('data-id', id_menu);
			}
			$menu.prependTo($conteneur);

			// Indiquer si le menu doit être scrollable
			if ($menu[0].scrollWidth > $menu[0].clientWidth) {
				$menu.addClass(classes.scrollable);
			}

			// On active l'onglet par défaut : celui en session, sinon le 1er
			var $onglet_defaut, $onglet_session;
			if (($onglet_session = $('#'+escapeId(storage.getItem(id_menu)))).length) {
				$onglet_defaut = $onglet_session;
			} else {
				$onglet_defaut = $menu.find('.'+classes.tablist_link).first();
			}
			activer_onglet($onglet_defaut, 0, false);
		});
	}

	// Retourne un tableau de collections de fieldsets, une pour chaque niveau
	var collections_fieldsets = function() {
		var collections = [];
		$(selecteur_fieldset).each( function() {
			var
				$fieldsets_niveau = $(this).add($(this).siblings(selecteur_fieldset)),
				parsed = $(this).data('saisies-onglet-parsed') || false;
			if (!parsed) {
				collections.push($fieldsets_niveau);
				$fieldsets_niveau.each( function() {
					$(this).data('saisies-onglet-parsed', true);
				});
			}
		});
		return collections;
	}

	// Activer un onglet
	// @param object $onglet Élément <a>
	var activer_onglet = function( $onglet, duree = 150, persistant = true ) {
		if ($onglet.length) {
			var $contenu = $(escapeId($onglet.attr('href')));
			$onglet.addClass(classes.active).attr('aria-selected', true).removeAttr('tabindex');
			$contenu.fadeIn(duree).removeAttr('hidden');
			// Mettre en session si on a ce qu'il faut
			var id_menu = $onglet.parents('.'+classes.tablist).attr('data-id') || null;
			if (persistant && id_menu) {
				storage.setItem(id_menu, $onglet.attr('id'));
			}
		}
	}

	// Désactiver un onglet
	// @param object $onglet Élément <a>
	var desactiver_onglet = function( $onglet, duree = 150 ) {
		if ($onglet.length) {
			var $contenu = $(escapeId($onglet.attr('href')));
			$onglet.removeClass(classes.active).attr('aria-selected', false).attr('tabindex', -1);
			$contenu.hide().attr('hidden', '');
		}
	}

	// Échapper les ids pour ne pas faire couiner jQuery
	var escapeId = function ( id ) {
		id = (id || '').replace(/[^\d\w_\-\#]/gi, '\\$&');
		return id;
	}

	// Retourne un identifiant aléatoire
	// https://stackoverflow.com/a/8084248
	var randomId = function (taille = 8) {
		var random = (Math.random() + 1).toString(36);
		return random.substring(random.length - taille);
	}

	// Hash simple et rapide
	// https://gist.github.com/hyamamoto/fd435505d29ebfa3d9716fd2be8d42f0
	var hashCode = function(s) {
		for (var i = 0, h = 0; i < s.length; i++)
			h = Math.imul(31, h) + s.charCodeAt(i) | 0;
		return Math.abs(h);
	}

	// C'est parti
	init();
}

function saisies_date_jour_mois_annee_changer_date(me, datetime) {
	var champ = jQuery(me);
	var li = champ.closest('.editer');
	var	jour = jQuery.trim(li.find('.date_jour').val());
	var	mois = jQuery.trim(li.find('.date_mois').val());
	var	annee = jQuery.trim(li.find('.date_annee').val());
	var	date = jQuery.trim(li.find('.datetime').val());

	while(jour.length < 2) {jour = '0' + jour;}
	while(mois.length < 2) {mois = '0' + mois;}
	while(annee.length < 4) {annee = '0' + annee;}

	if (datetime == 'oui') {
		heure = date.substring(10);
		if (!heure || !(heure.length == 9)) {
			heure = ' 00:00:00';
		}
		date = annee + '-' + mois + '-' + jour + heure;
	}
	else {
		date = annee + '-' + mois + '-' + jour;
	}
	li.find('.datetime').attr('value', date);
}

/** Ne pas valider lors des retours arrières sur multiétape **/
function saisies_multi_novalidate() {
	$('[name^="_retour_etape"]').click(function() {
		$(this).parents('form').attr('novalidate', 'novalidate');
	});
}
