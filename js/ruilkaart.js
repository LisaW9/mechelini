$(document).ready(function(){
    $('.ruilkaart').on('click', function(){
        var id = $(this).attr('id');
        window.location.href =  '/ruilen.php?receive='+id;
    })
});