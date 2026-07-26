<!-- resources/views/map-simple.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <style>
        body { margin: 0; }
        #map { height: 100vh; width: 100%; }
    </style>
</head>
<body>
    <div id="map"></div>
    <script>
        const params = new URLSearchParams(window.location.search);
        const lat = parseFloat(params.get('lat')) || 11.5;
        const lng = parseFloat(params.get('lng')) || 43.0;
        const zoom = parseInt(params.get('zoom')) || 9;
        
        function initMap() {
            const map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: lat, lng: lng },
                zoom: zoom
            });
            
            new google.maps.Marker({
                position: { lat: {{$lat}}, lng: {{$lng}} },
                map: map,
                animation: google.maps.Animation.DROP
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" async defer></script>
</body>
</html>