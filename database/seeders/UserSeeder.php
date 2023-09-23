<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createUsers();
    }



    public function createUsers(){
             
        $roleSuperAdmin = Role::create([
            'name' => 'super-admin', 'display_name' => 'Super Admin'
        ]);

        $roleAdmin  = Role::create([
            'name' => 'admin', 'display_name' => 'Admin'
        ]);
        /** Create Permission */
        $readStore = Permission::create(['name' => 'read-store', 'display_name' => 'Read Store']);
        $createStore = Permission::create(['name' => 'create-store', 'display_name' => 'Add Store']);
        $updateStore = Permission::create(['name' => 'update-store', 'display_name' => 'Update Store']);
        $deleteStore = Permission::create(['name' => 'delete-store', 'display_name' => 'Delete Store']);

        $superAdmin = User::create([
            'name'=>'super-admin',
            'email'=>"aoy@gmail.com",
            'password' => Hash::make('aoy@2023')
        ]);

        $superAdmin->attachRoles([$roleSuperAdmin,$roleAdmin]);
        $superAdmin->permissions()->attach([$readStore->id,$createStore->id,$updateStore->id,$deleteStore->id]);


        $Admin = User::create([
            'name'=>'admin',
            'email'=>"aoy1@gmail.com",
            'password' => Hash::make('aoy@2023')
        ]);
        $Admin->attachRoles([$roleAdmin]);
        $Admin->permissions()->attach([$readStore->id,$createStore->id]);
    }
}
