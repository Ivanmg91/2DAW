const lista_elementos = [];
let elemento = prompt("Introduce elemento: ");

while (elemento !== "") {
    lista_elementos.push(elemento);
    elemento = prompt("Introduce elemento: ");
}

for (let i = 0; i < lista_elementos.length; i++) {
    for (let j = 0; j < lista_elementos[i].length; j++) {
        if (!isNaN(lista_elementos[i].charAt(j))) { //SI PONES UNA CADENA DE ESPACIOS, COMO NO ES UN NUEMRO PERO TAMPOCO CARACTER LO ELIMINA TAMBIEN
            lista_elementos.splice(i, 1);
            break;
        }
    }
}

lista_elementos.sort();

for (let i = 0; i < lista_elementos.length; i++) {
    console.log(`El elemento ${i+1} es: ${lista_elementos[i]}`);
}
