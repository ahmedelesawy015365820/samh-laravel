<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['name' => 'role read','role' => 'role'],
            ['name' => 'role create','role' => 'role'],
            ['name' => 'role edit','role' => 'role'],
            ['name' => 'role delete','role' => 'role'],

            ['name' => 'user read','role' => 'user'],
            ['name' => 'user create','role' => 'user'],
            ['name' => 'user edit','role' => 'user'],
            ['name' => 'user delete','role' => 'user'],

            ['name' => 'status read','role' => 'status'],
            ['name' => 'status create','role' => 'status'],
            ['name' => 'status edit','role' => 'status'],
            ['name' => 'status delete','role' => 'status'],

            ['name' => 'roomType read','role' => 'roomType'],
            ['name' => 'roomType create','role' => 'roomType'],
            ['name' => 'roomType edit','role' => 'roomType'],
            ['name' => 'roomType delete','role' => 'roomType'],

            ['name' => 'room read','role' => 'room'],
            ['name' => 'room create','role' => 'room'],
            ['name' => 'room edit','role' => 'room'],
            ['name' => 'room delete','role' => 'room'],

            ['name' => 'reservation read','role' => 'reservation'],
            ['name' => 'reservation create','role' => 'reservation'],
            ['name' => 'reservation edit','role' => 'reservation'],
            ['name' => 'reservation delete','role' => 'reservation'],

            ['name' => 'order read','role' => 'order'],
            ['name' => 'order create','role' => 'order'],
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission['name'],'role' => $permission['role']]);
        }
    }
}
