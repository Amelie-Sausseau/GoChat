@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                    <h2>Derniers messages postés</h2>
                    <a href="{{ route('posts.create') }}" class="btn btn-dark">Ajouter un Chat</a>
                </div>
                @foreach ($posts as $post)
                    <div class="card text-center" style="margin-bottom: 1rem;">
                        <div class="card-header text-muted">
                            <span class="badge text-bg-info" style="display: flex; width: fit-content;">{{ $post->tags }}</span>
                            <div style="display: flex; align-items: self-end; justify-content: space-between;">
                                <h3 style="text-align: center !important;">{{ $post->titre }}</h3>
                                @if (Auth::user()->id == $post->user_id)
                                    <div style="display: flex; gap: 5%; margin: 1rem 0 0 1rem; max-width: 250px;">
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button style="max-width: 100px;" class="btn btn-danger">X</button>
                                        </form>
                                        <a href="{{ route('posts.edit', $post->id) }}" style="max-width: 100px;"
                                            class="btn btn-warning">Modifier</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <img src="{{ asset('storage/uploads/' . $post->image) }}" class="card-img-top" alt=""
                            style="max-width: 500px; margin: 1rem auto;">
                        <div class="card-body">
                            <p class="card-text">{{ $post->content }}</p>
                            <a href="{{ route('comments.add', $post->id) }}" class="btn btn-dark">Commenter</a>
                        </div>
                        <div class="card-footer text-muted">
                            Publié le {{ $post->created_at->format('d-m-Y à H:i') }} par
                            {{ $post->getAuthor($post->user_id) }}
                        </div>
                    </div>

                    @foreach ($post->getComments($post->id) as $comment)
                        <div class="card text-center" style="margin: 0 auto 1rem auto; max-width: 50%;">
                            <span class="badge text-bg-info" style="display: flex; width: fit-content; margin: 0.5rem 1rem 0 1rem;">{{ $comment->tags }}</span>
                            <div style="display : flex; justify-content: space-between; align-items: center">
                                <p class="card-text" style="padding: 1rem;">{{ $comment->content }}</p>
                                @if (Auth::user()->id == $comment->user_id)
                                    <div style="display: flex; gap: 5%; margin-right: 1rem; max-width: 250px;">
                                        <form action="{{ route('comments.destroy', $comment->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button style="max-width: 100px;" class="btn btn-danger">X</button>
                                        </form>
                                        <a href="{{ route('comments.edit', $comment->id) }}" style="max-width: 100px;"
                                            class="btn btn-warning">Modifier</a>
                                    </div>
                                @endif
                            </div>
                            <img src="{{ asset('storage/uploads/' . $comment->image) }}" class="card-img-top"
                                alt="" style="max-width: 500px; margin: 1rem auto;">
                            <div class="card-footer-dark text-muted">
                                Publié le {{ $comment->created_at }} par {{ $post->getAuthor($comment->user_id) }}
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
@endsection
