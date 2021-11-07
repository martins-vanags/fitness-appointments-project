@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Profile') }}</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">
                                {{ __('Name') }}
                            </label>

                            <div class="col-md-6">
                                <input id="name"
                                       type="text"
                                       class="form-control"
                                       name="name">
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
                                       name="surname">
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
                                    <option value="male" selected>{{__('Male')}} </option>
                                    <option value="female"> {{__('Female')}} </option>
                                    <option value="other"> {{__('Other')}} </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="age"
                                   class="col-md-4 col-form-label text-md-right">
                                {{ __('Age') }}
                            </label>

                            <div class="col-md-6">
                                <input type="number" class="form-control" name="age" min="0" max="99">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role"
                                   class="col-md-4 col-form-label text-md-right">
                                {{ __('Role') }}
                            </label>

                            <div class="col-md-6">
                                <input id="surname"
                                       type="text"
                                       class="form-control"
                                       name="role">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description"
                                   class="col-md-4 col-form-label text-md-right">
                                {{ __('Description') }}
                            </label>

                            <div class="col-md-6">
                                <textarea class="form-control" name="user-description"></textarea>
                            </div>
                        </div>

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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
