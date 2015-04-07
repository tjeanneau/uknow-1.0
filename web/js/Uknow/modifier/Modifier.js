/**
 * Created by thomas on 30/03/15.
 */

$(function(){
    $(document).ready(function(){
        var marge =  $('.breadcrumb').css('height');
        $('#marge').css('margin-top', marge);
        $('#colButton').css('height', marge);
        if($('#ajoutFooter').val() == 1)
        {
            $('#footer').css('display', 'none');
        }
        var posenfant = $('#footer').offset();
        if( posenfant.top < $(window).height() + 54){
            $('#footer').css('bottom', '0');
        }
        if(posenfant.top < $('#content').height() + 54){
            $('#footer').css('top', $('#content').height()+70);
        }
    });
    $('button').tooltip({ placement:'bottom', delay: { show: 400, hide: 200 } });
});

