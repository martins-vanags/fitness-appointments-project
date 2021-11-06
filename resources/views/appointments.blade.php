@extends('layouts.app')

@section('content')
    <div class="container text-center">
        @for($i = 0; $i < 15; $i++)
            {{ __('Appointment ') }} {{ $i }}  <br>
        @endfor
    </div>
@endsection
