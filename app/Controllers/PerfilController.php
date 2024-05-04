<?php

namespace App\Controllers;

use App\Models\Usuario;

class PerfilController extends BaseController
{
    protected $session;
    public function __construct()
    {
        $this->session = \Config\Services::session();
        helper(['form']);
    }
    public function index()
    {
        $usuario = new Usuario();
        $data['usuario'] = $usuario->find($this->session->user_id);
        return view('admin/usuarios/perfil', $data);
    }

    public function updatePerfil()
    {
        $data = [];

        $usuarioModel = new Usuario();
        $id = $this->session->user_id;
        // Si el formulario se ha enviado
        if ($this->request->getMethod() === 'put') {
            // Validación de reglas
            $validationRules = [
                'usuario' => 'required|is_unique[usuarios.usuario,id,' . $id . ']',
                'correo' => 'required|valid_email|is_unique[usuarios.correo,id,' . $id . ']',
                'nombre' => 'required|min_length[3]',
                'apellido' => 'required|min_length[3]'
            ];

            // Establecer reglas de validación
            if ($this->validate($validationRules)) {

                $data = [
                    'usuario' => $this->request->getPost('usuario'),
                    'correo' => $this->request->getPost('correo'),
                    'nombre' => $this->request->getPost('nombre'),
                    'apellido' => $this->request->getPost('apellido')
                ];

                $usuarioModel->update($id, $data);

                return redirect()->to('perfil')->with('success', 'Tu perfil se modificado.');
            } else {
                // La validación falló, vuelve a cargar la vista con los errores
                $data['validation'] = $this->validator;
            }

            $data['usuario'] = $usuarioModel->find($id);
            return view('admin/usuarios/perfil', $data);
        }
    }

    public function updatePassword()
    {
        $data = [];

        $usuarioModel = new Usuario();
        $id = $this->session->user_id;
        // Si el formulario se ha enviado
        if ($this->request->getMethod() === 'put') {
            // Validación de reglas
            $validationRules = [
                'actual' => 'required',
                'nueva' => 'required|min_length[5]|matches[confirmar]'
            ];
            
            // Establecer reglas de validación
            if ($this->validate($validationRules)) {
                $usuario = $usuarioModel->find($this->session->user_id);
                if (password_verify($this->request->getVar('actual'), $usuario['password'])) {
                    $data = [
                        'password' => password_hash($this->request->getVar('nueva'), PASSWORD_DEFAULT),
                    ];
    
                    $usuarioModel->update($id, $data);
                    return redirect()->to('perfil')->with('success', 'Contraseña modificado.');
                } else {
                    return redirect()->to('perfil')->with('error', 'Contraseña actual incorrecta.');
                }
                
                

                
            } else {
                // La validación falló, vuelve a cargar la vista con los errores
                $data['validation'] = $this->validator;
            }

            $data['usuario'] = $usuarioModel->find($id);
            return view('admin/usuarios/perfil', $data);
        }
    }
}
