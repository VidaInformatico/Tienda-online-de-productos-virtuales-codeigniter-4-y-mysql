<?php

namespace App\Controllers;

use App\Models\Categoria;
use App\Models\Producto;

class ProductoController extends BaseController
{
    protected $session;
    public function __construct()
    {
        $this->session = \Config\Services::session();
        helper(['form']);
    }
    public function index()
    {
        return view('admin/productos/index');
    }

    public function new()
    {
        $categoriaModel = new Categoria();
        $data['categorias'] = $categoriaModel->findAll();
        return view('admin/productos/create', $data);
    }

    public function create()
    {
        $data = [];

        if ($this->request->getMethod() === 'post') {
            $validationRules = [
                'codigo' => 'required|min_length[3]|is_unique[productos.codigo]',
                'titulo' => 'required|min_length[3]',
                'precio_normal' => 'required',
                'precio_rebajado' => 'required',
                'id_categoria' => 'required',
                'imagen' => 'uploaded[imagen]|max_size[imagen,1024]|is_image[imagen]',
                'archivo_zip' => 'uploaded[archivo_zip]|max_size[archivo_zip,10048]|ext_in[archivo_zip,zip,rar]'
            ];

            $categoriaModel = new Categoria();

            if ($this->validate($validationRules)) {
                $productoModel = new Producto();

                // Maneja la carga de la imagen
                $imagen = $this->request->getFile('imagen');

                if ($imagen->isValid() && !$imagen->hasMoved()) {
                    if ($imagen->getClientMimeType() == 'image/jpeg' || $imagen->getClientMimeType() == 'image/png') {
                        $nuevoNombreImagen = $imagen->getRandomName();

                        // Crea el directorio si no existe
                        $directorioImagen = ROOTPATH . 'public/img/productos';
                        if (!is_dir($directorioImagen)) {
                            mkdir($directorioImagen, 0777, true);
                        }

                        $imagen->move($directorioImagen, $nuevoNombreImagen);
                        $data['imagen'] = 'productos/' . $nuevoNombreImagen;
                    } else {
                        return redirect()->to('admin/productos')->with('error', 'La imagen debe ser JPEG o PNG.');
                    }
                } else {
                    return redirect()->to('admin/productos')->with('error', 'Debe cargar una imagen.');
                }

                // Maneja la carga del archivo ZIP o RAR
                $archivoZip = $this->request->getFile('archivo_zip');
                $nuevoNombreZip = null;

                if ($archivoZip->isValid() && !$archivoZip->hasMoved()) {
                    if ($archivoZip->getClientMimeType() == 'application/zip' 
                    || $archivoZip->getClientMimeType() == 'application/x-rar-compressed'
                    || $archivoZip->getClientMimeType() == 'application/x-zip-compressed') {
                        $nuevoNombreZip = $archivoZip->getRandomName();

                        // Crea el directorio si no existe
                        $directorioArchivos = ROOTPATH . 'public/archivos';
                        if (!is_dir($directorioArchivos)) {
                            mkdir($directorioArchivos, 0777, true);
                        }

                        $archivoZip->move($directorioArchivos, $nuevoNombreZip);
                        $data['archivo_zip'] = 'archivos/' . $nuevoNombreZip;
                    } else {
                        return redirect()->to('admin/productos')->with('error', 'El archivo debe ser un ZIP o RAR.');
                    }
                } else {
                    return redirect()->to('admin/productos')->with('error', 'Debe cargar un archivo ZIP o RAR.');
                }

                // Resto del código para los demás campos
                $data['codigo'] = $this->request->getPost('codigo');
                $data['titulo'] = $this->request->getPost('titulo');
                $data['descripcion'] = $this->request->getPost('descripcion');
                $data['precio_normal'] = $this->request->getPost('precio_normal');
                $data['slug'] = $this->createSlug($this->request->getPost('titulo'));
                $data['precio_rebajado'] = $this->request->getPost('precio_rebajado');
                $data['archivo_zip'] = $nuevoNombreZip;
                $data['id_categoria'] = $this->request->getPost('id_categoria');

                // Inserta los datos en la base de datos
                $productoModel->insert($data);

                return redirect()->to('admin/productos')->with('success', 'Producto creado exitosamente.');
            } else {
                $data['validation'] = $this->validator;
            }
        }
        $data['categoria'] = $this->request->getPost('id_categoria');
        $data['categorias'] = $categoriaModel->findAll();
        return view('admin/productos/create', $data);
    }


    public function edit($id)
    {
        $productoModel = new Producto();
        $categoriaModel = new Categoria();
        $data['producto'] = $productoModel->find($id);
        $data['categorias'] = $categoriaModel->findAll();
        return view('admin/productos/edit', $data);
    }

    public function show($id)
    {
        $productoModel = new Producto();
        $data['data'] = $productoModel->findAll();
        return $this->response->setJSON($data);
    }

