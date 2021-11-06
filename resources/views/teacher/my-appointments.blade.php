@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('create.appointment') }}">
            @csrf
            <button type="submit" class="btn btn-primary">{{ __('New appointment') }}</button>
        </form>
        <div class="card mt-2">
            <div class="card-header">{{ __('My appointments') }}</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                {{ __('User ') }} {{ Auth::user()->id }} {{ __('appointments goes here') }}
            </div>
        </div>
    </div>
@endsection
