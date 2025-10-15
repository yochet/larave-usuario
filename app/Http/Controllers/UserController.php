<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index(){

        $users = User::all();

        return view('users.index', ['users' =>$users]);
    }


    public function store(Request $request) {
    User::create($request->all());
    return redirect()->back();
}

public function update(Request $request, $id) {
    $user = User::findOrFail($id);
    $user->update($request->all());
    return redirect()->back();
}

public function destroy($id) {
    User::findOrFail($id)->delete();
    return redirect()->back();
}

}
