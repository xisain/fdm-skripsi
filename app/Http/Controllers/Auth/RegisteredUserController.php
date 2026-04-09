<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\Auth\RegisterService;
use Auth;

class RegisteredUserController extends Controller
{
    public function __construct(private RegisterService $service) {}

    public function create()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {
        $user = $this->service->register($request->toServiceData());
        Auth::login($user);

        return redirect()->route('admin.dashboard')->with('success', 'Registration successful!');
    }
}
