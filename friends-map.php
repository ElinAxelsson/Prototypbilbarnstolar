<?php
session_start();

// Om användaren inte är inloggad, omdirigera till login-sidan
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vänner på Karta</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=DIN_API_NYCKEL&callback=initMap" async defer></script>
    <script>
        let map;
        let markers = [];
        const friends = [
            { name: 'Anna', lat: 59.3293, lng: 18.0686 },  // Exempel på vänner med lat/lng (Stockholm)
            { name: 'Erik', lat: 57.7089, lng: 11.9746 },  // Göteborg
            { name: 'Sara', lat: 55.60498, lng: 13.0038 }  // Malmö
        ];

        // Initiera kartan
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 59.3293, lng: 18.0686 }, // Startposition, Stockholm
                zoom: 6
            });

            // Lägg till markörer för varje vän
            friends.forEach(friend => {
                const marker = new google.maps.Marker({
                    position: { lat: friend.lat, lng: friend.lng },
                    map: map,
                    title: friend.name
                });

                // Lägg till en infofönster för varje markör
                const infoWindow = new google.maps.InfoWindow({
                    content: `<h3>${friend.name}</h3><p>Lat: ${friend.lat}, Lng: ${friend.lng}</p>`
                });

                marker.addListener('click', function() {
                    infoWindow.open(map, marker);
                });

                markers.push(marker);
            });
        }
    </script>
</head>
<body>
    <h1>Vänner på Karta</h1>
    <button onclick="window.location.href='logout.php'">Logga ut</button>
    <div id="map" style="height: 500px; margin-top: 20px;"></div>
</body>
</html>
