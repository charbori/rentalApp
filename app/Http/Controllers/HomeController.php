<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function index() {
        return view('home');
    }

    public function show(Request $request, $articleId = null) {
        $articles = Article::query()->with(['user' => function($query) {
            $query->select('id', 'name');
        }])->get();

        return view('home', compact('articles'));
    }
}
