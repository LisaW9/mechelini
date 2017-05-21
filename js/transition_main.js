$(document).ready(function () {
    var alertDiv = $('.alert');
    alertDiv.css('bottom', '-15vh');
    alertDiv.hide();

    $(".menu_button_profile").click(function () {
        console.log("button click");
        //noinspection JSJQueryEfficiency
        $(".menu_button_profile").animate({
            zIndex: '99'
        });
        //noinspection JSJQueryEfficiency
        $(".menu_button_profile").animate({
            transition: "0.3s",
            width: '100%',
            height: '100vh'
        });
        $(".menu_button_profile p").animate({
            transition: '0.3s',
            opacity: '0'
        });
        setTimeout(function () {
            window.location.href = "/profile.php";
        }, 1000);
    });

    $(".menu_button_cards").click(function () {
        console.log("button click");
        //noinspection JSJQueryEfficiency
        $(".menu_button_cards").animate({
            zIndex: '99'
        });
        //noinspection JSJQueryEfficiency
        $(".menu_button_cards").animate({
            transition: "0.3s",
            width: '100%',
            height: '100vh',
            marginTop: '0',
            marginLeft: '0'
        });
        $(".menu_button_cards p").animate({
            transition: '0.3s',
            opacity: '0'
        });
        setTimeout(function () {
            window.location.href = "/kaarten.php";
        }, 1000);
    });

    $(".menu_button_trade").click(function () {
        console.log("button click");
        //noinspection JSJQueryEfficiency
        $(".menu_button_trade").animate({
            zIndex: '99'
        });
        //noinspection JSJQueryEfficiency
        $(".menu_button_trade").animate({
            transition: "0.3s",
            marginTop: '0',
            width: '100%',
            height: '100vh'
        });
        $(".menu_button_trade p").animate({
            transition: '0.3s',
            opacity: '0'
        });
        setTimeout(function () {
            window.location.pathname = "/ruilplaza.php";
        }, 1000);
    });

    $(".menu_button_progress").click(function () {
        console.log("button click");
        //noinspection JSJQueryEfficiency
        $(".menu_button_progress").animate({
            zIndex: '99'
        });
        //noinspection JSJQueryEfficiency
        $(".menu_button_progress").animate({
            transition: "0.3s",
            width: '100%',
            height: '100vh',
            marginTop: '0',
            marginLeft: '0'
        });
        $(".menu_button_progress p").animate({
            transition: '0.3s',
            opacity: '0'
        });
        setTimeout(function () {
            window.location.href = "";
        }, 1000);
    });

    $(".menu_button_friends").click(function () {
        console.log("button click");
        //noinspection JSJQueryEfficiency
        $(".menu_button_friends").animate({
            zIndex: '99'
        });
        //noinspection JSJQueryEfficiency
        $(".menu_button_friends").animate({
            transition: "0.3s",
            width: '100%',
            height: '100vh',
            marginTop: '0',
            marginLeft: '0'
        });
        $(".menu_button_friends p").animate({
            transition: '0.3s',
            opacity: '0'
        });
        setTimeout(function () {
            window.location.href = "";
        }, 1000);
    });

    $(".menu_button_logout").click(function () {
        console.log("button click");
        //noinspection JSJQueryEfficiency
        $(".menu_button_logout").animate({
            zIndex: '99'
        });
        //noinspection JSJQueryEfficiency
        $(".menu_button_logout").animate({
            transition: "0.3s",
            width: '100%',
            height: '100vh',
            marginTop: '0',
            marginLeft: '0'
        });
        $(".menu_button_logout p").animate({
            transition: '0.3s',
            opacity: '0'
        });
        setTimeout(function () {
            window.location.href = "";
        }, 1000);
    });
});