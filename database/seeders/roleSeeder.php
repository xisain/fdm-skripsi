<?php

namespace Database\Seeders;

use App\Models\role;
use Illuminate\Database\Seeder;

class roleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        role::create([
            'name' => 'peneliti',
            'description' => 'test aja',
        ]);
        role::create([
            'name' => 'admin pembibitan',
            'description' => 'test aja',
        ]);
        role::create([
            'name' => 'admin',
            'description' => 'test aja',
        ]);
    }
}
