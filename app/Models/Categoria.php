<?php

namespace App\Models;

use CodeIgniter\Model;

class Categoria extends Model
{
    protected $table = 'categorias';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre', 'imagen']; // Ajusta según tu estructura de base de datos
}