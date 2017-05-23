$(document).ready(function(){
    $('.trade').on('click', function(){
        var id = $('.receive').attr('id');
        window.location.href = '/kaarten.php?trade='+id;
    })
});