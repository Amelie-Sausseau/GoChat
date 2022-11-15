<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = ['content','tags', 'titre', 'image', 'user_id', 'post_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get a post author pseudo
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getAuthor($id) {
        $author = User::findOrFail($id);
        return $author->pseudo;
    }

    /**
     * Get a post
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function getPost($id) {
        $post = Post::findOrFail($id);
        return $post;
    }

    /**
     * Get a comment
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function getComments($id) {
        $comment = DB::select('select * from comments where post_id = ?', [$id]);

        return $comment;
    }

}
