import { validarFormulario } from "../funciones";
import Swal from "sweetalert2";

const formulario = document.getElementById('formPermiso');
const BtnGuardar = document.getElementById('btnGuardar');
const BtnModificar = document.getElementById('btnModificar');
const BtnCancelar = document.getElementById('btnCancelar');
const TablaPermiso = document.getElementById('TablitaPermiso');

TablaPermiso.parentElement.parentElement.classList.add('d-none');
BtnModificar.parentElement.classList.add('d-none');
BtnCancelar.parentElement.classList.add('d-none');

const Buscar = async () => {
    try {
        const url = '/CrudMVC2024/API/permiso/buscar';
        const respuesta = await fetch(url);
        const data = await respuesta.json();

        TablaPermiso.tBodies[0].innerHTML = '';
        const fragment = document.createDocumentFragment();
        let contador = 1;

        if (data.length > 0) {
            TablaPermiso.parentElement.parentElement.classList.remove('d-none');
            data.forEach(permiso => {
                const tr = document.createElement('tr');
                const celda1 = document.createElement('td');
                const celda2 = document.createElement('td');
                const celda3 = document.createElement('td');
                const celda4 = document.createElement('td');
                const celda5 = document.createElement('td');

                const BtnModificar = document.createElement('button');
                const BtnEliminar = document.createElement('button');

                BtnModificar.innerHTML = '<i class="bi bi-pencil"></i>';
                BtnModificar.classList.add('btn', 'btn-warning', 'w-100', 'text-uppercase', 'fw-bold', 'shadow', 'border-0');
                BtnEliminar.innerHTML = '<i class="bi bi-trash3"></i>';
                BtnEliminar.classList.add('btn', 'btn-danger', 'w-100', 'text-uppercase', 'fw-bold', 'shadow', 'border-0');

                BtnModificar.addEventListener('click', () => llenarDatos(permiso));
                BtnEliminar.addEventListener('click', () => Eliminar(permiso));

                celda1.innerText = contador;
                celda2.innerText = permiso.usu_nombre;
                celda3.innerText = permiso.rol_nombre;
                celda4.appendChild(BtnModificar);
                celda5.appendChild(BtnEliminar);

                tr.appendChild(celda1);
                tr.appendChild(celda2);
                tr.appendChild(celda3);
                tr.appendChild(celda4);
                tr.appendChild(celda5);

                fragment.appendChild(tr);
                contador++;
            });
        } else {
            const tr = document.createElement('tr');
            const td = document.createElement('td');
            td.innerText = 'No hay permisos registrados';
            tr.classList.add('text-center');
            td.colSpan = 5;
            tr.appendChild(td);
            fragment.appendChild(tr);
        }
        TablaPermiso.tBodies[0].appendChild(fragment);
    } catch (error) {
        console.error('Error al buscar permisos:', error);
    }
};

const guardar = async (e) => {
    e.preventDefault();

    BtnGuardar.disabled = true;

    if (!validarFormulario(formulario, ['permiso_id', 'permiso_usuario', 'permiso_rol'])) {
        BtnGuardar.disabled = false;
        return;
    }

    try {
        const url = '/CrudMVC2024/API/permiso/guardar';
        const formData = new FormData(formulario);
        const respuesta = await fetch(url, {
            method: 'POST',
            body: formData
        });

        const data = await respuesta.json();

        if (data.codigo === 1) {
            await Swal.fire({
                title: 'Éxito',
                text: data.mensaje,
                icon: 'success',
                confirmButtonText: 'Aceptar'
            });
            formulario.reset();
            Buscar();
        } else {
            await Swal.fire({
                title: 'Error',
                text: data.mensaje,
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
        }
    } catch (error) {
        console.error('Error al guardar permiso:', error);
    } finally {
        BtnGuardar.disabled = false;
    }
};

//funcion modificar
const Modificar = async (e) => {
    e.preventDefault();

    BtnModificar.disabled = true;

    if (!validarFormulario(formulario, ['permiso_id', 'permiso_usuario', 'permiso_rol'])) {
        BtnModificar.disabled = false;
        return;
    }

    try {
        const url = '/CrudMVC2024/API/permiso/modificar';
        const formData = new FormData(formulario);
        const respuesta = await fetch(url, {
            method: 'POST',
            body: formData
        });

        const data = await respuesta.json();

        if (data.codigo === 3) {
            await Swal.fire({
                title: 'Éxito',
                text: data.mensaje,
                icon: 'success',
                confirmButtonText: 'Aceptar'
            });
            formulario.reset();
            Buscar();
            // Volver a estado inicial del formulario
            BtnGuardar.parentElement.classList.remove('d-none');
            BtnModificar.parentElement.classList.add('d-none');
            BtnCancelar.parentElement.classList.add('d-none');
        } else {
            await Swal.fire({
                title: 'Error',
                text: data.mensaje,
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
        }
    } catch (error) {
        console.error('Error al modificar permiso:', error);
    } finally {
        BtnModificar.disabled = false;
    }
};

const Eliminar = async (permiso) => {
    try {
        const url = '/CrudMVC2024/API/permiso/eliminar';
        const formData = new FormData();
        formData.append('permiso_id', permiso.permiso_id);

        const respuesta = await fetch(url, {
            method: 'POST',
            body: formData
        });

        const data = await respuesta.json();

        if (data.codigo === 4) {
            await Swal.fire({
                title: 'Éxito',
                text: data.mensaje,
                icon: 'success',
                confirmButtonText: 'Aceptar'
            });
            formulario.reset();
            Buscar();
            // Volver a estado inicial del formulario
            BtnGuardar.parentElement.classList.remove('d-none');
            BtnModificar.parentElement.classList.add('d-none');
            BtnCancelar.parentElement.classList.add('d-none');
        } else {
            await Swal.fire({
                title: 'Error',
                text: data.mensaje,
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
        }
    } catch (error) {
        console.error('Error al eliminar permiso:', error);
    }
};
const llenarDatos = (permiso) => {
    document.getElementById('permiso_id').value = permiso.permiso_id;
    document.getElementById('permiso_usuario').value = permiso.permiso_usuario;
    document.getElementById('permiso_rol').value = permiso.permiso_rol;

    BtnGuardar.parentElement.classList.add('d-none');
    BtnModificar.parentElement.classList.remove('d-none');
    BtnCancelar.parentElement.classList.remove('d-none');
};

const cancelar = (e) => {
    e.preventDefault();
    formulario.reset();
    BtnGuardar.parentElement.classList.remove('d-none');
    BtnModificar.parentElement.classList.add('d-none');
    BtnCancelar.parentElement.classList.add('d-none');
};

formulario.addEventListener('submit', guardar);
BtnCancelar.addEventListener('click', cancelar);
BtnModificar.addEventListener('click', Modificar)

Buscar();
