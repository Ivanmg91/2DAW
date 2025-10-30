alert("Introduce la información de 2 fechas.");

function pedirFecha(num) {
    let fechaValida = false;
    let fecha;

    while (!fechaValida) {
        let dia = parseInt(prompt(`Introduce el día de la fecha ${num}`));
        let mes = parseInt(prompt(`Introduce el mes de la fecha ${num}`));
        let anio = parseInt(prompt(`Introduce el año de la fecha ${num}`));

        fecha = new Date(anio, mes - 1, dia);

        if (fecha.getFullYear() === anio && fecha.getMonth() === mes - 1 && fecha.getDate() === dia) {
            fechaValida = true;
        } else {
            alert("Fecha no válida, inténtalo de nuevo.");
        }
    }

    return fecha;
}

let fecha1 = pedirFecha(1);
let fecha2 = pedirFecha(2);

console.log(fecha1);
console.log(fecha2);

// para evitar errores, si la fecha 1 es mayor las cambiamos
if (fecha1 > fecha2) {
    let temp = fecha1;
    fecha1 = fecha2;
    fecha2 = temp;
}

let diferencia = fecha2 - fecha1; // milisegundos

let dias = diferencia / (1000 * 60 * 60 * 24);
let horas = diferencia / (1000 * 60 * 60);


let anios = fecha2.getFullYear() - fecha1.getFullYear();
let meses = fecha2.getMonth() - fecha1.getMonth();

// si el mes de fecha 2 es anterior
if (meses < 0) {
    anios--;
    meses += 12;
}

// Calcular la diferencia en días considerando si el mes o el día de fecha2 es anterior a fecha1
let diasRestantes = fecha2.getDate() - fecha1.getDate();
if (diasRestantes < 0) {
    let lastMonth = new Date(fecha2.getFullYear(), fecha2.getMonth(), 0);
    diasRestantes += lastMonth.getDate();
}

console.log(`Entre ${fecha1.toLocaleDateString()} y ${fecha2.toLocaleDateString()} hay ${dias} días: \n${anios} años, ${meses} meses y ${diasRestantes} días`);