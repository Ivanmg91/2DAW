function comprobarRequisitos() {
    let resultado;

    // Validación de nombre
    let nombre = prompt("Introduce el nombre del personaje.").trim();
    while (nombre == "" || nombre == null) {
        nombre = prompt("El nombre del personaje no puede estar en blanco.").trim();
    }

    // Validación de clase de personaje
    let clasePersonaje = prompt("Introduce el tipo del personaje.").trim();
    while (clasePersonaje != "Guerrero" && clasePersonaje != "Mago") {
        clasePersonaje = prompt("El tipo del personaje debe ser Guerrero o Mago.").trim();
    }

    // Validación de nivel
    let nivel = parseInt(prompt("Introduce el nivel del personaje.").trim());
    while (isNaN(nivel)) {
        nivel = parseInt(prompt("Introduce un nivel válido.").trim());
    }

    // Comprobar acceso por nivel
    if (clasePersonaje == "Mago" && nivel > 35) {
        alert(`Personaje ${nombre} de clase ${clasePersonaje} y nivel ${nivel}. ACCESO CONCEDIDO`);
        resultado = "Concedido";
    } else if (clasePersonaje == "Mago" && nivel <= 35) {
        alert(`Personaje ${nombre} de clase ${clasePersonaje} y nivel ${nivel}. ACCESO DENEGADO, debes introducir los datos de nuevo.`);
        resultado = "Denegado";
    }

    if (clasePersonaje == "Guerrero" && nivel > 40) {
        alert(`Personaje ${nombre} de clase ${clasePersonaje} y nivel ${nivel}. ACCESO CONCEDIDO`);
        resultado = "Concedido";
    } else if (clasePersonaje == "Guerrero" && nivel <= 35) {
        alert(`Personaje ${nombre} de clase ${clasePersonaje} y nivel ${nivel}. ACCESO DENEGADO, debes introducir los datos de nuevo.`);
        resultado = "Denegado";
    }

    // Respuesta
    return new Array(nombre, clasePersonaje, nivel, resultado);
}

// Objeto literal inventario
const inventario = {
    _pesoMinimo: Number(5),
    _pesoMaximo: Number(20),
    _objetos: [],

    // Capacidad inventario
    get capacidadDisponible() {
        let comprendidos = [];

        for (let i = this._pesoMinimo; i <= this._pesoMaximo; i++) {
            comprendidos.push(i);
        }

        return comprendidos;
    },

    // Setter objetos inventario
    set cargarObjetos(nombre_objetos) {
        for (let i = 0; i < nombre_objetos.length; i++) {
            this._objetos.push(nombre_objetos[i]);
        }
    }
}

// Clase personaje (base)
class Personaje {
    static contadorPersonaje = 0;

    // constructor
    constructor(nombre, clase, vida) {
        Personaje.contadorPersonaje++;
        this._idPersonaje = Personaje.contadorPersonaje;
        this._nombre = nombre;
        this._vida = vida;
        this._clase = clase;
    }

    // getters y setters
    get IdPersonaje() {
        return this._idPersonaje;
    }

    get NombrePersonaje() {
        return this._nombre;
    }

    set NombrePersonaje(nombre) {
        this._nombre = nombre;
    }

    get VidaPersonaje() {
        return this._vida;
    }

    set VidaPersonaje(vida) {
        this._vida = vida;
    }

    toString() {
        return `IdPersonaje: ${this._idPersonaje}, nombre: ${this._nombre}, vida: ${this._vida}, clase: ${this._clase}`;
    }
}

// clase guerrero (hija de personaje)
class Guerrero extends Personaje {
    static contadorGuerreros = 0;

    constructor(nombre, clase, vida, fuerza) {
        super(nombre, clase, vida);
        Guerrero.contadorGuerreros++;
        this._idGuerrero = Guerrero.contadorGuerreros;
        this._fuerza = fuerza;
    }

    get IdGuerrero() {
        return this._idGuerrero;
    }

    get FuerzaPersonaje() {
        return this._fuerza;
    }

    set FuerzaPersonaje(fuerza) {
        this._fuerza = fuerza;
    }

    toString() {
        return `${super.toString()}, IdGuerrero: ${this._idGuerrero}, fuerza ${this._fuerza}`;
    }
}

// Funcion calcular daño
function calcularDano(DANO_BASE, multiplicador) {
    // Si no se establece multiplicador lo establecemos por defecto
    if (isNaN(multiplicador)) {
        multiplicador = 3;
    }
    return DANO_BASE * multiplicador;
}

// ACTIVIDAD 1
// LLama a la función para iniciar la actividad
res = comprobarRequisitos();

console.log("--- Comprobación de Requisitos ---");
console.log(`Personaje: ${res[0]}, Clase: ${res[1]}, Nivel: ${res[2]}`);
console.log(`Resultado: Acceso ${res[3]}`);

console.log();

// ACTIVIDAD 2
console.log("--- Actividad 2: Inventario ---");
// mostrar capacidad disponible
console.log(`Capacidad Disponible: `, inventario.capacidadDisponible);
// usar el setter
inventario.cargarObjetos = ["Espadon", "Escudo", "Mapa"];
// mostrar objetos
console.log(`Objetos en Inventario: `, inventario._objetos);

console.log();

// ACTIVIDAD 3
console.log("--- Actividad 3: POO con Clases ---");
const personaje1 = new Personaje("Elara", "Mago", 90);
const personaje2 = new Personaje("Lúthien", "Arquero", 75);

const guerrero1 = new Guerrero("Balthus", "Paladin", 120, 85);
const guerrero2 = new Guerrero("Bunko", "Elfo", 110, 95);

console.log("--- 2 Personajes (Base) ---");
// Personajes con clase personaje
console.log(personaje1.toString());
console.log(personaje2.toString());
// guerreros con clase hija guerrero
console.log("--- 2 Guerreros (Hija) ---");
console.log(guerrero1.toString());
console.log(guerrero2.toString());

console.log();

// ACTIVIDAD 4
console.log("--- Actividad 4: Utilidad ---");
// funcion calcularDano con valor por defecto
let dano1 = calcularDano(45);
console.log("Calculando Daño: Daño Base = 45, Multiplicador usado = 3");
console.log(`Resultado Daño 1 (x3): ${dano1}`);
console.log("--- Actividad 4: Utilidad ---");
// funcion calcularDano con multiplicador especifico
let dano2 = calcularDano(45, 5);
console.log("Calculando Daño: Daño Base = 45, Multiplicador usado = 5");
console.log(`Resultado Daño 2 (x5): ${dano2}`);
