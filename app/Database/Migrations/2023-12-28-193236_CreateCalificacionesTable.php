<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCalificacionesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'comentario' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'calificacion' => [
                'type' => 'INTEGER',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'id_producto' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'id_usuario' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ]
        ]);

        $this->forge->addKey('id', true);

        // Agregar claves foráneas
        $this->forge->addForeignKey('id_producto', 'productos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_usuario', 'usuarios', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('calificaciones');
    }

    public function down()
    {
        $this->forge->dropTable('calificaciones', true);  // Eliminar si existe para evitar errores
    }
}