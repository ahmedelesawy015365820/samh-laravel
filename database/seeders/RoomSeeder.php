<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\RoomType;
use App\Models\Status;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $roomTypes = RoomType::pluck('id');
        $statuses = Status::pluck('id');

        for ($i = 1; $i <= 50; $i++) {
            $rooms[] = [
                'code'                  => rand(0, 10000),
                'name'                  =>  $faker->name,
                'description'           => $faker->paragraph,
                'price'                 => rand(0, 1000),
                'room_type_id'          => $roomTypes->random(),
                'status_id'             =>  $statuses->random(),
                'created_at'            => now(),
                'updated_at'            => now(),
            ];
        }

        $chunks = array_chunk($rooms, 25);
        foreach ($chunks as $chunk) {
            Room::insert($chunk);
        }
    }
}
