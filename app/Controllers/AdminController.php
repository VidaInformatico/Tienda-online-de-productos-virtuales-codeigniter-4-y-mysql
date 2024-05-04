<?php

namespace App\Controllers;

use App\Models\DetallePedido;
use App\Models\Pedido;

class AdminController extends BaseController
{
    protected $session;
    public function __construct()
    {
        $this->session = \Config\Services::session();
    }
    public function index()
    {
        $pedidosModel = new Pedido();

        // Realiza la consulta a la base de datos para obtener la cantidad de pedidos por mes
        $result = $pedidosModel->select('MONTH(fecha) as mes, SUM(monto) as total')
            ->groupBy('mes')
            ->orderBy('mes', 'ASC')
            ->findAll();

        // Prepara los datos para el gráfico
        $data['reportData'] = $result;
        $data['active'] = 'dashboard';
        // Carga la vista 'admin/dashboard' y pasa los datos
        return view('admin/dashboard', $data);
    }

    public function pagos()
    {
        $data['active'] = '';
        return view('principal/pagos', $data);
    }

    public function registrarPedido()
    {
        // Obtener los datos del cuerpo de la solicitud
        $data = $this->request->getJSON();

        // Acceder a los datos específicos
        $pedidos = $data->pedidos;
        $productos = $data->productos;

        // Insertar datos en la tabla de pedidos
        $pedidoModel = new Pedido();
        $pedidoData = [
            'nombre' => $pedidos->payer->name->given_name,  // Puedes obtener esto de tu aplicación
            'transaccion' => $pedidos->id,
            'fecha' => date('Y-m-d H:i:s'),
            'estado' => $pedidos->status,
            'monto' => $pedidos->purchase_units[0]->amount->value,
            'correo' => $pedidos->payer->email_address,  // Puedes obtener esto de tu aplicación
            'metodo' => 'PayPal',  // O el método de pago que estás utilizando
            'id_usuario' => $this->session->user_id
        ];
        $pedidoId = $pedidoModel->insert($pedidoData);

        // Insertar datos en la tabla de detalles de pedidos
        $detallePedidoModel = new DetallePedido();
        foreach ($productos as $producto) {
            $detallePedidoData = [
                'precio' => $producto->precio,
                'cantidad' => $producto->quantity,
                'id_pedido' => $pedidoId,
                'id_producto' => $producto->id,
            ];
            $detallePedidoModel->insert($detallePedidoData);
        }

        // Enviar una respuesta JSON al frontend
        return $this->response->setJSON(['msg' => 'Pedido registrado con éxito', 'icono' => 'success']);
    }

    public function pedidos()
    {
        return view('admin/pedidos/index');
    }

    public function detallePedido($id)
    {
        $detalleModel = new DetallePedido();
        $data['productos'] = $detalleModel->select('detallepedidos.*, p.titulo')
        ->join('productos p', 'detallepedidos.id_producto = p.id')
        ->where('detallepedidos.id_pedido', $id)
        ->findAll($id);
        //ACTUALIZAR COMO LEIDO
        $pedidoModel = new Pedido();
        $pedidoModel->update($id, ['leido' => 0]);
        return view('admin/pedidos/detalle', $data);
    }

    public function showPedido()
    {
        $pedidoModel = new Pedido();
        $data['data'] = $pedidoModel->select('pedidos.*, u.nombre AS usuario')
            ->join('usuarios u', 'pedidos.id_usuario = u.id')
            ->findAll();
        return $this->response->setJSON($data);
    }

    public function totalPedidos(){
        $pedidoModel = new Pedido();
        $data['data'] = $pedidoModel->selectCount('id')
            ->where('leido', '1')
            ->first();
        return $this->response->setJSON($data);
    }
}
