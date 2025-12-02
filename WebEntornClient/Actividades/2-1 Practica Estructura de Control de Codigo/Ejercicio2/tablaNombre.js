let nombre = prompt("Introduce tu nombre:");
let filas = parseInt(prompt("Introduce un número de filas:"));
let columnas = parseInt(prompt("Introduce un número de columnas:"));

if (isNaN(filas) || filas <= 0 || isNaN(columnas) || columnas <= 0) {
  alert("Introduce números válidos en las filas y columnas");
}

let tabla = document.getElementById("tabla");

for (let i = 0; i < filas; i++) {
  let fila = document.createElement("tr");
  for (let j = 0; j < columnas; j++) {
    let celda = document.createElement("td");
    celda.textContent = nombre;

    fila.appendChild(celda);
  }

  tabla.appendChild(fila);
}
