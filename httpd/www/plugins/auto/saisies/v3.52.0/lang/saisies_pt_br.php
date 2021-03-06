<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de https://trad.spip.net/tradlang_module/saisies?lang_cible=pt_br
// ** ne pas modifier le fichier **

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// B
	'bouton_parcourir_docs_article' => 'Procurar na matéria',
	'bouton_parcourir_docs_breve' => 'Procurar na nota',
	'bouton_parcourir_docs_rubrique' => 'Procurar na seção',
	'bouton_parcourir_mediatheque' => 'Procurar na mídiateca',

	// C
	'construire_action_annuler' => 'Cancelar',
	'construire_action_configurer' => 'Configurar',
	'construire_action_deplacer' => 'Mover',
	'construire_action_dupliquer' => 'Duplicar',
	'construire_action_dupliquer_copie' => '(cópia)',
	'construire_action_supprimer' => 'Excluir',
	'construire_ajouter_champ' => 'Incluir um campo',
	'construire_ajouter_groupe' => 'Incluir um grupo',
	'construire_attention_enregistrer' => 'Lembre-se de gravar as suas alterações!',
	'construire_attention_modifie' => 'O formulário abaixo é diferente do formulário inicial.Você tem a possibilidade de revertê-lo ao estado em que estava, antes das suas alterações.',
	'construire_attention_supprime' => 'As suas alterações incluem exclusões de campos. Por favor, confirme a gravação desta nova versão do formulário.',
	'construire_aucun_champs' => 'No momento, não há nenhum campo no formulário.',
	'construire_confirmer_supprimer_champ' => 'Você quer realmente excluir este campo?',
	'construire_info_nb_champs_masques' => '@nb@ campo(s) invisível(eis) o tempo de configurar o grupo.',
	'construire_position_explication' => 'Indique qual campo este deve preceder.',
	'construire_position_fin_formulaire' => 'No fim do formulário',
	'construire_position_fin_groupe' => 'No fim do grupo @groupe@',
	'construire_position_label' => 'Posição do campo',
	'construire_reinitialiser' => 'Reverter o formulário',
	'construire_reinitialiser_confirmer' => 'Você perderá todas as suas modificações. Quer realmente reverter à versão inicial do formulário?',
	'construire_verifications_aucune' => 'Nenhuma',
	'construire_verifications_label' => 'Tipo de verificação a ser usada',

	// E
	'erreur_generique' => 'Há erros nos campos abaixo. Por favor, verifique as informações digitadas',
	'erreur_option_nom_unique' => 'Este nome já está sendo usado por outro campo e deve ser único, neste formulário.',

	// I
	'info_configurer_saisies' => 'Página de teste das entradas de dados',

	// L
	'label_annee' => 'Ano',
	'label_jour' => 'Dia',
	'label_mois' => 'Mês',

	// O
	'option_aff_art_interface_explication' => 'Exibir somente as matérias do idioma do usuário', # MODIF
	'option_aff_art_interface_label' => 'Exibição multilíngue',
	'option_aff_langue_explication' => 'Exibe o idioma da matéria ou da seção selecionada antes do titulo',
	'option_aff_langue_label' => 'Exibir o idioma',
	'option_aff_rub_interface_explication' => 'Exibir apenas as seções do idioma do usuário', # MODIF
	'option_aff_rub_interface_label' => 'Exibição multilíngue',
	'option_afficher_si_explication' => 'Informe as condições para exibir o campo, em função do valor de outros campos. O identificador dos outros campos deve ser inserido entre <code>@</code>.<br />
