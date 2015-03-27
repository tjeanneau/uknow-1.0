/**
 * Created by thomas on 17/03/15.
 */


$(document).ready(function(){
    $.getJSON("http://localhost/Uknow/web/json/domaines.json", function(donnees){
        $.each(donnees.domaine, function(i, domaine){
            $('#uknow_platformbundle_ajout_domaine_nom').append('<option value="' + domaine.nom + '">' + domaine.nom + '</option>')
        })
    })
    $.getJSON("http://localhost/Uknow/web/json/matieres.json", function(donnees){
        $.each(donnees.matiere, function(i, domaine){
            $.each(domaine, function(i, matiere){
                $('#uknow_platformbundle_ajout_matiere_nom').append('<option value="' + matiere.nom + '">' + matiere.nom + '</option>')
            })
        })
    })
    $.getJSON("http://localhost/Uknow/web/json/themes.json", function(donnees){
        $.each(donnees.theme, function(i, domaine){
            $.each(domaine, function(i, matiere){
                $.each(matiere, function(i, theme){
                    $('#uknow_platformbundle_ajout_theme_nom').append('<option value="' + theme.nom + '">' + theme.nom + '</option>')
                })
            })
        })
    })
    $.getJSON("http://localhost/Uknow/web/json/chapitres.json", function(donnees){
        $.each(donnees.chapitre, function(i, domaine){
            $.each(domaine, function(i, matiere){
                $.each(matiere, function(i, theme){
                    $.each(theme, function(i, chapitre){
                        $('#uknow_platformbundle_ajout_chapitre_nom').append('<option value="' + chapitre.nom + '">' + chapitre.nom + '</option>')
                    })
                })
            })
        })
    })
});




