const barraCarga = document.querySelector('.barraFront');
const contador = document.querySelector('.contador');
const loading = document.getElementsByTagName('h1')[0];

let porcentajeCarga = 0;
intervalo = setInterval(cargarBarra, 50);



function cargarBarra() {

    // AUMENTO DE BARRA
    barraCarga.style.width = porcentajeCarga + '%';
    contador.innerHTML = Math.round(porcentajeCarga) + '%';

    // ALERTAS VISUALES
    if (porcentajeCarga > 80) {
        barraCarga.classList.add('alerta-final');
    }

    // DETENCION Y FINALIZACION
    if (porcentajeCarga >= 100) {
        clearInterval(intervalo);
        loading.innerHTML = '¡Carga Completa!';
    }

    porcentajeCarga++;
}