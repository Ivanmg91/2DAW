let numero = prompt("Introduce un número:");
let numeroVeces = prompt("Introduce el número de veces que quieres que se duplique el número anterior:");

let info = document.getElementById("info");

info.textContent = "El número es " + numero + " y se hallará el doble " + numeroVeces + " veces."

for (let index = 0; index < numeroVeces; index++) {
    let duplicado = document.createElement("p");
    numero *= 2;
    duplicado.textContent = numero;

    info.appendChild(duplicado);
}