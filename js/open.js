$(document).ready(function () {
    $.post('ajax/cards.php', {'openCards': 'true'}, function (data) {
        $(".kaarten").append(data);
    });

});