<?php

namespace App\Controllers;

use App\Models\Categoria;

class CategoriaController extends BaseController
{
    protected $session;
    public function __construct()
    {
        $this->session = \Config\Services::session();
        helper(['form']);
    }
    public function index()
    {
        return view('admin/categorias/index');
    }

    public function new()
    {
        return view('admin/categorias/create');
    }

    public function create()
    {
        $data = [];

        if ($this->request->getMethod() === 'post') {
            $validationRules = [
                'nombre' => 'required|min_length[3]|is_unique[categorias.nombre]',
                'imagen' => 'uploaded[imagen]|max_size[imagen,1024]|is_image[imagen]'
            ];

            if ($this->validate($validationRules)) {
                $categoriaModel = new Categoria();

                // Obtén la instancia del archivo
                $imagen = $this->request->getFile('imagen');

                if ($imagen->isValid() && !$imagen->hasMoved()) {
                    // Genera un nombre único para la imagen
                    $nuevoNombre = $imagen->getRandomName();

                    // Crea el directorio si no existe
                    $directorioImagen = ROOTPATH . 'public/img/categorias';
                    if (!is_dir($directorioImagen)) {
                        mkdir($directorioImagen, 0777, true);
                    }

                    // Mueve la imagen a la carpeta de destino
                    $imagen->move($directorioImagen, $nuevoNombre);

                    $data = [
                        'nombre' => $this->request->getPost('nombre'),
                        'slug' => $this->createSlug($this->request->getPost('nombre')),
                        'imagen' => 'categorias/' . $nuevoNombre // Guarda la ruta en la base de datos
                    ];

                    $categoriaModel->insert($data);

                    return redirect()->to('admin/categorias')->with('success', 'Categoría creada exitosamente.');
                } else {
                    return redirect()->to('admin/categorias')->with('error', 'Error al cargar la imagen.');
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('admin/categorias/create', $data);
    }

    public function edit($id)
    {
        $categoriaModel = new Categoria();
        $data['categoria'] = $categoriaModel->find($id);

        return view('admin/categorias/edit', $data);
    }

    public function show($id)
    {
        $categoriaModel = new Categoria();
        $data['data'] = $categoriaModel->findAll();
        return $this->response->setJSON($data);
    }

    public function update($id)
    {
        $data = [];

        $categoriaModel = new Categoria();
        $categoria = $categoriaModel->find($id);

        // Si el formulario se ha enviado
        if ($this->request->getMethod() === 'put') {
            // Validación de reglas
            $validationRules = [
                'nombre' => 'required|min_length[3]|is_unique[categorias.nombre,id,' . $id . ']',
            ];

            // Establecer reglas de validación
            if ($this->validate($validationRules)) {
                $data = [
                    'nombre' => $this->request->getPost('nombre'),
                    'slug' => $this->createSlug($this->request->getPost('nombre'))
                ];

                $imagen = $this->request->getFile('imagen');

                // Si se proporciona una nueva imagen, actualiza la imagen
                if ($imagen->isValid() && !$imagen->hasMoved()) {
                    // Elimina la imagen anterior si existe
                    if ($categoria['imagen'] && file_exists(ROOTPATH . 'public/img/' . $categoria['imagen'])) {
                        unlink(ROOTPATH . 'public/img/' . $categoria['imagen']);
                    }

                    // Genera un nombre único para la nueva imagen
                    $nuevoNombre = $imagen->getRandomName();
                    // Mueve la nueva imagen a la carpeta de destino
                    $imagen->move(ROOTPATH . 'public/img/categorias', $nuevoNombre);

                    $data['imagen'] = 'categorias/' . $nuevoNombre;
                }

                $categoriaModel->update($id, $data);

                return redirect()->to('admin/categorias')->with('success', 'Categoría modificada exitosamente.');
            } else {
                // La validación falló, vuelve a cargar la vista con los errores
                $data['validation'] = $this->validator;
            }

            $data['categoria'] = $categoria;
            return view('admin/categorias/edit', $data);
        }
    }

    public function delete($id)
    {
        $categoriaModel = new Categoria();
        $categoria = $categoriaModel->find($id);
        if ($categoria['imagen'] && file_exists(ROOTPATH . 'public/img/' . $categoria['imagen'])) {
            unlink(ROOTPATH . 'public/img/' . $categoria['imagen']);
        }

        $data = $categoriaModel->delete($id);

        if ($data) {
            $res = ['msg' => 'REGISTRO ELIMINADO', 'tipo' => 'success'];
        } else {
            $res = ['msg' => 'ERROR AL ELIMINAR', 'tipo' => 'error'];
        }

        return $this->response->setJSON($res);
    }

    private function createSlug($text)
    {
        // Reemplazar caracteres especiales y espacios con guiones
        $slug = strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '-', $text), '-'));
        return $slug;
    }
}
