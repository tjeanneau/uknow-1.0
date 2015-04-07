/**
 * Created by thomas on 29/03/15.
 */

$(function (){
    $('a').tooltip({ placement:'bottom' });
});

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
    $('#colCours').attr('class','col-md-offset-2 col-md-8');
    $('#colLien').attr('class','col-md-11');
    $('#colButton').attr('class','col-md-offset-11 col-md-1');
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

function afficherCorrection(index){
    $('#correctionDonnee_' + index).show(1000);
    $('#boutonCorrection_' + index)
        .attr('onclick', 'cacherCorrection(' + index + ')')
        .attr('data-toggle', 'tooltip')
        .html('<span class="glyphicon glyphicon-check"></span>');
}

function cacherCorrection(index){
    $('#correctionDonnee_' + index).hide(1000);
    $('#boutonCorrection_' + index)
        .attr('onclick','afficherCorrection(' + index + ')')
        .attr('data-toggle', 'tooltip')
        .html('<span class="glyphicon glyphicon-unchecked"></span>');
}

function enregistrer(id, index){
    $.ajax({
        type: 'GET',
        url: 'http://localhost/Uknow/web/app_dev.php/ajax/enregistrement',
        data: 'id=' + id,
        success: function(list){
            if(list != null) {
                $('#lienNav').html('').append('<li class="dropdown-header"> Cartable</li><li><a ' +
                'href="http://localhost/Uknow/web/app_dev.php/cartable/cours">Cours</a></li><li><a ' +
                'href="http://localhost/Uknow/web/app_dev.php/cartable/exercices">Exercices</a></li><li ' +
                'class="divider"></li><li class="dropdown-header" id="matiereNav"> Matières</li>');
                $.each(list['matiere'], function (i, donnee) {
                    $('#lienNav').append('<li><a href="http://localhost/Uknow/web/app_dev.php/cartable/' + donnee['lien'] + '">' + donnee['nom'] + '</a></li>');
                });
                $('#lienNav').append('<li class="dropdown-header" id="niveauNav"> Niveaux</li>');
                $.each(list['niveau'], function (i, donnee) {
                    $('#lienNav').append('<li><a href="http://localhost/Uknow/web/app_dev.php/cartable/' + donnee['lien'] + '">' + donnee['nom'] + '</a></li>');
                })
            }
        },
        error: function() {
            alert('La requête n\'a pas abouti.');
        }
    });
    if(index != null){
        $('#enregistrerCacher' + index)
            .html('')
            .append('<span class="glyphicon glyphicon-floppy-saved"></span>')
            .attr('onclick','');
        $('#enregistrerAfficher' + index)
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
        type: 'GET',
        url: 'http://localhost/Uknow/web/app_dev.php/ajax/suppression',
        data: 'id=' + id,
        success: function(list){
            if(list != null) {
                $('#lienNav').html('').append('<li class="dropdown-header"> Cartable</li><li><a ' +
                'href="http://localhost/Uknow/web/app_dev.php/cartable/cours">Cours</a></li><li><a ' +
                'href="http://localhost/Uknow/web/app_dev.php/cartable/exercices">Exercices</a></li><li ' +
                'class="divider"></li><li class="dropdown-header" id="matiereNav"> Matières</li>');
                $.each(list['matiere'], function (i, donnee) {
                    $('#lienNav').append('<li><a href="http://localhost/Uknow/web/app_dev.php/cartable/' + donnee['lien'] + '">' + donnee['nom'] + '</a></li>');
                });
                $('#lienNav').append('<li class="dropdown-header" id="niveauNav"> Niveaux</li>');
                $.each(list['niveau'], function (i, donnee) {
                    $('#lienNav').append('<li><a href="http://localhost/Uknow/web/app_dev.php/cartable/' + donnee['lien'] + '">' + donnee['nom'] + '</a></li>');
                })
            }
        },
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

function evaluation(id, type, nb, index){
    $.ajax({
        type: 'GET',
        url: 'http://localhost/Uknow/web/app_dev.php/ajax/evaluation',
        data: 'id=' + id + '&type=' + type,
        success: function(){
            if(type == 'inutile'){
                $('#inutileAfficher_' + index).html('').append('<span class="glyphicon glyphicon-ok"></span> Inadéquat ' +
                '<span style="background-color: #ffffff; color:#d9534f" class="badge">' + (nb + 1) +'</span></button>');
                $('#inutile_' + index).html(nb + 1);

            }else if(type == 'developper'){
                $('#developperAfficher_' + index).html('').append('<span class="glyphicon glyphicon-ok"></span> A développer ' +
                '<span style="background-color: #ffffff; color:#f0ad4e" class="badge">' + (nb + 1) +'</span></button>');
                $('#developper_' + index).html(nb + 1);
            }else if(type == 'pertinent'){
                $('#pertinentAfficher_' + index).html('').append('<span class="glyphicon glyphicon-ok"></span> Pertinent ' +
                '<span style="background-color: #ffffff; color:#5cb85c" class="badge">' + (nb + 1) +'</span></button>');
                $('#pertinent_' + index).html(nb + 1);
            }
            $('#inutileAfficher_' + index).attr('onclick','');
            $('#developperAfficher_' + index).attr('onclick','');
            $('#pertinentAfficher_' + index).attr('onclick','');
        },
        error: function() {
            alert('La requête n\'a pas abouti.');
        }
    });
}
