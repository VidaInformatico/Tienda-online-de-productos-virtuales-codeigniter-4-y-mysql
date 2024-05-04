<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'usuario' => 'admin',
                'correo' => 'admin@gmail.com',
                'nombre' => 'Tu nombre',
                'apellido' => 'Tu apellido',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'rol' => 'admin',
            ],
            [
                'usuario' => 'usuario',
                'correo' => 'ejemplo2@example.com',
                'nombre' => 'Nombre2',
                'apellido' => 'Apellido2',
                'password' => password_hash('usuario123', PASSWORD_DEFAULT),
                'rol' => 'usuario',
            ],
            // Agrega más datos según sea necesario
        ];

        // Inserta los datos en la tabla
        $this->db->table('usuarios')->insertBatch($data);
    }
}

