<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hotel::insert([
            [
                'name' => 'Grand Hotel',
                'city' => 'Бишкек',
            ],
            [
                'name' => 'Asia Palace',
                'city' => 'bishkek',
            ],
            [
                'name' => 'Sky Tower',
                'city' => 'БИШКЕК',
            ],
            [
                'name' => 'Osh Plaza',
                'city' => 'Ош',
            ],
            [
                'name' => 'City Stay',
                'city' => 'г. Ош',
            ],
            [
                'name' => 'Mountain',
                'city' => 'г.Ош',
            ],
            [
                'name' => 'Almaty Grand',
                'city' => 'Алматы',
            ],
            [
                'name' => 'Almaty Center',
                'city' => 'almaty',
            ],
            [
                'name' => 'Almaty',
                'city' => ' г. Алматы ',
            ],
            [
                'name' => 'Nomad Hotel',
                'city' => 'Г. Бишкек',
            ],
            [
                'name' => 'Sunrise',
                'city' => 'Bishkek',
            ],
            [
                'name' => 'Downtown Inn',
                'city' => 'bishkek ',
            ],
            [
                'name' => 'Central Park Hotel',
                'city' => 'г Бишкек',
            ],
            [
                'name' => 'Royal Stay',
                'city' => '  Ош ',
            ],
            [
                'name' => 'Elite Hotel',
                'city' => 'OSh',
            ],
            [
                'name' => 'Skyline',
                'city' => 'АЛМАТЫ',
            ],
            [
                'name' => 'Comfort',
                'city' => 'г. алматы',
            ],
        ]);
    }
}
