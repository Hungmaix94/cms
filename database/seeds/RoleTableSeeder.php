<?php

use App\Role;
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

        Role::create(['name'=> "admin", "code"=> "admin"]);
        Role::create(['name'=> "editor", "code"=> "editor"]);
        Role::create(['name'=> "author", "code"=> "author"]);
    }
}
