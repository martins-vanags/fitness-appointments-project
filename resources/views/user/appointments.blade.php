@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="mb-2">
            <a class="btn btn-primary" href="{{ route('appointment.create') }}">{{ __('New appointment') }}</a>
        </div>
        <div class="row">
            <div class="col">
                <div class="row">
                    <div class="col">
                        @foreach($appointments as $appointment)
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="small text-muted">{{ \Carbon\Carbon::parse($appointment->start_time)->format('F jS, H:m') }}</div>

                                    <h2 class="card-title h4">{{ $appointment->name }}</h2>

                                    <p class="card-text">{{ __('Price ') }} {{ $appointment->price }} €</p>

                                    <a class="btn btn-primary" href="{{ route('appointment.show', ['appointment' => $appointment->id]) }}">{{ __('Show more') }}</a>

                                    <a class="btn btn-secondary" href="{{ route('appointment.edit', ['appointment' => $appointment->id]) }}">{{ __('Edit') }}</a>

                                    <form method="POST" action="{{ route('appointment.destroy', ['appointment' => $appointment->id]) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
