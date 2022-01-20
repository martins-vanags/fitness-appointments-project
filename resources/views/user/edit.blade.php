@extends('layouts.app')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="card mx-auto">
                <div class="card-body">
                    <form method="POST" action="{{ route('user.update', $user) }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label ">{{ __('Name') }}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}">
                            @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('Surname') }}</label>
                            <input type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ $user->surname }}">
                            @error('surname')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('Gender') }}</label>
                            <select class="form-control @error('gender') is-invalid @enderror" name="gender">
                                <option value="Male">{{ __('Male') }}</option>
                                <option value="Female">{{ __('Female') }}</option>
                                <option value="Other">{{ __('Other') }}</option>
                            </select>
                            @error('gender')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('Age') }}</label>
                            <input type="number" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ $user->age }}" min="1" max="99">
                            @error('age')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('Description') }}</label>
                            <div class="form-floating">
                                <textarea class="form-control @error('description') is-invalid @enderror" maxlength="254" name="description">{{ $user->description }}</textarea>
                                @error('description')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Save changes') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