Exemplo: code>@selection_1@=="Toto"</code> condiciona a exibição do campo a que o campo  <code>selection_1</code> tenha o valor <code>Toto</code>.<br />
Pode-se usar operadores boleanos <code>||</code> (ou) e  <code>&&</code> (e)', # MODIF
	'option_afficher_si_label' => 'Exibição condicional',
	'option_afficher_si_remplissage_uniquement_explication' => 'Marcando este checkbox, a exibição condicioinal se aplicará unicamente no preenchimento do formulário e não na exibição dos resultados.',
	'option_afficher_si_remplissage_uniquement_label' => 'Unicamente no preenchimento',
	'option_attention_explication' => 'Uma mensagem mais importante que a explicação.',
	'option_attention_label' => 'Aviso',
	'option_attribut_title_label' => 'Incluir um atributo title no label, contendo o valor do campo. Para ser usado com moderação.', # MODIF
	'option_autocomplete_defaut' => 'Deixar por padrão',
	'option_autocomplete_explication' => 'Ao carregar a página, o seu navegador pode preencher previamente o campo em função do seu histórico',
	'option_autocomplete_label' => 'Preenchimento prévio do campo',
	'option_autocomplete_off' => 'Desativar',
	'option_autocomplete_on' => 'Ativar',
	'option_cacher_option_intro_label' => 'Esconder a primeira opção em branco.',
	'option_choix_alternatif_label' => 'Permitir a proposição de opção alternativa', # MODIF
	'option_choix_alternatif_label_defaut' => 'Outra opção',
	'option_choix_alternatif_label_label' => 'Rótulo desta outra opção',
	'option_choix_destinataires_explication' => 'Um ou mais autores que o usuário possa escolher. Se nada for selecionado, será selecionado o autor que instalou o site.', # MODIF
	'option_choix_destinataires_label' => 'Destinatários possíveis',
	'option_class_label' => 'Classes CSS adicionais',
	'option_cols_explication' => 'Largura do bloco (em números de caracteres). Este opção não é sempre aplicável, já que os estilos CSS do seu site podem se sobrepor.',
	'option_cols_label' => 'Largura',
	'option_datas_explication' => 'Você deve informar uma opção por linha,  no formato "chave|Rótulo da escolha"', # MODIF
	'option_datas_label' => 'Lista de opções aceitáveis',
	'option_datas_sous_groupe_explication' => 'Você deve indicar uma opção por linha, no formato "chave|Rótulo" da opção.<br /> 
