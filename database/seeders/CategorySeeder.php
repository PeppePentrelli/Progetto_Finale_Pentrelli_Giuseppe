<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [

    ['name' => 'Elettronica', 'img_category' => 'elettronica.jpg'],
    ['name' => 'Abbigliamento', 'img_category' => 'abbigliamento.jpg'],
    ['name' => 'Casa e giardinaggio', 'img_category' => 'casa_giardinaggio.jpg'],
    ['name' => 'Sport e tempo libero', 'img_category' => 'sport_tempo_libero.jpg'],
    ['name' => 'Animali domestici', 'img_category' => 'animali_domestici.jpg'],
    ['name' => 'Libri e riviste', 'img_category' => 'libri_riviste.jpg'],
    ['name' => 'Auto e motori', 'img_category' => 'auto_motori.jpg'],
    ['name' => 'Salute e bellezza', 'img_category' => 'salute_bellezza.jpg'],
    ['name' => 'Giocattoli', 'img_category' => 'giocattoli.jpg'],
    ['name' => 'Cucina', 'img_category' => 'cucina.jpg'],


        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}

