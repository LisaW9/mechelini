$(document).ready(function(){
    $('.kaartDiv').on('click', function(){
        var id = $(this).find($('.kaart')).attr('id');
        window.location.href =  '/kaartDetail.php?card='+id;
    })
});