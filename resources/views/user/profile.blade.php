@extends('layouts.app')

@section('content')
    <section class="py-5">
        <div class="container">
                <div class="card mx-auto">
                    <div class="card-body">
                        <h5 class="card-title">{{ $user->name }} {{ $user->surname }}
                            <h6 class="card-subtitle mb-2 text-muted">{{ __('Age:') }} {{ $user->age ?? __('unknown') }}</h6>
                            <h6 class="card-subtitle mb-2 text-muted">{{ __('Gender:') }} {{ $user->gender ?? __('unknown') }}</h6>
                            <h6 class="card-subtitle mb-2 text-muted">{{ __('Joined:') }} {{ $user->created_at }}</h6>
                        <p class="card-text">{{ $user->description }}</p>
                        @if (Auth::id() === $user->id)<a href="{{ route('user.edit', $user) }}" class="btn btn-primary">{{ __('Edit profile') }}</a>@endif
                    </div>
                </div>
            </div>
    </section>
@endsection
