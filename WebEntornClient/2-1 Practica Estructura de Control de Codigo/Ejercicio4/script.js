let intentosAcierto = 0;
let intentos = 10;
let numeroRandom = Math.floor(Math.random() * 10) + 1;
let numeroUsuario = parseInt(prompt("Del 1 al 10... ¿Qué numero entero crees que estoy pensando?\n" + "Intentos: " + intentos));

let seguirJugando;

for (let index = 0; index < intentos; index++) {
    if (isNaN(numeroUsuario) == true) {
        alert("El dato no es válido o has cancelado.");

        seguirJugando = confirm("¿Quieres seguir jugando?");
    
    } else if (numeroUsuario < 1 || numeroUsuario > 10) {
        alert("El dato introducido NO es válido. Se pide un número del 1 al 10.");
    }

    if (seguirJugando == false) {
        break;
    }
    
    // Si es mayor o menor
    if (numeroUsuario < numeroRandom) {
        intentos--;
        intentosAcierto++;
        alert("Estás cerca, mi número es mayor, te quedan " + intentos + " intentos.");
    } else if (numeroUsuario > numeroRandom) {
        intentosAcierto++;
        intentos--;
        alert("Estás cerca, mi número es menor, te quedan " + intentos + " intentos.");
    } else if (numeroUsuario == numeroRandom) {
        intentosAcierto++;
        alert("Enhorabuena!!! Has acertado, el número era " + numeroRandom + " Lo has adivinado en " + intentosAcierto + " intentos.");
        break;
    }
    
    numeroUsuario = parseInt(prompt("Del 1 al 10... ¿Qué numero entero crees que estoy pensando?\n" + "Intentos: " + intentos));
}

alert("Fin del juego.")