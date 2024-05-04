<?php

namespace App\Models;

use CodeIgniter\Model;

class Slider extends Model
{
    protected $table = 'sliders';
    protected $primaryKey = 'id';
    protected $allowedFields = ['titulo', 'subtitulo', 'slug', 'descripcion', 'imagen']; // Ajusta según tu estructura de base de datos
}