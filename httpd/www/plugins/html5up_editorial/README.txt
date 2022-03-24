Squelette SPIP pour intégrer le modèle Editorial de HTML5UP
https://html5up.net/editorial
Le squelette Solid State https://zone.spip.org/trac/spip-zone/browser/_squelettes_/html5up_solid_state
a été pris pour commencer celui-ci.

v1.0.6

Pour la rédaction et l'usage, voir la page de doc sur contrib : https://contrib.spip.net/?article4947

note de dév : Un problème js empêchait aléatoirement le script javascript/main.js de retirer la classe "is-loading" qui est placé sur la balise body (par ce même script). Ce petit soucis cause des problèmes plus gros dans l'interface.
Un petit bout de code dans javascript/perso.js permet de retirer cette classe de manière plus sûre, mais c'est une rustine en attendant mieux.

TODO
Vérifier et adapter les modèles où qu'on les insère => ok pour <iconebloc> - v1.0.4
Retrouver le multilinguisme 
Adapter les autres objets SPIP (mots, sites, brèves)
Se passer de google api pour les typos ? - OK en v1.1.7