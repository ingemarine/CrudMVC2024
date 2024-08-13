import { Dropdwon } from "bootstrap";
import { config } from "fullcalendar";
import { Toast, validarFormulario } from "../funciones";
import Swal from "sweetalert2";

const formulario = document.getElementById('formProducto');
const TablaProductos = document.getElementById('TablaProductos');

const guardar = async (e) => {
    e.preventDefault();

    if (!validarFormulario(formulario, ['prod_id'])) {
        Swal.fire({
            title: "Campos vacios",
            text: "Debe llenar todos los campos",
            icon: "info"
        })
        return
    }

    try {
        const body = new FormData(formulario)
        const url = '/CrudMVC2024/API/producto/guardar';

        const config = {
            method: 'POST',
            body
        }

        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        const { codigo, mensaje, detalle } = data
        TablaProductos.tBodies[0].innerHTML = ''
      
        if (codigo == 1) {


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
                icon: 'danger',
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
    }
}

const Buscar = async () => {

    const url = '/CrudMVC2024/API/producto/buscar';

    const config = {
        method: 'GET'
    }

    const respuesta = await fetch(url, config);
    const data = await respuesta.json();
    // console.log(data);

    TablaProductos.tBodies[0].innerHTML = '';
    const fragment = document.createDocumentFragment();
    let contador = 1;

    if (data.length > 0) {
        data.forEach(productos => {
            const tr = document.createElement('tr');
            const celda1 = document.createElement('td');
            const celda2 = document.createElement('td');
            const celda3 = document.createElement('td');

            celda1.innerText = contador;
            celda2.innerText = productos.prod_nombre;
            celda3.innerText = productos.prod_precio;

            tr.appendChild(celda1);
            tr.appendChild(celda2);
            tr.appendChild(celda3);
            
            fragment.appendChild(tr);
            contador++;

        })

    }else {
        const tr = document.createElement('tr');
        const td = document.createElement('td');
        td.innerText = 'No hay productos Registrados ';
        tr.classList.add('text-center');
        td.colSpan = 3;

        tr.appendChild(td);
        fragment.appendChild(tr);
    }
    TablaProductos.tBodies[0].appendChild(fragment);
}

Buscar();

const traerDatos = (producto)
formulario.addEventListener('submit', guardar)