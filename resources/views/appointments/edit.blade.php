@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card mt-2">
            <div class="card-header">{{ __('Edit appointment') }}</div>
            <div class="card-body">
                <form action="{{ route('appointment.update', ['appointment' => $appointment]) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $appointment->name }}">
                    </div>
                    <div class="mb-3">
                        <figure class="mb-4">
                            <div id="map" class="img-fluid" style="height: 400px; width: 1200px"></div>
                        </figure>
                    </div>
                    <div class="mb-3">
                        <label for="number-of-students" class="form-label">{{ __('Maximum number of students') }}</label>
                        <input type="number" class="form-control" id="number-of-students" name="student_count" min="0" max="999" value="{{ $appointment->student_count }}">
                    </div>
                    <div class="mb-3">
                        <label for="appointment-start-time" class="form-label">{{ __('Start time') }}</label>
                        <input type="datetime-local" class="form-control" id="appointment-start-time" name="start_time" value="{{ Carbon\Carbon::parse($appointment->start_time)->format('Y-m-d\TH:i') }}">
                    </div>
                    <div class="mb-3">
                        <label for="appointment-end-time" class="form-label">{{ __('End time') }}</label>
                        <input type="datetime-local" class="form-control" id="appointment-end-time" name="end_time" value="{{ Carbon\Carbon::parse($appointment->end_time)->format('Y-m-d\TH:i') }}">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">{{ __('Price in euro') }}</label>
                        <input type="number" class="form-control" id="price" min="0" step="any" name="price" value="{{ $appointment->price }}">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">{{ __('Description') }}</label>
                        <textarea class="form-control" id="description" aria-describedby="description" name="description">{{ $appointment->description }}</textarea>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="certificate_needed" name="certificate_needed" @if ($appointment->certificate_needed === 1) checked @endif>
                        <label class="form-check-label" for="certificate_needed">{{ __('Require covid-19 certificate') }}</label>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function initMap() {
            const marker = @json($coordinates)

            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 14,
                center: marker,
            });

            addMarker(marker, map);
        }

        function addMarker(location, map) {
            new google.maps.Marker({
                position: location,
                map,
            });
        }
    </script>

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDb8QAZaP5cQhU8jp6LRbj9tx80L95ezGM&callback=initMap&libraries=&v=weekly"
        async></script>
@endsection
