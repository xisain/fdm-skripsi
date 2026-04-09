<?php

namespace App\Services\Auth;

use App\Models\Collector;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterService
{
    public function register(array $data): User
    {
        return DB::transaction(function () use ($data) {
            $initial = strtoupper($data['collector_initial']);
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'phone_number' => $data['phone_number'],
                'roles_id' => 1,
            ]);
            Collector::create([
                'user_id' => $user->id,
                'full_name' => $user->name,
                'initial_collector_name' => $initial,
                'is_manual' => false,
                'last_sequence' => 0,
            ]);

            return $user;
        });
    }
}
