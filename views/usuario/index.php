<h2 class="text-center mb-4 text-primary">Registrar Usuario</h2>
<div class="row justify-content-center mt-3 mb-5">
    <form class="border bg-white shadow-lg rounded p-5 col-lg-6" id="FormUsuario">
        <input type="hidden" name="usu_id" id="usu_id" class="form-control">

        <div class="form-group mb-4">
            <label for="usu_nombre" class="form-label fw-bold text-secondary">Nombre del Usuario</label>
            <input type="text" name="usu_nombre" id="usu_nombre" class="form-control" placeholder="Ingrese el nombre del usuario">
        </div>

        <div class="form-group mb-4">
            <label for="usu_catalogo" class="form-label fw-bold text-secondary">Catálogo</label>
            <input type="number" name="usu_catalogo" id="usu_catalogo" class="form-control" placeholder="Ingrese el catálogo">
        </div>

        <div class="form-group mb-4">
            <label for="usu_password" class="form-label fw-bold text-secondary">Contraseña</label>
            <input type="password" name="usu_password" id="usu_password" class="form-control" placeholder="Ingrese la contraseña">
        </div>

        <div class="form-group mb-4">
            <label for="usu_password_confirm" class="form-label fw-bold text-secondary">Confirmar Contraseña</label>
            <input type="password" name="usu_password_confirm" id="usu_password_confirm" class="form-control" placeholder="Confirme la contraseña">
        </div>

        <div class="row justify-content-between text-center">
            <div class="col-lg-5 mb-3">
                <button type="submit" id="BtnGuardar" class="btn btn-primary w-100 text-uppercase shadow-sm"><i class="bi bi-save-fill me-2"></i>Guardar</button>
            </div>
            <div class="col-lg-5 mb-3">
                <button type="button" id="BtnModificar" class="btn btn-success w-100 text-uppercase shadow-sm"><i class="bi bi-pencil-fill me-2"></i>Modificar</button>
            </div>
            <div class="col-lg-5 mb-3">
                <button type="button" id="BtnCancelar" class="btn btn-secondary w-100 text-uppercase shadow-sm"><i class="bi bi-x-circle-fill me-2"></i>Cancelar</button>
            </div>
        </div>
    </form>
</div>

    <!-- MOSTRAR DATOS -->
    <div class="row justify-content-center mt-4">
        <div class="col-lg-6 table-wrapper" style="font-family:'Courier New', Courier, monospace; background-color: darkgoldenrod;">
            <h2 class="text-center mb-4">Usuarios Ingresados</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="TablitaUsuario" style="font-family:'Courier New', Courier, monospace; background-color: darkgoldenrod;">
                    <thead class="table-success">
                        <tr>
                            <th>No.</th>
                            <th>Nombre</th>
                            <th>Catalogo</th>
                            <th>Modificar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="5" class="text-center">Sin Usuarios registrados</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="<?= asset('./build/js/usuario/index.js') ?>"></script>
