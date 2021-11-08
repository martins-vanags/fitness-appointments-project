@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Profile') }}</div>
                    <form method="POST" action="{{ route('update.profile') }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">
                                    {{ __('Name') }}
                                </label>

                                <div class="col-md-6">
                                    <input id="name"
                                           type="text"
                                           class="form-control"
                                           name="name"
                                           value="{{ $user->name }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="surname"
                                       class="col-md-4 col-form-label text-md-right">
                                    {{ __('Surname') }}
                                </label>

                                <div class="col-md-6">
                                    <input id="surname"
                                           type="text"
                                           class="form-control"
                                           name="surname"
                                           value="{{ $user->surname }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="gender"
                                       class="col-md-4 col-form-label text-md-right">
                                    {{ __('Gender') }}
                                </label>

                                <div class="col-md-6">
                                    <select id="gender"
                                            name="gender"
                                            aria-label="gender"
                                            class="form-control">
                                        <option
                                            value="male" {{ $user->gender === 'male' ? 'selected' : ' ' }}>{{__('Male')}} </option>
                                        <option
                                            value="female" {{ $user->gender === 'female' ? 'selected' : ' ' }}> {{__('Female')}} </option>
                                        <option
                                            value="other" {{ $user->gender === 'other' ? 'selected' : ' ' }}> {{__('Other')}} </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="age"
                                       class="col-md-4 col-form-label text-md-right">
                                    {{ __('Age') }}
                                </label>

                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="age" min="0" max="99"
                                           value="{{ $user->age }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description"
                                       class="col-md-4 col-form-label text-md-right">
                                    {{ __('Description') }}
                                </label>

                                <div class="col-md-6">
                                    <textarea class="form-control"
                                              name="description"> {{ $user->description }}</textarea>
                                </div>
                            </div>

                            @if (Auth()->user()->id = request('id'))
                                <div class="form-group row">
                                    <label for="description"
                                           class="col-md-4 col-form-label text-md-right">
                                        {{ __('Update information') }}
                                    </label>

                                    <div class="col-md-6">
                                        <button type="submit" class="form-control btn btn-primary">
                                            {{ __('Update') }}
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
