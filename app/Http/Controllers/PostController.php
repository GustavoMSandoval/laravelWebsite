<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post; 

class PostController extends Controller
{

    public function deletePost(Post $post) {
        if(Auth::user()->id === $post['user_id']) {
            $post->delete();
        }
        return redirect('/home');
    }

    public function updatedPost(Post $post, Request $request) {
        if(Auth::user()->id !== $post['user_id']) {
            return redirect('/home');
        }

        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id']= Auth::id();

        $post->update($incomingFields);
        return redirect('/home');
    }

    public function showEditScreen(Post $post) {

        if(Auth::user()->id !== $post['user_id']) {
            return redirect('/home');
        }

        return view('edit-post', ['post' => $post]);
    }

    public function createPost(Request $request) {
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id']= Auth::id();

        Post::create($incomingFields);

        return redirect('/home');
    }
}
