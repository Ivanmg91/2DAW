// the function
let compararTextos = (texto1, texto2) => {

    // remove spaces  
    let texto1limpio = texto1.trim();
    let texto2limpio = texto2.trim();

    if (texto1limpio === texto2limpio) {
        return alert("Los textos " + texto1limpio + " y " + texto2limpio + " son iguales.");
    } else if (texto1limpio !== texto2limpio) {
        return alert("Los textos " + texto1limpio + " y " + texto2limpio + " son diferentes.");
    } else {
        return alert("No se ha podido comparar los textos.");
    }

}

let seguirComparando = true;

// start
while (seguirComparando) {
    let texto1 = prompt("Escribe la primera frase:");
    let texto2 = prompt("Escribe la segunda frase:");

    compararTextos(texto1, texto2);

    if (!confirm("¿Quieres comparar otras cadenas?")) {
        seguirComparando = false;
        alert("FIN DEL PROGRAMA");
    }
}