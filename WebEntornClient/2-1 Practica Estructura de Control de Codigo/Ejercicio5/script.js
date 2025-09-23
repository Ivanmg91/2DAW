let numeroUsuario = parseInt(prompt("Escribe un número:"));

while (isNaN(numeroUsuario)) {
    numeroUsuario = parseInt(prompt("Introduce un número:"))
}

let menu = prompt(
  "Elige una de estas dos opciones. Indica 1 ó 2.\n1. ¿Tu número es primo?\n2. Primos hasta tu número."
);
let esPrimo = true;

if (menu == 1) {
  if (numeroUsuario <= 1) {
    esPrimo = false;
  } else {
    for (let i = 2; i < numeroUsuario; i++) {
      if (numeroUsuario % i === 0) {
        esPrimo = false;
        break;
      }
    }
  }

  if (esPrimo === true) {
    alert("Tu número es primo.");
  } else if (esPrimo === false) {
    alert("Tu número no es primo");
  }
} else if (menu == 2) {
  console.log("Números primos hasta " + numeroUsuario + ":");
  for (let numero = 2; numero <= numeroUsuario; numero++) {
    let esPrimo = true;
    for (let i = 2; i < numero; i++) {
      if (numero % i === 0) {
        esPrimo = false;
        break;
      }
    }
    if (esPrimo) {
      console.log(numero);
    }
  }
} else {
  alert("Opción no válida. Por favor, elige 1 o 2.");
}
