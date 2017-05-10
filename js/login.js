
$(document).ready(function(){

    $('.register').on("click", function(event){
        event.preventDefault();
        $(this).animate({
            width: '100vw',
            height: '100vh',
            left: '0',
            top: '0',
            margin: '0',
            easing: easeInOutBack
        }, 200);
        window.location.href = "/register.php";

    });

    $('.register-login').on("click", function(event){
        event.preventDefault();
        $(this).animate({
            width: '100vw',
            height: '100vh',
            left: '0',
            top: '0',
            margin: '0',
            easing: easeInOutBack
        }, 200);
        window.location.href = "/index.php";

    })

});


