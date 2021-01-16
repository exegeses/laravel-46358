<?php

namespace Database\Seeders;

use App\Models\Pais;
use Illuminate\Database\Seeder;

class PaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pais::create(
                [ 'pNombre'=>'Argentina' ]
        );
        Pais::create(
                [ 'pNombre'=>'Brasil' ]
        );
        Pais::create(
                [ 'pNombre'=>'Uruguay' ]
        );
        Pais::create(
                [ 'pNombre'=>'Chile' ]
        );
        Pais::create(
                [ 'pNombre'=>'Paraguay' ]
        );
    }
}
