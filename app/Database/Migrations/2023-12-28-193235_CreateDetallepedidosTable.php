<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDetallepedidosTable extends Migration
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
            'producto' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'precio' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'cantidad' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'id_pedido' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'id_producto' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('detallepedidos');
    }

    public function down()
    {
        $this->forge->dropTable('detallepedidos');
    }
}
