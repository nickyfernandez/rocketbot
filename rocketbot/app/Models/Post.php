<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function comments(){
    return $this->hasMany(Comment::class,'id_post');
  }

    public function user(){
      return $this->belongsTo(User::class,'id_user');
    }

    public function scopeSearch($query, $id_post){
      return $query->where('id', '=', $id_post);
    }
}
