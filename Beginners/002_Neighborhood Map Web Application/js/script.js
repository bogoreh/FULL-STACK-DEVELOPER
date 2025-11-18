let map;
let markers = [];
let infoWindow;

// Initialize Google Map
function initMap() {
    const defaultLocation = { lat: 40.785091, lng: -73.968285 };
    
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
        center: defaultLocation,
        styles: [
            {
                featureType: 'poi',
                elementType: 'labels',
                stylers: [{ visibility: 'on' }]
            }
        ]
    });
    
    infoWindow = new google.maps.InfoWindow();
    
    // Add markers for all locations
    locations.forEach(location => {
        addMarker(location);
    });
    
    // Initialize Google Places Autocomplete
    initAutocomplete();
    
    // Initialize filtering and search
    initFiltering();
}

// Add marker to map
function addMarker(location) {
    const icon = getIconForType(location.type);
    
    const marker = new google.maps.Marker({
        position: { lat: parseFloat(location.lat), lng: parseFloat(location.lng) },
        map: map,
        title: location.name,
        icon: icon
    });
    
    marker.addListener('click', () => {
        const content = `
            <div class="info-window">
                <h3>${location.name}</h3>
                <p><strong>Type:</strong> ${location.type}</p>
                <p><strong>Address:</strong> ${location.address}</p>
                <p><small>Coordinates: ${location.lat}, ${location.lng}</small></p>
            </div>
        `;
        
        infoWindow.setContent(content);
        infoWindow.open(map, marker);
    });
    
    markers.push(marker);
}

// Get appropriate icon for location type
function getIconForType(type) {
    const baseUrl = 'https://maps.google.com/mapfiles/ms/icons/';
    const colorMap = {
        'Restaurant': 'red',
        'Park': 'green',
        'Shopping': 'orange',
        'Hospital': 'red',
        'School': 'purple',
        'Library': 'blue',
        'Sports': 'orange',
        'Community': 'yellow'
    };
    
    const color = colorMap[type] || 'blue';
    return `${baseUrl}${color}-dot.png`;
}

// Initialize Google Places Autocomplete
function initAutocomplete() {
    const autocomplete = new google.maps.places.Autocomplete(
        document.getElementById('autocomplete'),
        { types: ['geocode'] }
    );
    
    autocomplete.addListener('place_changed', () => {
        const place = autocomplete.getPlace();
        
        if (!place.geometry) {
            alert("No details available for input: '" + place.name + "'");
            return;
        }
        
        document.getElementById('lat').value = place.geometry.location.lat();
        document.getElementById('lng').value = place.geometry.location.lng();
    });
}

// Initialize filtering and search functionality
function initFiltering() {
    const filterType = document.getElementById('filterType');
    const searchInput = document.getElementById('searchLocation');
    
    filterType.addEventListener('change', filterLocations);
    searchInput.addEventListener('input', filterLocations);
}

// Filter locations based on type and search term
function filterLocations() {
    const typeFilter = document.getElementById('filterType').value.toLowerCase();
    const searchTerm = document.getElementById('searchLocation').value.toLowerCase();
    
    const locationItems = document.querySelectorAll('.location-item');
    
    locationItems.forEach(item => {
        const itemType = item.getAttribute('data-type').toLowerCase();
        const itemName = item.getAttribute('data-name');
        
        const typeMatch = !typeFilter || itemType === typeFilter;
        const nameMatch = !searchTerm || itemName.includes(searchTerm);
        
        if (typeMatch && nameMatch) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
    
    // Also filter markers on the map
    filterMarkers(typeFilter, searchTerm);
}

// Filter markers on the map
function filterMarkers(typeFilter, searchTerm) {
    markers.forEach(marker => {
        const markerType = marker.getTitle ? getLocationTypeByTitle(marker.getTitle()) : '';
        const markerName = marker.getTitle() ? marker.getTitle().toLowerCase() : '';
        
        const typeMatch = !typeFilter || markerType.toLowerCase() === typeFilter;
        const nameMatch = !searchTerm || markerName.includes(searchTerm);
        
        if (typeMatch && nameMatch) {
            marker.setMap(map);
        } else {
            marker.setMap(null);
        }
    });
}

// Helper function to get location type by title
function getLocationTypeByTitle(title) {
    const location = locations.find(loc => loc.name === title);
    return location ? location.type : '';
}

// Focus on specific location on the map
function focusOnLocation(lat, lng, title) {
    map.setCenter({ lat: parseFloat(lat), lng: parseFloat(lng) });
    map.setZoom(15);
    
    // Find and open info window for the marker
    const marker = markers.find(m => 
        m.getPosition().lat() === parseFloat(lat) && 
        m.getPosition().lng() === parseFloat(lng)
    );
    
    if (marker) {
        google.maps.event.trigger(marker, 'click');
    }
}

// Initialize map when Google Maps API is loaded
google.maps.event.addDomListener(window, 'load', initMap);