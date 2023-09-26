<!DOCTYPE html>
<html>
<head>
    <title>Ma carte</title>
    <!-- Inclure des liens vers les bibliothèques Leaflet CSS et JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
</head>
<body>
   
    <div id="map" style="width: 1650px; height: 600px;"></div>
    <script>
        var map = L.map('map').setView([49.8951, 2.3022], 13); // Coordonnées d'Amiens

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([49.8951, 2.3022]).addTo(map) // Coordonnées d'Amiens
            .bindPopup('Je suis gay .')
            .openPopup();
    </script>
</body>
</html>
