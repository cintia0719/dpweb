<?php
// Vista simple para mostrar los productos en grid. 
// Incluye tu header/plantilla según tu proyecto. 
// Asegúrate que la variable PHP base_url (o constante) exista y coincida con la que usa JS. 
$base = defined('BASE_URL') ? BASE_URL : '/'; // ajustar según tu proyecto 
?>

<div class="container-fluid mt-4 row">
    <h2>Ventas</h2>
    <div class="col 9">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Busqueda de Productos</h5>
                <div class="col-md-6">
                    <input type="text" class="form-control col-md-12" 
                    placeholder="buscar producto por codigo o nombre" id="busqueda_venta" onkeyup="viewMisProducts();">
                    <input type="hidden" id="id_producto_venta">
                    <input type="hidden" id="producto_precio_venta">
                    <input type="hidden" id="producto_cantidad_venta" value="1">
                </div>

                <div class="row container-fluid" id="productos_venta">
                    <!--<div class="card m-2 col-3">
                        <div class="card-body">
                            <img src="https://www.agenciaeplus.com.br/wp-content/uploads/2021/12/pagina-de-produto.jpg" alt="" width="100%" height="150px">
                            <p class="card-text">Descripcion del producto</p>
                            <button class="btn btn-primary">Agregar</button>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
        <div class="container py-3">
    <h2></h2>
    <div id="productos_grid" class="row g-2"> <!-- El contenido se rellenará desde JS --> 
    </div>
</div>
    </div>

    <div class="col-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Lista de Compra</h5>
                <div class="row" style="min-height: 500px;">
                    <div class="col-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Total</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="lista_compra">
                                <tr>
                                    <td>Producto 1</td>
                                    <td>2</td>
                                    <td>$10.00</td>
                                    <td>$20.00</td>
                                    <td><button class="btn btn-danger btn-sm">Eliminar</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-end">
                        <h4>Subtotal : <label id="">$20.00</label></h4>
                        <h4>Igv : <label id="">$20.00</label></h4>
                        <h4>Total : <label id="">$20.00</label></h4>
                        <button class="btn btn-success">Realizar Venta</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo BASE_URL; ?>view/function/producto.js"></script>
<script src="<?php echo BASE_URL; ?>view/function/venta.js"></script>
<script>
    let input = document.getElementById("busqueda_venta");
    input.addEventListener('keydown', (event) =>{
        if (event.key == 'Enter') {
            agregar_producto_temporal();
        }
    })
</script>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

    * {
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
    }

    body {
        background: #fff4fa;
        padding: 20px;
    }

    .card {
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(185, 79, 185, 0.2);
        border: none;
    }

    #buscar_producto {
        border-radius: 25px;
        padding: 10px 15px;
        border: 1px solid #e0b0e0;
        box-shadow: 0 2px 5px rgba(185, 79, 185, 0.1);
    }

    .producto {
        background: #ffffff;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(185, 79, 185, 0.2);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
    }

    .producto:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(185, 79, 185, 0.35);
    }

    .descuento {
        position: absolute;
        top: 10px;
        left: 10px;
        background: #ff66b3;
        color: white;
        padding: 5px 10px;
        border-radius: 12px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .producto img {
        width: 100%;
        height: 280px;
        object-fit: cover;
        border-bottom: 1px solid #f2d1f2;
        transition: transform 0.4s ease;
    }

    .producto img:hover {
        transform: scale(1.05);
    }

    .info {
        padding: 15px;
        text-align: center;
    }

    .info h3 {
        font-size: 1.1rem;
        color: #333;
        margin-bottom: 5px;
    }

    .info p {
        color: #777;
        font-size: 0.9rem;
        margin-bottom: 10px;
    }

    .precio {
        font-size: 1.2rem;
        color: #b94fb9;
        font-weight: 600;
    }

    .precio span {
        text-decoration: line-through;
        color: #999;
        font-size: 0.9rem;
        margin-left: 5px;
    }

    .botones {
        display: flex;
        justify-content: space-around;
        padding: 10px 15px 20px;
    }

    .botones button {
        border: none;
        padding: 8px 14px;
        border-radius: 25px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-ver {
        background: #e9b8f9;
        color: #fff;
    }

    .btn-ver:hover {
        background: #d184e2;
    }

    .btn-agregar {
        background: #b94fb9;
        color: #fff;
    }

    .btn-agregar:hover {
        background: #9d3d9d;
        /* agregado */
    }
</style>