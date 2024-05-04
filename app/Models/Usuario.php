<?php

namespace App\Models;

use CodeIgniter\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $allowedFields = ['usuario', 'correo', 'nombre', 'apellido', 'password', 'rol']; // Ajusta según tu estructura de base de datos
}