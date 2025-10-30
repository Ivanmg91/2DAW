# README — Proyecto Inicial: Disponibilidad Valenbisi

## 1. Introducción

Este proyecto es una **aplicación web ligera** que muestra la disponibilidad de puntos de servicio (por ejemplo estaciones de bicicleta compartida) a partir de un fichero JSON local, aunque se puede modificar para extraer los datos desde la api. El objetivo es ofrecer una **visualización clara y accesible** de cuántas plazas/vehículos están disponibles en cada punto y su posición geográfica sobre un mapa.

**Relación con la movilidad sostenible**: mostrar en tiempo real (o con datos actualizados) la disponibilidad de medios de transporte compartido facilita la toma de decisiones de los usuarios, reduce la necesidad de vehículo privado y fomenta el uso de alternativas sostenibles — todo lo cual contribuye a una movilidad urbana más eficiente y menos contaminante.

---

## 2. Arquitectura del proyecto

Estructura principal de carpetas y ficheros:

```
Proyecto Inicial/
├── index.html           # Vista principal (HTML)
├── styles.css           # Estilos (CSS)
├── file.json            # Datos estáticos de puntos de servicio (simula una API)
└── Scripts/
    ├── app.js           # Lógica del controlador principal (consulta y renderizado)
    ├── layerController.js # Inicialización y control de capas del mapa (Leaflet)
    ├── PuntoServicio.js # Modelo ligero (clase) que representa un punto de servicio
    └── script.js        # pequeño script de ejemplo (no crítico)
```

### Justificación del patrón Vista–Controlador (MVC simplificado)

El proyecto sigue un patrón **Vista–Controlador** (no estrictamente MVC completo) porque separa claramente:

* **Vista**: `index.html` + `styles.css` — responsables de la presentación y la interacción básica del usuario (tabla y mapa).
* **Controlador**: `app.js` (lógica de obtención de datos, transformación y renderizado) y `layerController.js` (gestión de capas del mapa).
* **Modelo ligero**: `PuntoServicio.js` encapsula la estructura de los datos de una estación.

Separar presentación y lógica facilita mantenimiento, pruebas y futuras mejoras (por ejemplo cambiar la fuente de datos por una API real sin tocar la vista).

### Breve descripción de cada fichero

* `index.html`: Documento HTML que monta la interfaz — incluye una tabla para listar puntos y un `div` con id `map` que usa Leaflet.
* `styles.css`: Reglas CSS para presentación (layout, tabla, contenedor del mapa).
* `file.json`: Fichero con la lista de puntos de servicio; cada registro incluye `address`, `number`, `available`, `free`, `total`, `geo_point_2d`, `updated_at`, etc.
* `Scripts/PuntoServicio.js`: Clase `PuntoServicio` que mapea las propiedades del JSON a atributos accesibles desde JS.
* `Scripts/layerController.js`: Función `setupLayerController(map)` que configura capas base (OpenStreetMap, Carto, Esri...) y un `LayerGroup` para marcadores.
* `Scripts/app.js`: Controlador principal: carga `file.json`, crea instancias `PuntoServicio`, renderiza la tabla, añade marcadores al mapa y gestiona búsqueda/ordenación.
* `Scripts/script.js`: Script de ejemplo para demostrar manipulación DOM (variables y despliegue sencillo) y no es crítico para la funcionalidad principal.

---

## 3. Explicación detallada del código

A continuación se describen las piezas clave del código y ejemplos comentados. Los extractos se han simplificado para centrarnos en la lógica.

### 3.1 `Scripts/PuntoServicio.js` (Modelo)

```js
// Clase que representa un punto de servicio
export class PuntoServicio {
  constructor(data) {
    this.direccion = data.address;
    this.numero = data.number;
    this.abierto = data.open;
    this.disponibles = data.available; // plazas/vehículos disponibles
    this.libres = data.free;          // análogamente plazas libres
    this.total = data.total;
    this.ticket = data.ticket;
    this.actualizado = data.updated_at;
    this.geo_point_2d = { lat: data.geo_point_2d.lat, lon: data.geo_point_2d.lon };
  }
}
```

**Comentario:** esta clase actúa de DTO (Data Transfer Object) para normalizar la estructura del JSON y facilitar su uso por el controlador.

---

### 3.2 `Scripts/layerController.js` (Controlador mapa)

Principales responsabilidades:

* Crear capas base (OpenStreetMap, CartoDB, Esri, etc.)
* Crear un `LayerGroup` para los marcadores
* Añadir controles de capas al mapa

Fragmento (simplificado):

```js
export function setupLayerController(map) {
  const osm = L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", { maxZoom: 18 });
  const cartoDBPositron = L.tileLayer(/* ... */);

  const markersLayer = L.layerGroup();
  const baseMaps = {
    "OpenStreetMap": osm,
    "CartoDB Positron": cartoDBPositron,
  };

  osm.addTo(map);
  markersLayer.addTo(map);

  L.control.layers(baseMaps, {}, { position: 'bottomleft' }).addTo(map);
}
```

**Comentario:** separar la lógica de capas permite cambiar estilos de mapa sin tocar el controlador de datos.

---

### 3.3 `Scripts/app.js` (Controlador principal)

Responsabilidades principales:

