@extends('layouts.app')

@section('content')
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="https://dummyimage.com/600x700/dee2e6/6c757d.jpg" alt="..."/></div>
                <div class="col-md-6">
                    <h1 class="display-5 fw-bolder">{{ $user->name }}  {{ $user->surname }}</h1>
                    <div class="small mb-1">Age: {{ $user->age }}</div>
                    <div class="small mb-1"><span class="text-decoration-line-through">{{ __('Gender:') }} {{ $user->gender }}</span></div>
                    <div class="small mb-1"><span class="text-decoration-line-through">{{ __('Role:') }} {{ $user->role }}</span></div>
                    <div class="small mb-1"><span class="text-decoration-line-through">{{ __('Description:') }} {{ ($user->description ?? __('Empty')) }}</span></div>
                    @if (Auth::id() === $user->id)
                        <div class="small mb-1"><a href="{{ route('user.edit', ['user' => $user->id]) }}" class="btn btn-primary">{{ __('Edit profile') }}</a></div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
