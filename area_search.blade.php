
function: initMap
docstring: This function creates a Google map on the web page with the given markers and sets the appropriate options and zoom level. It also adds info windows to each marker and centers the map to fit all the markers on the screen.
purpose: This functionality is used to display a map on a web page and add interactive markers to it. It can be used in various software development projects that require the integration of Google Maps.var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
		center: { lat: markers[0][1], lng: markers[0][2] },
        mapTypeId: 'roadmap',
		zoom: 2,
		streetViewControl: true,
    };
                    
    // Display a map on the web page
    map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);
    //map.setTilt(50);
	
	
    // Add multiple markers to map
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    
    // Place each marker on the map  
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
            title: markers[i][0]
        });
        
        // Add info window to marker    
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(markers[i][0]);
                infoWindow.open(map, marker);
            }
        })(marker, i));

        // Center the map to fit all markers on the screen
        map.fitBounds(bounds);
    }

    // Set zoom level
    // var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
    //     this.setZoom(14);
    //     google.maps.event.removeListener(boundsListener);
    // });
}

window.initMap = initMap;
</script>
@endsection
