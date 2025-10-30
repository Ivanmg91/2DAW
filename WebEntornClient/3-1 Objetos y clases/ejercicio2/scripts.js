// Clase Persona
class Persona {
    static contadorPersonas = 0;

    constructor(nombre, apellido, edad) {
        Persona.contadorPersonas++;
        this._idPersona = Persona.contadorPersonas;
        this._nombre = nombre;
        this._apellido = apellido;
        this._edad = edad;
    }

    get IdPersona() {
        return this._idPersona;
    }

    get Nombre() {
        return this._nombre;
    }

    set Nombre(nombre) {
        this._nombre = nombre;
    }

    get Apellido() {
        return this._apellido;
    }

    set Apellido(apellido) {
        this._apellido = apellido;
    }

    get Edad() {
        return this._edad;
    }

    set Edad(edad) {
        this._edad = edad;
    }

    toString() {
        return `${this._nombre}, ${this._edad}`;
    }
}

class Empleado extends Persona {
    static contadorEmpleados = 0;

    constructor(nombre, apellido, edad, sueldo) {
        super(nombre, apellido, edad);
        Empleado.contadorEmpleados++;
        this._idEmpleado = Empleado.contadorEmpleados;
        this._sueldo = sueldo;
    }

    get IdEmpleado() {
        return this._idEmpleado;
    }

    get Sueldo() {
        return this._sueldo;
    }

    set Sueldo(sueldo) {
        this._sueldo = sueldo;
    }

    toString() {
        return `${super.toString()}, Empleado/a : ${this._idEmpleado}: ${this._sueldo}`;
    }
}

class Cliente extends Persona {
    static contadorClientes = 0;

    constructor(nombre, apellido, edad, fechaRegistro) {
        super(nombre, apellido, edad);
        Cliente.contadorClientes++;
        this._idCliente = Cliente.contadorClientes;
        this._fechaRegistro = fechaRegistro;
    }

    get IdCliente() {
        return this._idCliente;
    }

    get FechaRegistro() {
        return this._fechaRegistro;
    }

    set FechaRegistro(fechaRegistro) {
        this._fechaRegistro = fechaRegistro;
    }

    toString() {
        return `${super.toString()}, Cliente/a:  ${this._idCliente}, Fecha alta: ${this._fechaRegistro.toLocaleDateString()}`;
    }
}

const persona1 = new Persona("Carmen", "García", 65);
const persona2 = new Persona("Carlos", "Pérez", 25);

const empleado1 = new Empleado("Laura", "González", 28, 1500);
const empleado2 = new Empleado("Pietro", "Sánchez", 32, 1200);

const cliente1 = new Cliente("Rodrigo", "Márquez", 50, new Date(2024, 9, 15));
const cliente2 = new Cliente("Pietro", "Sánchez", 32, new Date(2025, 9, 10));

console.log(persona1.toString());
console.log(persona2.toString());
console.log(empleado1.toString());
console.log(empleado2.toString());
console.log(cliente1.toString());
console.log(cliente2.toString());