<?php
require_once("../model/VentaModel.php");
require_once("../model/ProductsModel.php");

$objProducto = new ProductsModel();
$objVenta = new VentaModel();

$tipo = $_GET['tipo'];

if ($tipo == "registrarTemporal") {
    $respuesta = array('status' => false, 'msg' => 'fallo el controlador');
    $id_producto = $_POST['id_producto'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];

    $b_producto = $objVenta->buscarTemporal($id_producto);
    if ($b_producto) {
        $n_cantidad = $b_producto->cantidad + 1;
        $objVenta->actualizarCantidadTemporal($id_producto, $n_cantidad);
        $respuesta = array('status' => true, 'msg' => 'actualizado');
    } else {
        $registro = $objVenta->registrar_temporal($id_producto, $precio, $cantidad);
        $respuesta = array('status' => true, 'msg' => 'registrado');
    }
    echo json_encode($respuesta);
}

if ($tipo == "listar_venta_temporal") {
    $respuesta = array('status' => false, 'msg' => 'fallo el controlador');
    $b_producto = $objVenta->buscarTemporales();
    if ($b_producto) {
        $respuesta = array('status' => true, 'data' => $b_producto);
    } else {
        $respuesta = array('status' => false, 'msg' => 'no se encontraron datos');
    }
    echo json_encode($respuesta);
}

if ($tipo == "actualizar_cantidad") {
    $id = $_POST['id'];
    $cantidad =  $_POST['cantidad'];
    $respuesta = array('status' => false, 'msg' => 'fallo el controlador');
    $consulta = $objVenta->actualizarCantidadTemporalByid($id, $cantidad);
    if ($consulta) {
        $respuesta = array('status' => true, 'msg' => 'success');
    } else {
        $respuesta = array('status' => false, 'msg' => 'error');
    }
    echo json_encode($respuesta);
}

if ($tipo == "eliminar_temporal") {
    $id = $_POST['id'];
    $respuesta = array('status' => false, 'msg' => 'fallo el controlador');
    $consulta = $objVenta->eliminarTemporal($id);
    if ($consulta) {
        $respuesta = array('status' => true, 'msg' => 'eliminado');
    } else {
        $respuesta = array('status' => false, 'msg' => 'error');
    }
    echo json_encode($respuesta);
}

if ($tipo === "registrar_venta") {

    session_start();

    if (!isset($_SESSION['ventas_id'])) {
        echo json_encode([
            'status' => false,
            'msg' => 'Sesión expirada o usuario no autenticado'
        ]);
        exit;
    }

    if (!isset($_POST['id_cliente'], $_POST['fecha_venta'])) {
        echo json_encode([
            'status' => false,
            'msg' => 'Datos incompletos'
        ]);
        exit;
    }

    $id_cliente = $_POST['id_cliente'];
    $fecha_venta = $_POST['fecha_venta'];
    $id_vendedor = $_SESSION['ventas_id'];

    $ultima = $objVenta->buscar_ultima_venta();
    $codigo = $ultima ? $ultima->codigo + 1 : 1;

    $venta_id = $objVenta->registrar_venta(
        $codigo,
        $fecha_venta,
        $id_cliente,
        $id_vendedor
    );

    if (!$venta_id) {
        echo json_encode([
            'status' => false,
            'msg' => 'Error al registrar venta'
        ]);
        exit;
    }

    $temporales = $objVenta->buscarTemporales();

    if (!$temporales || count($temporales) === 0) {
        echo json_encode([
            'status' => false,
            'msg' => 'No hay productos en la venta'
        ]);
        exit;
    }

    foreach ($temporales as $t) {
        $objVenta->registrar_detalle_venta(
            $venta_id,
            $t->id_producto,
            $t->precio,
            $t->cantidad
        );
    }

    $objVenta->eliminarTemporales();

    echo json_encode([
        'status' => true,
        'msg' => 'Venta registrada correctamente'
    ]);
    exit;
}
