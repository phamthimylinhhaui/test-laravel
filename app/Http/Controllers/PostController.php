<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    //
    public function index(){
        $getAll= App\Models\Post :: all();
        foreach ($getAll as $post) {
            echo $post->title. "<br>";
        }
    }
}
