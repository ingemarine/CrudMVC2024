<h2 class="text-center">PRODUCTOS</h2>
<div class="row justify-content-center mt-3 mb-5">
    <form class="border bg-light shadow rounded p-4 col-lg-6" id="FormProducto">
        <div class="row mb-3">
            <div class="col">
                <input type="hidden" name="prod_id" id="prod_id" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="prod_nombre">Nombres del Prodcuto</label>
                <input type="text" name="prod_nombre" id="prod_nombre" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="prod_precio">Precio</label>
                <input type="number" name="prod_precio" step="any" id="prod_precio" class="form-control">
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
            <h2 class="text-center mb-4">Productos Ingresados</h2>
            <div class="table-responsive" >
                <table class="table table-bordered table-hover" id="Tablita" style="font-family:'Courier New', Courier, monospace; background-color: darkgoldenrod;">
                    <thead class="table-primary">
                        <tr>
                            <th>No.</th>
                            <th>Nombres</th>
                            <th>Precio</th>
                            <th>Modificar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="5" class="text-center">Sin productos registrados</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="<?= asset('./build/js/producto/index.js') ?>"></script>