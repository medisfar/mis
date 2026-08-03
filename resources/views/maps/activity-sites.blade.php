<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Carte des sites</title>
    <style>
        html, body, #activity-sites-map { width: 100%; height: 100%; margin: 0; }
        .empty-map { display: flex; align-items: center; justify-content: center; height: 100%; color: #64748b; font-family: Arial, sans-serif; }
    </style>
</head>
<body>
    <div id="activity-sites-map"></div>
    <script>
        const locations = @json($locations);

        function initActivitySitesMap() {
            const container = document.getElementById('activity-sites-map');

            if (!locations.length) {
                container.innerHTML = '<div class="empty-map">Aucun site avec des coordonnées GPS valides.</div>';
                return;
            }

            const map = new google.maps.Map(container, {
                center: { lat: locations[0].lat, lng: locations[0].lng },
                zoom: 13,
                mapTypeId: google.maps.MapTypeId.HYBRID,
                streetViewControl: false
            });
            const bounds = new google.maps.LatLngBounds();
            const infoWindow = new google.maps.InfoWindow();

            locations.forEach((location) => {
                const position = { lat: location.lat, lng: location.lng };
                const marker = new google.maps.Marker({ position, map, title: location.name });
                bounds.extend(position);

                marker.addListener('click', () => {
                    const content = document.createElement('div');
                    const name = document.createElement('strong');
                    name.textContent = location.name;
                    content.appendChild(name);

                    if (location.locality) {
                        const locality = document.createElement('div');
                        locality.textContent = location.locality;
                        content.appendChild(locality);
                    }

                    const coordinates = document.createElement('small');
                    coordinates.textContent = `${location.lat}, ${location.lng}`;
                    content.appendChild(coordinates);
                    infoWindow.setContent(content);
                    infoWindow.open({ map, anchor: marker });
                });
            });

            if (locations.length === 1) {
                map.setCenter(bounds.getCenter());
                map.setZoom(15);
            } else {
                map.fitBounds(bounds, 45);
            }
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initActivitySitesMap&loading=async" async defer></script>
</body>
</html>
