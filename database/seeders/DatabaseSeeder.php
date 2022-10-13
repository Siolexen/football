<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use Illuminate\Database\Seeder;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'id' => 1,
            'name' => Role::ROLE_USER
        ]);

        DB::table('roles')->insert([
            'id' => 1,
            'name' => Role::ROLE_EDITOR
        ]);

        DB::table('roles')->insert([
            'id' => 3,
            'name' => Role::ROLE_ADMIN
        ]);
    }
}
