<div class="container">
  <br>
    <a href="<?= BASE_URL ?>productos" class="btn btn-primary">Nuevo +</a>
    <br><br>

  <div class="card shadow-lg border-0">
    <div class="card-header bg-primary text-white text-center fs-5 fw-bold">
      <i class="bi bi-box-seam text-warning me-2"></i> Lista de Productos
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover align-middle text-center table-bordered">

          <thead class="table-primary">
            <tr>
              <th><i class=""></i> Nro</th>
              <th><i class=""></i> Código</th>
              <th><i class=""></i> Nombre</th>
              <th><i class=""></i> Precio</th>
              <th><i class=""></i> Stock</th>
              <th><i class=""></i> Categoría</th>
              <th><i class=""></i> Proveedor</th>
              <th><i class=""></i> Vencimiento</th>
              <th><i class=""></i> Codigo Barra</th>
              <th><i class=""></i> Acciones</th>
            </tr>
          </thead>
          <tbody id="content_productos">
            <!-- Filas dinámicas generadas con JavaScript -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script src="<?php echo BASE_URL; ?>view/function/producto.js"></script>
<script src="<?php echo BASE_URL; ?>view/function/JsBarcode.all.min.js"></script>
