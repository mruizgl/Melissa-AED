<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Director;

class DirectorSeeder extends Seeder
{
    public function run()
    {
        $directores = [
            'Dan Kwan',
            'Daniel Scheinert',
            'Daniels',
            'Sarah Polley',
            'Ruben Östlund',
            'Joseph Kosinski',
        ];

        foreach ($directores as $nombre) {
            Director::create(['nombre' => $nombre]);
        }
    }
}
