@extends('layouts.app')

@section('content')
    <div class="container">
        @forelse ($booked as $appointment)
            <div class="card mt-2">
                <div class="card-header">{{ $appointment->name }}</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">{{ __('Students applied') }}</th>
                            <th scope="col">{{ __('Start date') }}</th>
                            <th scope="col">{{ __('End date') }}</th>
                            <th scope="col">{{ __('Covid certificate') }}</th>
                            <th scope="col">{{ __('Price') }}</th>
                            <th scope="col">{{ __('Description') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $appointment->student_count }}</td>
                            <td>{{ $appointment->start_time }}</td>
                            <td>{{ $appointment->end_time }}</td>
                            @if ($appointment->certificate_needed === 1)
                                <td> {{ __('Yes') }}</td>
                            @else
                                <td> {{ __('No') }}</td>
                            @endif
                            <td>{{ $appointment->price }}</td>
                            <td>{{ $appointment->description }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @empty
            <div class="card mt-2">
                <div class="card-header">{{ __('You have no booked appointments') }}</div>
                <div class="card-body">
                    {{ __('Nothing to show') }}
                </div>
            </div>
        @endforelse
    </div>
@endsection
