<div>
    <h2>My Map</h2>
    <div id="map"></div>
</div>

@push('messtyles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map { height: 500px; width: 100%; border: 1px solid green; }
    </style>
@endpush
@push('messcripts')
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        /* ---- data from server ---- */
        const locations = @json($locations ?? []);

        /* ---- map ---- */
        const map = L.map('map').setView([11.5, 43.15], 10);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        /* ---- draggable markers (no AJAX) ---- */
        locations.forEach(loc => {
            const marker = L.marker([loc.lat, loc.lng], { draggable: true })
                            .addTo(map)
                            .bindPopup(loc.name);

            marker.on('dragend', function (e) {
                const p = e.target.getLatLng();
                marker.bindPopup(`${loc.name}<br>new: ${p.lat.toFixed(5)}, ${p.lng.toFixed(5)}`).openPopup();
            });
        });

        /* ---- ADD THIS: click handler ---- */
        map.on('click', function(e) {
            const lat = e.latlng.lat;
            const lng = e.latlng.lng;
            const name = prompt('Enter location name:', 'New Location');
            
            if (name && name.trim()) {
                // Call Livewire to save
                @this.call('saveLocation', lat, lng, name);
                
                // Add marker immediately (no page reload)
                const newMarker = L.marker([lat, lng], { draggable: true })
                    .addTo(map)
                    .bindPopup(`${name}<br>${lat.toFixed(5)}, ${lng.toFixed(5)}`);
                
                newMarker.on('dragend', function(e) {
                    const p = e.target.getLatLng();
                    newMarker.bindPopup(`${name}<br>new: ${p.lat.toFixed(5)}, ${p.lng.toFixed(5)}`).openPopup();
                });
                
                newMarker.openPopup();
            }
        });

        /* ---- fix tiles if container was hidden ---- */
        setTimeout(() => map.invalidateSize(), 300);
    </script>
@endpush