<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('users.index', compact('user'));
    }

    public function create() {}

    public function edit() {}

    public function update() {}

    public function destroy() {}
}
