<?php

namespace App\Controllers;

use App\Models\Calificacion;
use App\Models\Categoria;
use App\Models\Configuracion;
use App\Models\DetallePedido;
use App\Models\Producto;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class TiendaController extends BaseController
{
    protected $session;
    public function __construct()
    {
        $this->session = \Config\Services::session();
    }

    public function index(): string
    {
        $empresa = new Configuracion();
        $data['empresa'] = $empresa->first();
        $categorias = new Categoria();
        $productos = new Producto();
        $data['class'] = 'hero hero-normal';
        $data['active'] = 'tienda';
        $data['categorias'] = $categorias->findAll();

        $config = [
            'baseURL' => base_url('TiendaController/index'), // Cambia 'controlador/mostrarProductos' por la URL de tu controlador y método
            'totalRows' => $productos->countAll(), // Obtiene el total de filas de tu modelo
            'perPage' => 12, // Número de productos por página
        ];

        $data['productos'] = $productos->orderBy('id', 'DESC')->paginate($config['perPage']);
        $data['paginador'] = $productos->pager;
        $data['totalProductos'] = $productos->countAllResults();

        return view('principal/tienda', $data);
    }

    public function carrito(): string
    {
        $empresa = new Configuracion();
        $data['empresa'] = $empresa->first();
        $data['class'] = 'hero hero-normal';
        $data['active'] = 'carrito';
        $categorias = new Categoria();
        $data['categorias'] = $categorias->findAll();
        return view('principal/carrito', $data);
    }

    public function checkout()
    {
        $empresa = new Configuracion();
        $data['empresa'] = $empresa->first();
        $data['class'] = 'hero hero-normal';
        $data['active'] = 'carrito';
        $categorias = new Categoria();
        $data['categorias'] = $categorias->findAll();
        return view('principal/checkout', $data);
    }

    public function detail($slug)
    {
        $empresa = new Configuracion();
        $data['empresa'] = $empresa->first();
        $data['class'] = 'hero hero-normal';
        $data['active'] = 'tienda';

        $categorias = new Categoria();
        $productoModel = new Producto();
        $calificacionModel = new Calificacion();

        // Obtener información del producto
        $data['categorias'] = $categorias->findAll();
        $data['producto'] = $productoModel->where('slug', $slug)->first();

        // Obtener la calificación promedio del producto
        $productoId = $data['producto']['id'];
        $promedioCalificacion = $calificacionModel->where('id_producto', $productoId)
            ->selectAvg('calificacion', 'promedio_calificacion')
            ->first();

        // Agregar la calificación promedio al array de datos
        $data['promedio_calificacion'] = ($promedioCalificacion && $promedioCalificacion['promedio_calificacion'] !== null)
            ? round($promedioCalificacion['promedio_calificacion'], 1)
            : null;

        $data['calificaciones'] = $calificacionModel->select('calificaciones.calificacion,calificaciones.comentario, u.nombre')
            ->join('usuarios AS u', 'calificaciones.id_usuario = u.id')
            ->where('calificaciones.id_producto', $productoId)
            ->orderBy('calificaciones.id', 'desc')
            ->findAll();

        $data['imagenes'] = array();
        $directorio = 'img/productos/' . $productoId;
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

        // Cargar la vista con los datos
        return view('principal/detail', $data);
    }


    public function categorias($slug): string
    {
        $empresa = new Configuracion();
        $data['empresa'] = $empresa->first();
        $data['class'] = 'hero hero-normal';
        $data['active'] = 'tienda';
        $categorias = new Categoria();
        $producto = new Producto();
        $data['categorias'] = $categorias->findAll();
        $data['categoria'] = $categorias->where('slug', $slug)->first();
        $id_categoria = $data['categoria']['id'];

        $config = [
            'baseURL' => base_url('TiendaController/index'), // Cambia 'controlador/mostrarProductos' por la URL de tu controlador y método
            'totalRows' => $producto->countAll(), // Obtiene el total de filas de tu modelo
            'perPage' => 12, // Número de productos por página
        ];

        $data['productos'] = $producto->where('id_categoria', $id_categoria)->orderBy('id', 'DESC')->paginate($config['perPage']);
        $data['paginador'] = $producto->pager;
        $data['totalProductos'] = $producto->where('id_categoria', $id_categoria)->countAllResults();

        return view('principal/categorias', $data);
    }

    public function contactos(): string
    {
        $empresa = new Configuracion();
        $data['empresa'] = $empresa->first();
        $data['class'] = 'hero hero-normal';
        $data['active'] = 'contactos';
        $categorias = new Categoria();
        $data['categorias'] = $categorias->findAll();
        return view('principal/contactos', $data);
    }

    public function contactenos()
    {
        $empresa = new Configuracion();


        $data = [];

        if ($this->request->getMethod() === 'post') {
            $validationRules = [
                'nombre' => 'required|min_length[3]',
                'correo' => 'required|valid_email',
                'mensaje' => 'required|min_length[5]'
            ];

            if ($this->validate($validationRules)) {
                //ENVIAR CORREO
                $mail = new PHPMailer(true);
                try {
                    $datos = $empresa->first();
                    //Server settings
                    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                    $mail->SMTPDebug = 0;                      //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = $datos['host_smtp'];                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = $datos['user_smtp'];                     //SMTP username
                    $mail->Password   = $datos['clave_smtp'];                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                    $mail->Port       = $datos['puerto_smtp'];                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                    //Recipients
                    $mail->setFrom($this->request->getVar('correo'), $this->request->getVar('nombre'));
                    $mail->addAddress($datos['correo']);

                    //Content
                    $mail->isHTML(true);
                    $mail->CharSet = 'UTF-8';                                  //Set email format to HTML
                    $mail->Subject = $datos['nombre_comercial'];
                    $mail->Body    = $this->request->getVar('mensaje');

                    $mail->send();
                    return redirect()->to('contactos')->with('success', 'Correo Enviado');
                } catch (Exception $e) {
                    return redirect()->to('contactos')->with('error', 'ERROR AL ENVIAR EL CORREO: ' . $mail->ErrorInfo);
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        $data['class'] = 'hero hero-normal';
        $data['active'] = 'contactos';
        $categorias = new Categoria();
        $data['categorias'] = $categorias->findAll();
        $data['empresa'] = $empresa->first();
        return view('principal/contactos', $data);
    }

    //LISTA DE DESEO
    public function miListaDeseo()
    {
        $empresa = new Configuracion();
        $data['empresa'] = $empresa->first();
        $data['class'] = 'hero hero-normal';
        $data['active'] = '';
        $categorias = new Categoria();
        $data['categorias'] = $categorias->findAll();
        return view('principal/deseo', $data);
    }

    // En tu controlador
    public function search()
    {
        $productosModel = new Producto(); // Ajusta según tu modelo

        $term = $this->request->getVar('term'); // Obtiene el término de búsqueda desde la solicitud AJAX

        // Realiza la búsqueda en la base de datos utilizando LIKE
        $productos = $productosModel->like('titulo', $term)->findAll(10);

        $result = [];

        foreach ($productos as $producto) {
            $result[] = [
                'id'    => $producto['id'],
                'label' => $producto['titulo'],
                'value' => $producto['titulo'],
                'slug' => $producto['slug']
            ];
        }

        return $this->response->setJSON($result);
    }
}
