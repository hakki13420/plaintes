<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::truncate();
        DB::table('role_user')->truncate();
        
        $super = App\User::create([
                    'name'=>"hakki rabah",
                    'email'=>"hak_rab@yahoo.fr",
                    'password'=>Hash::make('hakki'),
                ]);
        $admin = App\User::create([
                    'name'=>"admin admin",
                    'email'=>"admin@admin.fr",
                    'password'=>Hash::make('hakki'),
                ]);
        $chef = App\User::create([
                    'name'=>"chef chef",
                    'email'=>"chef@chef.fr",
                    'password'=>Hash::make('hakki'),
                ]);
        $agent = App\User::create([
                    'name'=>"agent agent",
                    'email'=>"agent@agent.fr",
                    'password'=>Hash::make('hakki'),
                ]);
        $visiteur = App\User::create([
                    'name'=>"visiteur visiteur",
                    'email'=>"visiteur@visiteur.fr",
                    'password'=>Hash::make('hakki'),
                ]);

        $superRole=App\Role::where('name','SuperAdmin')->first();
        $adminRole=App\Role::where('name','Administrateur')->first();
        $chefRole=App\Role::where('name','Chef')->first();
        $agentRole=App\Role::where('name','Agent')->first();
        $visiteurRole=App\Role::where('name','Visiteur')->first();

        $super->roles()->attach($superRole);
        $admin->roles()->attach($adminRole);
        $chef->roles()->attach($chefRole);
        $agent->roles()->attach($agentRole);
        $visiteur->roles()->attach($visiteurRole);
    }
}
