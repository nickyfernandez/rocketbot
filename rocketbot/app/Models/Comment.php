<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

  public function post(){
    return $this->belongsTo(Post::class,'id_post');
  }
  public function scopeSearch($query, $id_post){
    return $query->where('id', '=', $id_post);
  }
}
