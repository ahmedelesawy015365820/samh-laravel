<?php

namespace Database\Seeders;

use App\Models\RoomType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RoomType::create([
            'name' => 'single',
            'status' => 1
        ]);

        RoomType::create([
            'name' => 'double',
            'status' => 1
        ]);

        RoomType::create([
            'name' => 'suite',
            'status' => 1
        ]);
    }
}
