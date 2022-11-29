<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
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
    public function create($id)
    {
        $post = Post::getPost($id);
        return view("comments.add", ['post' => $post]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $userId = Auth::user()->id;
        $post = Post::findOrFail($id);

        $this->validate($request, [
            'message' => 'required',
            'image' => 'nullable|mimes:png,gif,jpg,jpeg|max:4000',
            'tags' => 'string',
        ]);

        // 2. On upload l'image
        if ($request->image) {
            $fileName = $request->image->getClientOriginalName();
            $filePath = 'uploads/' . $fileName;

            $path = Storage::disk('public')->put($filePath, file_get_contents($request->image));
            $path = Storage::disk('public')->url($path);

            // 3. On enregistre les informations du Comment
            Comment::create([
                'content' => $request->message,
                'image' => $fileName,
                'tags' => $request->tags,
                'user_id' => $userId,
                'post_id' => $post->id,
            ]);
        }

        else {
            Comment::create([
                'content' => $request->message,
                'tags' => $request->tags,
                'user_id' => $userId,
                'post_id' => $post->id,
            ]);
        }

        


        return back()
            ->with('success', 'Commentaire ajouté !');
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
        $comment = Comment::getComment($id);

        $this->authorize('update', $comment);

        return view("comments.edit", ['comment' => $comment]);
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
        $updatedComment = Comment::findOrFail($id);

        $this->authorize('update', $updatedComment);

        $userId = Auth::user()->id;

        $this->validate($request, [
            'message' => 'required',
            'image' => 'nullable|mimes:png,gif,jpg,jpeg|max:4000',
            'tags' => 'string',
        ]);

        if ($request->image) {

        $fileName = $request->image->getClientOriginalName();
        $filePath = 'uploads/' . $fileName;

        $path = Storage::disk('public')->put($filePath, file_get_contents($request->image));
        $path = Storage::disk('public')->url($path);

        $updatedComment->update([
            'image' => $fileName,
        ]);
        }

        $updatedComment->update([
            'content' => $request->message,
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
        $comment = Comment::findOrFail($id);

        $this->authorize('delete', $comment);

        if (Auth::user()->id == $comment->user_id || Auth::user()->id == isAdmin()) {
            DB::delete('delete from comments where id = ?', [$id]);

            return redirect()->route('home')
                ->with('success', 'Commentaire supprimé !');
        }
        else {
            return redirect()->route('home')
                ->with('message', 'Vous n\'avez pas les droits!');
        }
    }
}
