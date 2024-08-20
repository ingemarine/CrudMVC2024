import { Dropdown, Tab } from "bootstrap";
import { config } from "fullcalendar";
import { Toast, validarFormulario } from "../funciones";
import Swal from "sweetalert2";

const formulario = document.getElementById('FormProducto');
const TablaProductos = document.getElementById('Tablita');
const BtnGuardar = document.getElementById('BtnGuardar');
const BtnModificar = document.getElementById('BtnModificar');
const BtnBuscar = document.getElementById('BtnBuscar');
const BtnCancelar = document.getElementById('BtnCancelar');

BtnModificar.parentElement.classList.add('d-none');
BtnCancelar.parentElement.classList.add('d-none');

const guardar = async (e) => {
    e.preventDefault();

    BtnGuardar.disabled = true;

    if (!validarFormulario(formulario, ['prod_id'])) {
        Swal.fire({
            title: "Campos vacíos",
            text: "Debe llenar todos los campos",
            icon: "info"
        });
        BtnGuardar.disabled = false;
        return;
    }

    try {
        const body = new FormData(formulario);
        const url = '/CrudMVC2024/API/producto/guardar';

        const config = {
            method: 'POST',
            body
        };

        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        const { codigo, mensaje, detalle } = data;

        if (codigo === 1) {
            Swal.fire({
                title: '¡Éxito!',
                text: mensaje,
                icon: 'success',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                background: '#e0f7fa',
                customClass: {
                    title: 'custom-title-class',
                    text: 'custom-text-class'
                }
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
                background: '#e0f7fa',
                customClass: {
                    title: 'custom-title-class',
                    text: 'custom-text-class'
                }
            });
        }

    } catch (error) {
        console.error(error);
    }

    BtnGuardar.disabled = false;
};

const Buscar = async () => {
    BtnBuscar.disabled = true;

    const url = '/CrudMVC2024/API/producto/buscar';

    const config = {
        method: 'GET'
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();

        TablaProductos.tBodies[0].innerHTML = '';
        const fragment = document.createDocumentFragment();
        let contador = 1;

        if (data.length > 0) {
            data.forEach(producto => {
                const tr = document.createElement('tr');

                const celda1 = document.createElement('td');
                const celda2 = document.createElement('td');
                const celda3 = document.createElement('td');
                const celda4 = document.createElement('td');
                const celda5 = document.createElement('td');

                const BtnModificar = document.createElement('button');
                const BtnEliminar = document.createElement('button');

                BtnModificar.innerHTML = '<i class="bi bi-pencil-square"></i>';
                BtnModificar.classList.add('btn', 'btn-warning', 'w-100', 'text-uppercase', 'fw-bold', 'shadow', 'border-0');

                BtnEliminar.innerHTML = '<i class="bi bi-trash3"></i>';
                BtnEliminar.classList.add('btn', 'btn-danger', 'w-100', 'text-uppercase', 'fw-bold', 'shadow', 'border-0');

                BtnModificar.addEventListener('click', () => llenarDatos(producto));
                BtnEliminar.addEventListener('click', () => Eliminar(producto));

                celda1.innerText = contador;
                celda2.innerText = producto.prod_nombre;
                celda3.innerText = producto.prod_precio;
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
            td.innerText = 'No existen productos';
            tr.classList.add('text-center');
            td.colSpan = 5;

            tr.appendChild(td);
            fragment.appendChild(tr);
        }

        TablaProductos.tBodies[0].appendChild(fragment);
    } catch (error) {
        console.error('Error fetching data:', error);
    }

    BtnBuscar.disabled = false;
};

const llenarDatos = (producto) => {
    TablaProductos.parentElement.classList.add('d-none');
    BtnBuscar.classList.add('d-none');
    BtnGuardar.parentElement.classList.add('d-none');
    BtnModificar.parentElement.classList.remove('d-none');
    BtnCancelar.parentElement.classList.remove('d-none');

    formulario.prod_id.value = producto.prod_id;
    formulario.prod_nombre.value = producto.prod_nombre;
    formulario.prod_precio.value = producto.prod_precio;
};

const Cancelar = () => {
    TablaProductos.parentElement.classList.remove('d-none');
    BtnBuscar.classList.remove('d-none');
    BtnGuardar.parentElement.classList.remove('d-none');
    BtnModificar.parentElement.classList.add('d-none');
    BtnCancelar.parentElement.classList.add('d-none');
    formulario.reset();
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
        const url = '/CrudMVC2024/API/producto/modificar';

        const config = {
            method: 'POST',
            body
        };

        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        const { codigo, mensaje, detalle } = data;

        if (codigo === 3) {
            Swal.fire({
                title: '¡Éxito!',
                text: mensaje,
                icon: 'success',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                background: '#e0f7fa',
                customClass: {
                    title: 'custom-title-class',
                    text: 'custom-text-class'
                }
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
                background: '#e0f7fa',
                customClass: {
                    title: 'custom-title-class',
                    text: 'custom-text-class'
                }
            });
        }
    } catch (error) {
        console.error(error);
    }
};

const Eliminar = async (producto) => {
    let confirmacion = await Swal.fire({
        title: '¿Está seguro de que desea eliminar este producto?',
        text: "No podrá deshacer esta acción.",
        icon: 'warning',
        showDenyButton: true,
        confirmButtonText: 'Sí, eliminar',
        denyButtonText: 'No, cancelar',
        confirmButtonColor: '#3085d6',
        denyButtonColor: '#d33',
        background: '#fff3e0',
        customClass: {
            title: 'custom-title-class',
            text: 'custom-text-class',
            confirmButton: 'custom-confirm-button',
            denyButton: 'custom-deny-button'
        }
    });

    if (confirmacion.isConfirmed) {
        try {
            const body = new FormData();
            body.append('id', producto.prod_id);

            const url = '/CrudMVC2024/API/producto/eliminar';
            const config = {
                method: 'POST',
                body
            };

            const respuesta = await fetch(url, config);
            const data = await respuesta.json();
            const { codigo, mensaje, detalle } = data;

            if (codigo === 4) {
                Swal.fire({
                    title: '¡Éxito!',
                    text: mensaje,
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                    background: '#e0f7fa',
                    customClass: {
                        title: 'custom-title-class',
                        text: 'custom-text-class'
                    }
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
                    background: '#e0f7fa',
                    customClass: {
                        title: 'custom-title-class',
                        text: 'custom-text-class'
                    }
                });
            }
        } catch (error) {
            console.error(error);
        }
    } else if (confirmacion.isDenied) {
        Swal.fire({
            title: 'Acción cancelada',
            text: 'El producto no ha sido eliminado.',
            icon: 'info',
            background: '#f3e5f5',
            customClass: {
                title: 'custom-title-class',
                text: 'custom-text-class'
            }
        });
    }
};

// Listeners
BtnGuardar.addEventListener('click', guardar);
BtnModificar.addEventListener('click', Modificar);
BtnBuscar.addEventListener('click', Buscar);
BtnCancelar.addEventListener('click', Cancelar);

// Llamada inicial para buscar productos al cargar la página
Buscar();
