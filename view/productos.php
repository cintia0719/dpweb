<div class="container-fluid mt-4 row">
    <h2>Ventas</h2>
    <div class="col-8">
        <div class="card">
            <div class="card-body row">
                <h5 class="card-title col-md-4">Busqueda de Productos</h5>
                <div class="col-md-6">
                    <input type="text" class="form-control col-md-12" placeholder="buscar producto por codigo o nombre" id="busqueda_venta" onkeyup="listar_productos_venta();">
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
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Lista de Compra</h5>
                <div class="row" style="min-height: auto;">
                    <div class="col-12">
                        <table class="table-responsive table table-hover">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Cant.</th>
                                    <th>P. Unit.</th>
                                    <th>SubTotal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="lista_compra">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-end">
                        <h4>Subtotal : <label id="subtotal_general"></label></h4>
                        <h4>Igv : <label id="igv_general"></label></h4>
                        <h4>Total : <label id="total"></label></h4>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Realizar Venta</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Registro de Venta</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_venta">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="cliente_dni" class="form-label">DNI del Cliente</label>
                            <input type="text" class="form-control" id="cliente_dni" name="cliente_dni" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="11">
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary mt-4" onclick="buscar_cliente_venta();">Buscar Cliente</button>
                        </div>
                        <div class="col-md-12">
                            <label for="cliente_nombre" class="form-label">Nombre del Cliente</label>
                            <input type="text" class="form-control" id="cliente_nombre" name="cliente_nombre" readonly>
                            <input type="hidden" class="form-control" id="id_cliente_venta">
                        </div>
                        <div class="col-md-3">
                            <label for="fecha_venta">fecha de venta</label>
                            <input type="datetime" class="form-control" id="fecha_venta" name="fecha_venta" value="<?= date('Y-m-d H:i') ?>">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="registrarVenta();">Registrar Venta</button>
            </div>
        </div>
    </div>
</div>
<script src="<?= BASE_URL ?>view/function/producto.js"></script>
<script src="<?= BASE_URL ?>view/function/venta.js"></script>

<script>
    let input = document.getElementById("busqueda_venta");
    input.addEventListener('keydown', (event) => {
        if (event.key == 'Enter') {
            agregar_producto_temporal();
        }
    });
    // Cargar productos al iniciar la vista
    document.addEventListener('DOMContentLoaded', () => {
        listar_productos_venta();
        listar_temporales();
        act_subt_general();
    });
</script>

<style>
    /* =========================
   ESTILO PASTEL FEMENINO
   ========================= */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

:root {
    --rosa: #f8c8dc;
    --rosa-fuerte: #f2a7c6;
    --lila: #e6d9ff;
    --lavanda: #d8c7ff;
    --crema: #fff7fb;
    --morado: #9b7fcf;
    --gris: #777;
}

body {
    background: linear-gradient(120deg, #fff1f7, #f6f2ff);
    font-family: 'Poppins', sans-serif;
}

/* TITULOS */
h2, h5 {
    color: var(--morado);
    font-weight: 600;
}

/* CARDS */
.card {
    border: none;
    border-radius: 18px;
    background: var(--crema);
    box-shadow: 0 8px 20px rgba(200, 150, 220, 0.25);
}

/* INPUTS */
.form-control {
    border-radius: 25px;
    border: 1px solid var(--lila);
    padding: 10px 15px;
}

.form-control:focus {
    box-shadow: 0 0 0 0.2rem rgba(216, 199, 255, 0.4);
    border-color: var(--lavanda);
}

/* TABLA */
.table thead {
    background: var(--lila);
    color: #5a4a80;
}

.table tbody tr:hover {
    background: #fdf2ff;
}

/* BOTONES */
.btn-success {
    background: linear-gradient(45deg, #f2a7c6, #d8c7ff);
    border: none;
    border-radius: 25px;
    font-weight: 600;
}

.btn-success:hover {
    background: linear-gradient(45deg, #e38ab0, #c3b1ff);
}

.btn-primary {
    background: linear-gradient(45deg, #d8c7ff, #f8c8dc);
    border: none;
    border-radius: 25px;
    color: #5a4a80;
    font-weight: 600;
}

.btn-primary:hover {
    background: linear-gradient(45deg, #c3b1ff, #f2a7c6);
}

.btn-danger {
    background: linear-gradient(45deg, #c3b1ff, #f2a7c6);
    border: none;
    border-radius: 6px;      
    padding: 6px 10px;
    font-weight: 600;
    color: #5a4a80;
}

.btn-danger:hover {
    background: linear-gradient(45deg, #b09df5, #e996b9);
    color: #4a3a70;
}
/* LISTA COMPRA */
#lista_compra td {
    vertical-align: middle;
    color: #555;
}

/* MODAL */
.modal-content {
    border-radius: 20px;
    background: linear-gradient(135deg, #fff7fb, #f6f2ff);
}

.modal-header {
    border-bottom: none;
}

.modal-title {
    color: var(--morado);
    font-weight: 600;
}

/* TOTAL */
#total {
    color: #9b7fcf;
    font-weight: 700;
    font-size: 1.4rem;
}

/* PRODUCTOS GRID */
#productos_venta .card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

#productos_venta .card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 25px rgba(180, 140, 220, 0.35);
}

</style>