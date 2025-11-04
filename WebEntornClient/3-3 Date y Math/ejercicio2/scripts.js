class Punto {
    constructor(nombre, x, y) {
        this._nombre = nombre;
        this._x = x;
        this._y = y;
    }

    get nombre() {
        return this._nombre;
    }

    get x() {
        return this._x;
    }

    get y() {
        return this._y;
    }

    set nombre(nombre) {
        this._nombre = nombre;
    }

    set x(x) {
        this._x = x;
    }

    set y(y) {
        this._y = y;
    }

    static mostrar(punto) {
        console.log(`Nombre: ${punto.nombre}, X: ${punto.x}, Y: ${punto.y}`);
    }

    static copiar(punto1, punto2) {
        punto2.nombre = punto1.nombre;
        punto2.x = punto1.x;
        punto2.y = punto1.y;
    }

    cambiar(x, y) {
        this._x = x;
        this._y = y;
    }

    static iguales(punto1, punto2) {
        return punto1.x === punto2.x && punto1.y === punto2.y;
    }

    sumar(valor, nombre = "PuntoNuevo") {
        const nuevoPunto = new Punto(
            nombre,
            this._x + valor.x,
            this._y + valor.y
        );
        return nuevoPunto;
    }


    obtenerDistancia(punto) {
        const distancia = Math.sqrt(
            Math.pow(punto.x - this._x, 2) + Math.pow(punto.y - this._y, 2)
        );
        return distancia;
    }

    toString() {
        return `${this._nombre} (${this._x}, ${this._y})`;
    }
}

function pedirCoordenada(nombre, eje, rangoMin, rangoMax) {
    let valor;
    while (true) {
        valor = prompt(`Escribe la coordenada ${eje} del punto "${nombre}" (Entre ${rangoMin} y ${rangoMax}):`, "0");

        if (valor === null) {
            return null;
        }

        valor = parseFloat(valor);
        if (isNaN(valor)) {
            alert("Valor no válido. Intente nuevamente.");
            continue;
        }

        valor = Math.trunc(valor);

        if (valor < rangoMin || valor > rangoMax) {
            alert(`El valor tiene que estar en el rango de ${rangoMin} a ${rangoMax}.`);
        } else {
            return valor;
        }
    }
}

// INICIO
const rangoMin = -6;
const rangoMax = 6;

let punto1 = new Punto();
let x = pedirCoordenada("Punto1", "x", rangoMin, rangoMax);

if (x === null) {

    alert("Ha cancelado, el programa NO seguirá");

} else {
    let y = pedirCoordenada("Punto1", "y", rangoMin, rangoMax);

    if (y === null) {
        console.log("Fin del programa");
    } else {
        
        punto1 = new Punto("Punto1", x, y);
        alert(`Las coordenadas de ${punto1.toString()}`);

        // copiar punto1
        let punto2 = new Punto("Punto2", punto1.x, punto1.y);
        alert(`Las coordenadas de ${punto2.toString()}`);


        let confirmar = confirm("¿Desea modificar las coordenadas del segundo punto (Punto2)?");
        if (confirmar) {
            let nuevoX = pedirCoordenada("Punto2", "x", rangoMin, rangoMax);
            let nuevoY = pedirCoordenada("Punto2", "y", rangoMin, rangoMax);

            if (nuevoX === null || nuevoY === null) {
                alert("Fin del programa");
            } else {
                punto2.cambiar(Math.round(nuevoX), Math.round(nuevoY));
                alert(`Las coordenadas de ${punto2.toString()}`);
            }

            if (Punto.iguales(punto1, punto2)) {
                const valorAleatorio = {
                    x: Math.floor(Math.random() * (rangoMax - rangoMin + 1)) + rangoMin, // redondeo hacia abajo
                    y: Math.ceil(Math.random() * (rangoMax - rangoMin + 1)) + rangoMin  // redondeo hacia arriba
                };

                const punto3 = punto1.sumar(valorAleatorio, "Punto3");
                const distancia = punto1.obtenerDistancia(punto3);
                alert(`La distancia entre ${punto1} y ${punto3} es: ${distancia.toFixed(2)}`);

            } else {
                const distancia = punto1.obtenerDistancia(punto2);
                alert(`La distancia entre ${punto1} y ${punto2} es: ${distancia.toFixed(2)}`);
            }

        } else {

            const valorAleatorio = {
                x: Math.floor(Math.random() * (rangoMax - rangoMin + 1)) + rangoMin,
                y: Math.ceil(Math.random() * (rangoMax - rangoMin + 1)) + rangoMin
            };

            const punto3 = punto1.sumar(valorAleatorio, "Punto3");

            const distancia = punto1.obtenerDistancia(punto3);
            alert(`La distancia entre ${punto1} y ${punto3} es: ${distancia.toFixed(2)}`);
        }
    }
}
