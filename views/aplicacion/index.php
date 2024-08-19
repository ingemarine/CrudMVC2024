<h2 class="text-center text-primary font-weight-bold">APLICACIÓN</h2>
<div class="row justify-content-center mt-3 mb-5">
    <form class="border bg-white shadow-sm rounded p-5 col-lg-6" id="FormAplicacion">
        <div class="row mb-4">
            <div class="col">
                <input type="hidden" name="app_id" id="app_id" class="form-control">
            </div>
        </div>
        <div class="row mb-4 text-center">
            <div class="col">
                <label for="app_nombre" class="form-label text-primary">Nombre de la APP</label>
                <input type="text" name="app_nombre" id="app_nombre" class="form-control border-primary shadow-sm">
            </div>
        </div>

        <div class="row mb-3 justify-content-center text-center">
            <div class="col-lg-4 mb-2">
                <button type="submit" id="BtnGuardar" class="btn btn-primary w-100 text-uppercase shadow-sm border-0">
                    <i class="bi bi-floppy"></i> Guardar
                </button>
            </div>
            <div class="col-lg-4 mb-2">
                <button type="button" id="BtnModificar" class="btn btn-success w-100 text-uppercase shadow-sm border-0"><i class="bi bi-pencil-square"></i> 
                    Modificar
                </button>
            </div>
            <div class="col-lg-4">
                <button type="button" id="BtnCancelar" class="btn btn-secondary w-100 text-uppercase shadow-sm border-0">
                    Cancelar
                </button>
            </div>
        </div>
    </form>
</div>


    <!-- MOSTRAR DATOS -->
    <div class="row justify-content-center mt-4">
    <div class="col-lg-6 table-wrapper p-4 rounded shadow-lg" style="font-family:'Courier New', Courier, monospace; ">
        <h2 class="text-center mb-4 text-primary">Aplicaciones Ingresadas</h2>
        <div class="table-responsive bg-white p-3 rounded shadow-sm">
            <table class="table table-bordered table-hover mb-0" id="TablitaAplicacion" style="font-family:'Courier New', Courier, monospace;">
                <thead class="table-success">
                    <tr>
                        <th>No.</th>
                        <th>Nombre</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4" class="text-center">Sin Aplicaciones registradas</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="<?= asset('./build/js/aplicacion/index.js') ?>"></script>
