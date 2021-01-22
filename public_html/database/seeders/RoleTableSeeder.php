<?php

namespace Database\Seeders;


use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => "admin", "code" => "admin", "descriptions" => "admin",]);
        Role::create(['name' => "editor", "code" => "editor", "descriptions" => "admin",]);
        Role::create(['name' => "author", "code" => "author", "descriptions" => "admin",]);
    }
}
