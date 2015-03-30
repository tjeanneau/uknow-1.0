/**
 * Created by thomas on 19/03/15.
 */

$(function(){
    $('#uknow_platformbundle_recherche_recherche').keyup(function(e){
        if(e.which >= 65 && e.which <= 90 || e.which == 222 || e.which == 8 || e.which == 46){
            var lettres = encodeURIComponent($('#uknow_platformbundle_recherche_recherche').val());
            $.ajax({
                type: 'GET',
                url: 'http://localhost/Uknow/web/app_dev.php/ajax/autocompletion?lettres=' + lettres,
                success: function(donnees) {
                    if(donnees != null){
                        $('#donnees').html('');
                        $('#resultats_recherche').hide(1);
                        $.each(donnees, function(i, donnee){
                            $('#donnees').append(
                                '<a id="lienResultat" href="http://localhost/Uknow/web/app_dev.php/recherche/' +
                                donnee['domaine_lien'] + '/' + donnee['matiere_lien'] + '/' + donnee['theme_lien'] + '/' + donnee['chapitre_lien'] + '/' + donnee['id'] + '">' +
                                '<div class="blockDonnee"><b>' + donnee.titre + '</b><div class="texteDroite">' + donnee['type'] + ' de ' + donnee['niveau'] + '</div></br>' +
                                '<h5>' + donnee['domaine_nom'] + ' / ' + donnee['matiere_nom'] + ' / ' + donnee['theme_nom'] + ' / ' + donnee['chapitre_nom'] +  '</h5></div></a>');
                        });
                        $('#resultats_recherche').show(500);
                    }else{
                        $('#resultats_recherche').hide(500);
                    }
                },
                error: function() {
                    alert('La requête n\'a pas abouti'); }
            });
        }
    }).focusin(function(){
        $('#resultats_recherche').show(500);
    }).focusout(function(){
        $('#resultats_recherche').hide(500);
    });
});
