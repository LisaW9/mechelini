$(document).ready(function () {
    var compareLat = 51.02470267;
    var compareLon = 4.48420393;
    var latitude;
    var longitude;

    navigator.geolocation.getCurrentPosition(function (position) {
        latitude = position.coords.latitude;
        longitude = position.coords.longitude;

        // TEST -> MOET WEG !!
        latitude = compareLat;
        longitude = compareLon;

        if (compareLat == latitude && compareLon == longitude) {
            alert('Je bent in de Gym!!');
            $.post( "ajax/location.php", function( data ) {
                alert(data);
            });
        } else {
            alert('Begeef je naar de Gym om kaarten te ontvangen');
        }
    });
});