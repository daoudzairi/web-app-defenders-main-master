<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    protected $fillable = ['title', 'slug' ,'description', 'image_path', 'user_id' ];
    use HasFactory;
   

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function likes(){
        return $this->hasMany(Likes::class);
    }

    public function LikedBy(User $user){
        return $this->likes->contains('user_id', $user->id);
    }
}
