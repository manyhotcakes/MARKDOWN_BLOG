<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $articles = Article::where('delete_flg', false)
      ->orderBy('id', 'desc')
      ->paginate(env('NUM_OF_ARTICLES_PERPAGE'));
      return view('index', ['articles' => $articles]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
      $article = Article::find($id);
      return view('detail', ['article' => $article]);
    }
}
