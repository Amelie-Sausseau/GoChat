@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Créer un Chat') }}</div>

                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('posts.store') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="image"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Ajouter une photo') }}</label>
                                <div class="col-md-6">
                                    <input type="file" name="image" class="form-control" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="titre"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Titre de votre Chat') }}</label>

                                <div class="col-md-6">
                                    <input id="titre" type="text"
                                    class="form-control @error('titre') is-invalid @enderror" name="titre" required
                                    autocomplete="titre">

                                    @error('titre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="message"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Votre Chat') }}</label>

                                <div class="col-md-6">
                                    <textarea id="message" type="text" rows="4"
                                        class="form-control @error('message') is-invalid @enderror" name="message" required
                                        autocomplete="message" autofocus></textarea>

                                    @error('message')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="tags"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Catégorie') }}</label>

                                <div class="col-md-6">
                                    <input id="tags" type="text"
                                        class="form-control @error('tags') is-invalid @enderror" name="tags" required
                                        autocomplete="tags">

                                    @error('tags')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-dark">
                                        {{ __('Enregistrer') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <a type="button" class="btn btn-outline-secondary" style="margin-top: 2rem"
                    href="{{ route('home') }}">{{ __('Retour') }}</a>
            </div>
        </div>
    </div>
@endsection
