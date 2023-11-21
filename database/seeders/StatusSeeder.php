<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create([
            'name' => 'available',
            'status' => 1
        ]);

        Status::create([
            'name' => 'booked',
            'status' => 1
        ]);

        Status::create([
            'name' => 'pending',
            'status' => 1
        ]);
    }
}
