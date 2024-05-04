<?php

namespace App\Controllers;

use App\Models\Categoria;
use App\Models\Configuracion;
use App\Models\Producto;
use App\Models\Slider;

class Home extends BaseController
{
    public function index(): string
    {
        $categorias = new Categoria();
        $data['categorias'] = $categorias->findAll();
        $empresa = new Configuracion();
        $data['empresa'] = $empresa->first();
        $sliders = new Slider();
        $data['sliders'] = $sliders->findAll();
        $productos = new Producto();
        $data['class'] = 'hero';
        $data['active'] = 'inicio';
        $data['productos'] = $productos->orderBy('id', 'DESC')->findAll(12);
        return view('index', $data);
    }
}
