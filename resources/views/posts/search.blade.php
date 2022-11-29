@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('home') }}" class="btn btn-dark" style="margin-bottom: 1.5rem;">Retour aux Chats</a>
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if ($posts->count()>0)
                    <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                        <h2>Résultats de recherche pour "{{ $search }}" : {{ $posts->count() }}</h2>
                    </div>
                @endif
                @foreach ($posts as $post)
                    <div class="card text-center" style="margin-bottom: 1rem;">
                        <div class="card-header text-muted" style="background-color: #1987543b;">
                            <span class="badge text-bg-info"
                                style="display: flex; width: fit-content;">{{ $post->tags }}</span>
                            <div style="display: flex; align-items: self-end; justify-content: space-between;">
                                <h3 style="text-align: center !important;">{{ $post->titre }}</h3>
                                <div style="display: flex; gap: 5%; margin: 1rem 0 0 1rem; max-width: 250px;">
                                    @can('update', $post)
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button style="max-width: 100px;" class="btn btn-danger">X</button>
                                        </form>
                                    @endcan
                                    @can('delete', $post)
                                        <a href="{{ route('posts.edit', $post->id) }}" style="max-width: 100px;"
                                            class="btn btn-dark">Modifier</a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                        <img src="{{ asset('storage/uploads/' . $post->image) }}" class="card-img-top" alt=""
                            style="max-width: 500px; margin: 1rem auto;">
                        <div class="card-body">
                            <p class="card-text">{{ $post->content }}</p>
                            <p style="font-weight: bold;">{{ count($post->getComments($post->id)) }} commentaires</p>
                            <a href="{{ route('comments.add', $post->id) }}" class="btn btn-dark">Commenter</a>
                        </div>
                        <div class="card-footer text-muted">
                            Publié le {{ $post->formatDate($post->created_at) }} par
                            {{ $post->user->pseudo }}
                        </div>
                    </div>

                    @foreach ($post->getComments($post->id) as $comment)
                        <div class="card text-center" style="margin: 0 auto 1rem auto; max-width: 50%;">
                            <span class="badge text-bg-info"
                                style="display: flex; width: fit-content; margin: 0.5rem 1rem 0 1rem;">{{ $comment->tags }}</span>
                            <div style="display : flex; justify-content: space-between; align-items: center">
                                <p class="card-text" style="padding: 1rem;">{{ $comment->content }}</p>

                                <div style="display: flex; gap: 5%; margin-right: 1rem; max-width: 250px;">
                                    @can('delete', $comment)
                                        <form action="{{ route('comments.destroy', $comment->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button style="max-width: 100px;" class="btn btn-danger">X</button>
                                        </form>
                                    @endcan
                                    @can('update', $comment)
                                        <a href="{{ route('comments.edit', $comment->id) }}" style="max-width: 100px;"
                                            class="btn btn-dark">Modifier</a>+
                                    @endcan
                                </div>
                            </div>
                            <img src="{{ asset('storage/uploads/' . $comment->image) }}" class="card-img-top"
                                alt="" style="max-width: 500px; margin: 1rem auto;">
                            <div class="card-footer-dark text-muted">
                                Publié le {{ $post->formatDate($comment->created_at) }} par
                                {{ $post->user->pseudo }}
                            </div>
                        </div>
                    @endforeach
                @endforeach
                <div class="col-md-2 offset-md-5">
                    {{ $posts->links() }}
                </div>
                @if ($posts->count() == 0)
                <div class="card text-center" style="margin-bottom: 1rem;">
                    <h2>Aucun résultat pour "{{ $search }}"</h2>
                    <img src="/storage/uploads/GoChat2.png" width="250px" style="margin-left: auto; margin-right: auto;" alt="">
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
