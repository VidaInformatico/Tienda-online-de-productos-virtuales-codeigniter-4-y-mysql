<?php

namespace App\Controllers;

use App\Models\Slider;

class SliderController extends BaseController
{
    protected $session;
    public function __construct()
    {
        $this->session = \Config\Services::session();
        helper(['form']);
    }
    public function index()
    {
        return view('admin/sliders/index');
    }

    public function new()
    {
        return view('admin/sliders/create');
    }

    public function create()
    {
        $data = [];

        if ($this->request->getMethod() === 'post') {
            $validationRules = [
                'titulo' => 'required|min_length[3]|is_unique[sliders.titulo]',
                'subtitulo' => 'required|min_length[3]',
                'descripcion' => 'required|min_length[3]',
                'imagen' => 'uploaded[imagen]|max_size[imagen,1024]|is_image[imagen]'
            ];

            if ($this->validate($validationRules)) {
                $categoriaModel = new Slider();

                // Obtén la instancia del archivo
                $imagen = $this->request->getFile('imagen');

                if ($imagen->isValid() && !$imagen->hasMoved()) {
                    // Genera un titulo único para la imagen
                    $nuevoNombre = $imagen->getRandomName();

                    // Crea el directorio si no existe
                    $directorioImagen = ROOTPATH . 'public/img/sliders';
                    if (!is_dir($directorioImagen)) {
                        mkdir($directorioImagen, 0777, true);
                    }

                    // Mueve la imagen a la carpeta de destino
                    $imagen->move($directorioImagen, $nuevoNombre);

                    $data = [
                        'titulo' => $this->request->getPost('titulo'),
                        'slug' => $this->createSlug($this->request->getPost('titulo')),
                        'subtitulo' => $this->request->getPost('subtitulo'),
                        'descripcion' => $this->request->getPost('descripcion'),
                        'imagen' => 'sliders/' . $nuevoNombre // Guarda la ruta en la base de datos
                    ];

                    $categoriaModel->insert($data);

                    return redirect()->to('admin/sliders')->with('success', 'Slider creada exitosamente.');
                } else {
                    return redirect()->to('admin/sliders')->with('error', 'Error al cargar la imagen.');
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('admin/sliders/create', $data);
    }



    public function edit($id)
    {
        $categoriaModel = new Slider();
        $data['slider'] = $categoriaModel->find($id);

        return view('admin/sliders/edit', $data);
    }

    public function show($id)
    {
        $categoriaModel = new Slider();
        $data['data'] = $categoriaModel->findAll();
        return $this->response->setJSON($data);
    }

    public function update($id)
    {
        $data = [];

        $categoriaModel = new Slider();
        $slider = $categoriaModel->find($id);

        // Si el formulario se ha enviado
        if ($this->request->getMethod() === 'put') {
            // Validación de reglas
            $validationRules = [
                'titulo' => 'required|min_length[3]|is_unique[sliders.titulo,id,' . $id . ']',
                'subtitulo' => 'required|min_length[3]',
                'descripcion' => 'required|min_length[3]',
            ];

            // Establecer reglas de validación
            if ($this->validate($validationRules)) {
                $data = [
                    'titulo' => $this->request->getPost('titulo'),
                    'slug' => $this->createSlug($this->request->getPost('titulo')),
                    'subtitulo' => $this->request->getPost('subtitulo'),
                    'descripcion' => $this->request->getPost('descripcion'),
                ];
                // Obtén la instancia del archivo
                $imagen = $this->request->getFile('imagen');

                if ($imagen->isValid() && !$imagen->hasMoved()) {
                    // Elimina la imagen anterior si existe
                    if ($slider['imagen'] && file_exists(ROOTPATH . 'public/img/' . $slider['imagen'])) {
                        unlink(ROOTPATH . 'public/img/' . $slider['imagen']);
                    }

                    // Genera un titulo único para la nueva imagen
                    $nuevoNombre = $imagen->getRandomName();
                    // Mueve la nueva imagen a la carpeta de destino
                    $imagen->move(ROOTPATH . 'public/img/sliders', $nuevoNombre);

                    $data['imagen'] = 'sliders/' . $nuevoNombre;
                }

                $categoriaModel->update($id, $data);

                return redirect()->to('admin/sliders')->with('success', 'Slider modificada exitosamente.');
            } else {
                // La validación falló, vuelve a cargar la vista con los errores
                $data['validation'] = $this->validator;
            }

            $data['slider'] = $slider;
            return view('admin/sliders/edit', $data);
        }
    }

    public function delete($id)
    {
        $categoriaModel = new Slider();
        $slider = $categoriaModel->find($id);
        if ($slider['imagen'] && file_exists(ROOTPATH . 'public/img/' . $slider['imagen'])) {
            unlink(ROOTPATH . 'public/img/' . $slider['imagen']);
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
