/**
 * Created by thomas on 19/03/15.
 */

$(function(){
    $('#uknow_platformbundle_recherche_recherche').keyup(function(e){
        if(e.which >= 65 && e.which <= 90 || e.which == 222 || e.which == 8 || e.which == 46){
            var lettres = encodeURIComponent($('#uknow_platformbundle_recherche_recherche').val());
            $.ajax({
                type: 'GET',
                url: 'http://localhost/Uknow/web/app_dev.php/autocompletion?lettres=' + lettres,
                success: function(donnees) {
                    if(donnees != null){
                        $('#resultats_recherche').css('display', 'block');
                        $('#donnees').html('');
                        $.each(donnees, function(i, donnee){
                            $('#donnees').append(
                                '<a id="lienResultat" href="http://localhost/Uknow/web/app_dev.php/recherche/' +
                                donnee.domaineTitre + '/' + donnee.matiereTitre + '/' + donnee.themeTitre + '/' + donnee.chapitreTitre + '">' +
                                '<div class="blockDonnee"><b>' + donnee.titre + '</b><div class="texteDroite">' + donnee.type + ' de ' + donnee.niveau + '</div></br>' +
                                '<h5>' + donnee.domaine + ' / ' + donnee.matiere + ' / ' + donnee.theme + ' / ' + donnee.chapitre + '</h5></div></a>');
                        });
                    }else{
                        $('#resultats_recherche').css('display', 'none');
                    }
                },
                error: function() {
                    alert('La requête n\'a pas abouti'); }
            });
        }
    });
});