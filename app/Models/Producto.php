<?php

namespace App\Models;

use CodeIgniter\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['codigo', 'titulo', 'slug', 'descripcion', 'precio_normal', 'precio_rebajado', 'imagen', 'archivo_zip', 'id_categoria']; // Ajusta según tu estructura de base de datos
}