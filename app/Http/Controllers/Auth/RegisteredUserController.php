<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Auth;
class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone_number'=> ['required', 'max:13'],
            'collector_initial' => ['required','string','max:3']
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['roles_id'] = 1;
        $user = User::create($validated);

        Auth::login($user);

        return redirect()->route('admin.dashboard')->with('success', 'Registration successful!');
    }
}
