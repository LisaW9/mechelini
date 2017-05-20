$(document).ready(function () {

    $('.kaartDiv').on('click', function () {
        var time = 500;
        $('.kaartDiv').each(function () {
            var that = $(this);
            setTimeout(function () {
                that.children().css('transform', 'rotateY(-180deg)');
            }, time);
            time += 500;
        })
    });

});