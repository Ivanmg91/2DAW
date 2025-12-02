function pedir() {
    let salir = true;
    let respuesta;

    do {

        respuesta = prompt("¿Quieres trabajar con letras o números (L / N)?");
        if (respuesta == null) {
            alert("NO se va a hacer nada");
            salir = false;
        } else if (respuesta != "L" && respuesta != "N") {
            alert("Por favor, escribe solo L o N.");
        } else {
            salir = false;
        }
        
    } while (salir);

    return respuesta;
}

// INICIO
const letras_o_numeros = pedir();
const set1 = new Set();
const set2 = new Set();

if (letras_o_numeros === "N") {

    let i = 0;
    while (i < 10) {
        let random = Math.floor(Math.random() * 21);

        set1.add(random);
        i++;
    }

    i = 0;
    while (i < 10) {
        let random = Math.floor(Math.random() * 21);

        set2.add(random);
        i++;
    }


    console.log(set1);
    console.log(set2);

    console.log("La unión de los conjuntos es: ");
    console.log(set1.union(set2));

    console.log("Los elementos comunes de los conjuntos es: ");
    console.log(set1.intersection(set2));

    console.log("Los elementos del primer conjunto que no están en el segundo son: ");
    console.log(set1.difference(set2));
} else {

    const letras = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
    let i = 0;

    while (i < 10) {

        let random = Math.floor(Math.random() * letras.length);
        let letra = letras[random];

        set1.add(letra);
        i++;
    }

    i = 0;
    while (i < 10) {

        let random = Math.floor(Math.random() * letras.length);
        let letra = letras[random];

        set2.add(letra);
        i++;
    }

    console.log(set1);
    console.log(set2);

    console.log("La unión de los conjuntos es: ");
    console.log(set1.union(set2));

    console.log("Los elementos comunes de los conjuntos es: ");
    console.log(set1.intersection(set2));

    console.log("Los elementos del primer conjunto que no están en el segundo son: ");
    console.log(set1.difference(set2));
}