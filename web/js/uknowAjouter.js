/**
 * Created by thomas on 17/03/15.
 */

$(document).ready(function(){
    $.getJSON("http://localhost/Uknow/web/json/domaines.json", function(donneesdomaine){
        $.getJSON("http://localhost/Uknow/web/json/matieres.json", function(donneesmatiere){
            $.getJSON("http://localhost/Uknow/web/json/themes.json", function(donneestheme){
                $.getJSON("http://localhost/Uknow/web/json/chapitres.json", function(donneeschapitre){
                    $('#uknow_platformbundle_ajout_domaine_nom').html('').append('<option value selected="selected">Choisir le domaine</option>');
                    $('#uknow_platformbundle_ajout_matiere_nom').html('').append('<option value selected="selected">Choisir la matière</option>');
                    $('#uknow_platformbundle_ajout_theme_nom').html('').append('<option value selected="selected">Choisir le thème</option>');
                    $('#uknow_platformbundle_ajout_chapitre_nom').html('').append('<option value selected="selected">Choisir le chapitre</option>');
                    $.each(donneesdomaine.domaine, function(i, domaine){
                        $('#uknow_platformbundle_ajout_domaine_nom').append('<option value="' + domaine.lien + '">' + domaine.nom + '</option>');
                        $('#uknow_platformbundle_ajout_matiere_nom').append('<optgroup label="' + domaine.nom + '">');
                        $('#uknow_platformbundle_ajout_theme_nom').append('<optgroup label="' + domaine.nom + '">');
                        $('#uknow_platformbundle_ajout_chapitre_nom').append('<optgroup label="' + domaine.nom + '">');
                        $.each(donneesmatiere.matiere[domaine.lien], function(i, matiere) {
                            $('#uknow_platformbundle_ajout_matiere_nom').find('optgroup[label="' + domaine.nom + '"]').append('<option value="' + matiere.lien + '">' + matiere.nom + '</option>');
                            $('#uknow_platformbundle_ajout_theme_nom').append('<optgroup label="' + matiere.nom + '">');
                            $('#uknow_platformbundle_ajout_chapitre_nom').append('<optgroup label="' + matiere.nom + '">');
                            $.each(donneestheme.theme[domaine.lien][matiere.lien], function(i, theme){
                                $('#uknow_platformbundle_ajout_theme_nom').find('optgroup[label="' + matiere.nom + '"]').append('<option value="' + theme.lien + '">' + theme.nom + '</option>');
                                $('#uknow_platformbundle_ajout_chapitre_nom').append('<optgroup label="' + theme.nom + '">');
                                $.each(donneeschapitre.chapitre[domaine.lien][matiere.lien][theme.lien], function(i, chapitre){
                                    $('#uknow_platformbundle_ajout_chapitre_nom').find('optgroup[label="' + theme.nom + '"]').append('<option value="' + chapitre.lien + '">' + chapitre.nom + '</option>')
                                });
                            });
                        });
                    });
                })
            })
        })
    });
    $('option').css('text-indent', '2em');
});

