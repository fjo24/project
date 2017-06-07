<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Article;
use Laracasts\Flash\Flash;
use App\Http\Requests\ArticlesRequest;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('title', 'DESC')->get();
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $request = $request->all();
        $request['created_by'] = Auth()->user()->id;
        $request['updated_by'] = Auth()->user()->id;
        $article = new Article($request);
        $article->save();
        Flash::success('Se ha registrado el articulo '. $article->title. ' de manera exitosa!')->important();
        return redirect()->route('articles.index');
    }

    public function show($id)
    {
        $article = Article::find($id);
        return view('articles.show', compact('article'));
    }

    public function edit($id)
    {
        $article = Article::find($id);
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, article $article)
    {
        $request = $request->all();
        $request['updated_by'] = Auth()->user()->id;
        $article->update($request);
        flash('El articulo '. $article->title. ' ha sido editado con exito!!', 'success')->important();
        return redirect()->route('articles.index');
    }

    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();
        flash('El articulo '. $article->title.' ha sido eliminado con exito!!', 'danger')->important();
        return redirect()->route('articles.index');
    }
}
