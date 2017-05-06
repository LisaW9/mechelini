$(document).ready(function () {
    $(".back").click(function () {
        console.log("button click");
        //noinspection JSJQueryEfficiency
        $(".header").animate({
            zIndex: '1000',
            height: '100vh'
        });
        //noinspection JSJQueryEfficiency
        $(".back").animate({
            transition: "0.3s",
            opacity: 0
        });
        $(".header h1").animate({
            transition: '0.3s',
            opacity: '0'
        });
        setTimeout(function () {
            window.location.pathname = "/mechelini";
        }, 1000);
    });
});