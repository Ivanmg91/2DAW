document.addEventListener('DOMContentLoaded', () => {

    function alternarMenu() {
        const oculto = document.querySelector('.forma_pago.oculto');
        oculto.style.visibility = 'visible';
    }


    const botonFlecha = document.querySelector('.fa-regular.fa-circle-up');
    botonFlecha.addEventListener("click", alternarMenu);
});