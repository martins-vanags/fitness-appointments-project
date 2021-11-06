@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card mt-2">
            <div class="card-header">{{ __('New appointment') }}</div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('create') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name"
                               class="form-label">
                            {{ __('Name') }}
                        </label>
                        <input type="text"
                               class="form-control"
                               id="name"
                               name="name"
                               required>
                    </div>
                    <div class="mb-3">
                        <label for="location"
                               class="form-label">
                            {{ __('Location') }}
                        </label>
                        <input type="text"
                               class="form-control"
                               id="location"
                               readonly
                               placeholder="TODO: Google maps api. Pass lat/lng values">
                        <input type="hidden" name="lat" value="">
                        <input type="hidden" name="lng" value="">
                    </div>
                    <div class="mb-3">
                        <label for="number-of-students"
                               class="form-label">
                            {{ __('Maximum number of students') }}
                        </label>
                        <input type="number"
                               class="form-control"
                               id="number-of-students"
                               name="number-of-students"
                               min="0"
                               max="999"
                               required>
                    </div>
                    <div class="mb-3">
                        <label for="appointment-start-time"
                               class="form-label">
                            {{ __('Start time') }}
                        </label>
                        <input type="datetime-local"
                               class="form-control"
                               id="appointment-start-time"
                               name="start-time"
                               required>
                    </div>
                    <div class="mb-3">
                        <label for="appointment-end-time"
                               class="form-label">
                            {{ __('End time') }}
                        </label>
                        <input type="datetime-local"
                               class="form-control"
                               id="appointment-end-time"
                               name="end-time"
                               required>
                    </div>
                    <div class="mb-3">
                        <label for="price"
                               class="form-label">
                            {{ __('Price in euro') }}
                        </label>
                        <input type="number"
                               class="form-control"
                               id="price"
                               min="0"
                               step="any"
                               name="price"
                               required>
                    </div>
                    <div class="mb-3">
                        <label for="description"
                               class="form-label">
                            {{ __('Description') }}
                        </label>
                        <textarea class="form-control"
                                  id="description"
                                  aria-describedby="description"
                                  name="description">
                        </textarea>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox"
                               class="form-check-input"
                               id="require-certificate"
                               name="require-certificate">
                        <label class="form-check-label"
                               for="require-certificate">
                            {{ __('Require covid-19 certificate') }}
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection

