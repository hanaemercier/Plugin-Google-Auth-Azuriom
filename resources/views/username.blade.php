@extends('layouts.app')

@section('title', trans('auth.register'))

@section('content')
    <div class="container content">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ trans('google-auth::messages.register-username') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('google-auth.register-username') }}" id="captcha-form">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ trans('auth.name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            @include('elements.captcha', ['center' => true])

                            <div class="form-group row mb-0 my-3">
                                <div class="col-md-6 offset-md-4">
                                    <a class="btn btn-primary" href="/">{{ trans('google-auth::messages.keep-google-username') }}</a>
                                    <button type="submit" class="btn btn-primary">
                                        {{ trans('auth.register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection