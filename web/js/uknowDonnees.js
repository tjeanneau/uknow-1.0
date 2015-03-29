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
    agrandir();
    $('#donneeCache_' + index)
        .hide(1000)
        .css('display', 'none');
    $('#donneeAffiche_' + index)
        .hide(1)
        .css('display', 'block')
        .show(1000);

}

function cacher(index){
    $('#donneeAffiche_' + index)
        .hide(1000)
        .css('display', 'none');
    $('#donneeCache_' + index)
        .hide(1)
        .css('display', 'inline-block').show(1000);
}

function modifier(index){

}

function modification(index){

}

