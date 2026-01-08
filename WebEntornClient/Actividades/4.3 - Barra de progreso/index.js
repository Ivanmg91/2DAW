// initialize variables
const barraCarga = document.querySelector('.barraFront');
const contador = document.querySelector('.contador');
const loading = document.getElementsByTagName('h1')[0];

let porcentajeCarga = 0;
let intervalo = setInterval(cargarBarra, 50);


// function to load bar
function cargarBarra() {

    // BAR INCREASE
    barraCarga.style.width = porcentajeCarga + '%';
    contador.innerHTML = Math.round(porcentajeCarga) + '%';

    // VISUAL ALERTS
    if (porcentajeCarga > 80) {
        barraCarga.classList.add('alerta-final');
    }

    // DETENCTION AND END
    if (porcentajeCarga >= 100) {
        clearInterval(intervalo);
        loading.textContent = '¡Carga Completa!';
    }

    porcentajeCarga++;
}