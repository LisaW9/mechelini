$(document).ready(function () {
    var compareLat = 51.024684;
    var compareLon = 4.484692;
    var latitude;
    var longitude;

    navigator.geolocation.getCurrentPosition(function (position) {
        latitude = position.coords.latitude.toFixed(6);
        longitude = position.coords.longitude.toFixed(6);
        console.log(compareLat + ", " + compareLon);
        console.log(latitude + ", " + longitude);
console.log(Math.abs(compareLat - latitude).toFixed(6));
        // TEST -> MOET WEG !!

        if (Math.abs(compareLat - latitude).toFixed(6) < 0.001 && Math.abs(compareLon - longitude).toFixed(6) < 0.001) {
            alert('Je bent in de Gym!!');
            $.post("ajax/location.php", function (data) {
                alert(data);
            });
        } else {
            alert('Begeef je naar de Gym om kaarten te ontvangen');
        }
    });
});