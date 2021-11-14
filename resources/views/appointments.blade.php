@extends('layouts.app')

@section('content')
    <!-- Page content-->
    <div class="container py-4">
        <div class="row">
            <!-- Blog entries-->
            <div class="col-lg-8">
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
                                    <a class="btn btn-primary"
                                       href="{{ route('show', ['id' => $appointment->id]) }}">{{ __('Show more') }}</a>
                                </div>
                            </div>
                        @empty
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="small text-muted">{{ now() }}</div>
                                    <h2 class="card-title h4">{{ __('No appointments found') }}</h2>
                                    <p class="card-text">{{ __('Appointment information') }}</p>
                                    <a class="btn btn-primary" href="#!">{{ __('Show more') }}</a>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
                <!-- Pagination-->
                <nav aria-label="Pagination">
                    <hr class="my-0"/>
                    <ul class="pagination justify-content-center my-4">
                        {{ $appointments->links() }}
                    </ul>
                </nav>
            </div>
            <!-- Side widgets-->
            <div class="col-lg-4">
                <!-- Categories widget-->
                <div class="card mb-4">
                    <div class="card-header">Categories</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <ul class="list-unstyled mb-0">
                                    <li><a href="#!">Powerlifting</a></li>
                                    <li><a href="#!">Weightlifting</a></li>
                                    <li><a href="#!">Crossfit</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <ul class="list-unstyled mb-0">
                                    <li><a href="#!">Online</a></li>
                                    <li><a href="#!">Individual</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
