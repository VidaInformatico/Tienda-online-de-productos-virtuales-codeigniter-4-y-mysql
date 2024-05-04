<?php

namespace App\Controllers;

use App\Models\DetallePedido;
use App\Models\Pedido;

class DescargaController extends BaseController
{
    protected $session;
    public function __construct()
    {
        $this->session = \Config\Services::session();
    }
    public function index()
    {
        $pedidos = new Pedido();
        $detalle = new DetallePedido();
        $id_usuario = $this->session->user_id;
        $query = $pedidos->where('id_usuario', $id_usuario)->orderBy('id', 'DESC')->findAll();

        for ($i = 0; $i < count($query); $i++) {
            $query[$i]['productos'] = $detalle->select('detallepedidos.*, p.titulo, p.archivo_zip')
                ->join('productos AS p', 'detallepedidos.id_producto = p.id')
                ->where('detallepedidos.id_pedido', $query[$i]['id'])
                ->findAll();
        }

        $data['descargas'] = $query;
        $data['active'] = 'descargas';
        return view('principal/descarga', $data);
    }
}
