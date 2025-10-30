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

    toString() {
        return `${this._nombre}, ${this._x}, ${this._y}`;
    }
}
