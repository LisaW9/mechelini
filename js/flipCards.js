$(document).ready(function () {

    $('.kaartDiv').on('click', function () {
        var time = 0;
        $('.kaartDiv').each(function () {
            var that = $(this);
            setTimeout(function () {
                that.children().css('transform', 'rotateY(-180deg)');
                openCards(that.attr('id'));
            }, time);
            time += 500;
        })
    });
});