$(document).ready(function () {
    $('.close').on('click', function () {
        window.location.href = '/kaarten.php';
    });

    $('.tradeBtn').on('click', function () {
        var that = $(this);
        var id = that.attr('id');
        var array;
        var trade;
        if (that.hasClass('tradeFalse')) {
            trade = 'true';
        } else if (that.hasClass('tradeTrue')) {
            trade = 'false';
        }
        $.post('ajax/cards.php', {'trade': trade, 'id': id}, function (data) {
            array = JSON.parse(data);
            that.removeClass(array[0]);
            that.addClass(array[1]);
            that.text(array[2]);
        });
    });
});