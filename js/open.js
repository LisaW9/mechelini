$(document).ready(function(){
    openCards();

    // AJAX functie
    function openCards() {
        $.post('ajax/cards.php', {'openCards': 'true'}, function (data) {
            $(".kaarten").append(data);
        });
    }
});