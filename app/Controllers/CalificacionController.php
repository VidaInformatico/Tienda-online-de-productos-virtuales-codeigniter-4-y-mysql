<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Calificacion;
use App\Models\Producto;

class CalificacionController extends BaseController
{
    protected $session;
    public function __construct()
    {
        $this->session = \Config\Services::session();
    }
    public function agregar()
    {
        $productoId = $this->request->getPost('producto_id');
        $calificacion = $this->request->getPost('rating');
        $comentario = $this->request->getPost('comentario');
        $usuarioId = $this->session->user_id;

        $validation = \Config\Services::validation();
        $validation->setRule('rating', 'calificacion', 'required');

        // Redirigir o mostrar un mensaje de éxito
        $productoModel = new Producto();
        $producto = $productoModel->find($productoId);

        if (!$validation->withRequest($this->request)->run()) {
            $data['rating_error'] = $validation->getError('rating');
            $data['comentario'] = $comentario;

            return redirect()->to('producto/' . $producto['slug'])->with('error', $data);
        }

        // Verificar si ya existe una calificación para el mismo producto y usuario
        $calificacionModel = new Calificacion();
        $existingCalificacion = $calificacionModel->where('id_usuario', $usuarioId)
            ->where('id_producto', $productoId)
            ->first();

        // Si ya existe una calificación, actualiza en lugar de insertar
        if ($existingCalificacion) {
            $data = [
                'calificacion' => $calificacion,
                'comentario' => $comentario,
            ];

            $calificacionModel->update($existingCalificacion['id'], $data);
        } else {
            // Si no existe, inserta la nueva calificación
            $data = [
                'id_usuario' => $usuarioId,
                'id_producto' => $productoId,
                'calificacion' => $calificacion,
                'comentario' => $comentario,
            ];

            $calificacionModel->insert($data);
        }



        return redirect()->to('producto/' . $producto['slug'])->with('success', 'Calificación agregada correctamente');
    }
}
