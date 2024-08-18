import { Dropdwon, Tab } from "bootstrap";
import { Toast, validarFormulario } from "../funciones";
import Swal from "sweetalert2";

const formulario = document.getElementById('FormUsuario');
const TablaUsuario = document.getElementById('TablitaUsuario');
const BtnGuardar = document.getElementById('BtnGuardar');
const BtnModificar = document.getElementById('BtnModificar');
const BtnCancelar = document.getElementById('BtnCancelar');

TablaUsuario.parentElement.parentElement.classList.add('d-none');
BtnModificar.parentElement.classList.add('d-none');
BtnCancelar.parentElement.classList.add('d-none');

const guardar = async (e) => {
    e.preventDefault();

    BtnGuardar.disabled = true;

    if (!validarFormulario(formulario, ['usu_id', 'usu_password_confirm'])) {
        Swal.fire({
            title: "Campos vacíos",
            text: "Debe llenar todos los campos",
            icon: "info"
        });
        BtnGuardar.disabled = false;
        return;
    }

    const password = formulario.usu_password.value;
    const confirmPassword = formulario.usu_password_confirm.value;

    if (password !== confirmPassword) {
        Swal.fire({
            title: "Contraseñas no coinciden",
            text: "La confirmación de la contraseña no coincide.",
            icon: "warning"
        });
        BtnGuardar.disabled = false;
        return;
    }

    try {
        const body = new FormData(formulario);
        const url = '/CrudMVC2024/API/usuario/guardar';

        const config = {
            method: 'POST',
            body
        };

        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        const { codigo, mensaje } = data;

        if (codigo == 1) {
            Swal.fire({
                title: '¡Éxito!',
                text: mensaje,
                icon: 'success',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
            });
            formulario.reset();
            Buscar();
        } else {
            Swal.fire({
                title: '¡Error!',
                text: mensaje,
                icon: 'error',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
            });
        }
    } catch (error) {
        console.log(error);
    }

    BtnGuardar.disabled = false;
};

const Buscar = async () => {
    const url = '/CrudMVC2024/API/usuario/buscar';

    const config = {
        method: 'GET'
    };

    const respuesta = await fetch(url, config);
    const data = await respuesta.json();

    TablaUsuario.tBodies[0].innerHTML = '';
    const fragment = document.createDocumentFragment();
    let contador = 1;

    if (data.length > 0) {
        TablaUsuario.parentElement.parentElement.classList.remove('d-none');
        data.forEach(usuario => {
            const tr = document.createElement('tr');
            const celda1 = document.createElement('td');
            const celda2 = document.createElement('td');
            const celda3 = document.createElement('td');
            const celda4 = document.createElement('td');

            const BtnModificar = document.createElement('button');
            const BtnEliminar = document.createElement('button');

            BtnModificar.innerHTML = '<i class="bi bi-pencil"></i>';
            BtnModificar.classList.add('btn', 'btn-warning', 'w-100', 'text-uppercase', 'fw-bold', 'shadow', 'border-0');

            BtnEliminar.innerHTML = '<i class="bi bi-trash3"></i>';
            BtnEliminar.classList.add('btn', 'btn-danger', 'w-100', 'text-uppercase', 'fw-bold', 'shadow', 'border-0');

            BtnModificar.addEventListener('click', () => llenarDatos(usuario));
            BtnEliminar.addEventListener('click', () => Eliminar(usuario));

            celda1.innerText = contador;
            celda2.innerText = usuario.usu_nombre;
            celda3.appendChild(BtnModificar);
            celda4.appendChild(BtnEliminar);

            tr.appendChild(celda1);
            tr.appendChild(celda2);
            tr.appendChild(celda3);
            tr.appendChild(celda4);

            fragment.appendChild(tr);
            contador++;
        });
    } else {
        const tr = document.createElement('tr');
        const td = document.createElement('td');
        td.innerText = 'No existen usuarios';
        tr.classList.add('text-center');
        td.colSpan = 4;

        tr.appendChild(td);
        fragment.appendChild(tr);
    }

    TablaUsuario.tBodies[0].appendChild(fragment);
};

const llenarDatos = (usuario) => {
    TablaUsuario.parentElement.parentElement.classList.add('d-none');
    BtnGuardar.parentElement.classList.add('d-none');
    BtnModificar.parentElement.classList.remove('d-none');
    BtnCancelar.parentElement.classList.remove('d-none');

    formulario.usu_id.value = usuario.usu_id;
    formulario.usu_nombre.value = usuario.usu_nombre;
    formulario.usu_catalogo.value = usuario.usu_catalogo;
};

const Cancelar = () => {
    TablaUsuario.parentElement.parentElement.classList.remove('d-none');
    BtnGuardar.parentElement.classList.remove('d-none');
    BtnModificar.parentElement.classList.add('d-none');
    BtnCancelar.parentElement.classList.add('d-none');
    formulario.reset();
    Buscar();
};

const Modificar = async (e) => {
    e.preventDefault();

    if (!validarFormulario(formulario)) {
        Swal.fire({
            title: "Campos vacíos",
            text: "Todos los campos deben estar llenos",
            icon: "info"
        });
        return;
    }

    try {
        const body = new FormData(formulario);
        const url = '/CrudMVC2024/API/usuario/modificar';

        const config = {
            method: 'POST',
            body
        };

        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        const { codigo, mensaje } = data;

        if (codigo == 3) {
            Swal.fire({
                title: '¡Éxito!',
                text: mensaje,
                icon: 'success',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
            });
            formulario.reset();
            Cancelar();
            Buscar();
        } else {
            Swal.fire({
                title: '¡Error!',
                text: mensaje,
                icon: 'error',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
            });
        }
    } catch (error) {
        console.log(error);
    }
};

const Eliminar = async (usuario) => {
    let confirmacion = await Swal.fire({
        title: '¿Está seguro de que desea eliminar este usuario?',
        text: "Esta acción no se puede deshacer.",
        icon: 'warning',
        showDenyButton: true,
        confirmButtonText: 'Sí, eliminar',
        denyButtonText: 'No, cancelar',
        confirmButtonColor: '#3085d6',
        denyButtonColor: '#d33',
    });

    if (confirmacion.isConfirmed) {
        try {
            const body = new FormData();
            body.append('id', usuario.usu_id);

            const url = '/CrudMVC2024/API/usuario/eliminar';
            const config = {
                method: 'POST',
                body
            };

            const respuesta = await fetch(url, config);
            const data = await respuesta.json();
            const { codigo, mensaje } = data;

            if (codigo == 4) {
                Swal.fire({
                    title: '¡Éxito!',
                    text: mensaje,
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                });
                formulario.reset();
                Buscar();
            } else {
                Swal.fire({
                    title: '¡Error!',
                    text: mensaje,
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                });
            }
        } catch (error) {
            console.log(error);
        }
    }
};

Buscar();
BtnCancelar.addEventListener('click', Cancelar);
formulario.addEventListener('submit', guardar);
BtnModificar.addEventListener('click', Modificar);
