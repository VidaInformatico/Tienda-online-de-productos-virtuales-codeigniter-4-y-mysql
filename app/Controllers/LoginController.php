<?php

namespace App\Controllers;

class LoginController extends BaseController
{
    public function __construct()
    {
        helper(['form']);
    }
    public function index()
    {
        $data['register'] = false;
        return view('admin/login', $data);
    }

    public function login()
    {
        $data['register'] = false;
        $validation = \Config\Services::validation();
        $validation->setRule('usuario', 'usuario', 'required');
        $validation->setRule('password', 'contraseña', 'required');

        if (!$validation->withRequest($this->request)->run()) {
            $data['username_error'] = $validation->getError('usuario');
            $data['password_error'] = $validation->getError('password');

            return view('admin/login', $data);
        }

        $userModel = new \App\Models\Usuario();
        $username = $this->request->getVar('usuario');
        $password = $this->request->getVar('password');

        $user = $userModel->where('usuario', $username)
            ->orWhere('correo', $username)
            ->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                // Las credenciales son válidas, establecer la sesión del usuario
                $session = session();
                $userData = [
                    'user_id' => $user['id'],
                    'username' => $user['usuario'],
                    'email' => $user['correo'],
                    'rol' => $user['rol'],
                    // Agrega más datos de usuario según sea necesario
                ];

                $session->set($userData);

                if ($user['rol'] == 'admin') {
                    return redirect()->to('dashboard');
                } else {
                    return redirect()->to('descargas');
                }
            } else {
                // Credenciales inválidas
                return redirect()->to('login')->withInput()->with('error', 'Credenciales inválidas');
            }
        } else {
            return redirect()->to('login')->withInput()->with('error', 'Usuario no existe');
        }
    }

    public function register()
    {
        $validation = \Config\Services::validation();
        $validation->setRule('nombre_registro', 'nombre', 'required');
        $validation->setRule('apellido_registro', 'apellido', 'required');
        $validation->setRule('correo_registro', 'correo', 'required|valid_email|is_unique[usuarios.correo]');
        $validation->setRule('usuario_registro', 'usuario', 'required|is_unique[usuarios.usuario]');
        $validation->setRule('password_registro', 'contraseña', 'required');

        if (!$validation->withRequest($this->request)->run()) {
            $data['nombre_registro_error'] = $validation->getError('nombre_registro');
            $data['apellido_registro_error'] = $validation->getError('apellido_registro');
            $data['correo_registro_error'] = $validation->getError('correo_registro');
            $data['usuario_registro_error'] = $validation->getError('usuario_registro');
            $data['password_registro_error'] = $validation->getError('password_registro');
            $data['register'] = true;
            return view('admin/login', $data);
        }

        $userModel = new \App\Models\Usuario();

        $user = $userModel->insert([
            'nombre' => $this->request->getPost('nombre_registro'),
            'apellido' => $this->request->getPost('apellido_registro'),
            'usuario' => $this->request->getPost('usuario_registro'),
            'correo' => $this->request->getPost('correo_registro'),
            'password' => password_hash($this->request->getVar('password_registro'), PASSWORD_DEFAULT),
            'rol' => 'usuario'
        ]);

        $session = session();
        $userData = [
            'user_id' => $user,
            'username' => $this->request->getPost('usuario_registro'),
            'email' => $this->request->getPost('correo_registro'),
            'rol' => 'usuario',
            // Agrega más datos de usuario según sea necesario
        ];

        $session->set($userData);

        return redirect()->to('descargas');
    }

    public function logout()
    {
        // Obtener el objeto de sesión
        $session = session();

        // Destruir la sesión
        $session->destroy();

        // Redirigir a la página de inicio de sesión u otra página después de cerrar sesión
        return redirect()->to(base_url('login'));
    }
}
