import { PuntoServicio } from "./PuntoServicio.js";
import { setupLayerController } from "./layerController.js";

const puntosServicio = [];

async function fetchJSONDataInTable() {
  try {
    const response = await fetch("./file.json");
    const data = await response.json();

    data.forEach((item) => {
      const punto = new PuntoServicio(item);
      puntosServicio.push(punto);
    });


  } catch (error) {
    console.error("Error al cargar el JSON:", error);
  }
}

function mostrarTablaPuntos() {
  const tbody = document.querySelector("#tablaPuntos tbody");
  tbody.innerHTML = ""; // Limpiar contenido previo

  puntosServicio.forEach((punto) => {
    const fila = document.createElement("tr");

    fila.innerHTML = `
      <td>${punto.direccion}</td>
      <td>${punto.disponibles}</td>
      <td>${punto.libres}</td>
      <td>${punto.total}</td>
    `;

    // Al hacer clic en una fila, centramos el mapa en ese punto
    fila.addEventListener("click", () => {
      map.setView([punto.geo_point_2d.lat, punto.geo_point_2d.lon], 17);
    });

    tbody.appendChild(fila);
  });
}



window.onload = async function () {

  //MAPA
  const map = L.map("map").setView(
    [39.476747340831494, -0.37534238089458904],
    14
  );

  map.zoomControl.setPosition('bottomright'); // Mover el +- abajo a la derecha

  L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution:
      'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors',
    maxZoom: 18,
  }).addTo(map);

  await fetchJSONDataInTable();
  mostrarTablaPuntos();

  //capas
  setupLayerController(map);


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

  var blackIcon = new L.Icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-black.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
  });

  let markerGroup = L.layerGroup().addTo(map); //Esto nos ayudará a borrar los marcadores

  function buscarPuntos(busqueda) {

    markerGroup.clearLayers();

    if (busqueda == null) {
      puntosServicio.forEach(punto => {
        if (punto.disponibles == 0) {
          const marcador = L.marker([punto.geo_point_2d.lat, punto.geo_point_2d.lon], {
            icon: blackIcon,
            draggable: false,
          }).addTo(map).bindPopup(`
            <strong>Dirección:</strong> ${punto.direccion}<br>
            <strong>Abierto:</strong> ${punto.abierto === "T" ? "Sí" : "No"}<br>
            <strong>Disponibles:</strong> ${punto.disponibles}<br>
            <strong>Libres:</strong> ${punto.libres}<br>
            <strong>Total:</strong> ${punto.total}<br>
            <strong>Última Actualización:</strong> ${punto.actualizado}
          `);
          marcador.addTo(markerGroup);
        }
        // Si hay disponibles, comprobamos si es más de un tercio de los disponibles
        else if (punto.disponibles > 0 && punto.disponibles >= 5) {
          const marcador = L.marker([punto.geo_point_2d.lat, punto.geo_point_2d.lon], {
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
          marcador.addTo(markerGroup);
        }
        // Si los disponibles son mayores a 5, se marcan en rojo
        else {
          const marcador = L.marker([punto.geo_point_2d.lat, punto.geo_point_2d.lon], {
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
          marcador.addTo(markerGroup);
        }
      });
    } else {
      puntosServicio.forEach(punto => {
        // Verificar si la dirección contiene la subcadena
        if (punto.direccion.toLowerCase().includes(busqueda)) {
          // Primero revisamos si no hay disponibles (disponibles == 0)
          if (punto.disponibles == 0) {
            const marcador = L.marker([punto.geo_point_2d.lat, punto.geo_point_2d.lon], {
              icon: blackIcon,
              draggable: false,
            }).addTo(map).bindPopup(`
              <strong>Dirección:</strong> ${punto.direccion}<br>
              <strong>Abierto:</strong> ${punto.abierto === "T" ? "Sí" : "No"}<br>
              <strong>Disponibles:</strong> ${punto.disponibles}<br>
              <strong>Libres:</strong> ${punto.libres}<br>
              <strong>Total:</strong> ${punto.total}<br>
              <strong>Última Actualización:</strong> ${punto.actualizado}
            `);
            marcador.addTo(markerGroup);
          }
          // Si hay disponibles, comprobamos si es más de un tercio de los disponibles
          else if (punto.disponibles > 0 && punto.disponibles <= 5) {
            const marcador = L.marker([punto.geo_point_2d.lat, punto.geo_point_2d.lon], {
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
            marcador.addTo(markerGroup);
          }
          // Si los disponibles son mayores a 5, se marcan en rojo
          else {
            const marcador = L.marker([punto.geo_point_2d.lat, punto.geo_point_2d.lon], {
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
            marcador.addTo(markerGroup);
          }
        }
      });
    }
}


  buscarPuntos();

  let barraBusqueda = document.querySelector('#barraBusqueda');
  barraBusqueda.addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
      markerGroup.clearLayers();
      buscarPuntos(barraBusqueda.value);
    }
  });

  // Mostar la tabla desplegable de la izquerda
  document.getElementById("tablabutton").addEventListener("click", function name() {

    document.getElementById("tabla").style.visibility = "visible";
    document.getElementById("map").style.width = "10px";

  })

  document.getElementById("tablabuttonCerrar").addEventListener("click", function name() {

    document.getElementById("tabla").style.visibility = "hidden";
  })

  console.log(puntosServicio);
};
