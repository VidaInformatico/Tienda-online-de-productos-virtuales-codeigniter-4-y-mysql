<?php

namespace App\Controllers;

use App\Models\Configuracion;

class ConfigController extends BaseController
{

    protected $session;
    public function __construct()
    {
        $this->session = \Config\Services::session();
        helper(['form']);
    }
    public function index()
    {
        $configModel = new Configuracion();
        $data['empresa'] = $configModel->first();
        return view('admin/configuracion', $data);
    }


    public function update($id)
    {
        $data = [];

        $configModel = new Configuracion();
        // Si el formulario se ha enviado
        if ($this->request->getMethod() === 'put') {
            // Validación de reglas
            $validationRules = [
                'identidad' => 'required|min_length[8]',
                'nombre_comercial' => 'required|min_length[3]',
                'razon_social' => 'required',
                'telefono' => 'required',
                'correo' => 'required|valid_email',
                'direccion' => 'required',
            ];

            // Establecer reglas de validación
            if ($this->validate($validationRules)) {
                $data = [
                    'identidad' => $this->request->getPost('identidad'),
                    'nombre_comercial' => $this->request->getPost('nombre_comercial'),
                    'razon_social' => $this->request->getPost('razon_social'),
                    'telefono' => $this->request->getPost('telefono'),
                    'correo' => $this->request->getPost('correo'),
                    'direccion' => $this->request->getPost('direccion'),
                    'mensaje' => $this->request->getPost('mensaje'),
                    'facebook' => $this->request->getPost('facebook'),
                    'twitter' => $this->request->getPost('twitter'),
                    'instagram' => $this->request->getPost('instagram'),
                    'whatsapp' => $this->request->getPost('whatsapp'),
                    'mapa' => $this->request->getPost('mapa'),
                    'host_smtp' => $this->request->getPost('host_smtp'),
                    'user_smtp' => $this->request->getPost('user_smtp'),
                    'clave_smtp' => $this->request->getPost('clave_smtp'),
                    'puerto_smtp' => $this->request->getPost('puerto_smtp')
                ];

                // Si se proporciona una nueva imagen, actualiza la imagen
                if ($imagen = $this->request->getFile('imagen')) {
                    // Elimina la imagen anterior si existe
                    if (file_exists(ROOTPATH . 'public/principal/img/logo.png')) {
                        unlink(ROOTPATH . 'public/principal/img/logo.png');
                    }
                    // Mueve la nueva imagen a la carpeta de destino
                    $imagen->move(ROOTPATH . 'public/principal/img', 'logo.png');
                }

                $configModel->update($id, $data);

                return redirect()->to('admin/empresa')->with('success', 'Configuracion modificada exitosamente.');
            } else {
                // La validación falló, vuelve a cargar la vista con los errores
                $data['validation'] = $this->validator;
            }

            $data['empresa'] = $configModel->find($id);
            return view('admin/configuracion', $data);
        }
    }

}
