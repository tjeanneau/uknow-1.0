/**
 * Created by thomas on 29/03/15.
 */

function agrandir(){
    $('#header').hide(1000);
    $('#question').hide(1000);
    $('#affichage').animate({'margin-top': '0'}, 1000);
    $('#colCours').attr('class','col-md-12');
    $('#colLien').attr('class','col-md-11');
    $('#colButton').attr('class','col-md-offset-11 col-md-1');
    $('#agrandir')
        .html('')
        .append('<span class="glyphicon glyphicon-resize-small"></span>')
        .attr('onclick','diminuer()');
}

function diminuer(){
    $('#header').show(1000);
    $('#question').show(1000);
    $('#affichage').animate({'margin-top': '54'}, 1000);
    $('#colCours').attr('class','col-md-9');
    $('#colLien').attr('class','col-md-8');
    $('#colButton').attr('class','col-md-offset-8 col-md-1');
    $('#agrandir')
        .html('')
        .append('<span class="glyphicon glyphicon-resize-full"></span>')
        .attr('onclick','agrandir()');
}

function afficher(index){
    $('#donneeCache_' + index)
        .hide(1000);
    $('#donneeAffiche_' + index)
        .show(1000);
}

function cacher(index){
    $('#donneeAffiche_' + index)
        .hide(1000);
    $('#donneeCache_' + index)
        .show(1000);
}

function enregistrer(id, index){
    $.ajax({
        type: 'POST',
        url: 'http://localhost/Uknow/web/app_dev.php/ajax/enregistrement',
        data: 'id=' + id,
        error: function() {
            alert('La requête n\'a pas abouti.');
        }
    });
    if(index != null){
        $('#enregistrer' + index)
            .html('')
            .append('<span class="glyphicon glyphicon-floppy-saved"></span>')
            .attr('onclick','');
    }else{
        $('#boutonEnregistrer')
            .html('')
            .append('<span class="glyphicon glyphicon-floppy-saved"></span>')
            .attr('onclick','');
    }
}

function supprimer(id, index){
    $.ajax({
        type: 'POST',
        url: 'http://localhost/Uknow/web/app_dev.php/ajax/suppression',
        data: 'id=' + id,
        error: function() {
            alert('La requête n\'a pas abouti.');
        }
    });
    if(index != null){
        $('#donneeAffiche_' + index)
            .hide(1000);
        $('#donneeCache_' + index)
            .hide(1000);
    }else{
        $(location).attr('href',"http://localhost/Uknow/web/app_dev.php/cartable/cours");
    }

}
