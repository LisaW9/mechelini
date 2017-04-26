



$(document).ready(function(){

    $('.register').on("click", function(event){
        event.preventDefault();
        $(this).animate({
            width: '100vw',
            height: '100vh',
            left: '0',
            top: '0',
            margin: '0'
        }, 500);
        setTimeout(function () {
            window.location.href = "../home.php";
        }, 500);

    })

})