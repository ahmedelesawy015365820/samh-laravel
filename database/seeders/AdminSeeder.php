<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => '12345678',
            'show_password' => '12345678',
            'username' => 'ahmed',
            'status' => 1
        ]);

        $role = Role::create(['name' => 'SuperAdmin']);
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);

        $user1 = User::create([
            'name' => 'employee',
            'email' => 'employee@employee.com',
            'password' => '12345678',
            'show_password' => '12345678',
            'username' => 'employee',
            'status' => 1
        ]);

        $role1 = Role::create(['name' => 'Employee']);
        $permissions1 = Permission::whereNotIn('role',['user','role'])->pluck('id');
        $role1->syncPermissions($permissions1);
        $user1->assignRole([$role1->id]);

        $user2 = User::create([
            'name' => 'client',
            'email' => 'client@client.com',
            'password' => '12345678',
            'show_password' => '12345678',
            'username' => 'client',
            'status' => 1
        ]);

        $role2 = Role::create(['name' => 'Client']);
        $permissions2 = Permission::whereRole('order')->pluck('id');
        $role2->syncPermissions($permissions2);
        $user2->assignRole([$role2->id]);
    }
}
