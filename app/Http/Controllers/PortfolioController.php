<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Blog;
use App\Models\Gallery;

class PortfolioController extends Controller
{
    public function index(){
      $posts = Blog::orderBy('created_at', 'desc')->take(6)->get();
      $photos = Gallery::all();
      return view('home')->with('posts', $posts)->with('photos', $photos);
    }




}
