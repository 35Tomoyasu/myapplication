<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create(){
        $categories = \App\Category::orderBy('id','asc')->pluck('name','id');
        //  プルダウンの一番最初は空欄にしたい時には、先頭に追加しておく
        $categories = $categories -> prepend('カテゴリー', '');

        return view('cagtegoties.create')->with(['categories' => $categories]);
    }
}