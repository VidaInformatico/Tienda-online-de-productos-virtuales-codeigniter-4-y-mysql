<?php

namespace App\Models;

use CodeIgniter\Model;

class DetallePedido extends Model
{
    protected $table = 'detallepedidos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['producto', 'precio', 'cantidad', 'id_pedido', 'id_producto']; // Ajusta según tu estructura de base de datos
}