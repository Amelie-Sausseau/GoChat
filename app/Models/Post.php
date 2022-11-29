<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

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

    // je charge automatiquement l'utilisateur à chaque fois que je récupère un message
    protected $with = ['user'];


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

    public static function formatDate($date) {
        return Carbon::parse($date)->format('d-m-Y à H:i');
    }

}
