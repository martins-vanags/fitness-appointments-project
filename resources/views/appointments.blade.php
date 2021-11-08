@extends('layouts.app')

@section('content')
    @forelse ($appointments as $appointment)
        <div class="container">
            <div class="card mt-2">
                <div class="card-header">{{ $appointment->name }}</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">{{ __('Location') }}</th>
                            <th scope="col">{{ __('Price') }}</th>
                            <th scope="col">{{ __('More information') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $appointment->latitude }} {{ $appointment->longitude }} {{ __('Will reverse geo code this to display Location name') }}</td>
                            <td>{{ $appointment->price }}</td>
                            <td>
                                <form>
                                    <button type="submit" class="btn btn-primary">{{ __('More information') }}</button>
                                </form>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @empty
                <div class="card mt-2">
                    <div class="card-header">{{ __('No appointments') }}</div>
                    <div class="card-body">
                        {{ __('If someone creates an appointment it will be displayed here') }}
                    </div>
                </div>
            @endforelse
            {{ $appointments->links() }}
        </div>
@endsection
