/**
 * Created by thomas on 19/03/15.
 */

$(function(){
    $('#uknow_platformbundle_recherche_recherche').keypress(function(c){
        $.ajax({
            type: 'GET',
            url: './autocompletion',
            success: function(donnees) {

                $('#resultats_recherche').css('display', 'block');

                $.each(donnees, function(i, donnee){
                    $('#donnees').append('<div class="blockDonnee"><b>' + donnee.titre + '</b>' +
                    '<div class="texteDroite">' + donnee.type + ' de ' + donnee.niveau + '</div></br><h5>'
                    + donnee.domaine + ' / ' + donnee.matiere + ' / ' + donnee.theme + ' / ' + donnee.chapitre + '</h5></div>');
                })










            },
            error: function() {
                alert('La requête n\'a pas abouti'); }
        });
    });
});