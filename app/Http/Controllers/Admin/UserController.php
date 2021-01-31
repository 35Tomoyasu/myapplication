<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{       
    /**
     * GET /user/{id}/show
     */
    public function show() 
    {   
        $user = Auth::user();
        $created_at = $user->created_at->format('Y/m/d h:i');
        return view('admin.user.show', ['user' => $user, 'created_at' => $created_at]);
    }

    /**
     * GET /user/{id}/edit
     */
    public function edit() 
    {   
        $user = Auth::user();
        return view('admin.user.edit', ['user' => $user]);
    }

    //userデータの更新
    public function update(Request $request) 
    {   
        $user = User::where('id', $request->user()->id)->first();
        $user->update(['name' => $request->name, 'email' => $request->email]);
        return redirect()->route('admin.user.show', ['id' => $user->id]);
    }
}
