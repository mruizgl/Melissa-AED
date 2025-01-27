<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Actor;

class ActorSeeder extends Seeder
{
    public function run()
    {
        $actores = [
            'Michelle Yeoh',
            'Ke Huy Quan',
            'Jamie Lee Curtis',
            'Rooney Mara',
            'Claire Foy',
            'Ben Whishaw',
            'Jessie Buckley',
            'Harris Dickinson',
            'Charlbi Dean',
            'Zlatko Buric',
            'Dolly De Leon',
            'Tom Cruise',
            'Miles Teller',
            'Jennifer Connelly',
            'Jon Hamm',
        ];

        foreach ($actores as $nombre) {
            Actor::create(['nombre' => $nombre]);
        }
    }
}
