@extends('layouts.app')

@section('content')
    <style>
        #map {
            height: 200px;
            width: 300px;
        }
    </style>
    <div class="container">
        <div class="row g-5">
            <div class="col-md-5 col-lg-4 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary">{{ __('Location') }}</span>
                </h4>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <div id="map"></div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-md-7 col-lg-8">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input type="text" class="form-control" id="name" placeholder=""
                               value="{{ $appointment->name }}" readonly>
                    </div>

                    <div class="col-sm-6">
                        <label for="price" class="form-label">{{ __('Price') }}</label>
                        <input type="number" class="form-control" id="price" placeholder=""
                               value="{{ $appointment->price }}" readonly>
                    </div>

                    <div class="col-sm-6">
                        <label for="start_time" class="form-label">{{ __('Start time') }}</label>
                        <input type="text" class="form-control" id="start_time" placeholder=""
                               value="{{ $appointment->start_time }}" readonly>
                    </div>

                    <div class="col-sm-6">
                        <label for="end_time" class="form-label">{{ __('End time') }}</label>
                        <input type="text" class="form-control" id="end_time" placeholder=""
                               value="{{ $appointment->end_time }}" readonly>
                    </div>

                    <div class="col-12">
                        <label for="description" class="form-label">{{ __('Description') }}</label>
                        <textarea class="form-control" readonly rows="5">{{ $appointment->description }}</textarea>
                    </div>
                </div>

                <div class="form-check mt-2">
                    <input type="checkbox" class="form-check-input" id="certificate_needed"
                           @if ($appointment->certificate_needed === 1) checked @endif>
                    <label class="form-check-label" for="certificate_needed">{{ __('Covid certificate') }}</label>
                </div>


                <hr class="my-4">

                <h4 class="mb-3">{{ __('Payment') }}</h4>

                <div class="my-3">
                    <div class="form-check">
                        <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked>
                        <label class="form-check-label" for="credit">{{ __('Credit card') }}</label>
                    </div>
                    <div class="form-check">
                        <input id="debit" name="paymentMethod" type="radio" class="form-check-input">
                        <label class="form-check-label" for="debit">{{ __('Debit card') }}</label>
                    </div>
                    <div class="form-check">
                        <input id="paypal" name="paymentMethod" type="radio" class="form-check-input">
                        <label class="form-check-label" for="paypal">{{ __('PayPal') }}</label>
                    </div>
                </div>

                <div class="row gy-3">
                    <div class="col-md-6">
                        <label for="cc-name" class="form-label">{{ __('Name on card') }}</label>
                        <input type="text" class="form-control" id="cc-name" placeholder="">
                        <small class="text-muted">{{ __('Full name as displayed on card') }}</small>
                    </div>

                    <div class="col-md-6">
                        <label for="cc-number" class="form-label">{{ __('Credit card number') }}</label>
                        <input type="text" class="form-control" id="cc-number" placeholder="">
                    </div>

                    <div class="col-md-3">
                        <label for="cc-expiration" class="form-label">{{ __('Expiration') }}</label>
                        <input type="text" class="form-control" id="cc-expiration" placeholder="">
                    </div>

                    <div class="col-md-3">
                        <label for="cc-cvv" class="form-label">{{ __('CVV') }}</label>
                        <input type="text" class="form-control" id="cc-cvv" placeholder="">
                    </div>
                </div>

                <hr class="my-4">

                <button class="w-100 btn btn-primary btn-lg" type="submit">{{ __('Continue to checkout') }}</button>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        function initMap() {
            const marker = @json($latLng)
            
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 10,
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

    <script src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap&libraries=&v=weekly" async></script>
@endsection
