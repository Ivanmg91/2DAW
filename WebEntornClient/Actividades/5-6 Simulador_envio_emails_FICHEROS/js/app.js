document.addEventListener('DOMContentLoaded', () => {
    // Take HTML values
    const email = document.getElementById('email');
    const asunto = document.getElementById('asunto');
    const mensaje = document.getElementById('mensaje');

    const formulario = document.getElementById('formulario');
    const btnReset = formulario.querySelector('button[type="reset"]');
    const btnSubmit = formulario.querySelector('button[type="submit"]');

    
    // Function to validate fields and activate send button
    function validarFormulario() {
        const regex = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
        
        const resultadoEmail = regex.test(email.value.trim());
        const asuntoValido = asunto.value.trim() !== '';
        const mensajeValido = mensaje.value.trim() !== '';

        if (resultadoEmail && asuntoValido && mensajeValido) {
            btnSubmit.disabled = false;
            btnSubmit.classList.remove('opacity-50');
        } else {
            btnSubmit.disabled = true;
            btnSubmit.classList.add('opacity-50');
        }
    }

    // Listeners to wait a new input in the text fields
    email.addEventListener('input', validarFormulario);
    asunto.addEventListener('input', validarFormulario);
    mensaje.addEventListener('input', validarFormulario);

});