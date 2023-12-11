<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Termwind\Components\Dd;

class ArticleController extends Controller
{

    private function uploadImage(Article $article,Request $request): string {
            $imageName = uniqid().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            return $imageName;
    }
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
            'image' => 'nullable|image|max:2048',
        ]);
        $article = new Article($request->all());
        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $article->image = $this->uploadImage($article, $request);

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
            'image' => 'nullable|image|max:2048',
        ]);

        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $article->image = $this->uploadImage($article, $request);
        }
        $article->title = $request->input('title');
        $article->description = $request->input('description');
        $article->category = $request->input('category');
        $article->status = $request->input('status');

        $article->save();

        return $article;
    }




    public function destroy(Article $article)
    {
        $article -> delete();
        return response()->json(['message' => 'Article deleted successfully.']);
    }
}
