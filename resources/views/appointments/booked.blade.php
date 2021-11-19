@extends('layouts.app')

@section('content')
    @forelse ($appointments as $appointment)
        <section class="py-5">
            <div class="container px-5 my-5">
                <div class="row gx-5">
                    <div class="col-lg-3">
                        <div class="d-flex align-items-center mt-lg-5 mb-4">
                            <div class="ms-3">
                                <div class="fw-bold">{{ __('Appointment length') }}</div>
                                <div
                                    class="text-muted">{{ \Carbon\Carbon::parse( $appointment->start_time )->diffInHours( $appointment->end_time ) }} {{ __('Hour(s)') }}</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mt-lg-5 mb-4">
                            <div class="ms-3">
                                <div class="fw-bold">{{ __('Require covid certificate?') }}</div>
                                <div
                                    class="text-muted">@if ($appointment->certificate = 1) {{ __('Yes') }} @else {{ __('No') }} @endif</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <article>
                            <header class="mb-4">
                                <h1 class="fw-bolder mb-1">{{ $appointment->name }}</h1>
                                <div
                                    class="text-muted fst-italic mb-2">{{ \Carbon\Carbon::parse($appointment->start_time)->format('F jS, H:m') }}</div>
                            </header>
                            <figure class="mb-4">
                                <div id="map" class="img-fluid" style="height: 400px; width: 900px"></div>
                            </figure>
                            <section class="mb-5">
                                <p class="fs-5 mb-4"></p>
                                <h2 class="fw-bolder mb-4 mt-5">{{ __('Description') }}</h2>
                                <p class="fs-5 mb-4">{{ $appointment->description }}</p>
                            </section>
                        </article>
                        <!-- Pagination-->
                        <nav aria-label="Pagination">
                            <hr class="my-0"/>
                            <ul class="pagination justify-content-center my-4">
                                {{ $appointments->links() }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
    @empty
        <header class="py-5">
            <div class="container px-5">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-xxl-6">
                        <div class="text-center my-5">
                            <h1 class="fw-bolder mb-3">{{ __('You have no booked appointments') }}</h1>
                            <p class="lead fw-normal text-muted mb-4">{{ __('Book an appointment to view it here') }}</p>
                            <a class="btn btn-primary btn-lg" href="{{ route('appointments') }}">{{ __('Book appointment') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    @endforelse
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

