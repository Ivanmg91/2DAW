const selectCriptos = document.getElementById('criptomonedas');
const formulario = document.getElementById('formulario');
const moneda = document.getElementById('moneda');
const criptomonedas = document.getElementById('criptomonedas');
const resultado = document.getElementById('resultado');


async function listarCriptos () {
    try {
        const respuesta = await fetch('https://min-api.cryptocompare.com/data/top/mktcapfull?limit=10&tsym=USD');
        const datos = await respuesta.json(); // await para qno devuelva una promise (pending)

        datos.Data.forEach(dato => { // .data para entrar dentro del object
            //console.log(dato); // aqui hacemos dato.CoinInfo.Full name para acceder a la propiedad q necesitamos

            const { Name: codigo, FullName: nombre } = dato.CoinInfo; // destructuring object

            const opcion = document.createElement('option');
            opcion.value = codigo;
            opcion.text = nombre;

            selectCriptos.appendChild(opcion);
        });

    } catch (error) {
        console.error("Error: ", error.message);
    }
}

listarCriptos();

formulario.addEventListener('submit', function (e) {
    e.preventDefault(); // Evita que el formulario se recargue

    if (moneda.value === '' && criptomonedas.value === '' && !resultado.classList.contains('error')) {
        resultado.classList.add('error');
        resultado.textContent = ('Ambos campos son obligatorios');

        setTimeout(() => {
            resultado.textContent = '';
            resultado.classList.remove('error');
        }, 2000);

        return;
    } else {
        mostrarResultados(moneda.value, criptomonedas.value)
    }

});

async function mostrarResultados(moneda, criptomoneda) {
    const respuesta = await fetch(`https://min-api.cryptocompare.com/data/pricemultifull?fsyms=${criptomoneda}&tsyms=${moneda}`);
    const datos = await respuesta.json(); // await para qno devuelva una promise (pending)

    const { PRICE, HIGHDAY, LOWDAY, CHANGEPCT24HOUR, LASTUPDATE } = Object.values(datos.RAW.BTC)[0];

    // Crear un párrafo
    const h = document.createElement('h1');
    h.textContent = `
        El Precio es: ${PRICE} ${moneda} | 
        Precio más alto del día: ${HIGHDAY} | 
        Precio más bajo del día: ${LOWDAY} | 
        Valoración últimas 24 horas: ${CHANGEPCT24HOUR.toFixed(2)}% | 
        Última actualización: ${new Date(LASTUPDATE * 1000).toLocaleString()}
    `;

    // Añadir al final del body
    document.body.appendChild(h);
}