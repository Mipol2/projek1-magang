<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset cahced roles and permission
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'view Customers']);
        Permission::create(['name' => 'create Customers']);
        Permission::create(['name' => 'edit Customers']);
        Permission::create(['name' => 'delete Customers']);

        Permission::create(['name' => 'view Pesanans']);
        Permission::create(['name' => 'create Pesanans']);
        Permission::create(['name' => 'edit Pesanans']);
        Permission::create(['name' => 'delete Pesanans']);


        //create roles and assign existing permissions
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo('view Pesanans');
        $userRole->givePermissionTo('create Pesanans');
        $userRole->givePermissionTo('edit Pesanans');
        $userRole->givePermissionTo('delete Pesanans');


        $superadminRole = Role::create(['name' => 'super-admin']);
        // gets all permissions via Gate::before rule

        // create demo users
        $user = User::factory()->create([
            'name' => 'Example user',
            'email' => 'writer@qadrlabs.com',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole($userRole);


        $user = User::factory()->create([
            'name' => 'Example superadmin user',
            'email' => 'superadmin@qadrlabs.com',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole($superadminRole);
    }
}