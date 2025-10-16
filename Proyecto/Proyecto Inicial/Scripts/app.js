import { PuntoServicio } from "./PuntoServicio.js";

const puntosServicio = []; // Lista donde guardaremos los objetos PuntoServicio

async function fetchJSONDataInTable() {
  try {
    const response = await fetch("./file.json");
    const data = await response.json();

    data.forEach((item) => {
      const punto = new PuntoServicio(item);
      puntosServicio.push(punto);
    });

    mostrarPuntosEnTabla(puntosServicio);

  } catch (error) {
    console.error("Error al cargar el JSON:", error);
  }
}

function mostrarPuntosEnTabla(puntos) {
  const tbody = document.querySelector("#tabla tbody");
  tbody.innerHTML = "";

  puntos.forEach((punto) => {
    const fila = document.createElement("tr");

    fila.innerHTML = `
      <td class="direccion">${punto.direccion}</td>
      <td>${punto.numero}</td>
      <td>${punto.abierto}</td>
      <td>${punto.disponibles}</td>
      <td>${punto.libres}</td>
      <td>${punto.total}</td>
      <td>${punto.ticket}</td>
      <td>${punto.actualizado}</td>
      <td>${punto.geo_point_2d.lat}</td>
      <td>${punto.geo_point_2d.lon}</td>
    `;

    // Agregar el evento de clic sobre la dirección
    const direccionCell = fila.querySelector(".direccion");
    direccionCell.addEventListener("click", () => {
      const lat = punto.geo_point_2d.lat;
      const lon = punto.geo_point_2d.lon;

      // Mover el mapa a las coordenadas del punto seleccionado
      map.setView([lat, lon], 16); // Puedes ajustar el zoom (16) según lo necesites
    });

    tbody.appendChild(fila);
  });
}


window.onload = async function () {
  // Crear el mapa centrado en Valladolid
  const map = L.map("map").setView(
    [39.476747340831494, -0.37534238089458904],
    14
  );

  L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution:
      'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors',
    maxZoom: 18,
  }).addTo(map);

  // Añadir un marcador draggable
  L.marker([39.476747340831494, -0.37534238089458904], {
    draggable: true,
  }).addTo(map);

  await fetchJSONDataInTable();


  // HACER Q LOS Q HAYAN DISPONIBLES ESTEN DE UN COLOR Y LOS Q NO DE OTRO
  puntosServicio.forEach(punto => {
    if (punto.abierto == "T" && punto.disponibles > 0) {
      L.marker([punto.geo_point_2d.lat, punto.geo_point_2d.lon], {
        draggable: false,
      }).addTo(map)
    }
  });

  // Escala
  L.control.scale().addTo(map);

  console.log(puntosServicio);
};
