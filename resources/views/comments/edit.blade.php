@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="background-color: #1987543b;">{{ __('Modifier un commentaire') }}</div>

                    <div class="card-body">
                        <form action="{{ route('comments.update', $comment->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div class="row mb-3">
                                <label for="image"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Ajouter une photo') }}</label>
                                <div class="col-md-6">
                                    <input type="file" name="image" class="form-control" />
                                </div>
                            </div>

                            @if ($comment->image)
                                <div style="display: flex; flex-direction: column; align-items: center; margin: 1rem">
                                    <p>Image actuelle :</p>
                                    <img src="{{ asset('storage/uploads/' . $comment->image) }}" class="card-img-top"
                                        alt="" style="max-width: 200px;">
                                    <p>{{ $comment->image }}</p>
                                </div>
                            @endif

                            <div class="row mb-3">
                                <label for="message"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Votre commentaire') }}</label>

                                <div class="col-md-6">
                                    <textarea id="message" type="text" rows="4" class="form-control @error('message') is-invalid @enderror"
                                        name="message" required autocomplete="content"> {{ $comment->content }} </textarea>

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
                                        autocomplete="tags" value="{{ $comment->tags }}">

                                    @error('tags')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Enregistrer') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <a type="button" class="btn btn-outline-success" style="margin-top: 2rem"
                    href="{{ route('home') }}">{{ __('Retour') }}</a>
            </div>
        </div>
    </div>
@endsection
