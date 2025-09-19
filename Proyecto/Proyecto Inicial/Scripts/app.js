import { PuntoServicio } from "./PuntoServicio.js";

function fetchJSONData() {
  fetch("./file.json") // fetch("https://valencia.opendatasoft.com/api/explore/v2.1/catalog/datasets/valenbisi-disponibilitat-valenbisi-dsiponibilidad/records?limit=20")
    .then((response) => {
      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }
      return response.json();
    })
    .then((datos) => {
      const contenedor = document.getElementById("contenedor");
      datos.forEach((obj) => { // Con slice puedo pone limite de cards: datos.slice(0, 5).forEach((obj) => {
        const punto = new PuntoServicio(obj);
        contenedor.innerHTML += punto.generarCardHTML();
      });
    })
    .catch((error) => console.error("Failed to fetch data:", error));
}

// Ejecutamos la función al cargar el script
fetchJSONData();

/*
function fetchJSONData() {
  fetch("https://valencia.opendatasoft.com/api/explore/v2.1/catalog/datasets/valenbisi-disponibilitat-valenbisi-dsiponibilidad/records?limit=20")
    .then((response) => {
      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }
      return response.json();
    })
    .then((data) => {
      const contenedor = document.getElementById("contenedor");
      data.results.forEach((obj) => {
        const punto = new PuntoServicio(obj);
        contenedor.innerHTML += punto.generarCardHTML();
      });
    })
    .catch((error) => console.error("Error al obtener datos de la API:", error));
}

fetchJSONData();
*/
