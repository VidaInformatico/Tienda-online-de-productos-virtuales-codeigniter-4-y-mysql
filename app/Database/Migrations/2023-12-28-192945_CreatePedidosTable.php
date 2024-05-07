<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePedidosTable extends Migration
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
            'nombre' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'transaccion' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'estado' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'monto' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'correo' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'metodo' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'fecha' => [
                'type' => 'DATETIME'
            ],
            'leido' => [
                'type' => 'INT',
                'default' => 1
            ],
            'id_usuario' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('pedidos');
    }

    public function down()
    {
        $this->forge->dropTable('pedidos');
    }
}
