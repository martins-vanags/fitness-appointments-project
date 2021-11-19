@extends('layouts.app')

@section('content')
    <style>
        .controls {
            margin-top: 9px;
            border: 1px solid transparent;
            border-radius: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            height: 40px;
            width: 300px;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }
    </style>
    <div class="container">
        <div class="card mt-2">
            <div class="card-header">{{ __('New appointment') }}</div>
            <div class="card-body">
                <form action="{{ route('appointment.store') }}" method="POST" onkeydown="return event.key !== 'Enter';">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">{{ __('Location') }}</label>
                        <figure class="mb-4">
                            <input id="pac-input" class="controls" type="text" name="location">
                            <div id="map" class="img-fluid" style="height: 400px; width: 1200px"></div>
                        </figure>
                        <input type="hidden" name="latitude" id="latitude" required>
                        <input type="hidden" name="longitude" id="longitude" required>
                    </div>
                    <div class="mb-3">
                        <label for="number-of-students" class="form-label">{{ __('Maximum number of students') }}</label>
                        <input type="number" class="form-control" id="number-of-students" name="student_count" min="0" max="999" required>
                    </div>
                    <div class="mb-3">
                        <label for="appointment-start-time" class="form-label">{{ __('Start time') }}</label>
                        <input type="datetime-local" class="form-control" id="appointment-start-time" name="start_time" required>
                    </div>
                    <div class="mb-3">
                        <label for="appointment-end-time" class="form-label">{{ __('End time') }}</label>
                        <input type="datetime-local" class="form-control" id="appointment-end-time" name="end_time" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">{{ __('Price in euro') }}</label>
                        <input type="number" class="form-control" id="price" min="0" step="any" name="price" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">{{ __('Description') }}</label>
                        <textarea class="form-control" id="description" aria-describedby="description" name="description"></textarea>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="certificate_needed" name="certificate_needed">
                        <label class="form-check-label" for="certificate_needed">{{ __('Require covid-19 certificate') }}</label>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function initAutocomplete() {
            const map = new google.maps.Map(document.getElementById("map"), {
                center: {lat: 56.94629, lng: 24.10508},
                zoom: 7,
                mapTypeId: "roadmap",
            });
            // Create the search box and link it to the UI element.
            const input = document.getElementById("pac-input");
            const searchBox = new google.maps.places.SearchBox(input);

            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
            // Bias the SearchBox results towards current map's viewport.
            map.addListener("bounds_changed", () => {
                searchBox.setBounds(map.getBounds());
                middlePoint = map.getCenter();
                document.getElementById('latitude').value = middlePoint.lat();
                document.getElementById('longitude').value = middlePoint.lng();
            });

            let markers = [];

            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener("places_changed", () => {
                const places = searchBox.getPlaces();

                if (places.length === 0) {
                    return;
                }

                // Clear out the old markers.
                markers.forEach((marker) => {
                    marker.setMap(null);
                });
                markers = [];

                // For each place, get the icon, name and location.
                const bounds = new google.maps.LatLngBounds();

                places.forEach((place) => {
                    if (!place.geometry || !place.geometry.location) {
                        console.log("Returned place contains no geometry");
                        return;
                    }

                    const icon = {
                        url: place.icon,
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(25, 25),
                    };

                    // Create a marker for each place.
                    markers.push(
                        new google.maps.Marker({
                            map,
                            icon,
                            title: place.name,
                            position: place.geometry.location,
                        })
                    );
                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });
        }
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDb8QAZaP5cQhU8jp6LRbj9tx80L95ezGM&callback=initAutocomplete&libraries=places&v=weekly&channel=2"
        async>
    </script>
@endsection


