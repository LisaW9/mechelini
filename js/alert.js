$(document).ready(function () {
    var alertDiv = $('.alert');
    alertDiv.animate({
        bottom: '0'
    }, 1000).delay(500);

    $('.open').on('click', function () {
        window.location.href = '/open.php';
    });

    $('.close').on('click', function () {
        alertDiv.animate({
            bottom: '-15vh'
        }, 1000, function () {
            alertDiv.hide();
        });
    })
});