Você pode indicar o início de um subgrupo, no formato "*Título do subgrupo". Para encerrar um subgrupo, você pode iniciar um outro ou inserir uma linha contendo apenas "/*".', # MODIF
	'option_defaut_label' => 'Valor padrão',
	'option_disable_avec_post_explication' => 'Igual na opção anterior, mas envia ainda o valor dentro um campo escondido.',
	'option_disable_avec_post_label' => 'Desativar mas enviar',
	'option_disable_explication' => 'O campo não pode mais obter foco.',
	'option_disable_label' => 'Desativar o campo',
	'option_erreur_obligatoire_explication' => 'Você pode personalizar a mensagem de erro exibida para indicar a obrigatoriedade (se não, deixe em branco).',
	'option_erreur_obligatoire_label' => 'Mensagem de obrigatoriedade', # MODIF
	'option_explication_explication' => 'Se necessário, uma frase curta descrevendo o objeto do campo.',
	'option_explication_label' => 'Explicação',
	'option_groupe_affichage' => 'Exibição',
	'option_groupe_description' => 'Descrição',
	'option_groupe_utilisation' => 'Utilização',
	'option_groupe_validation' => 'Validação',
	'option_heure_pas_explication' => 'Ao usar o horário, é exibido um menu para ajudar na entrada de horas e minutos. Você pode escolher o intervalo de tempo entre cada opção (30 min por padrão)',
	'option_heure_pas_label' => 'Intervalo de minutos no menu de apoio à entrada de dados',
	'option_horaire_label' => 'Horário',
	'option_horaire_label_case' => 'Permitir informar também o horário',
	'option_id_groupe_label' => 'Grupo de palavras',
	'option_info_obligatoire_explication' => 'Você pode alterar o valor padrão da indicação de obrigatoriedade: <i>[Obrigatório]</i>.', # MODIF
	'option_info_obligatoire_label' => 'Indicação de obrigatoriedade',
	'option_inserer_barre_choix_edition' => 'barra de formatação completa',
	'option_inserer_barre_choix_forum' => 'barra dos fóruns',
	'option_inserer_barre_explication' => 'Inserir uma barra de ferramentas da Pena, se o plugin estiver ativo.',
	'option_inserer_barre_label' => 'Inserir uma barra de ferramentas ',
	'option_label_case_label' => 'Rótulo localizado ao lado do checkbox',
	'option_label_explication' => 'O titulo que será exibido.',
	'option_label_label' => 'Rótulo',
	'option_label_non_explication' => 'Será visível na exibição dos resultados.',
	'option_label_non_label' => 'Label se o checkbox não estiver marcado',
	'option_label_oui_explication' => 'Será visível na exibição dos resultados.',
	'option_label_oui_label' => 'Label se o checkbox estiver marcado',
	'option_limite_branche_explication' => 'Limita a escolha a um ramo específico do site',
	'option_limite_branche_label' => 'Limitar a um ramo',
	'option_maxlength_explication' => 'O usuário não poderá digitar mais do que esse número de caracteres.', # MODIF
	'option_maxlength_label' => 'Número máximo de caracteres.',
	'option_multiple_explication' => 'O usuário poderá selecionar vários valores.', # MODIF
	'option_multiple_label' => 'Seleção múltipla',
	'option_nom_explication' => 'Um nome que identificará o campo.  Só pode conter letras minúsculas, números e o caracter "_".',
	'option_nom_label' => 'Nome do campo',
	'option_obligatoire_label' => 'Campo obrigatório',
	'option_option_destinataire_intro_label' => 'Rótulo da primeira opção em branco (quando em formato de lista)',
	'option_option_intro_label' => 'Rótulo da primeira opção em branco',
	'option_option_statut_label' => 'Exibir os status',
	'option_placeholder_label' => 'Marcador de posição',
	'option_pliable_label' => 'Expansível',
	'option_pliable_label_case' => 'O grupo de campos poderá ser expandido',
	'option_plie_label' => 'Já retraído',
	'option_plie_label_case' => 'Se o grupo de campos é expansível, ele já estará contraído na exibição do formulário.',
	'option_previsualisation_explication' => 'Si o plugin Pena estiver ativo, adiciona uma aba para visualizar o texto digitado.',
	'option_previsualisation_label' => 'Ativar a visualização',
	'option_readonly_explication' => 'O campo pode ser lido, selecionado, mas não alterado.',
	'option_readonly_label' => 'Só leitura',
	'option_rows_explication' => 'Altura do bloco em número de linhas. Esta opção não é sempre aplicável, já que os estilos CSS do seu site poderão sobrepor-se.',
	'option_rows_label' => 'Número de linhas',
	'option_size_explication' => 'Largura do campo em número de caractéres. Esta opção não é sempre aplicável, já que os estilos CSS do seu site poderão sobrepor-se.',
	'option_size_label' => 'Tamanho do campo',
	'option_statut_label' => 'Status particular(es)',
	'option_type_choix_plusieurs' => 'Permitir que o usuário escolha <strong>diversos</strong> destinatários.', # MODIF
	'option_type_choix_tous' => 'Incluir <strong>todos</strong> estes autores como destinatários. O usuário não terá nenhuma escolha.', # MODIF
	'option_type_choix_un' => 'Permitir ao usuário escolher <strong>um único</strong> destinatário (no formato de lista).', # MODIF
	'option_type_choix_un_radio' => 'Permite ao usuário escolher <strong>um único</strong> destinatário (no formato de checkboxes).', # MODIF
	'option_type_explication' => 'Em modo "mascarado", o conteúdo do campo não será mostrado.',
	'option_type_label' => 'Tipo do campo',
	'option_type_password' => 'Texto mascarado durante o preenchimento (ex: senha).',
	'option_type_text' => 'Normal',
	'option_valeur_non_label' => 'Valor não',
	'option_valeur_oui_label' => 'Valor sim',

	// P
	'plugin_yaml_inactif' => 'O plugin YAML está desativado. Você precisa ativá-lo para que esta página fique funcional.',

	// S
	'saisie_auteurs_explication' => 'Permite selecionar um ou mais autores', # MODIF
	'saisie_auteurs_titre' => 'Autores', # MODIF
	'saisie_case_explication' => 'Permite ativar ou desativar algo.',
	'saisie_case_titre' => 'Checkbox único',
	'saisie_checkbox_explication' => 'Permite escolher varias opções com checkboxes.',
	'saisie_checkbox_titre' => 'Checkboxes',
	'saisie_date_explication' => 'Permite informar uma data com a ajuda do calendário.', # MODIF
	'saisie_date_titre' => 'Data',
	'saisie_destinataires_explication' => 'Permite escolher um ou mais destinatários entre autores pré-selecionados.', # MODIF
	'saisie_destinataires_titre' => 'Destinatários',
	'saisie_email_explication' => 'Permite ter um campos do tipo e-mail em HTML5.',
	'saisie_email_titre' => 'Endereço de e-mail',
	'saisie_explication_explication' => 'Um texto explicativo geral.',
	'saisie_explication_titre' => 'Explicação',
	'saisie_fieldset_explication' => 'Uma área que poderá englobar vários campos.',
	'saisie_fieldset_titre' => 'Grupo de campos',
	'saisie_file_explication' => 'Envio de um arquivo',
	'saisie_file_titre' => 'Arquivo',
	'saisie_hidden_explication' => 'Um campo preenchido previamente, que o usuário não poderá ver.', # MODIF
	'saisie_hidden_titre' => 'Campo invisível',
	'saisie_input_explication' => 'Uma simples linha de texto podendo ser visível ou mascarada (senha).',
	'saisie_input_titre' => 'Linha de texto',
	'saisie_mot_explication' => 'Uma ou mais palavras-chave de um grupo de palavras', # MODIF
	'saisie_mot_titre' => 'Palavra-chave',
	'saisie_oui_non_explication' => 'Sim ou não, está claro? ;)',
	'saisie_oui_non_titre' => 'Sim ou não',
	'saisie_radio_defaut_choix1' => 'Um',
	'saisie_radio_defaut_choix2' => 'Dois',
	'saisie_radio_defaut_choix3' => 'Três',
	'saisie_radio_explication' => 'Permite escolher uma opção entre várias disponíveis.', # MODIF
	'saisie_radio_titre' => 'Botões rádio',
	'saisie_selecteur_article' => 'Exibe um navegador de seleção de matéria',
	'saisie_selecteur_document' => 'Exibe um seletor de documento',
	'saisie_selecteur_rubrique' => 'Exibe um navegador de seleção de seção',
	'saisie_selecteur_rubrique_article' => 'Exibe um navegador de seleção de matéria ou de seção',
	'saisie_selecteur_rubrique_article_titre' => 'Seletor de matéria ou seção', # MODIF
	'saisie_selection_explication' => 'Escolher uma opção em uma lista',
	'saisie_selection_multiple_explication' => 'Permite escolher várias opções em uma lista',
	'saisie_selection_multiple_titre' => 'Seleção múltipla',
	'saisie_selection_titre' => 'Lista', # MODIF
	'saisie_textarea_explication' => 'Um campo de texto em várias linhas.',
	'saisie_textarea_titre' => 'Bloco de texto',

	// T
	'titre_page_saisies_doc' => 'Documentação das entradas de dados',
	'tous_visiteurs' => 'Todos os visitantes (mesmo os não registrados)',
	'tout_selectionner' => '(De)Selecionar tudo',

	// V
	'vue_sans_reponse' => '<i>Sem resposta</i>',

	// Z
	'z' => 'zzz'
);
