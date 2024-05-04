<?php

namespace App\Controllers;

use App\Models\Usuario;

class UsuarioController extends BaseController
{
    protected $session;
    public function __construct()
    {
        $this->session = \Config\Services::session();
        helper(['form']);
    }
    public function index()
    {
        return view('admin/usuarios/index');
    }

    public function new()
    {
        return view('admin/usuarios/create');
    }

    public function create()
    {
        $data = [];

        // Si el formulario se ha enviado
        if ($this->request->getMethod() === 'post') {
            // Validación de reglas
            $validationRules = [
                'usuario' => 'required|is_unique[usuarios.usuario]',
                'correo' => 'required|valid_email|is_unique[usuarios.correo]',
                'nombre' => 'required|min_length[3]',
                'apellido' => 'required|min_length[3]',
                'password' => 'required|max_length[5]|matches[password_confirm]',
                'rol' => 'required',
            ];

            // Establecer reglas de validación
            if ($this->validate($validationRules)) {
                $usuarioModel = new Usuario();

                $data = [
                    'usuario' => $this->request->getPost('usuario'),
                    'correo' => $this->request->getPost('correo'),
                    'nombre' => $this->request->getPost('nombre'),
                    'apellido' => $this->request->getPost('apellido'),
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'rol' => $this->request->getPost('rol'),
                ];

                $usuarioModel->insert($data);

                return redirect()->to('admin/usuarios')->with('success', 'Usuario creado exitosamente.');
            } else {
                // La validación falló, vuelve a cargar la vista con los errores
                $data['validation'] = $this->validator;
            }
        }

        // Carga la vista con los datos y errores de validación
        return view('admin/usuarios/create', $data);
    }

    public function edit($id)
    {
        $usuarioModel = new Usuario();
        $data['usuario'] = $usuarioModel->find($id);

        return view('admin/usuarios/edit', $data);
    }

    public function show($id)
    {
        $usuarioModel = new Usuario();
        $data['data'] = $usuarioModel->findAll();
        return $this->response->setJSON($data);
    }

    public function update($id)
    {
        $data = [];

        $usuarioModel = new Usuario();

        // Si el formulario se ha enviado
        if ($this->request->getMethod() === 'put') {
            // Validación de reglas
            $validationRules = [
                'usuario' => 'required|is_unique[usuarios.usuario,id,' . $id . ']',
                'correo' => 'required|valid_email|is_unique[usuarios.correo,id,' . $id . ']',
                'nombre' => 'required|min_length[3]',
                'apellido' => 'required|min_length[3]',
                'rol' => 'required',
            ];

            // Establecer reglas de validación
            if ($this->validate($validationRules)) {

                $data = [
                    'usuario' => $this->request->getPost('usuario'),
                    'correo' => $this->request->getPost('correo'),
                    'nombre' => $this->request->getPost('nombre'),
                    'apellido' => $this->request->getPost('apellido'),
                    'rol' => $this->request->getPost('rol'),
                ];

                $usuarioModel->update($id, $data);

                return redirect()->to('admin/usuarios')->with('success', 'Usuario modificado exitosamente.');
            } else {
                // La validación falló, vuelve a cargar la vista con los errores
                $data['validation'] = $this->validator;
            }

            $data['usuario'] = $usuarioModel->find($id);
            return view('admin/usuarios/edit', $data);
        }
    }


    public function delete($id)
    {
        $usuarioModel = new Usuario();
        $data = $usuarioModel->delete($id);

        if ($data) {
            $res = ['msg' => 'REGISTRO ELIMINADO', 'tipo' => 'success'];
        } else {
            $res = ['msg' => 'ERROR AL ELIMINAR', 'tipo' => 'error'];
        }

        return $this->response->setJSON($res);
    }
}
