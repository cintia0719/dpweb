<div class="container mt-4">
  <a href="<?= BASE_URL ?>new-user" class="btn btn-primary">Nuevo +</a>
    <br><br>
  <div class="card shadow-lg border-0 rounded-3">
    <div class="card-header text-white text-center fw-semibold fs-5" style="background-color: #1b0d18ff;">
      <i class=""></i> LISTA DE USUARIOS
    </div>
    <table class="table table-bordered table-striped">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle text-center mb-0">
          <thead class="text-white" style="background-color: #e799d0ff;">
            <tr>
              <th scope="col">N°</th>
              <th scope="col">DNI</th>
              <th scope="col">Nombres y Apellidos</th>
              <th scope="col">Correo</th>
              <th scope="col">Rol</th>
              <th scope="col">Estado</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody id="content_users">
            <!-- Se cargan los usuarios dinámicamente -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script src="<?= BASE_URL ?>view/function/user.js"></script>
<!-- <script>view_users();</script> -->
