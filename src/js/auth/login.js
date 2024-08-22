const { validarFormulario, Toast } = require("../funciones");
const Swal = require('sweetalert2');

const formulario = document.querySelector('form');

const iniciar = async (e) => {
    e.preventDefault();
    if (!validarFormulario(formulario)) {
        Swal.fire({
            icon: 'info',
            title: 'Debe llenar todos los campos',
            timer: 5000, // Duración de 5 segundos
            timerProgressBar: true,
            position: 'center',
            didOpen: () => {
                Swal.showLoading();
            },
            willClose: () => {
                Swal.hideLoading();
            }
        });
        return;
    }

    try {
        const body = new FormData(formulario);
        const url = "/CrudMVC2024/API/login";
        const config = {
            method: 'POST',
            body
        };

        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        const { codigo, mensaje, detalle } = data;

        console.log(data);

        let icon = 'info';
        if (codigo == 1) {
            icon = 'success';
            formulario.reset();
            location.href = '/CrudMVC2024/menu';
        } else {
            icon = 'error';
            console.log(detalle);
        }

        Swal.fire({
            icon: icon,
            title: mensaje,
            timer: 10000, // Duración de 5 segundos
            timerProgressBar: true,
            position: 'center',
            didOpen: () => {
                Swal.showLoading();
            },
            willClose: () => {
                Swal.hideLoading();
            }
        });
    } catch (error) {
        console.log(error);
    }
};

formulario.addEventListener('submit', iniciar);
