$(document).ready(function(){
    var alertDiv = $('.alert');
    alertDiv.css('bottom', '-15vh');
    alertDiv.hide();

    $('.trade').on('click', function(){
        var id = $('.receive').attr('id');
        window.location.href = '/kaarten.php?trade='+id;
    })
});