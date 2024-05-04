<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
class MainSeeder extends Seeder
{
    public function run()
    {
        $this->call('ConfigSeeder');
        $this->call('UsuarioSeeder');
        $this->call('CategoriaSeeder');
        $this->call('SliderSeeder');
        $this->call('ProductoSeeder');
    }
}
