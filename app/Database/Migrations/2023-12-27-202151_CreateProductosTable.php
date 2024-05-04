<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductosTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'codigo' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'unique' => true,
            ],
            'titulo' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => true,
            ],
            'descripcion' => [
                'type' => 'TEXT'
            ],
            'precio_normal' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'precio_rebajado' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'cantidad' => [
                'type' => 'INTEGER',
                'constraint' => 11,
            ],
            'imagen' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'archivo_zip' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'id_categoria' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('productos');
    }

    public function down()
    {
        $this->forge->dropTable('productos');
    }
}
