<h2 class="text-center">ROLES</h2>
<div class="row justify-content-center mt-3 mb-5">
    <form class="border bg-light shadow rounded p-4 col-lg-6" id="FormRol">
        <div class="row mb-3">
            <div class="col">
                <input type="hidden" name="rol_id" id="rol_id" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="rol_nombre">Nombre del Rol</label>
                <input type="text" name="rol_nombre" id="rol_nombre" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="rol_nombre_ct">Nombre del Rol CT</label>
                <input type="text" name="rol_nombre_ct" id="rol_nombre_ct" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="rol_app">Nombre de la Aplicacion</label>
                <select name="rol_app" id="rol_app" class="form-control">
                    <option value="#">Seleccione...</option>
                    <?php foreach ($aplicaciones as $app) : ?> 
                        <option value="<?= $app['app_id'] ?>"> <?=$app['app_nombre']?></option>';
                    <?php endforeach ?>
                </select>
            </div>
        </div>

        <div class="row mb-3 justify-content-center text-center">
            <div class="col-lg-5">
                <button type="submit" id="BtnGuardar" class="btn btn-primary w-100 text-uppercase shadow border-0">Guardar</button>
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
        <div class="col-lg-6 table-wrapper"style="font-family:'Courier New', Courier, monospace; background-color: darkgoldenrod;">
            <h2 class="text-center mb-4">Roles Ingresados</h2>
            <div class="table-responsive" >
                <table class="table table-bordered table-hover" id="TablitaRol" style="font-family:'Courier New', Courier, monospace; background-color: darkgoldenrod;">
                    <thead class="table-success">
                        <tr>
                            <th>No.</th>
                            <th>Nombre del Rol</th>
                            <th>Nombre rol Ct</th>
                            <th>Nombre App</th>
                            <th>Modificar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6" class="text-center">Sin Roles registradas</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="<?= asset('./build/js/rol/index.js') ?>"></script>