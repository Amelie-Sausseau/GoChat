<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    
    protected $fillable = ['content','tags', 'image', 'user_id', 'post_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function post() {
        return $this->belongsTo(Post::class);
    }

    
    /**
     * Get a comment
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function getComment($id) {
        $comment = Comment::findOrFail($id);
        return $comment;
    }
}
