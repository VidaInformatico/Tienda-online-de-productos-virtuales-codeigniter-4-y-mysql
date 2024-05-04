<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ConfigSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'identidad' => '12345678',
            'nombre_comercial' => 'Tu nombre comercial',
            'razon_social' => 'Tu nombre comercial SAC',
            'telefono' => '+51921244307',
            'correo' => 'tucorreo@gmail.com',
            'direccion' => 'Peru',
            'mensaje' => 'Gracias',
        ];

        // Inserta los datos en la tabla
        $this->db->table('configuracion')->insert($data);
    }
}
