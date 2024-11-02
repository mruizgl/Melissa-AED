<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class InsertImagesCommand extends Command
{
    protected $signature = 'images:insert';
    protected $description = 'Insert images from public/images into the database';

    public function handle()
    {
        $imageDir = public_path('images');
        $files = scandir($imageDir);
        $images = array_filter($files, function($file) {
            return preg_match('/\.png$/', $file);
        });

        foreach ($images as $image) {
            $imagePath = $imageDir . '/' . $image;
            $imageData = file_get_contents($imagePath);
            $tipo_imagen = 'image/png';

            // Insertar en la base de datos
            DB::table('figuras')->insert([
                'imagen' => $imageData,
                'tipo_imagen' => $tipo_imagen
            ]);

            $this->info("Imagen $image insertada correctamente.");
        }
    }
}

//php artisan make:command InsertImagesCommand
//php artisan images:insert
