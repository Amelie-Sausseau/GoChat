@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="margin-bottom: 1.5rem;">
                    <div class="card-body" style="display: flex; align-items: center;">
                        <img src="{{ asset('storage/uploads/' . $post->image) }}" class="card-img-top" alt=""
                            style="max-width: 100px; margin: 1rem auto;">
                        <div class="card-body">
                            <h5 class="card-text">{{ $post->titre }}</h5>
                            <p class="card-text">{{ $post->content }}</p>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">{{ __('Ajouter un commentaire au Chat de ' . $post->getAuthor($post->user_id) ) }}</div>
                    <div class="card-body">
                        <form action="{{ route('comments.store', $post->id) }}" enctype="multipart/form-data" method="post">
                            @csrf
                            @method('post')

                            <div class="row mb-3">
                                <label for="image"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Ajouter une photo') }}</label>
                                <div class="col-md-6">
                                    <input type="file" name="image" class="form-control" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="message"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Votre commentaire') }}</label>

                                <div class="col-md-6">
                                    <textarea id="message" type="text" rows="4" class="form-control @error('message') is-invalid @enderror"
                                        name="message" required autocomplete="message" autofocus></textarea>

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
                                        {{ __('Ajouter') }}
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
