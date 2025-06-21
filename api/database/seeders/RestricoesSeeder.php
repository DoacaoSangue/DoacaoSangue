<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestricoesSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement("
            INSERT INTO restricoes (id_tipo_doador, id_tipo_recebedor)
            SELECT id_tipo_doador, id_tipo_recebedor FROM (
                SELECT
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'A+') AS id_tipo_doador,
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'A-') AS id_tipo_recebedor
                UNION ALL
                SELECT
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'A+') AS id_tipo_doador,
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'B+') AS id_tipo_recebedor
                UNION ALL
                SELECT
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'A+') AS id_tipo_doador,
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'B-') AS id_tipo_recebedor
                UNION ALL
                SELECT
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'A+') AS id_tipo_doador,
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'AB-') AS id_tipo_recebedor
                UNION ALL
                SELECT
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'A+') AS id_tipo_doador,
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'O+') AS id_tipo_recebedor
                UNION ALL
                SELECT
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'A+') AS id_tipo_doador,
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'O-') AS id_tipo_recebedor
                UNION ALL
                SELECT
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'A-') AS id_tipo_doador,
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'B+') AS id_tipo_recebedor
                UNION ALL
                SELECT
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'A-') AS id_tipo_doador,
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'B-') AS id_tipo_recebedor
                UNION ALL
                SELECT
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'A-') AS id_tipo_doador,
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'O+') AS id_tipo_recebedor
                UNION ALL
                SELECT
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'A-') AS id_tipo_doador,
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'O-') AS id_tipo_recebedor
                UNION ALL
                SELECT
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'B+') AS id_tipo_doador,
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'B-') AS id_tipo_recebedor
                UNION ALL
                SELECT
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'B+') AS id_tipo_doador,
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'A+') AS id_tipo_recebedor
                UNION ALL
                SELECT
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'B+') AS id_tipo_doador,
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'A-') AS id_tipo_recebedor
                UNION ALL
                SELECT
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'B+') AS id_tipo_doador,
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'AB-') AS id_tipo_recebedor
                UNION ALL
                SELECT
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'B+') AS id_tipo_doador,
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'O+') AS id_tipo_recebedor
                UNION ALL
                SELECT
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'B+') AS id_tipo_doador,
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'O-') AS id_tipo_recebedor
                UNION ALL
                SELECT
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'B-') AS id_tipo_doador,
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'A+') AS id_tipo_recebedor
                UNION ALL
                SELECT
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'B-') AS id_tipo_doador,
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'A-') AS id_tipo_recebedor
                UNION ALL
                SELECT
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'B-') AS id_tipo_doador,
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'O+') AS id_tipo_recebedor
                UNION ALL
                SELECT
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'B-') AS id_tipo_doador,
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'O-') AS id_tipo_recebedor
                UNION ALL
                SELECT
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'AB+') AS id_tipo_doador,
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'B+') AS id_tipo_recebedor
                UNION ALL
                SELECT
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'AB+') AS id_tipo_doador,
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'B-') AS id_tipo_recebedor
                UNION ALL
                SELECT
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'AB+') AS id_tipo_doador,
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'A+') AS id_tipo_recebedor
                UNION ALL
                SELECT
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'AB+') AS id_tipo_doador,
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'A-') AS id_tipo_recebedor
                UNION ALL
                SELECT
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'AB+') AS id_tipo_doador,
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'AB-') AS id_tipo_recebedor
                UNION ALL
                SELECT
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'AB+') AS id_tipo_doador,
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'O+') AS id_tipo_recebedor
                UNION ALL
                SELECT
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'AB+') AS id_tipo_doador,
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'O-') AS id_tipo_recebedor
                UNION ALL
                SELECT
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'AB-') AS id_tipo_doador,
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'A+') AS id_tipo_recebedor
                UNION ALL
                SELECT
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'AB-') AS id_tipo_doador,
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'A-') AS id_tipo_recebedor
                UNION ALL
                SELECT
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'AB-') AS id_tipo_doador,
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'B+') AS id_tipo_recebedor
                UNION ALL
                SELECT
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'AB-') AS id_tipo_doador,
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'B-') AS id_tipo_recebedor
                UNION ALL
                SELECT
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'AB-') AS id_tipo_doador,
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'O+') AS id_tipo_recebedor
                UNION ALL
                SELECT
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'AB-') AS id_tipo_doador,
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'O-') AS id_tipo_recebedor
                UNION ALL
                SELECT
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'O+') AS id_tipo_doador,
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'A-') AS id_tipo_recebedor
                UNION ALL
                SELECT
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'O+') AS id_tipo_doador,
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'B-') AS id_tipo_recebedor
                UNION ALL
                SELECT
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'O+') AS id_tipo_doador,
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'AB-') AS id_tipo_recebedor
                UNION ALL
                SELECT
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'O+') AS id_tipo_doador,
                    (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'O-') AS id_tipo_recebedor
            ) AS sub;
        ");
    }
}
