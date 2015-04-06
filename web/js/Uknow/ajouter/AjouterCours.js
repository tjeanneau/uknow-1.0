/**
 * Created by thomas on 17/03/15.
 */

$(function() {
    function initialisation(domaineVal, matiereVal, themeVal, chapitreVal) {
        $.getJSON("http://localhost/Uknow/web/json/domaines.json", function (donneesdomaine) {
            $.getJSON("http://localhost/Uknow/web/json/matieres.json", function (donneesmatiere) {
                $.getJSON("http://localhost/Uknow/web/json/themes.json", function (donneestheme) {
                    $.getJSON("http://localhost/Uknow/web/json/chapitres.json", function (donneeschapitre) {
                        if(domaineVal == null){
                            $('#uknow_platformbundle_ajout_cours_domaine_lien')
                                .html('')
                                .append('<option value selected="selected">Choisir le domaine</option>');
                        }else{
                            $('#uknow_platformbundle_ajout_cours_domaine_lien')
                                .html('')
                                .append('<option value>Choisir le domaine</option>');
                        }
                        if(matiereVal == null) {
                            $('#uknow_platformbundle_ajout_cours_matiere_lien')
                                .html('')
                                .append('<option value selected="selected">Choisir la matière</option>');
                        }else{
                            $('#uknow_platformbundle_ajout_cours_matiere_lien')
                                .html('')
                                .append('<option value>Choisir la matière</option>');
                        }
                        if(themeVal == null) {
                            $('#uknow_platformbundle_ajout_cours_theme_lien')
                                .html('')
                                .append('<option value selected="selected">Choisir le thème</option>');
                        }else{
                            $('#uknow_platformbundle_ajout_cours_theme_lien')
                                .html('')
                                .append('<option value>Choisir le thème</option>');
                        }
                        if(chapitreVal == null) {
                            $('#uknow_platformbundle_ajout_cours_chapitre_lien')
                                .html('')
                                .append('<option value selected="selected">Choisir le chapitre</option>');
                        }else{
                            $('#uknow_platformbundle_ajout_cours_chapitre_lien')
                                .html('')
                                .append('<option value>Choisir le chapitre</option>');
                        }
                        $.each(donneesdomaine['domaine'], function (i, domaine) {
                            if(domaineVal == domaine.lien){
                                $('#uknow_platformbundle_ajout_cours_domaine_lien')
                                    .append('<option value="' + domaine.lien + '" selected="selected">' + domaine.nom + '</option>');
                            }else{
                                $('#uknow_platformbundle_ajout_cours_domaine_lien')
                                    .append('<option value="' + domaine.lien + '">' + domaine.nom + '</option>');
                            }
                            $('#uknow_platformbundle_ajout_cours_matiere_lien')
                                .append('<optgroup label="' + domaine.nom + '">');
                            $('#uknow_platformbundle_ajout_cours_theme_lien')
                                .append('<optgroup label="' + domaine.nom + '">');
                            $('#uknow_platformbundle_ajout_cours_chapitre_lien')
                                .append('<optgroup label="' + domaine.nom + '">');
                            $.each(donneesmatiere['matiere'][domaine.lien], function (i, matiere) {
                                if(matiereVal == matiere.lien){
                                    $('#uknow_platformbundle_ajout_cours_matiere_lien')
                                        .find('optgroup[label="' + domaine.nom + '"]')
                                        .append('<option value="' + matiere.lien + '" selected="selected">' + matiere.nom + '</option>');
                                }else{
                                    $('#uknow_platformbundle_ajout_cours_matiere_lien')
                                        .find('optgroup[label="' + domaine.nom + '"]')
                                        .append('<option value="' + matiere.lien + '">' + matiere.nom + '</option>');
                                }
                                $('#uknow_platformbundle_ajout_cours_theme_lien')
                                    .find('optgroup[label="' + domaine.nom + '"]')
                                    .append('<optgroup label="' + matiere.nom + '">');
                                $('#uknow_platformbundle_ajout_cours_chapitre_lien')
                                    .find('optgroup[label="' + domaine.nom + '"]')
                                    .append('<optgroup label="' + matiere.nom + '">');
                                $.each(donneestheme['theme'][domaine.lien][matiere.lien], function (i, theme) {
                                    if(themeVal == theme.lien){
                                        $('#uknow_platformbundle_ajout_cours_theme_lien')
                                            .find('optgroup[label="' + domaine.nom + '"]')
                                            .find('optgroup[label="' + matiere.nom + '"]')
                                            .append('<option value="' + theme.lien + '" selected="selected">' + theme.nom + '</option>');
                                    }else{
                                        $('#uknow_platformbundle_ajout_cours_theme_lien')
                                            .find('optgroup[label="' + domaine.nom + '"]')
                                            .find('optgroup[label="' + matiere.nom + '"]')
                                            .append('<option value="' + theme.lien + '">' + theme.nom + '</option>');
                                    }
                                    $('#uknow_platformbundle_ajout_cours_chapitre_lien')
                                        .find('optgroup[label="' + domaine.nom + '"]')
                                        .find('optgroup[label="' + matiere.nom + '"]')
                                        .append('<optgroup label="' + theme.nom + '">');
                                    $.each(donneeschapitre['chapitre'][domaine.lien][matiere.lien][theme.lien], function (i, chapitre) {
                                        if(chapitreVal == chapitre.lien){
                                            $('#uknow_platformbundle_ajout_cours_chapitre_lien')
                                                .find('optgroup[label="' + domaine.nom + '"]')
                                                .find('optgroup[label="' + matiere.nom + '"]')
                                                .find('optgroup[label="' + theme.nom + '"]')
                                                .append('<option value="' + chapitre.lien + '" selected="selected">' + chapitre.nom + '</option>')
                                        }else{
                                            $('#uknow_platformbundle_ajout_cours_chapitre_lien')
                                                .find('optgroup[label="' + domaine.nom + '"]')
                                                .find('optgroup[label="' + matiere.nom + '"]')
                                                .find('optgroup[label="' + theme.nom + '"]')
                                                .append('<option value="' + chapitre.lien + '">' + chapitre.nom + '</option>')
                                        }
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
                    $('#uknow_platformbundle_ajout_cours_matiere_lien')
                        .html('')
                        .append('<option value selected="selected">Choisir la matière</option>');
                    $('#uknow_platformbundle_ajout_cours_theme_lien')
                        .html('')
                        .append('<option value selected="selected">Choisir le thème</option>');
                    $('#uknow_platformbundle_ajout_cours_chapitre_lien'
                    ).html('')
                        .append('<option value selected="selected">Choisir le chapitre</option>');
                    $.each(donneesmatiere['matiere'][$('#uknow_platformbundle_ajout_cours_domaine_lien').val()], function (i, matiere) {
                        $('#uknow_platformbundle_ajout_cours_matiere_lien')
                            .append('<option value="' + matiere.lien + '">' + matiere.nom + '</option>');
                        $('#uknow_platformbundle_ajout_cours_theme_lien')
                            .append('<optgroup label="' + matiere.nom + '">');
                        $('#uknow_platformbundle_ajout_cours_chapitre_lien')
                            .append('<optgroup label="' + matiere.nom + '">');
                        $.each(donneestheme['theme'][$('#uknow_platformbundle_ajout_cours_domaine_lien').val()][matiere.lien], function (i, theme) {
                            $('#uknow_platformbundle_ajout_cours_theme_lien')
                                .find('optgroup[label="' + matiere.nom + '"]')
                                .append('<option value="' + theme.lien + '">' + theme.nom + '</option>');
                            $('#uknow_platformbundle_ajout_cours_chapitre_lien')
                                .find('optgroup[label="' + matiere.nom + '"]')
                                .append('<optgroup label="' + theme.nom + '">');
                            $.each(donneeschapitre['chapitre'][$('#uknow_platformbundle_ajout_cours_domaine_lien').val()][matiere.lien][theme.lien], function (i, chapitre) {
                                $('#uknow_platformbundle_ajout_cours_chapitre_lien')
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
        if($('#uknow_platformbundle_ajout_cours_domaine_lien').val() == ''){
            $.getJSON("http://localhost/Uknow/web/json/domaines.json", function (donneesdomaine) {
                $.getJSON("http://localhost/Uknow/web/json/matieres.json", function (donneesmatiere) {
                    $.each(donneesdomaine['domaine'], function (i, domaine) {
                        $.each(donneesmatiere['matiere'][domaine.lien], function (i, matiere) {
                            if($('#uknow_platformbundle_ajout_cours_matiere_lien').val() == matiere.lien){
                                $('#uknow_platformbundle_ajout_cours_domaine_lien').find('option[value="' + domaine.lien + '"]').prop('selected', true);
                            }
                        })
                    })
                })
            });
        }

        $.getJSON("http://localhost/Uknow/web/json/themes.json", function (donneestheme) {
            $.getJSON("http://localhost/Uknow/web/json/chapitres.json", function (donneeschapitre) {
                $('#uknow_platformbundle_ajout_cours_theme_lien')
                    .html('')
                    .append('<option value selected="selected">Choisir le thème</option>');
                $('#uknow_platformbundle_ajout_cours_chapitre_lien')
                    .html('')
                    .append('<option value selected="selected">Choisir le chapitre</option>');
                $.each(donneestheme['theme'][$('#uknow_platformbundle_ajout_cours_domaine_lien').val()][$('#uknow_platformbundle_ajout_cours_matiere_lien').val()], function (i, theme) {
                    $('#uknow_platformbundle_ajout_cours_theme_lien')
                        .append('<option value="' + theme.lien + '">' + theme.nom + '</option>');
                    $('#uknow_platformbundle_ajout_cours_chapitre_lien')
                        .append('<optgroup label="' + theme.nom + '">');
                    $.each(donneeschapitre['chapitre'][$('#uknow_platformbundle_ajout_cours_domaine_lien').val()][$('#uknow_platformbundle_ajout_cours_matiere_lien').val()][theme.lien], function (i, chapitre) {
                        $('#uknow_platformbundle_ajout_cours_chapitre_lien')
                            .find('optgroup[label="' + theme.nom + '"]')
                            .append('<option value="' + chapitre.lien + '">' + chapitre.nom + '</option>');
                    })
                })
            })
        })
    }

    function themeSelect(){
        if($('#uknow_platformbundle_ajout_cours_matiere_lien').val() == '') {
            $.getJSON("http://localhost/Uknow/web/json/domaines.json", function (donneesdomaine) {
                $.getJSON("http://localhost/Uknow/web/json/matieres.json", function (donneesmatiere) {
                    $.getJSON("http://localhost/Uknow/web/json/themes.json", function (donneestheme) {
                        $.each(donneesdomaine['domaine'], function (i, domaine) {
                            $.each(donneesmatiere['matiere'][domaine.lien], function (i, matiere) {
                                $.each(donneestheme['theme'][domaine.lien][matiere.lien], function (i, theme) {
                                    if (theme.lien == $('#uknow_platformbundle_ajout_cours_theme_lien').val()) {
                                        $('#uknow_platformbundle_ajout_cours_domaine_lien').find('option[value="' + domaine.lien + '"]').prop('selected', true);
                                        $('#uknow_platformbundle_ajout_cours_matiere_lien').find('option[value="' + matiere.lien + '"]').prop('selected', true);
                                        $.getJSON("http://localhost/Uknow/web/json/chapitres.json", function (donneeschapitre) {
                                            $('#uknow_platformbundle_ajout_cours_chapitre_lien')
                                                .html('')
                                                .append('<option value selected="selected">Choisir le chapitre</option>');
                                            $.each(donneeschapitre['chapitre'][domaine.lien][matiere.lien][$('#uknow_platformbundle_ajout_cours_theme_lien').val()], function (i, chapitre) {
                                                $('#uknow_platformbundle_ajout_cours_chapitre_lien')
                                                    .append('<option value="' + chapitre.lien + '">' + chapitre.nom + '</option>');
                                            })
                                        })
                                    }
                                })
                            })
                        })
                    })
                })
            });
        }else{
            $.getJSON("http://localhost/Uknow/web/json/chapitres.json", function (donneeschapitre) {
                $('#uknow_platformbundle_ajout_cours_chapitre_lien')
                    .html('')
                    .append('<option value selected="selected">Choisir le chapitre</option>');
                $.each(donneeschapitre['chapitre'][$('#uknow_platformbundle_ajout_cours_domaine_lien').val()][$('#uknow_platformbundle_ajout_cours_matiere_lien').val()][$('#uknow_platformbundle_ajout_cours_theme_lien').val()], function (i, chapitre) {
                    $('#uknow_platformbundle_ajout_cours_chapitre_lien')
                        .append('<option value="' + chapitre.lien + '">' + chapitre.nom + '</option>');
                })
            })
        }
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
                                        if (chapitre.lien == $('#uknow_platformbundle_ajout_cours_chapitre_lien').val()) {
                                            $('#uknow_platformbundle_ajout_cours_domaine_lien').find('option[value="' + domaine.lien + '"]').prop('selected', true);
                                            if($('#uknow_platformbundle_ajout_cours_matiere_lien').val() == ''){
                                                $('#uknow_platformbundle_ajout_cours_matiere_lien').find('option[value="' + matiere.lien + '"]').prop('selected', true);
                                            }
                                            $('#uknow_platformbundle_ajout_cours_theme_lien').find('option[value="' + theme.lien + '"]').prop('selected', true);
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

    $(document).ready(initialisation(
        $('#uknow_platformbundle_ajout_cours_domaine_lien').val(),
        $('#uknow_platformbundle_ajout_cours_matiere_lien').val(),
        $('#uknow_platformbundle_ajout_cours_theme_lien').val(),
        $('#uknow_platformbundle_ajout_cours_chapitre_lien').val()));

    $('#uknow_platformbundle_ajout_cours_domaine_lien').change(function () {
        if($('#uknow_platformbundle_ajout_cours_domaine_lien').val() == ''){
            initialisation(null, null, null, null);
        }else{
            domaineSelect();
        }
    });

    $('#uknow_platformbundle_ajout_cours_matiere_lien').change(function () {
        if($('#uknow_platformbundle_ajout_cours_matiere_lien').val() == ''){
            initialisation(null, null, null, null);
        }else{
            matiereSelect();
        }
    });

    $('#uknow_platformbundle_ajout_cours_theme_lien').change(function () {
        if($('#uknow_platformbundle_ajout_cours_theme_lien').val() == ''){
            initialisation(null, null, null, null);
        }else{
            themeSelect();
        }
    });

    $('#uknow_platformbundle_ajout_cours_chapitre_lien').change(function () {
        if($('#uknow_platformbundle_ajout_cours_chapitre_lien').val() == ''){
            initialisation(null, null, null, null);
        }else{
            chapitreSelect();
        }
    })
});



