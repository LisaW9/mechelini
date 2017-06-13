$(document).ready(function () {
    var compareLat = 51.044201;
    var compareLon = 4.492044;
    var latitude;
    var longitude;

    navigator.geolocation.getCurrentPosition(function (position) {
        latitude = position.coords.latitude.toFixed(6);
        longitude = position.coords.longitude.toFixed(6);
        console.log(Math.abs(compareLat - latitude).toFixed(6));

        if (Math.abs(compareLat - latitude).toFixed(6) <= 0.005 && Math.abs(compareLon - longitude).toFixed(6) <= 0.005) {
            $.post("ajax/location.php", function (data) {
                console.log(data);
            });
        }
    });
});