$(document).ready(function(){
    $('.kaartDiv').on('click', function(){
        var id = $(this).find($('.kaart')).attr('id');
        if($(this).parent().hasClass('trading')){
            var trade = $(this).parent().attr('id');
            window.location.href =  '/ruilen.php?trade='+id+'&receive='+trade;
        } else{
            window.location.href =  '/kaartDetail.php?card='+id;
        }
    })
});