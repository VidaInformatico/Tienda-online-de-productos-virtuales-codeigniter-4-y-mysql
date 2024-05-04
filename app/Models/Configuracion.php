<?php

namespace App\Models;

use CodeIgniter\Model;

class Configuracion extends Model
{
    protected $table = 'configuracion';
    protected $primaryKey = 'id';
    protected $allowedFields = ['identidad', 'nombre_comercial', 'razon_social', 'telefono', 'correo', 'direccion', 'mensaje', 'facebook', 'twitter', 'instagram', 'whatsapp', 'mapa', 'host_smtp', 'user_smtp', 'clave_smtp', 'puerto_smtp'];
}