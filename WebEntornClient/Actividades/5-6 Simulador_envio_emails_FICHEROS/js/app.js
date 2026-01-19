document.addEventListener('DOMContentLoaded', () => {
    // Take HTML values
    const email = document.getElementById('email');
    const asunto = document.getElementById('asunto');
    const mensaje = document.getElementById('mensaje');
    const inputCC = document.getElementById('cc');
    const formulario = document.getElementById('formulario');
    const btnReset = formulario.querySelector('button[type="reset"]');
    const btnSubmit = formulario.querySelector('button[type="submit"]');
    const spinner = document.getElementById('spinner');

    const datosEmail = {
        email: '',
        cc: '',
        asunto: '',
        mensaje: ''
    };

    // Function to validate fields and activate send button
    function validarFormulario(e) {
        
        const referencia = e.target.parentElement;
        const value = e.target.value.trim();
        const id = e.target.id;

        limpiarAlerta(referencia);

        // VALIDATIONS
        if (value === '' && id !== 'cc') {
            mostrarAlerta(`El campo ${id} es obligatorio`, referencia);
            datosEmail[e.target.name] = '';
            comprobarEmail();
            return;
        }

        if (id === 'email' && !validarEmail(value)) {
            mostrarAlerta('El email no es válido', referencia);
            datosEmail[e.target.name] = '';
            comprobarEmail();
            return;
        }

        if (id === 'cc' && value !== '' && !validarEmail(value)) {
            mostrarAlerta('El email no es válido', referencia);
            datosEmail[e.target.name] = '';
            comprobarEmail();
            return;
        }

        datosEmail[e.target.name] = value.toLowerCase();
        
        comprobarEmail();
    }

    // Listeners to wait a new input in the text fields
    email.addEventListener('input', validarFormulario);
    asunto.addEventListener('input', validarFormulario);
    mensaje.addEventListener('input', validarFormulario);
    if(inputCC) {
        inputCC.addEventListener('input', validarFormulario);
    }

    formulario.addEventListener('submit', enviarEmail);

    btnReset.addEventListener('click', (e) => {
        e.preventDefault();
        resetFormulario();
    });

    function enviarEmail(e) {
        e.preventDefault();

        spinner.classList.add('flex');
        spinner.classList.remove('hidden');

        setTimeout(() => {
            spinner.classList.remove('flex');
            spinner.classList.add('hidden');

            resetFormulario();

            const alertaExito = document.createElement('p');
            alertaExito.classList.add('bg-green-500', 'text-white', 'p-2', 'text-center', 'rounded-lg', 'mt-10', 'font-bold', 'text-sm', 'uppercase');
            alertaExito.textContent = 'Mensaje enviado correctamente';
            formulario.appendChild(alertaExito);

            setTimeout(() => {
                alertaExito.remove();
            }, 3000);
        }, 3000);
    }

    // Show alert
    function mostrarAlerta(mensaje, referencia) {
        limpiarAlerta(referencia);
        
        const error = document.createElement('p');
        error.textContent = mensaje;
        error.classList.add('bg-red-600', 'text-white', 'p-2', 'text-center');
        referencia.appendChild(error);
    }

    // Clear alert
    function limpiarAlerta(referencia) {
        const alerta = referencia.querySelector('.bg-red-600');
        if (alerta) {
            alerta.remove();
        }
    }

    // Validate email
    function validarEmail(email) {
        const regex = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
        return regex.test(email);
    }

    // Check email
    function comprobarEmail() {

        if (datosEmail.email === '' || datosEmail.asunto === '' || datosEmail.mensaje === '') {
            btnSubmit.classList.add('opacity-50');
            btnSubmit.disabled = true;
            return;
        }

        btnSubmit.classList.remove('opacity-50');
        btnSubmit.disabled = false;
    }

    function resetFormulario() {
        datosEmail.email = '';
        datosEmail.cc = '';
        datosEmail.asunto = '';
        datosEmail.mensaje = '';

        formulario.reset();
        
        // Limpiar alertas visuales si quedaron
        const alertas = document.querySelectorAll('.bg-red-600');
        alertas.forEach(alerta => alerta.remove());
        
        comprobarEmail();
    }
});