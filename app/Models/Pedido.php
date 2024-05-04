<?php

namespace App\Models;

use CodeIgniter\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre', 'transaccion', 'fecha', 'estado', 'monto', 'correo', 'metodo', 'leido', 'id_usuario'];
}