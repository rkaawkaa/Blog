<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;


class ArticleController extends Controller
{
    public function index()
    {
        return Article::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category' => 'required',
            'status' => 'required',
            'image' => 'nullable|image|max:2000',
        ]);

        $article = new Article($request->all());

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $article->image = $imageName;
        }

        $article->save();

        return response()->json($article, 201);
    }


    public function show(Article $article)
    {
        return $article;
    }

    public function update(Request $request, Article $article)
    {

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category' => 'required',
            'status' => 'required',
            'image' => 'nullable|image|max:1999',
        ]);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $article->image = $imageName;
        } else {
            $request->except(['image']);
        }

        $article->update($request->all());
        return $article;
    }




    public function destroy(Article $article)
    {
        $article -> delete();
        return response()->json(['message' => 'Article deleted successfully.']);
    }
}
