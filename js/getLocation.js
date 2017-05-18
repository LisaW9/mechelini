$(document).ready(function () {
    var compareLat = 51.02470267;
    var compareLon = 4.48420393;
    var latitude;
    var longitude;

    navigator.geolocation.getCurrentPosition(function (position) {
        latitude = position.coords.latitude;
        longitude = position.coords.longitude;

        console.log(latitude);
        console.log(longitude);

        if (compareLat == latitude && compareLon == longitude) {
            alert('Je bent in de Gym!!');
        } else {
            alert('Begeef je naar de Gym om kaarten te ontvangen');
        }
    });
});