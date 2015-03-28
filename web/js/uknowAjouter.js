/**
 * Created by thomas on 17/03/15.
 */

$(function() {
    function initialisation() {
        $.getJSON("http://localhost/Uknow/web/json/domaines.json", function (donneesdomaine) {
            $.getJSON("http://localhost/Uknow/web/json/matieres.json", function (donneesmatiere) {
                $.getJSON("http://localhost/Uknow/web/json/themes.json", function (donneestheme) {
                    $.getJSON("http://localhost/Uknow/web/json/chapitres.json", function (donneeschapitre) {
                        $('#uknow_platformbundle_ajout_domaine_nom')
                            .html('')
                            .append('<option value selected="selected">Choisir le domaine</option>');
                        $('#uknow_platformbundle_ajout_matiere_nom')
                            .html('')
                            .append('<option value selected="selected">Choisir la matière</option>');
                        $('#uknow_platformbundle_ajout_theme_nom')
                            .html('')
                            .append('<option value selected="selected">Choisir le thème</option>');
                        $('#uknow_platformbundle_ajout_chapitre_nom')
                            .html('')
                            .append('<option value selected="selected">Choisir le chapitre</option>');
                        $.each(donneesdomaine['domaine'], function (i, domaine) {
                            $('#uknow_platformbundle_ajout_domaine_nom')
                                .append('<option value="' + domaine.lien + '">' + domaine.nom + '</option>');
                            $('#uknow_platformbundle_ajout_matiere_nom')
                                .append('<optgroup label="' + domaine.nom + '">');
                            $('#uknow_platformbundle_ajout_theme_nom')
                                .append('<optgroup label="' + domaine.nom + '">');
                            $('#uknow_platformbundle_ajout_chapitre_nom')
                                .append('<optgroup label="' + domaine.nom + '">');
                            $.each(donneesmatiere['matiere'][domaine.lien], function (i, matiere) {
                                $('#uknow_platformbundle_ajout_matiere_nom')
                                    .find('optgroup[label="' + domaine.nom + '"]')
                                    .append('<option value="' + matiere.lien + '">' + matiere.nom + '</option>');
                                $('#uknow_platformbundle_ajout_theme_nom')
                                    .find('optgroup[label="' + domaine.nom + '"]')
                                    .append('<optgroup label="' + matiere.nom + '">');
                                $('#uknow_platformbundle_ajout_chapitre_nom')
                                    .find('optgroup[label="' + domaine.nom + '"]')
                                    .append('<optgroup label="' + matiere.nom + '">');
                                $.each(donneestheme['theme'][domaine.lien][matiere.lien], function (i, theme) {
                                    $('#uknow_platformbundle_ajout_theme_nom')
                                        .find('optgroup[label="' + domaine.nom + '"]')
                                        .find('optgroup[label="' + matiere.nom + '"]')
                                        .append('<option value="' + theme.lien + '">' + theme.nom + '</option>');
                                    $('#uknow_platformbundle_ajout_chapitre_nom')
                                        .find('optgroup[label="' + domaine.nom + '"]')
                                        .find('optgroup[label="' + matiere.nom + '"]')
                                        .append('<optgroup label="' + theme.nom + '">');
                                    $.each(donneeschapitre['chapitre'][domaine.lien][matiere.lien][theme.lien], function (i, chapitre) {
                                        $('#uknow_platformbundle_ajout_chapitre_nom')
                                            .find('optgroup[label="' + domaine.nom + '"]')
                                            .find('optgroup[label="' + matiere.nom + '"]')
                                            .find('optgroup[label="' + theme.nom + '"]')
                                            .append('<option value="' + chapitre.lien + '">' + chapitre.nom + '</option>')
                                    });
                                });
                            });
                        });
                    })
                })
            })
        });
    }

    function domaineSelect(){
        $.getJSON("http://localhost/Uknow/web/json/matieres.json", function (donneesmatiere) {
            $.getJSON("http://localhost/Uknow/web/json/themes.json", function (donneestheme) {
                $.getJSON("http://localhost/Uknow/web/json/chapitres.json", function (donneeschapitre) {
                    $('#uknow_platformbundle_ajout_matiere_nom')
                        .html('')
                        .append('<option value selected="selected">Choisir la matière</option>');
                    $('#uknow_platformbundle_ajout_theme_nom')
                        .html('')
                        .append('<option value selected="selected">Choisir le thème</option>');
                    $('#uknow_platformbundle_ajout_chapitre_nom'
                    ).html('')
                        .append('<option value selected="selected">Choisir le chapitre</option>');
                    $.each(donneesmatiere['matiere'][$('#uknow_platformbundle_ajout_domaine_nom').val()], function (i, matiere) {
                        $('#uknow_platformbundle_ajout_matiere_nom')
                            .append('<option value="' + matiere.lien + '">' + matiere.nom + '</option>');
                        $('#uknow_platformbundle_ajout_theme_nom')
                            .append('<optgroup label="' + matiere.nom + '">');
                        $('#uknow_platformbundle_ajout_chapitre_nom')
                            .append('<optgroup label="' + matiere.nom + '">');
                        $.each(donneestheme['theme'][$('#uknow_platformbundle_ajout_domaine_nom').val()][matiere.lien], function (i, theme) {
                            $('#uknow_platformbundle_ajout_theme_nom')
                                .find('optgroup[label="' + matiere.nom + '"]')
                                .append('<option value="' + theme.lien + '">' + theme.nom + '</option>');
                            $('#uknow_platformbundle_ajout_chapitre_nom')
                                .find('optgroup[label="' + matiere.nom + '"]')
                                .append('<optgroup label="' + theme.nom + '">');
                            $.each(donneeschapitre['chapitre'][$('#uknow_platformbundle_ajout_domaine_nom').val()][matiere.lien][theme.lien], function (i, chapitre) {
                                $('#uknow_platformbundle_ajout_chapitre_nom')
                                    .find('optgroup[label="' + matiere.nom + '"]')
                                    .find('optgroup[label="' + theme.nom + '"]')
                                    .append('<option value="' + chapitre.lien + '">' + chapitre.nom + '</option>');
                            })
                        })
                    })
                })
            })
        })
    }

    function matiereSelect(){
        if($('#uknow_platformbundle_ajout_domaine_nom').val() == ''){
            $.getJSON("http://localhost/Uknow/web/json/domaines.json", function (donneesdomaine) {
                $.getJSON("http://localhost/Uknow/web/json/matieres.json", function (donneesmatiere) {
                    $.each(donneesdomaine['domaine'], function (i, domaine) {
                        $.each(donneesmatiere['matiere'][domaine.lien], function (i, matiere) {
                            if($('#uknow_platformbundle_ajout_matiere_nom').val() == matiere.lien){
                                $('#uknow_platformbundle_ajout_domaine_nom').find('option[value="' + domaine.lien + '"]').prop('selected', true);
                            }
                        })
                    })
                })
            });
        }

        $.getJSON("http://localhost/Uknow/web/json/themes.json", function (donneestheme) {
            $.getJSON("http://localhost/Uknow/web/json/chapitres.json", function (donneeschapitre) {
                $('#uknow_platformbundle_ajout_theme_nom')
                    .html('')
                    .append('<option value selected="selected">Choisir le thème</option>');
                $('#uknow_platformbundle_ajout_chapitre_nom')
                    .html('')
                    .append('<option value selected="selected">Choisir le chapitre</option>');
                $.each(donneestheme['theme'][$('#uknow_platformbundle_ajout_domaine_nom').val()][$('#uknow_platformbundle_ajout_matiere_nom').val()], function (i, theme) {
                    $('#uknow_platformbundle_ajout_theme_nom')
                        .append('<option value="' + theme.lien + '">' + theme.nom + '</option>');
                    $('#uknow_platformbundle_ajout_chapitre_nom')
                        .append('<optgroup label="' + theme.nom + '">');
                    $.each(donneeschapitre['chapitre'][$('#uknow_platformbundle_ajout_domaine_nom').val()][$('#uknow_platformbundle_ajout_matiere_nom').val()][theme.lien], function (i, chapitre) {
                        $('#uknow_platformbundle_ajout_chapitre_nom')
                            .find('optgroup[label="' + theme.nom + '"]')
                            .append('<option value="' + chapitre.lien + '">' + chapitre.nom + '</option>');
                    })
                })
            })
        })
    }

    function themeSelect(){
        if($('#uknow_platformbundle_ajout_matiere_nom').val() == '') {
            $.getJSON("http://localhost/Uknow/web/json/domaines.json", function (donneesdomaine) {
                $.getJSON("http://localhost/Uknow/web/json/matieres.json", function (donneesmatiere) {
                    $.getJSON("http://localhost/Uknow/web/json/themes.json", function (donneestheme) {
                        $.each(donneesdomaine['domaine'], function (i, domaine) {
                            $.each(donneesmatiere['matiere'][domaine.lien], function (i, matiere) {
                                $.each(donneestheme['theme'][domaine.lien][matiere.lien], function (i, theme) {
                                    if (theme.lien == $('#uknow_platformbundle_ajout_theme_nom').val()) {
                                        $('#uknow_platformbundle_ajout_domaine_nom').find('option[value="' + domaine.lien + '"]').prop('selected', true);
                                        $('#uknow_platformbundle_ajout_matiere_nom').find('option[value="' + matiere.lien + '"]').prop('selected', true);
                                    }
                                })
                            })
                        })
                    })
                })
            });
        }

        $.getJSON("http://localhost/Uknow/web/json/chapitres.json", function (donneeschapitre) {
            $('#uknow_platformbundle_ajout_chapitre_nom')
                .html('')
                .append('<option value selected="selected">Choisir le chapitre</option>');
            $.each(donneeschapitre['chapitre'][$('#uknow_platformbundle_ajout_domaine_nom').val()][$('#uknow_platformbundle_ajout_matiere_nom').val()][$('#uknow_platformbundle_ajout_theme_nom').val()], function (i, chapitre) {
                $('#uknow_platformbundle_ajout_chapitre_nom')
                    .append('<option value="' + chapitre.lien + '">' + chapitre.nom + '</option>');
            })
        })
    }

    function chapitreSelect(){
        $.getJSON("http://localhost/Uknow/web/json/domaines.json", function (donneesdomaine) {
            $.getJSON("http://localhost/Uknow/web/json/matieres.json", function (donneesmatiere) {
                $.getJSON("http://localhost/Uknow/web/json/themes.json", function (donneestheme) {
                    $.getJSON("http://localhost/Uknow/web/json/chapitres.json", function (donneeschapitre) {
                        $.each(donneesdomaine['domaine'], function (i, domaine) {
                            $.each(donneesmatiere['matiere'][domaine.lien], function (i, matiere) {
                                $.each(donneestheme['theme'][domaine.lien][matiere.lien], function (i, theme) {
                                    $.each(donneeschapitre['chapitre'][domaine.lien][matiere.lien][theme.lien], function (i, chapitre) {
                                        if (chapitre.lien == $('#uknow_platformbundle_ajout_chapitre_nom').val()) {
                                            $('#uknow_platformbundle_ajout_domaine_nom').find('option[value="' + domaine.lien + '"]').prop('selected', true);
                                            $('#uknow_platformbundle_ajout_matiere_nom').find('option[value="' + matiere.lien + '"]').prop('selected', true);
                                            $('#uknow_platformbundle_ajout_theme_nom').find('option[value="' + theme.lien + '"]').prop('selected', true);
                                        }
                                    })
                                })
                            })
                        })
                    })
                })
            })
        })
    }

    $(document).ready(initialisation());

    $('#uknow_platformbundle_ajout_domaine_nom').change(function () {
        if($('#uknow_platformbundle_ajout_domaine_nom').val() == ''){
            initialisation();
        }else{
            domaineSelect();
        }
    });

    $('#uknow_platformbundle_ajout_matiere_nom').change(function () {
        if($('#uknow_platformbundle_ajout_matiere_nom').val() == ''){
            initialisation();
        }else{
            matiereSelect();
        }
    });

    $('#uknow_platformbundle_ajout_theme_nom').change(function () {
        if($('#uknow_platformbundle_ajout_theme_nom').val() == ''){
            initialisation();
        }else{
            themeSelect();
        }
    });

    $('#uknow_platformbundle_ajout_chapitre_nom').change(function () {
        if($('#uknow_platformbundle_ajout_chapitre_nom').val() == ''){
            initialisation();
        }else{
            chapitreSelect();
        }
    })
});



