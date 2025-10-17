function obtenerNumeroComensales() {
    let numeroComensales = parseInt(prompt("¿Con cuántos comensales vamos a contar?"));

    while (isNaN(numeroComensales) || numeroComensales <= 0) {
        alert("Por favor, introduce un número de comensales");
        numeroComensales = parseInt(prompt("¿Con cuántos comensales vamos a contar?"));
    }

    return numeroComensales;
}

function obtenerNumeroComensalesAbuelos(comensalesTotales) {
    let numeroComensalesAbuelos = parseInt(prompt("¿Cuántos comensales tenemos mayores de 65 años?"));

    while (isNaN(numeroComensalesAbuelos) || numeroComensalesAbuelos > comensalesTotales) {
        alert("Por favor, introduce un número de comensales mayores de 65 años válido.");
        numeroComensalesAbuelos = parseInt(prompt("¿Cuántos comensales tenemos mayores de 65 años?"));
    }

    return numeroComensalesAbuelos;
}

function obtenerNumeroComensalesNinios(comensalesTotales, comensalesAbuelos) {
    let numeroComensalesNinios = parseInt(prompt("¿Cuántos comensales tenemos menores de 10 años con menú infantil?"));

    while (isNaN(numeroComensalesNinios) || numeroComensalesNinios > (comensalesTotales - comensalesAbuelos)) {
        alert("Por favor, introduce un número de comensales menores de 10 años válido.");
        numeroComensalesNinios = parseInt(prompt("¿Cuántos comensales tenemos menores de 10 años con menú infantil?"));
    }

    return numeroComensalesNinios;
}

function mostrarInfoMenus() {
    alert("Estas son las opciones de menús para adultos...\n\n1.- Menú del dia --> 12,5€\n\n2.- Menú del día PREMIUM --> 17,45€\n\n3.- Menú Buffet Libre --> 23,85€\n\nNOTA: Todos los precios son sin IVA")
}

function mostrarCuantosPorElegir (menusElegidos, menusPorElegir) {
    alert(`De momento llevas ${menusElegidos} menús elegidos...\nTe quedan ${menusPorElegir}`)
}

function mostrarResultadoMenus(numeroComensales,numeroComensalesNinios, numeroComensalesAdultos, menu1, menu2, menu3, menu4) {
    alert(`Contamos con un total de ${numeroComensales}: ${numeroComensalesNinios} niños y ${numeroComensalesAdultos} adultos\n\nLos menús que servirán serán los siguientes:\n\n${menu1} menú/s del día\n\n${menu2} menú/s PREMIUM\n\n${menu3} menú/s Buffet Libre\n\n${menu4} menú/s infatil/es`);
}

// Start program
let numeroComensales = obtenerNumeroComensales();
let numeroComensalesAbuelos = obtenerNumeroComensalesAbuelos(numeroComensales);
let numeroComensalesNinios = obtenerNumeroComensalesNinios(numeroComensales, numeroComensalesAbuelos);
let numeroComensalesAdultos = numeroComensales - numeroComensalesNinios;

let menu1 = 0; // daily menu
let menu2 = 0; // daily menu premium
let menu3 = 0; // free buffet menu
let menu4 = numeroComensalesNinios;

// User select menus
mostrarInfoMenus();

let menusElegidos = 0;
let menusPorElegir = numeroComensales - numeroComensalesNinios;
mostrarCuantosPorElegir(menusElegidos, menusPorElegir);

if (menusPorElegir > 0) {
    let cuantosQuieren = parseInt(prompt("¿Cuántos comensales quieren el menú?\n1.- Menú del día --> 12,5€"), 10);

    if (isNaN(cuantosQuieren)) {
        cuantosQuieren = 0;
    }

    menusElegidos += cuantosQuieren;
    menu1 = cuantosQuieren;
    menusPorElegir = numeroComensales - numeroComensalesNinios - menusElegidos;
    mostrarCuantosPorElegir(menusElegidos, menusPorElegir);
}

if (menusPorElegir > 0) {
    cuantosQuieren = parseInt(prompt("¿Cuántos comensales quieren el menú?\n2.- Menú del día PREMIUM --> 17,45€"), 10);

    if (isNaN(cuantosQuieren)) {
        cuantosQuieren = 0;
    }

    menusElegidos += cuantosQuieren;
    menu2 = cuantosQuieren;
    menusPorElegir = numeroComensales - numeroComensalesNinios - menusElegidos;
    mostrarCuantosPorElegir(menusElegidos, menusPorElegir);
}

menu3 = menusPorElegir;

mostrarResultadoMenus(numeroComensales, numeroComensalesNinios, numeroComensalesAdultos, menu1, menu2, menu3, menu4);

alert(`Debe saber que ${numeroComensalesAbuelos} menú/s se beneficiarán de un 15% de descuento,\n\nrespecto al menú de adultos por ser mayores de 65 años\n\nNOTA: El descuento será aplicado a los menús más económicos`);
alert(`Los menús infantiles tienen un precio de 9.25€ + IVA\n\nEn su caso, se le apliacrá este precio a ${numeroComensalesNinios} comensales`);

const preciosAdultos = [
    { menu: "del día", precio: 12.5, cantidad: menu1 },
    { menu: "PREMIUM", precio: 17.45, cantidad: menu2 },
    { menu: "Buffet", precio: 23.85, cantidad: menu3 },
];

let abuelosRestantes = numeroComensalesAbuelos;
let totalFinal = 0;
let resumenLineas = [];

for (let i = 0; i < preciosAdultos.length; i++) {
    let { menu, precio, cantidad } = preciosAdultos[i];

    let abuelosConDescuento = Math.min(abuelosRestantes, cantidad);
    abuelosRestantes -= abuelosConDescuento;

    let totalMenu = (cantidad - abuelosConDescuento) * precio + abuelosConDescuento * precio * 0.85;

    resumenLineas.push(`${cantidad} menú/s ${menu} x ${precio} € ....... ${totalMenu.toFixed(2)} €\n`);
    totalFinal += totalMenu;
}

// children menu
let subtotalNinios = menu4 * 9.25;
resumenLineas.push(`${menu4} menú/s infantil/es x 9.25 € ....... ${subtotalNinios.toFixed(2)} €`);

totalFinal += subtotalNinios;

const iva = totalFinal * 0.10;
const totalConIva = totalFinal + iva;

alert(`Los menús que se servirán serán los siguientes:\n\n${resumenLineas.join('\n')}\n\nIVA 10% ....... ${iva.toFixed(2)} €\n\nTOTAL CON IVA ....... ${totalConIva.toFixed(2)} €`);
