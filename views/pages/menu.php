<h1>Menu principal de la APP</h1>
<a href="/CrudMVC2024/logout" class="btn btn-danger">Salir</a>
<?php var_dump($_SESSION) ?>

<?php if ($_SESSION['user']['rol_nombre_ct'] == 'TIENDA_ADMIN') : ?>
    <p>Usuario administrador</p>

<?php endif ?>