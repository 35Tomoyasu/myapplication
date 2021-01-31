<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //userデータの取得
    public function index() {
        $show_user_flag = true;
        return view('admin.user.index', ['user' => Auth::user(), 'show_user_flag' => $show_user_flag]);
    }

    //userデータの編集
    public function edit() {
        $show_user_flag = true;
        return view('admin.user.edit', ['user' => Auth::user(), 'show_user_flag' => $show_user_flag]);
    }

    //userデータの保存
    public function update(Request $request) {

        $user_form = $request->all();
        $user = Auth::user();

        //不要な「_token」の削除
        unset($user_form['_token']);
        $user->fill($user_form)->save();
        return redirect('admin.user.index');
    }
}
