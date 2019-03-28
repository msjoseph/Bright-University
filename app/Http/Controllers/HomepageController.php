<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Project;


class HomepageController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->take(4)->get();
        $projects = Project::orderBy('created_at', 'desc')->take(4)->get();
        return view('home.homepage', compact('posts', 'projects'));
    }
}
