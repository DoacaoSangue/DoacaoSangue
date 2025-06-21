<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposSanguineosSeeder extends Seeder
{
    public function run(): void
    {
        $tipos = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];

        foreach ($tipos as $tipo) {
            DB::table('tipos_sanguineos')->insert(['tipo' => $tipo]);
        }
    }
}
