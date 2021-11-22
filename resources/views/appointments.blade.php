@extends('layouts.app')

@section('content')
    <!-- Page content-->
    <div class="container py-4">
        <div class="row">
            <!-- Blog entries-->
            <div class="col">
                <!-- Nested row for non-featured blog posts-->
                <div class="row">
                    <div class="col">
                        <!-- Blog post-->
                        @forelse ($appointments as $appointment)
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div
                                        class="small text-muted">{{ \Carbon\Carbon::parse($appointment->start_time)->format('F jS, H:m') }}</div>
                                    <h2 class="card-title h4">{{ $appointment->name }}</h2>
                                    <p class="card-text">{{ __('Price ') }} {{ $appointment->price }} €</p>

                                    @if ($appointment->start_time <= now())
                                        <a class="btn btn-primary" disabled>{{ __('Appointment already happened') }}</a>
                                    @else
                                    <a class="btn btn-primary" href="{{ route('appointment.show', ['appointment' => $appointment]) }}">{{ __('Show more') }}</a>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="small text-muted">{{ now() }}</div>
                                    <h2 class="card-title h4">{{ __('No appointments found') }}</h2>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
                <nav aria-label="Pagination">
                    <hr class="my-0"/>
                    <ul class="pagination justify-content-center my-4">
                        {{ $appointments->links() }}
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection
