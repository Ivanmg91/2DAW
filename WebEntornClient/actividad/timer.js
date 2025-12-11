let tiempoInicial = document.getElementById('minutos-input');
let segundosRestantes; // Los segundos restantes son los generales, los minutos pasados a segundos

let segs = 0;
let mins;

let intervalo;
let pausado = true;
let acabado = false;

function iniciar() {
    if (!segundosRestantes) {
        mins = document.getElementById('minutos-input').value;
        let  tiempoInput = document.getElementById('minutos-input').value;
        segundosRestantes = parseInt(tiempoInput) * 60;
    }

    intervalo = setInterval(actualizarTiempo, 1000);
    document.getElementById('boton-control').textContent = "Pausar Sesión";
    pausado = false;
    acabado = false;
}
function pausar() {
    clearInterval(intervalo)
    document.getElementById('boton-control').textContent= "Reanudar Sesión";
    pausado = true;
    acabado = false;
}

function iniciar0 () {
    clearInterval(intervalo);
    document.getElementById('boton-control').textContent = "Reiniciar";
    document.getElementById('minutos-input').disabled=false;
    segundosRestantes = null;

    document.getElementById('temporizador').classList.remove('finalizado');
    document.getElementById('temporizador').classList.remove('alerta');

    document.getElementById('estado').style.color = "white";
}


function actualizarTiempo() {

    // Formatear los mins y segs
    segs = (segs < 10 && segs[0] != 0) ? '0' + segs : segs;
    mins = (mins < 10 && mins[0] != 0) ? '0' + mins : mins;

    document.getElementById('minutos-input').disabled=true;
    document.getElementById('tiempo').textContent = `${mins}:${segs}`;

    if (segundosRestantes > 0) {
        segundosRestantes-= 1;
    }

    if (segundosRestantes <= 10) {
        document.getElementById('temporizador').classList.add('finalizado');
        document.getElementById('estado').style.color = "red";
    } else if (segundosRestantes <= 180) {
        document.getElementById('temporizador').classList.add('alerta');
    } else {
        document.getElementById('temporizador').classList.remove('finalizado');
        document.getElementById('temporizador').classList.remove('alerta');
    }

    if (segs == 0 && mins == 0) {
        pausado = true;
        acabado = true;
        iniciar0();
        return;
    }

    if (segs == 0 && mins != 0) {
        segs = 60;
        mins-=1;
    }

    segs-=1;
}

document.getElementById('boton-control').addEventListener('click', function() {
    if (pausado == false && acabado == false) {
        pausar();
    } else if (pausado == true && acabado == false) {
        iniciar();
    } else if (pausado == true && acabado == true) {
        iniciar();
    }
});
