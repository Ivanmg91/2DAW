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
    
    cambiar (x, y) {
        this._x = x;
        this._y = y;
    }

    static iguales(punto1, punto2) {
        if (punto1.x == punto2.x && punto1.y == punto2.y) {
            return true;
        } else {
            return false;
        }
    }

    // esta funcion permite crear un objeto de tipo Punto 
    // cuyas coordenadas serán las de otro objeto más un valor determinado
    sumar (punto, valor) {
        const nuevoPunto = new Punto(punto.x + valor.x, punto.y + valor.y);
        
        return nuevoPunto;
    }

    obtenerDistancia(punto) {
        const distancia = Math.sqrt(Math.pow(punto.x - this._x) + Math.pow(punto.y - this._y));

        return distancia;
    }

    toString() {
        return `${this._nombre} son (${this._x}, ${this._y})`;
    }
}

function pedirCoordenada(nombre, eje, rangoMin, rangoMax) {
    let valor;
    while (true) {
        valor = prompt(`Escribe la coordenada ${eje} del punto "${nombre}" (Entre ${rangoMin} y ${rangoMax}):`, "0");

        if (valor === null) {
            console.log("El usuario ha cancelado la operación. Terminando el programa.");
            return null;
        }

        valor = parseFloat(valor);
        if (isNaN(valor)) {
            console.log("Valor no válido. Intente nuevamente.");
            continue;
        }

        valor = Math.trunc(valor);

        if (valor < rangoMin || valor > rangoMax) {
            console.log(`El valor tiene que estar en el rango de ${rangoMin} a ${rangoMax}.`, "0");
        } else {
            return valor;
        }
    }
}

// INICIO
const rangoMin = -5;
const rangoMax = 5;

let punto1 = new Punto();
let x = pedirCoordenada("Punto1", "x", rangoMin, rangoMax);

if (x === null) {

    console.log("Fin del programa");

} else {

    let y = pedirCoordenada("Punto1", "y", rangoMin, rangoMax);

    if (y === null) {
        console.log("Fin del programa");
    } else {
        punto1 = new Punto("Punto1", x, y);
    }
}

console.log(`Las coordenadas de ${punto1.toString()}`);

