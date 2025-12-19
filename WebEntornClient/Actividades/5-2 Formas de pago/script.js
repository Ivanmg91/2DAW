document.addEventListener('DOMContentLoaded', () => {

    let visible = false;
    const divBoton = document.querySelector('.combo p');

    function alternarMenu() {
        const oculto = document.querySelector('.forma_pago.oculto');
        const icono = document.querySelector('.fa-regular');

        if (visible == false) {
            oculto.style.visibility = 'visible';
            visible = true;
            icono.classList.remove('fa-circle-up');
            icono.classList.add('fa-circle-down');
        } else {
            oculto.style.visibility = 'hidden';
            visible = false;
            icono.classList.remove('fa-circle-down');
            icono.classList.add('fa-circle-up');
        }
    }

    const items = document.querySelectorAll('.forma_pago li');

    items.forEach(item => {
        item.addEventListener('click', function() {
            const icono = item.querySelector('i');
            const texto = item.querySelector('p').innerText;

            const htmlIcono = icono.outerHTML; // outher devuelve todo lo de la etiqueta

            divBoton.innerHTML = htmlIcono + " " + texto;

            alternarMenu();
        });
    });

    const botonFlecha = document.querySelector('.fa-regular');
    botonFlecha.addEventListener("click", alternarMenu);
});