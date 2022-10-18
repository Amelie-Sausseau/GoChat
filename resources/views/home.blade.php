@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Tableau de bord') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div style="display: flex; align-items: center; gap: 5%; margin-bottom: 1rem;">
                            <img src="{{ asset('storage/uploads/' . Auth::user()->image) }}"
                                style="width:50px; border-radius: 100%;" alt="">
                            <h2>{{ __('Bienvenue') }} {{ Auth::user()->pseudo }} {{ __('!') }}</h2>
                        </div>
                        <a type="button" class="btn btn-outline-secondary"
                            href="{{ route('auth.modify', Auth::user()->id) }}">{{ __('Modifier mes informations') }}</a>
                        <a type="button" class="btn btn-outline-secondary"
                            href="{{ route('password.reset', app()->getLocale()) }}">{{ __('Modifier mon mot de passe') }}</a>
                        @if (is_null(Auth::user()->image))
                            <a type="button" class="btn btn-outline-secondary"
                                href="{{ route('get.fileupload') }}">{{ __('Ajouter une photo de profil') }}</a>
                        @else
                            <a type="button" class="btn btn-outline-secondary"
                                href="{{ route('get.fileupload') }}">{{ __('Modifier ma photo de profil') }}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
