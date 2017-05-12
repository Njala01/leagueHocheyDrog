<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Role;
use App\User;

class ManageController extends Controller
{
    public function manage() : View
    {
        $roles = Role::all();
        return view('auth.manage', compact('roles'));
    }

    public function role(Request $request, $id)
    {
        //pour debug
        //echo $request;
        $user = User::find($id);
        $user->roles()->attach($request->role);
        $user->save();
        return response()->json([$user],200);
    }
}
