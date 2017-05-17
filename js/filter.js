$(document).ready(function () {
    //Kaarten ophalen
    filter('time');

    //Filter functies
    var open = false;
    $('.first').hide();
    $('.second').hide();

    $('.filter').on('click', function () {
        if (open) {
            $(this).addClass('active');
            var i = 'first';
            $('.filter').not($('.active')).each(function () {
                $(this).addClass(i);
                i = 'second';
            });

            $('.filter').animate({
                right: '10px'
            }, 500, function () {
                $('.first').hide();
                $('.second').hide();
            });

            if ($(this).hasClass('amount')) {
                filter('amount');
            } else if ($(this).hasClass('abc')) {
                filter('abc');
            } else if ($(this).hasClass('time')) {
                filter('time');
            }

            open = !open;
        } else {
            $('.first').show();
            $('.second').show();

            $('.first').animate({
                right: '120px'
            }, 500);
            $('.second').animate({
                right: '65px'
            }, 500);

            $(this).removeClass('active');
            $('.first').removeClass('first');
            $('.second').removeClass('second');
            open = !open;
        }

    });

    // AJAX functie
    function filter(filter) {
        $.post('ajax/filter.php', {'filter': filter}, function (data) {
            $(".kaarten").children().remove();
            $(".kaarten").append(data); //append data into #results element
        });
    }
});