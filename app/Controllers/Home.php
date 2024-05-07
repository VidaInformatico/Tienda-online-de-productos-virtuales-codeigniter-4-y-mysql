<?php

namespace App\Controllers;

use App\Models\Categoria;
use App\Models\Configuracion;
use App\Models\DetallePedido;
use App\Models\Producto;
use App\Models\Slider;

class Home extends BaseController
{
    public function index(): string
    {
        $categorias = new Categoria();
        $productos = new Producto();
        $detalles = new DetallePedido();
        $data['categorias'] = $categorias->findAll();
        $empresa = new Configuracion();
        $data['empresa'] = $empresa->first();
        $sliders = new Slider();
        $data['sliders'] = $sliders->findAll();
        $data['tops'] = $detalles->select('SUM(detallepedidos.cantidad) as total, detallepedidos.producto, detallepedidos.id_producto, p.slug, p.imagen')
        ->join('productos AS p', 'detallepedidos.id_producto = p.id')
        ->groupBy(['detallepedidos.producto', 'detallepedidos.id_producto'])->findAll(10);
        $data['class'] = 'hero';
        $data['active'] = 'inicio';
        $data['productos'] = $productos->orderBy('id', 'DESC')->findAll(12);
        return view('index', $data);
    }
}
