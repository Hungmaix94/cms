<?php
namespace Database\Seeders;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $adminRole = Role::where("name", "admin")->first();
        $editorRole = Role::where("name", "editor")->first();

        $admin = User::create([
            'name'=> "SuperAdmin",
            'email' => "phamhung.bk94@gmail.com",
            'password' => bcrypt("123456"),
        ]);
        $joe = User::create([
            'name'=> "Joe",
            'email' => "joe@superadmin.com",
            'password' => bcrypt("joe@123456"),
        ]);
        $admin->roles()->attach($adminRole);
        $joe->roles()->attach($editorRole);
    }
}
