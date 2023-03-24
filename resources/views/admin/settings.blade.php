@extends('admin.layouts.admin')

@section('title', '')

<!DOCTYPE html>
<title>{{ trans('google-auth::admin.title') }} | {{ site_name() }}</title>

@section('content')
<div class="row">
    <div class="my-3">
        <div class="card shadow mb-0">
            <div class="card-header">
                <h3 class="mb-0">{{ trans('google-auth::admin.header') }}</h3>
            </div>
        </div>
        <div class="my-3">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="card-header">
                        <h4 class="mb-0">{{ trans('google-auth::admin.subtitle') }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('google-auth.admin.settings') }}" method="POST">
                            @csrf
                            {{ trans('google-auth::admin.cloud-google') }} :
                            <a class="m-0 font-weight-bold text-primary" target="_blank" rel="noopener noreferrer" href="https://console.cloud.google.com/">
                                https://console.cloud.google.com/
                            </a>
                            <div class="row my-3">
                                <div class="col-md-2 form-group">
                                    <label for="client_id">{{ trans('google-auth::admin.max_per_ip') }}</label>
                                    <input type="number" min="1" max="10" class="form-control" id="host" placeholder="1" name="max_per_ip" value="{{ $max_per_ip }}" required="required">
                                </div>
                                <div class="col-md-5 form-group">
                                    <label for="client_id">{{ trans('google-auth::admin.client_id') }}</label>
                                    <input class="form-control" id="host" placeholder="client_id" name="client_id" value="{{ $client_id }}" required="required">
                                </div>
                                <div class="col-md-5 form-group">
                                    <label for="client_secret">{{ trans('google-auth::admin.client_secret') }}</label>
                                    <input class="form-control" placeholder="client_secret" type="password" id="client_secret" name="client_secret" value="{{ $client_secret }}" required="required">
                                </div>
                            </div>
                            <div class="my-3">
                                {{ trans('google-auth::admin.uri') }} :
                                <a class="m-0 font-weight-bold text-primary" target="_blank" rel="noopener noreferrer">
                                    {{ url('/google-auth/callback') }}
                                </a>  
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> {{ trans('messages.actions.save') }}
                            </button>
                            <a class="btn btn-primary" target="_blank" href="https://discord.com/invite/G92Ktvb9WD"><i class="bi bi-info-circle"></i> {{ trans('google-auth::admin.support') }}</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection