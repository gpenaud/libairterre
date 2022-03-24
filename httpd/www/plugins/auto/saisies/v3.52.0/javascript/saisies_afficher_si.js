$(function(){
	afficher_si_init();
});
$(document).ajaxComplete(function() {
	afficher_si_init();
});
afficher_si_current_data = '';
function afficher_si_init() {
	$('form:not([data-afficher_si-init])').each(function(){
		form = $(this);
		afficher_si_set_current_data(form);
		form.find('[data-afficher_si]').each(function(){
			verifier_afficher_si(form, $(this), true);
			}
		);
		$(this).find('textarea, input, select').change(function(){
				form = $(this).parents('form');
				name = $(this).attr('name').replace('[]', '');
				afficher_si_set_current_data(form);
				form.find('[data-afficher_si*=\''+name+'\']').each(function(){
					verifier_afficher_si(form, $(this));
				})
		});
		$(this).attr('data-afficher_si-init', true);
	})
}
function afficher_si_set_current_data(form) {
	current_data = form.serializeArray();//Le format de retour n'est pas simple, on transforme en tableau associatif
	afficher_si_current_data = [];
	$(current_data).each(function() {
		if (this.name.includes('[]')) {
			this.name	= this.name.replace('[]', '');
			if (Array.isArray(afficher_si_current_data[this.name])) {
				afficher_si_current_data[this.name].push(this.value)
			} else {
				afficher_si_current_data[this.name] = [this.value];
			}
		} else {
			afficher_si_current_data[this.name] = this.value;
		}
	});
}
function verifier_afficher_si(form, saisie, chargement) {
	if (saisie.hasClass('erreur')) {//Tjr afficher s'il y a une erreur
		return true;
	}
	condition = saisie.attr('data-afficher_si');
	condition = eval(condition);
	if (condition) {
		saisie.removeClass('afficher_si_masque_chargement').removeClass('afficher_si_masque').addClass('afficher_si_visible').removeAttr('aria-hiden');
		afficher_si_show(saisie);
		saisie.find('[data-afficher-si-required]').attr('required', true).attr('data-afficher-si-required',false);
	} else {
		console.log(saisie);
		if (saisie.hasClass('erreur')) {
			console.log('Saisies masquées par afficher_si avec une erreur...' + saisie.attr('data-id'));
		} else {
			afficher_si_hide(saisie);
			if (chargement) {
				saisie.addClass('afficher_si_masque_chargement');
			}
			saisie.addClass('afficher_si_masque').removeClass('afficher_si_visible').attr('aria-hiden', true);
			saisie.find('[required]').attr('required', false).attr('data-afficher-si-required', null);
		}
	}
}

function afficher_si(args) {
	valeur_champ = afficher_si_current_data[args['champ']];
	valeur = args['valeur'];

	// Compat historique == > IN pour données tabulaires !
	if (Array.isArray(valeur_champ) && !args['total']) {
		if (args['operateur'] == '==') {
			args['operateur'] = 'IN';
		} else if(args['operateur'] == '!=') {
			args['operateur'] = '!IN';
		}
	}
	// Si on vérifie un total
	if (args['total']) {
		if (Array.isArray(valeur_champ)) {
			valeur_champ = valeur_champ.length;
		} else {
			valeur_champ = 0;
		}
	}

	// Transformation en tableau des valeurs et valeur_champ, si IN/!IN
	if (args['operateur'] == 'IN' || args['operateur'] == '!IN') {
		valeur = valeur.split(',');
		if (!Array.isArray(valeur_champ)) {
			if (valeur_champ) {
				valeur_champ = [valeur_champ];
			} else {
				valeur_champ = [];
			}
		}
	}

	// Et maintenant les test
	switch (args['operateur']) {
		case '==':
			return valeur_champ == valeur;
		case '!=':
			return valeur_champ != valeur;
		case '>':
			return valeur_champ > valeur;
		case '>=':
			return valeur_champ >= valeur;
		case '<':
			return valeur_champ < valeur;
		case '<=':
			return valeur_champ <= valeur;
		case 'MATCH':
			return RegExp(valeur, args.regexp_modif).test(valeur_champ);
		case 'MATCH':
			return !RegExp(valeur, args.regexp_modif).test(valeur_champ);
		case 'IN':
			return $(valeur).filter(valeur_champ).length ? true : false;
		case '!IN':
			return $(valeur).filter(valeur_champ).length ? false : true;
		default:
			return valeur_champ ? true : false;
	}
}
