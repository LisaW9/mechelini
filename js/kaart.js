$(document).ready(function(){
    $('.kaartDiv').on('click', function(){
        var id = $(this).find($('.kaart')).attr('id');
        alert(id);
        window.href='/kaartDetail?id='+id;
    })
});