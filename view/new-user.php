<div class="container mt-4">
  <div class="card shadow-lg border-0 rounded-3">
    <div class="card-header text-white text-center fw-semibold fs-5" style="background-color: #1b0d18ff;">
      <i class=""></i> REGISTRO DE USUARIOS
    </div>

    <form id="frm_user" action="" method="">
      <div class="card-body">

        <div class="mb-3 row">
          <label for="nro_identidad" class="col-sm-2 col-form-label ">
            <i class=" text-primary"></i> N° Documento
          </label>
          <div class="col-sm-9">
            <input type="number" class="form-control" id="nro_identidad" name="nro_identidad" required>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="razon_social" class="col-sm-2 col-form-label ">
            <i class=" text-success"></i> Nombre/Razón Social
          </label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="razon_social" name="razon_social" required>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="telefono" class="col-sm-2 col-form-label ">
            <i class=" text-info"></i> Teléfono
          </label>
          <div class="col-sm-9">
            <input type="number" class="form-control" id="telefono" name="telefono" required>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="correo" class="col-sm-2 col-form-label ">
            <i class=" text-warning"></i> Correo
          </label>
          <div class="col-sm-9">
            <input type="email" class="form-control" id="correo" name="correo" required>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="departamento" class="col-sm-2 col-form-label ">
            <i class=" text-danger"></i> Departamento
          </label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="departamento" name="departamento" required>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="provincia" class="col-sm-2 col-form-label ">
            <i class=" text-success"></i> Provincia
          </label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="provincia" name="provincia" required>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="distrito" class="col-sm-2 col-form-label ">
            <i class=" text-primary"></i> Distrito
          </label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="distrito" name="distrito" required>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="cod_postal" class="col-sm-2 col-form-label ">
            <i class=" text-warning"></i> Código Postal
          </label>
          <div class="col-sm-9">
            <input type="number" class="form-control" id="cod_postal" name="cod_postal" required>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="direccion" class="col-sm-2 col-form-label ">
            <i class=" text-info"></i> Dirección
          </label>
          <div class="col-sm-9 ">
            <input type="text" class="form-control" id="direccion" name="direccion" required>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="rol" class="col-sm-2 col-form-label ">
            <i class=" text-danger"></i> Rol
          </label>
          <div class="col-sm-9">
            <select class="form-select" id="rol" name="rol" required>
              <option value="" disabled selected>Seleccione</option>
              <option value="admin">Administrador</option>
              <option value="user">Usuario</option>
              <option value="proveedor">Proveedor</option>
            </select>
          </div>
        </div>

        <div class="text-center">
          <button type="submit" class="btn btn-primary me-2">
            <i class=""></i> Registrar
          </button>
          <button type="reset" class="btn btn-info text-white me-2">
            <i class=""></i> Limpiar
          </button>
          <button type="button" class="btn btn-danger me-2">
            <i class=""></i> Cancelar
          </button>
          <a href="<?php echo BASE_URL; ?>usuarios-lista" class="btn btn-success">
            <i class=""></i> Ver
          </a>
        </div>

      </div>
    </form>
  </div>
</div>

<script src="<?php echo BASE_URL; ?>view/function/user.js"></script>