    public function update($id)
    {
        $data = [];

        $productoModel = new Producto();
        $categoriaModel = new Categoria();
        $producto = $productoModel->find($id);

        // Si el formulario se ha enviado
        if ($this->request->getMethod() === 'put') {
            // Validación de reglas
            $validationRules = [
                'codigo' => 'required|min_length[3]|is_unique[productos.codigo,id,' . $id . ']',
                'titulo' => 'required|min_length[3]',
                'precio_normal' => 'required',
                'precio_rebajado' => 'required',
                'id_categoria' => 'required',
            ];

            // Establecer reglas de validación
            if ($this->validate($validationRules)) {
                $data = [
                    'codigo' => $this->request->getPost('codigo'),
                    'titulo' => $this->request->getPost('titulo'),
                    'descripcion' => $this->request->getPost('descripcion'),
                    'precio_normal' => $this->request->getPost('precio_normal'),
                    'precio_rebajado' => $this->request->getPost('precio_rebajado'),
                    'slug' => $this->createSlug($this->request->getPost('titulo')),
                    'id_categoria' => $this->request->getPost('id_categoria')
                ];

                // Actualiza la imagen si se proporciona una nueva
                $imagen = $this->request->getFile('imagen');
                if (!empty($imagen->getName())) {
                    // Elimina la imagen anterior si existe
                    if ($producto['imagen'] && file_exists(ROOTPATH . 'public/' . $producto['imagen'])) {
                        unlink(ROOTPATH . 'public/' . $producto['imagen']);
                    }

                    // Genera un título único para la nueva imagen
                    $nuevoNombreImagen = $imagen->getRandomName();
                    // Mueve la nueva imagen a la carpeta de destino
                    $imagen->move(ROOTPATH . 'public/img/productos', $nuevoNombreImagen);

                    $data['imagen'] = 'productos/' . $nuevoNombreImagen;
                }
                $archivoZip = $this->request->getFile('archivo_zip');
                // Actualiza el archivo ZIP o RAR si se proporciona uno nuevo
                if (!empty($archivoZip->getName())) {
                    // Verifica si el archivo es un ZIP o RAR
                    if ($archivoZip->getClientMimeType() == 'application/zip' 
                    || $archivoZip->getClientMimeType() == 'application/x-rar-compressed'
                    || $archivoZip->getClientMimeType() == 'application/x-zip-compressed') {
                        // Elimina el archivo anterior si existe
                        if ($producto['archivo_zip'] && file_exists(ROOTPATH . 'public/' . $producto['archivo_zip'])) {
                            unlink(ROOTPATH . 'public/' . $producto['archivo_zip']);
                        }
                        $directorioArchivos = ROOTPATH . 'public/archivos';
                        if (!is_dir($directorioArchivos)) {
                            mkdir($directorioArchivos, 0777, true);
                        }
                        // Genera un título único para el nuevo archivo ZIP o RAR
                        $nuevoNombreZip = $archivoZip->getRandomName();
                        // Mueve el nuevo archivo a la carpeta de destino
                        $archivoZip->move(ROOTPATH . 'public/archivos', $nuevoNombreZip);

                        $data['archivo_zip'] = 'archivos/' . $nuevoNombreZip;
                    } else {
                        // Maneja el caso en que el archivo no sea un ZIP o RAR
                        return redirect()->to('admin/productos')->with('error', 'El archivo debe ser un ZIP o RAR.');
                    }
                }

                $productoModel->update($id, $data);

                return redirect()->to('admin/productos')->with('success', 'Producto modificado exitosamente.');
            } else {
                // La validación falló, vuelve a cargar la vista con los errores
                $data['validation'] = $this->validator;
            }
            $data['categoria'] = $this->request->getPost('id_categoria');
            $data['categorias'] = $categoriaModel->findAll();
            $data['producto'] = $producto;
            return view('admin/productos/edit', $data);
        }
    }

    public function delete($id)
    {
        $productoModel = new Producto();
        $producto = $productoModel->find($id);
        if ($producto['imagen'] && file_exists(ROOTPATH . 'public/' . $producto['imagen'])) {
            unlink(ROOTPATH . 'public/' . $producto['imagen']);
        }

        $data = $productoModel->delete($id);

        if ($data) {
            $res = ['msg' => 'REGISTRO ELIMINADO', 'tipo' => 'success'];
        } else {
            $res = ['msg' => 'ERROR AL ELIMINAR', 'tipo' => 'error'];
        }

        return $this->response->setJSON($res);
    }

    public function galeria($id_producto)
    {
        $productoModel = new Producto();
        $data['producto'] = $productoModel->find($id_producto);

        $data['imagenes'] = array();
        $directorio = 'img/productos/' . $id_producto;
        if (file_exists($directorio)) {
            $imagenes = scandir($directorio);
            if (false !== $imagenes) {
                foreach ($imagenes as $file) {
                    if ('.' != $file && '..' != $file) {
                        array_push($data['imagenes'], $file);
                    }
                }
            }
        }

        return view('admin/productos/imagenes', $data);
    }

    public function subirImagenes() {
        $id_producto = $this->request->getPost('idProducto');
        if (!empty($_FILES)) {
            $uploadDir = 'img/productos/' . $id_producto . '/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir);
            }
            $archivo = $_FILES['file'];            
            for ($i = 0; $i < count($archivo['name']); $i++) {
                $nombre = $archivo['name'][$i];
                $filePath = $uploadDir . $nombre;
                move_uploaded_file($archivo['tmp_name'][$i], $filePath);
            }
            // Enviar respuesta al cliente
            $res = array('msg' => "Archivos subidos", 'tipo' => 'success');
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    public function deleteImagen($id_producto, $ruta)
    {
        $destino = 'img/productos/' . $id_producto . '/' . $ruta;
        if (unlink($destino)) {
            $res = array('msg' => 'IMAGEN ELIMINADO', 'tipo' => 'success');
        } else {
            $res = array('msg' => 'ERROR AL ELIMINAR', 'tipo' => 'error');
        }
        echo json_encode($res);
        die();
    }


    private function createSlug($text)
    {
        // Reemplazar caracteres especiales y espacios con guiones
        $slug = strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '-', $text), '-'));
        return $slug;
    }
}
