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
        Role::truncate();               //supprime tous les enregustrement du roles

        Role::create(["name"=>"SuperAdmin"]);
        
        $role=new Role();
        $role->name="Administrateur";
        $role->save();

        $role=new Role();
        $role->name="Chef";
        $role->save();

        $role=new Role();
        $role->name="Agent";
        $role->save();

        $role=new Role();
        $role->name="Visiteur";
        $role->save();

        
    }
}
