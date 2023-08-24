<?php

namespace Database\Seeders;

use App\Models\Link;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $links = [
            [
                'long_link' => 'https://www.esteticaexperts.com.br',
                'title' => 'Estética Experts - Cursos Online para Profissionais de Estética',
                'favicon' => 'https://www.esteticaexperts.com.br/favicon.ico',
                'slug' => 'i3E3s9',
                'user_id' => 1,
                'hit_counter' => 5,
            ],
            [
                'long_link' => 'https://www.youtube.com/watch?v=QgaTQ5-XfMM&list=RDEMdVnVIAwYlB4zIe31nRwa4Q&start_radio=1',
                'title' => 'Christina Perri - A Thousand Years (Piano/Cello Cover) - YouTube',
                'favicon' => 'https://www.youtube.com/s/desktop/0529f0d5/img/favicon_32x32.png',
                'slug' => 'jsg5QcC',
                'user_id' => 1,
                'hit_counter' => 2,
            ],
            [
                'long_link' => 'https://dribbble.com/shots/17087324-DDSV-Link-Shortener',
                'title' => 'Dribbble - DDSV_Link_Shortener.png by Daniel Dogeanu',
                'favicon' => 'https://cdn.dribbble.com/assets/favicon-b38525134603b9513174ec887944bde1a869eb6cd414f4d640ee48ab2a15a26b.ico',
                'slug' => 'meu-link',
                'user_id' => 1,
                'hit_counter' => 3,
            ],
        ];

        foreach ($links as $link) {
            Link::create($link);
        }
    }
}
