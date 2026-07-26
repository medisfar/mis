<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location Map</title>
    <style>
        body { margin: 0; padding: 0; }
        #map { height: 100vh; width: 100%; }
    </style>
</head>
<body>
    <div id="map"></div>

    <script>
        // Define variables in the global scope
        let map;
        let markers = [];
        let infoWindow = null; // Single info window is better

        // Define the blue icon ONCE (small version)
        function getBluePin() {
            return {
                path: "M 0 0 C -20 -20 -30 -40 -30 -60 C -30 -80 -10 -100 0 -100 C 10 -100 30 -80 30 -60 C 30 -40 20 -20 0 0 Z",
                fillColor: "#1A73E8",
                fillOpacity: 1,
                strokeColor: "#FFFFFF",
                strokeWeight: 2,
                scale: 0.3,
                
            };
        }

        // Main initialization function
        function initMap() {
            // Create the map
            map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 11.5, lng: 43.0 },
                zoom: 10
            });

            // Create a single info window (better performance)
            infoWindow = new google.maps.InfoWindow();

            // Get locations from Livewire and add markers
            const locations = @json($locations);
            addMarkers(locations);
        }

        // Function to add markers
        function addMarkers(locations) {
            // Clear existing markers
            markers.forEach(marker => marker.setMap(null));
            markers = [];

            if (!locations || locations.length === 0) {
                return;
            }

            const bluePin = getBluePin();

            locations.forEach(loc => {
                const position = { 
                    lat: parseFloat(loc.lat), 
                    lng: parseFloat(loc.lng) 
                };

                const marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    title: loc.name || 'Location',
                    icon: {
                    url: 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png'
                },
                    
                    animation: google.maps.Animation.DROP
                });

                // Info Window content
                const content = `
                    <div style="padding: 10px; max-width: 200px;">
                        <strong style="font-size: 14px;">${loc.name || 'Unnamed'}</strong>
                        <br>
                        <span style="color: #666;">Budget: ${loc.budget || 'N/A'}</span>
                    </div>
                `;

                // Click listener
                marker.addListener('click', function() {
                    infoWindow.setContent(content);
                    infoWindow.open(map, marker);
                });

                // Make draggable
                marker.setDraggable(true);

                // Drag event
                marker.addListener('dragend', function(e) {
                    const newLat = e.latLng.lat();
                    const newLng = e.latLng.lng();
                    
                    // Call Livewire method
                    @this.updateLocation(loc.id, newLat, newLng);
                });

                markers.push(marker);
            });
        }

        // Listen for Livewire events
        document.addEventListener('livewire:initialized', function() {
            // This fires when Livewire is ready
        });

        // When Livewire updates the locations
        document.addEventListener('livewire:updated', function() {
            // Reload markers with fresh data
            const locations = @json($locations);
            addMarkers(locations);
        });

        // Custom event for new location added
        document.addEventListener('locationAdded', function(event) {
            const loc = event.detail;
            
            if (!loc) return;

            const position = { 
                lat: parseFloat(loc.lat), 
                lng: parseFloat(loc.lng) 
            };

            const bluePin = getBluePin();

            const marker = new google.maps.Marker({
                position: position,
                map: map,
                title: loc.name || 'New Location',
                icon: bluePin,
                animation: google.maps.Animation.DROP
            });

            const content = `
                <div style="padding: 10px; max-width: 200px;">
                    <strong style="font-size: 14px;">${loc.name || 'Unnamed'}</strong>
                    <br>
                    <span style="color: #666;">Budget: ${loc.budget || 'N/A'}</span>
                </div>
            `;

            marker.addListener('click', function() {
                infoWindow.setContent(content);
                infoWindow.open(map, marker);
            });

            markers.push(marker);
        });

        // Handle the case where the API loads but initMap doesn't get called
        if (typeof google !== 'undefined' && google.maps) {
            // If the API is already loaded
            if (document.readyState === 'complete') {
                initMap();
            }
        }
    </script>

    <!-- Load Google Maps API -->
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap&loading=async" async defer>
    </script>

    <!-- Fallback in case the callback fails -->
    <script>
        // If initMap wasn't called after 5 seconds, try again
        setTimeout(function() {
            if (typeof map === 'undefined' || !map) {
                console.log('Retrying map initialization...');
                if (typeof google !== 'undefined' && google.maps) {
                    initMap();
                }
            }
        }, 5000);
    </script>
</body>
</html>