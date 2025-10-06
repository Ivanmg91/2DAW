const ABCNUM = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
let cantidadCadenas = parseInt(prompt("¿Cuántas cadenas aleatorias quieres generar?"));

if (isNaN(cantidadCadenas) || cantidadCadenas <= 0) {

  console.log("Debes introducir un número mayor que 0.");

} else {

  let cadenas = [];
  let vacias = 0;

  for (let i = 0; i < cantidadCadenas; i++) {

    let longitud = Math.floor(Math.random() * 11);
    let cadena = "";

    for (let j = 0; j < longitud; j++) {
      let caracter = Math.floor(Math.random() * ABCNUM.length);
      cadena += ABCNUM[caracter];
    }

    cadenas.push(cadena);

    if (cadena.length === 0) {
      vacias++;
    }
  }


  cadenas.forEach((c, i) => {
    console.log(`Cadena nº ${i + 1}: "${c}"`);
  });

  console.log(`\nEn el conjunto de cadenas aleatorias encontramos ${vacias} elemento/s vacío/s`);
}