* Leer `file.json` (simulando una API)
* Transformar cada registro a `PuntoServicio`
* Renderizar una tabla HTML con la lista de puntos
* Añadir marcadores al mapa (popup con información)
* Implementar búsqueda y ordenación de la tabla

Algunos fragmentos clave y su explicación:

#### Carga de datos (fetch)

```js
async function fetchJSONDataInTable() {
  try {
    const response = await fetch("./file.json");
    const data = await response.json();

    data.forEach((item) => {
      const punto = new PuntoServicio(item);
      puntosServicio.push(punto);
    });

    // Después de cargar, renderizamos tabla y marcadores
    mostrarTablaPuntos();
    // ... función que añade marcadores al mapa
  } catch (error) {
    console.error("Error al cargar el JSON:", error);
  }
}
```

**Comentario:** actualmente se usa `fetch` local; para producción esto debería apuntar a una API REST (por ejemplo `/api/estaciones`).

---

#### Renderizado de la tabla

```js
function mostrarTablaPuntos() {
  const tbody = document.querySelector("#tablaPuntos tbody");
  tbody.innerHTML = ""; // limpiar

  puntosServicio.forEach((punto) => {
    const fila = document.createElement("tr");
    fila.innerHTML = `
      <td>${punto.direccion}</td>
      <td>${punto.disponibles}</td>
      <td>${punto.libres}</td>
      <td>${punto.total}</td>
    `;
    tbody.appendChild(fila);
  });
}
```

**Comentario:** sencillo y efectivo; para grandes volúmenes se recomendaría paginación o renderizado virtualizado.

---

#### Búsqueda y ordenación

El controlador implementa funciones `buscarPuntos` y `ordenarTabla` que filtran u ordenan `puntosServicio`, y vuelven a llamar a `mostrarTablaPuntos()` para actualizar la vista.

Fragmento (esquema):

```js
function buscarPuntos(query) {
  const resultado = puntosServicio.filter(p => p.direccion.toLowerCase().includes(query.toLowerCase()));
  // renderizar solo `resultado`
}

function ordenarTabla(campo) {
  puntosServicio.sort((a,b) => a[campo] > b[campo] ? 1 : -1);
  mostrarTablaPuntos();
}
```

**Comentario:** la ordenación actual usa comparaciones directas; si los campos son numéricos conviene convertir a `Number()` antes de comparar.

---

### 3.4 `index.html` (puntos a destacar)

* Se importa Leaflet para manejo de mapas.
* Se carga `app.js` como módulo (`type="module"`).
* Contiene una tabla con id `tablaPuntos` y un `div#map` para el mapa.

---

## 4. Interacción entre módulos

Diagrama simple (flujo de datos):

```
[file.json]
   │  (fetch)
   ▼
[app.js] -- crea --> [PuntoServicio instances]
   │                  │
   │ render tabla     │ añade marcadores
   ▼                  ▼
[index.html (Tabla)]  [Leaflet map via layerController.js]
```

Descripción:

* La **fuente de datos** actual es `file.json` (simula una API). `app.js` la consume con `fetch`.
* `app.js` crea objetos `PuntoServicio` para normalizar la información.
* `app.js` llama a funciones de `layerController.js` para inicializar el mapa y añadir marcadores en la capa de `markers`.
* La **vista** (`index.html`) muestra la tabla y el mapa y recibe las actualizaciones cuando el controlador vuelve a renderizar.

---

## 5. Mejoras futuras (propuestas)

1. **Sustituir `file.json` por una API REST real** con endpoints como `/stations` y `/stations/:id` para datos en tiempo real.
2. **Integración con app móvil**: exponer la API y desarrollar un cliente móvil (React Native / Flutter) que use la misma API y muestre notificaciones sobre estaciones favoritas.
3. **Autenticación y personalización**: permitir que usuarios guarden estaciones favoritas, reciban alertas y personalicen la vista (ej. filtros por distancia, tipo de vehículo).
4. **Geolocalización y rutas**: calcular distancia desde la posición del usuario a estaciones cercanas y proponer rutas (integración con servicios de ruteo).
5. **Testeo y CI**: añadir tests unitarios para funciones de ordenación / filtrado y configurar integración continua para despliegue.

---

## 6. Conclusiones

**Valoración personal del trabajo realizado:**

El proyecto está bien organizado para una prueba de concepto: separación clara entre la vista, el controlador y el modelo ligero; uso de Leaflet aporta una visualización geográfica inmediata; y el uso de `fetch` facilita sustituir la fuente de datos por una API real.

**Dificultades encontradas:**

* Actualmente los datos provienen de un fichero estático (`file.json`); esto limita la actualidad de la información y no representa una conexión en tiempo real.
* El renderizado de la tabla y la gestión de marcadores están diseñados para volúmenes modestos; con miles de estaciones sería necesario optimizar.
* La ordenación y búsqueda son funcionales pero pueden presentar problemas si los tipos de campo no se normalizan (string vs número).

---

## 7. Notas finales y recomendaciones de desarrollo

* Convertir `file.json` en una API REST y añadir CORS para clientes externos.
* Añadir validaciones al crear `PuntoServicio` (por ejemplo, comprobar `geo_point_2d` antes de usar lat/lon).
* Añadir manejo de errores más robusto (mensajes al usuario cuando `fetch` falla).
