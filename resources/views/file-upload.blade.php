@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                @if (is_null(Auth::user()->image))
                    <h2>Ajouter une photo de profil</h2>
                @else
                    <h2>Modifier ma photo de profil</h2>
                @endif
            </div>


            <form action="{{ route('store.file') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <input type="file" name="file" class="form-control" />
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-dark">Valider</button>
                    </div>
                </div>
            </form>
            @if (Auth::user()->image)
                <h3 style="margin-top: 2rem">Photo de profil actuelle</h3>
                <img src="{{ asset('storage/uploads/' . Auth::user()->image) }}" alt="">
            @endif

        </div>
        <a type="button" class="btn btn-outline-secondary" style="margin-top: 2rem"
            href="{{ route('home') }}">{{ __('Retour') }}</a>
    </div>
@endsection
