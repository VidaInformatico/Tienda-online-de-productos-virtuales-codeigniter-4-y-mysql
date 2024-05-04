<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateConfiguracionTable extends Migration
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
            'identidad' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'unique' => true,
            ],
            'nombre_comercial' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'razon_social' => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ],
            'telefono' => [
                'type' => 'VARCHAR',
                'constraint' => '50'
            ],
            'correo' => [
                'type' => 'VARCHAR',
                'constraint' => '150'
            ],
            'direccion' => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ],
            'mensaje' => [
                'type' => 'TEXT'
            ],
            'facebook' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'twitter' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'instagram' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'whatsapp' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'mapa' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'host_smtp' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'user_smtp' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'clave_smtp' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'puerto_smtp' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('configuracion');
    }

    public function down()
    {
        $this->forge->dropTable('configuracion');
    }
}
