<?php
require_once("../model/VentaModel.php");
require_once("../model/ProductsModel.php");

header('Content-Type: application/json');

$objProducto = new ProductsModel();
$objVenta    = new VentaModel();

$tipo = $_GET['tipo'] ?? '';

/* =====================================================
   REGISTRAR PRODUCTO TEMPORAL
===================================================== */
if ($tipo === "registrarTemporal") {

    $id_producto = $_POST['id_producto'] ?? '';
    $precio      = $_POST['precio'] ?? '';
    $cantidad    = $_POST['cantidad'] ?? 1;

    if ($id_producto == '' || $precio == '') {
        echo json_encode(['status' => false, 'msg' => 'Datos incompletos']);
        exit;
    }

    $b_producto = $objVenta->buscarTemporal($id_producto);

    if ($b_producto) {
        $n_cantidad = $b_producto->cantidad + $cantidad;
        $objVenta->actualizarCantidadTemporal($id_producto, $n_cantidad);
        echo json_encode(['status' => true, 'msg' => 'actualizado']);
    } else {
        $objVenta->registrar_temporal($id_producto, $precio, $cantidad);
        echo json_encode(['status' => true, 'msg' => 'registrado']);
    }
    exit;
}

/* =====================================================
   LISTAR VENTA TEMPORAL
===================================================== */
if ($tipo === "listar_venta_temporal") {

    $temporales = $objVenta->buscarTemporales();

    if (!empty($temporales)) {
        echo json_encode(['status' => true, 'data' => $temporales]);
    } else {
        echo json_encode(['status' => false, 'msg' => 'No hay productos']);
    }
    exit;
}

/* =====================================================
   ACTUALIZAR CANTIDAD TEMPORAL
===================================================== */
if ($tipo === "actualizar_cantidad") {

    $id       = $_POST['id'] ?? '';
    $cantidad = $_POST['cantidad'] ?? '';

    if ($id == '' || $cantidad == '') {
        echo json_encode(['status' => false, 'msg' => 'Datos incompletos']);
        exit;
    }

    $ok = $objVenta->actualizarCantidadTemporalByid($id, $cantidad);

    echo json_encode([
        'status' => $ok ? true : false,
        'msg'    => $ok ? 'actualizado' : 'error'
    ]);
    exit;
}

/* =====================================================
   ELIMINAR TEMPORAL
===================================================== */
if ($tipo === "eliminar_temporal") {

    $id = $_POST['id'] ?? '';

    if ($id == '') {
        echo json_encode(['status' => false, 'msg' => 'ID requerido']);
        exit;
    }

    $ok = $objVenta->eliminarTemporal($id);

    echo json_encode([
        'status' => $ok ? true : false,
        'msg'    => $ok ? 'eliminado' : 'error'
    ]);
    exit;
}

/* =====================================================
   REGISTRAR VENTA FINAL
===================================================== */
if ($tipo === "registrar_venta") {

    session_start();

    if (!isset($_SESSION['ventas_id'])) {
        echo json_encode(['status' => false, 'msg' => 'Sesión no válida']);
        exit;
    }

    $id_cliente  = $_POST['id_cliente'] ?? '';
    $fecha_venta = $_POST['fecha_venta'] ?? '';
    $id_vendedor = $_SESSION['ventas_id'];

    if ($id_cliente == '' || $fecha_venta == '') {
        echo json_encode(['status' => false, 'msg' => 'Datos incompletos']);
        exit;
    }

    $ultima_venta = $objVenta->buscar_ultima_venta();
    $correlativo  = $ultima_venta ? ($ultima_venta->codigo + 1) : 1;

    $id_venta = $objVenta->registrar_venta(
        $correlativo,
        $fecha_venta,
        $id_cliente,
        $id_vendedor
    );

    if ($id_venta) {

        $temporales = $objVenta->buscarTemporales();

        foreach ($temporales as $temp) {
            $objVenta->registrar_detalle_venta(
                $id_venta,
                $temp->id_producto,
                $temp->precio,
                $temp->cantidad
            );
        }

        $objVenta->eliminarTemporales();

        echo json_encode(['status' => true, 'msg' => 'Venta registrada con éxito']);
    } else {
        echo json_encode(['status' => false, 'msg' => 'Error al registrar venta']);
    }
    exit;
}

/* =====================================================
   TIPO NO VÁLIDO
===================================================== */
echo json_encode(['status' => false, 'msg' => 'Tipo de operación no válida']);
exit;
