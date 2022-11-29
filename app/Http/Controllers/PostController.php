<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("posts.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = Auth::user()->id;

        $this->validate($request, [
            'message' => 'required',
            'titre' => 'string',
            'image' => 'nullable|mimes:png,gif,jpg,jpeg|max:4000',
            'tags' => 'string',
        ]);

        // 2. On upload l'image
        $fileName = $request->image->getClientOriginalName();
        $filePath = 'uploads/' . $fileName;

        $path = Storage::disk('public')->put($filePath, file_get_contents($request->image));
        $path = Storage::disk('public')->url($path);

        // 3. On enregistre les informations du Post
        Post::create([
            'content' => $request->message,
            'titre' => $request->titre,
            'image' => $fileName,
            'tags' => $request->tags,
            'user_id' => $userId,
        ]);

        return back()
            ->with('success', 'Chat ajouté !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::getPost($id);

        $this->authorize('update', $post);
       
        return view("posts.edit", ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $updatedPost = Post::findOrFail($id);

        $userId = Auth::user()->id;

        $this->validate($request, [
            'message' => 'required',
            'titre' => 'string',
            'image' => 'nullable|mimes:png,gif,jpg,jpeg|max:4000',
            'tags' => 'string',
        ]);

        if ($request->image) {

        $fileName = $request->image->getClientOriginalName();
        $filePath = 'uploads/' . $fileName;

        $path = Storage::disk('public')->put($filePath, file_get_contents($request->image));
        $path = Storage::disk('public')->url($path);

        $updatedPost->update([
            'image' => $fileName,
        ]);
        }

        $updatedPost->update([
            'content' => $request->message,
            'titre' => $request->titre,
            'tags' => $request->tags,
            'user_id' => $userId,
        ]);

        return back()
            ->with('success', 'Modifications enregistrées');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $this->authorize('delete', $post);

        if (Auth::user()->id == $post->user_id) {
            DB::delete('delete from posts where id = ?', [$id]);

            return redirect()->route('home')
                ->with('success', 'Chat supprimé !');
        }
        else {
            return redirect()->route('home')
                ->with('message', 'Vous n\'avez pas les droits!');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchResult(Request $request)
    {
        $request->validate([
            'search' => 'required',
        ]);

        $search = $request->input('search');

        $post = Post::where('posts.tags', 'LIKE', "%$search%")
            ->orWhere('posts.content', 'LIKE', "%$search%")
            ->with('user', 'comments.user')
            ->latest()->paginate(10);

        return view("posts.search", ['posts' => $post, 'search' => $search]);
    }


}
