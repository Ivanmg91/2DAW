// VARIABLES HTML
const selectCriptos = document.getElementById('criptomonedas');
const formulario = document.getElementById('formulario');
const moneda = document.getElementById('moneda');
const criptomonedas = document.getElementById('criptomonedas');
const resultado = document.getElementById('resultado');


// FUNCIONES

// Función para mostrar una lista del top 10 cryptos
async function listarCriptos () {
    try {
        const respuesta = await fetch('https://min-api.cryptocompare.com/data/top/mktcapfull?limit=10&tsym=USD');
        const datos = await respuesta.json(); // await para qno devuelva una promise (pending)

        datos.Data.forEach(dato => { // .data para entrar dentro del object
            //console.log(dato); // aqui hacemos dato.CoinInfo.Full name para acceder a la propiedad q necesitamos

            const { Name: codigo, FullName: nombre } = dato.CoinInfo; // destructuring object

            // Creamos la option y la añadimos al select
            const opcion = document.createElement('option');
            opcion.value = codigo;
            opcion.text = nombre;

            selectCriptos.appendChild(opcion);
        });

    } catch (error) {
        console.error("Error: ", error.message);
    }
}

// Función para q se muestren los resultados de conversión
async function mostrarResultados(moneda, criptomoneda) {
    // Endpoint modificado para q busque la conversión seleccionada
    const respuesta = await fetch(`https://min-api.cryptocompare.com/data/pricemultifull?fsyms=${criptomoneda}&tsyms=${moneda}`);
    const datos = await respuesta.json(); // await para qno devuelva una promise (pending)

    // Destructuración para usar luego las variables
    const { PRICE, HIGHDAY, LOWDAY, CHANGEPCT24HOUR, LASTUPDATE } = Object.values(datos.RAW[criptomoneda])[0];

    // Limpiamos para que solo se muestren los resultados actuales
    resultado.innerHTML = '';

    // Crear un párrafo
    const p = document.createElement('p');
    p.classList.add('precio');
    p.textContent = `
        El Precio es: ${PRICE} ${moneda} | 
        Precio más alto del día: ${HIGHDAY} | 
        Precio más bajo del día: ${LOWDAY} | 
        Valoración últimas 24 horas: ${CHANGEPCT24HOUR.toFixed(2)}% | 
        Última actualización: ${new Date(LASTUPDATE * 1000).toLocaleString()}
    `;
    // Añadir al final del body
    resultado.appendChild(p);
}


// EJECUCIÓN DEL PROGRAMA

// Ejecutamos la función para q se vean la lista de cryptos
listarCriptos();

// Listener para escuchar cuando clickas en el boton de resultados (boton submit del formulario)
formulario.addEventListener('submit', function (e) {
    e.preventDefault(); // Evita que el formulario se recargue

    // Comparación para q muestre alerta si no seleccionas nada. Tambien evita q colapse la alerta al clickar mucho, si la clase error esta activa no hace nada el boton
    if (moneda.value === '' && criptomonedas.value === '' && !resultado.classList.contains('error')) {
        resultado.classList.add('error');
        resultado.textContent = ('Ambos campos son obligatorios');

        // Quitar la alerta en 2s
        setTimeout(() => {
            resultado.textContent = '';
            resultado.classList.remove('error');
        }, 2000);resultado.innerHTML = '';


        return;
    } else {
        mostrarResultados(moneda.value, criptomonedas.value)
    }

});