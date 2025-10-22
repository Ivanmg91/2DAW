import { PuntoServicio } from "./PuntoServicio.js";

const puntosServicio = [];

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


  // PARA EL COLOR DEL MARCADOR
  var blueIcon = new L.Icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
  });

  var redIcon = new L.Icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
  });

  // HACER Q LOS Q HAYAN DISPONIBLES ESTEN DE UN COLOR Y LOS Q NO DE OTRO
  puntosServicio.forEach(punto => {
    if (punto.disponibles > 0) {
      if (punto.abierto == "T") {
        L.marker([punto.geo_point_2d.lat, punto.geo_point_2d.lon], {
          icon: blueIcon,
          draggable: false,
        }).addTo(map).bindPopup(`
          <strong>Dirección:</strong> ${punto.direccion}<br>
          <strong>Abierto:</strong> ${punto.abierto === "T" ? "Sí" : "No"}<br>
          <strong>Disponibles:</strong> ${punto.disponibles}<br>
          <strong>Libres:</strong> ${punto.libres}<br>
          <strong>Total:</strong> ${punto.total}<br>
          <strong>Última Actualización:</strong> ${punto.actualizado}
        `);
      } else if (punto.abierto == "F") {
        L.marker([punto.geo_point_2d.lat, punto.geo_point_2d.lon], {
          icon: redIcon,
          draggable: false,
        }).addTo(map).bindPopup(`
          <strong>Dirección:</strong> ${punto.direccion}<br>
          <strong>Abierto:</strong> ${punto.abierto === "T" ? "Sí" : "No"}<br>
          <strong>Disponibles:</strong> ${punto.disponibles}<br>
          <strong>Libres:</strong> ${punto.libres}<br>
          <strong>Total:</strong> ${punto.total}<br>
          <strong>Última Actualización:</strong> ${punto.actualizado}
        `);
      }
    }
  });

  
  // Escala
  L.control.scale().addTo(map);

  console.log(puntosServicio);
};
