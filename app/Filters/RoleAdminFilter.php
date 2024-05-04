<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleAdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->has('user_id') && session()->get('rol') == 'admin') {
            return $request;
        }
        return redirect()->to('/login')->with('fail', 'No tienes permisos');
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Puedes realizar acciones después de que el controlador haya sido ejecutado
    }
}