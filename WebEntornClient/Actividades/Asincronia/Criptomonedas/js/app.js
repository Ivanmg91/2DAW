const selectCriptos = document.getElementById('criptomonedas');

async function listarCriptos () {
    try {
        const respuesta = await fetch('https://min-api.cryptocompare.com/data/top/mktcapfull?limit=10&tsym=USD');
        const datos = await respuesta.json(); // await para qno devuelva una promise (pending)

        datos.Data.forEach(dato => { // .data para entrar dentro del object
            // console.log(dato.CoinInfo.FullName); // aqui hacemos dato.CoinInfo.Full name para acceder a la propiedad q necesitamos

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