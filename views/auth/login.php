<h1 class="text-center mb-4" style="color: #4a4a4a; font-family: 'Poppins', sans-serif; font-weight: 600; letter-spacing: 1px;">Inicio de sesión</h1>
<div class="row justify-content-center">
    <form class="col-lg-4 border rounded shadow p-4" style="background-color: #f7f9fc; border: none; border-radius: 12px; box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1); padding: 40px;">
        <div class="text-center mb-4">
            <img src="<?= asset('./images/persona.webp'); ?>" alt="Icono de Usuario" style="width: 90px; border-radius: 50%; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);">
        </div>
        <div class="form-group mb-3">
            <label for="usu_catalogo" class="form-label" style="font-family: 'Poppins', sans-serif; font-weight: 500; color: #6c757d;">Catálogo del usuario</label>
            <input type="number" name="usu_catalogo" id="usu_catalogo" class="form-control" style="border-radius: 10px; border: 1px solid #ced4da; padding: 12px; font-size: 14px; color: #495057;">
        </div>
        <div class="form-group mb-4">
            <label for="usu_password" class="form-label" style="font-family: 'Poppins', sans-serif; font-weight: 500; color: #6c757d;">Password</label>
            <input type="password" name="usu_password" id="usu_password" class="form-control" style="border-radius: 10px; border: 1px solid #ced4da; padding: 12px; font-size: 14px; color: #495057;">
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary" style="background-color: #5c67f2; border: none; padding: 12px; font-size: 16px; font-weight: 600; border-radius: 10px; cursor: pointer; transition: background-color 0.3s, transform 0.2s;">
                Iniciar sesión
            </button>
        </div>
    </form>
</div>
<script src="<?=  asset('/build/js/auth/login.js' )?>" ></script>
