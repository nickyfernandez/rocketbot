<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auth;
use App\Post;
use App\Comment;
use App\User;

class PostController extends Controller
{
  public function createPost(Request $req){

    $nuevoPost = new Post();
    $nuevoPost->post = $req["post"];
    $nuevoPost->id_user = Auth::user();
    $nuevoPost->save();
    return view('home');
  }

  public function createComment(Request $req, $id){

    $nuevoComment = new Comment();
    $nuevoComment->comment = $req["comment"];
    $nuevoComment->id_post = $id;
    $nuevoComment->save();
    return view('home');
  }

  public function seePost($id){
        $id_post = $id;
        $postElegido = Post::Search($id_post->id)->first();
        $postComments = $postElegido->comments()->get();
      return view('detalle')->with('postElegido', $postElegido)->with('postComments', $postComments);
  }

  public function seeAllPosts(){
      $todosPosts = Post::all();
      foreach ($todosPosts as $post) {
        $id_post = $post->id;
        $postElegido = Post::Search($id_post->id)->first();
        $postComments = $postElegido->comments()->get();
        
      }
      return view('todos')->with('todosPosts', $todosPosts)->with('postComments', $postComments);
  }


  public function seeMyPosts(){
      $id_user = Auth::user();
      $userposts = User::Search($id_user->id)->first();
      $postsDelUsuario = $userposts->posts()->get();

      foreach ($postsDelUsuario as $post) {
        $id_post = $post->id;
        $postElegido = Post::Search($id_post->id)->first();
        $postComments = $postElegido->comments()->get();
      }
      return view('todo')->with('postsDelUsuario', $postsDelUsuario)->with('postComments', $postComments);
  }

  public function seeMyComments(){
      $todosPosts = Post::all();
      $id_user = Auth::user();
      $userComments = User::Search($id_user->id)->first();
      $commentsDelUsuario = $userComments->comments()->get();

      foreach ($commentsDelUsuario as $comment) {
        $id_comment = $comment->id;
        $commentElegido = Comment::Search($id_post->id)->first();
        $postComments = $commentElegido->post()->get();
      }
      return view('comentarios')->with('commentsDelUsuario', $commentsDelUsuario)->with('postComments', $postComments);
  }


}