$(function(){
    $('#uknow_platformbundle_ajout_domaine_nom').change(function(){
        $.getJSON("http://localhost/Uknow/web/json/matieres.json", function(donnees){
            $('#uknow_platformbundle_ajout_matiere_nom').html('').append('<option value selected="selected">Choisir la matière</option>')
            $.each(donnees.matiere[$('#uknow_platformbundle_ajout_domaine_nom').val()], function(i, matiere) {
                $('#uknow_platformbundle_ajout_matiere_nom').append('<option value="' + matiere.lien + '">' + matiere.nom + '</option>');
            })
        });
        $.getJSON("http://localhost/Uknow/web/json/themes.json", function(donnees){
            $('#uknow_platformbundle_ajout_theme_nom').html('').append('<option value selected="selected">Choisir le thème</option>')
            $.each(donnees.theme[$('#uknow_platformbundle_ajout_domaine_nom').val()], function(i, matiere) {
                $.each(matiere, function(i, theme) {
                    $('#uknow_platformbundle_ajout_theme_nom').append('<option value="' + theme.lien + '">' + theme.nom + '</option>');
                })
            })
        });
        $.getJSON("http://localhost/Uknow/web/json/chapitres.json", function(donnees){
            $('#uknow_platformbundle_ajout_chapitre_nom').html('').append('<option value selected="selected">Choisir le chapitre</option>')
            $.each(donnees.chapitre[$('#uknow_platformbundle_ajout_domaine_nom').val()], function(i, matiere) {
                $.each(matiere, function(i, theme){
                    $.each(theme, function(i, chapitre) {
                        $('#uknow_platformbundle_ajout_chapitre_nom').append('<option value="' + chapitre.lien + '">' + chapitre.nom + '</option>');
                    })
                })
            })
        });
    });


    $('#uknow_platformbundle_ajout_matiere_nom').change(function(){
        $.getJSON("http://localhost/Uknow/web/json/matieres.json", function(donnees){
            $('#uknow_platformbundle_ajout_matiere_nom').html('').append('<option value selected="selected">Choisir la matière</option>')
            $.each(donnees.matiere[$('#uknow_platformbundle_ajout_domaine_nom').val()], function(i, matiere) {
                $('#uknow_platformbundle_ajout_matiere_nom').append('<option value="' + matiere.lien + '">' + matiere.nom + '</option>');
            })
        });
        $.getJSON("http://localhost/Uknow/web/json/themes.json", function(donnees){
            $('#uknow_platformbundle_ajout_theme_nom').html('').append('<option value selected="selected">Choisir le thème</option>')
            $.each(donnees.theme[$('#uknow_platformbundle_ajout_domaine_nom').val()], function(i, matiere) {
                $.each(matiere, function(i, theme) {
                    $('#uknow_platformbundle_ajout_theme_nom').append('<option value="' + theme.lien + '">' + theme.nom + '</option>');
                })
            })
        });
        $.getJSON("http://localhost/Uknow/web/json/chapitres.json", function(donnees){
            $('#uknow_platformbundle_ajout_chapitre_nom').html('').append('<option value selected="selected">Choisir le chapitre</option>')
            $.each(donnees.chapitre[$('#uknow_platformbundle_ajout_domaine_nom').val()], function(i, matiere) {
                $.each(matiere, function(i, theme){
                    $.each(theme, function(i, chapitre) {
                        $('#uknow_platformbundle_ajout_chapitre_nom').append('<option value="' + chapitre.lien + '">' + chapitre.nom + '</option>');
                    })
                })
            })
        });
    });


    $('#uknow_platformbundle_ajout_theme_nom').change(function(){
        $.getJSON("http://localhost/Uknow/web/json/matieres.json", function(donnees){
            $('#uknow_platformbundle_ajout_matiere_nom').html('').append('<option value selected="selected">Choisir la matière</option>')
            $.each(donnees.matiere[$('#uknow_platformbundle_ajout_domaine_nom').val()], function(i, matiere) {
                $('#uknow_platformbundle_ajout_matiere_nom').append('<option value="' + matiere.lien + '">' + matiere.nom + '</option>');
            })
        });
        $.getJSON("http://localhost/Uknow/web/json/themes.json", function(donnees){
            $('#uknow_platformbundle_ajout_theme_nom').html('').append('<option value selected="selected">Choisir le thème</option>')
            $.each(donnees.theme[$('#uknow_platformbundle_ajout_domaine_nom').val()], function(i, matiere) {
                $.each(matiere, function(i, theme) {
                    $('#uknow_platformbundle_ajout_theme_nom').append('<option value="' + theme.lien + '">' + theme.nom + '</option>');
                })
            })
        });
        $.getJSON("http://localhost/Uknow/web/json/chapitres.json", function(donnees){
            $('#uknow_platformbundle_ajout_chapitre_nom').html('').append('<option value selected="selected">Choisir le chapitre</option>')
            $.each(donnees.chapitre[$('#uknow_platformbundle_ajout_domaine_nom').val()], function(i, matiere) {
                $.each(matiere, function(i, theme){
                    $.each(theme, function(i, chapitre) {
                        $('#uknow_platformbundle_ajout_chapitre_nom').append('<option value="' + chapitre.lien + '">' + chapitre.nom + '</option>');
                    })
                })
            })
        });
    });


    $('#uknow_platformbundle_ajout_chapitre_nom').change(function(){
        $.getJSON("http://localhost/Uknow/web/json/matieres.json", function(donnees){
            $('#uknow_platformbundle_ajout_matiere_nom').html('').append('<option value selected="selected">Choisir la matière</option>')
            $.each(donnees.matiere[$('#uknow_platformbundle_ajout_domaine_nom').val()], function(i, matiere) {
                $('#uknow_platformbundle_ajout_matiere_nom').append('<option value="' + matiere.lien + '">' + matiere.nom + '</option>');
            })
        });
        $.getJSON("http://localhost/Uknow/web/json/themes.json", function(donnees){
            $('#uknow_platformbundle_ajout_theme_nom').html('').append('<option value selected="selected">Choisir le thème</option>')
            $.each(donnees.theme[$('#uknow_platformbundle_ajout_domaine_nom').val()], function(i, matiere) {
                $.each(matiere, function(i, theme) {
                    $('#uknow_platformbundle_ajout_theme_nom').append('<option value="' + theme.lien + '">' + theme.nom + '</option>');
                })
            })
        });
        $.getJSON("http://localhost/Uknow/web/json/chapitres.json", function(donnees){
            $('#uknow_platformbundle_ajout_chapitre_nom').html('').append('<option value selected="selected">Choisir le chapitre</option>')
            $.each(donnees.chapitre[$('#uknow_platformbundle_ajout_domaine_nom').val()], function(i, matiere) {
                $.each(matiere, function(i, theme){
                    $.each(theme, function(i, chapitre) {
                        $('#uknow_platformbundle_ajout_chapitre_nom').append('<option value="' + chapitre.lien + '">' + chapitre.nom + '</option>');
                    })
                })
            })
        });
    });
});



