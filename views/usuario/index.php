<h2 class="text-center">USUARIO</h2>
<div class="row justify-content-center mt-3 mb-5">
    <form class="border bg-light shadow rounded p-4 col-lg-6" id="FormUsuario">
        <div class="row mb-3">
            <div class="col">
                <input type="hidden" name="usu_id" id="usu_id" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="usu_nombre">Nombre del Usuario</label>
                <input type="text" name="usu_nombre" id="usu_nombre" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="usu_catalogo">Catálogo</label>
                <input type="number" name="usu_catalogo" id="usu_catalogo" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="usu_password">Contraseña</label>
                <input type="password" name="usu_password" id="usu_password" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="usu_password_confirm">Confirmar Contraseña</label>
                <input type="password" name="usu_password_confirm" id="usu_password_confirm" class="form-control">
            </div>
        </div>

        <div class="row mb-3 justify-content-center text-center">
            <div class="col-lg-5">
                <button type="submit" id="BtnGuardar" class="btn btn-primary w-100 text-uppercase shadow border-0"><i class="bi bi-floppy"></i> Guardar</button>
            </div>
            <div class="col-lg-5">
                <button type="button" id="BtnModificar" class="btn btn-success w-100 text-uppercase shadow border-0">Modificar</button>
            </div>
            <div class="col-lg-5">
                <button type="button" id="BtnCancelar" class="btn btn-secondary w-100 text-uppercase shadow border-0">Cancelar</button>
            </div>
        </div>
    </form>

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
