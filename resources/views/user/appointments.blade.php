@extends('layouts.app')

@section('content')
    <div class="container">
        @if(Auth::user()->isTeacher())
            <form method="GET" action="{{ route('new.appointment') }}">
                <button type="submit" class="btn btn-primary">{{ __('New appointment') }}</button>
            </form>
        @endif
        @forelse ($appointments as $appointment)
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
                            @if(Auth::user()->isTeacher())
                                <th scope="col">{{ __('Edit') }}</th>
                                <th scope="col">{{ __('Delete') }}</th>
                            @endif
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
                            @if(Auth::user()->isTeacher())
                                <td>
                                    <form method="GET" action="{{ route('edit', ['id' => $appointment->id]) }}">
                                        <button type="submit" class="btn btn-primary">Edit</button>
                                    </form>
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('destroy') }}">
                                        @method('DELETE')
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $appointment->id }}">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @empty
            <div class="card mt-2">
                <div class="card-header">{{ __('You have no appointments') }}</div>
                <div class="card-body">
                    {{ __('Book an appointment to see it here') }}
                </div>
            </div>
        @endforelse
    </div>
@endsection
