
Function Name: initAutocomplete
Docstring: This function initializes the autocomplete search box and adds a marker with an info window for the selected location on the Google Maps. It also includes options for geocode search and country restrictions.
Purpose: The purpose of this functionality is to provide a user-friendly and efficient way for users to search for locations and display them on the map. This is useful in software development for creating interactive maps and location-based features. const map = new google.maps.Map(document.getElementById("map"), {
		center: myLatLng,
		zoom: 13,
		mapTypeId: "roadmap",
	});

	var options = {
		types: ['geocode'],
		componentRestrictions: {country: "in"},
		streetViewControl: true,
	};
	// Create the search box and link it to the UI element.
	const input = document.getElementById("autocomplete");
	const searchBox = new google.maps.places.SearchBox(input, options);

	//map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
	// Bias the SearchBox results towards current map's viewport.
	map.addListener("bounds_changed", () => {
		searchBox.setBounds(map.getBounds());
	});

	let markers = [];

	// Add info window
	const infowindow = new google.maps.InfoWindow({
		content: "{{ $data['title'] }}"
	});

	// The marker, positioned at selected location
	const marker = new google.maps.Marker({
		position: myLatLng,
		map: map,
		title: "{{ $data['title'] }}"
	});

	// Marker click event: open info window
	google.maps.event.addListener(marker, 'click', function() {
		infowindow.open(map, marker);
	});

	infowindow.open(map, marker);
}

window.initAutocomplete = initAutocomplete;

</script>
@endsection
