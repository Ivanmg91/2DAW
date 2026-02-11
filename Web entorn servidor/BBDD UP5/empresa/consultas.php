<?php
/**
 * @autor Silvia Vilar
 * Ejercicio 2 UP5. Consultas
 */
// include_once __DIR__ . '\..\..\db.php';

// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Conecta a la base de datos (ajusta los detalles de la conexión según tu configuración)
    try {
        $pdo = new PDO('mysql:host=192.168.1.109;dbname=EMPRESA;charset=utf8mb4', 'developerphp', 'developerphp');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }

    // Determina el tipo de consulta
    $tipo = $_POST['tipoConsulta'] ?? '';
    $consulta = null;
    $parametros = [];

    switch ($tipo) {
            //consultas de Clientes
        case 'ClientePorDni':
            //Datos de cliente por DNI
            $consulta = "SELECT * FROM CLIENTE WHERE DNI = ?";
            $parametros = [$_POST['dni']];
            break;

        case 'ListadoClientes':
            //Listado de todos los clientes ordenados por dni de cliente
            $consulta = "SELECT * FROM CLIENTE ORDER BY DNI";
            break;

        case 'ClientesDadapoblacion':
            //Datos de Clientes de una Población seleccionada ordenados por dni de cliente
            $consulta = "SELECT * FROM CLIENTE WHERE POBLACION = ? ORDER BY DNI";
            $parametros = [$_POST['poblacion']];
            break;
        case 'ListadoClientesPorPoblacion':
            //Listado de Clientes de una población seleccionada ordenados por población
            $consulta = "SELECT * FROM CLIENTE WHERE POBLACION = ? ORDER BY POBLACION";
            $parametros = [$_POST['poblacion']];
            break;

        case 'NumeroClientesPorPoblacion':
            //Listado de Clientes de una población seleccionada ordenados por población
            $consulta = "SELECT COUNT(*) as total FROM CLIENTE WHERE POBLACION = ?";
            $parametros = [$_POST['poblacion']];
            break;

        case 'ListadoClientesConCompras':
            //Datos de Clientes que han realizado compras ordenados por dni de cliente
            $consulta = "SELECT DISTINCT C.* FROM CLIENTE C JOIN COMPRA Co ON C.DNI = Co.CLIENTE ORDER BY C.DNI";
            break;
        case 'ListadoClientesSinCompras':
            //Datos de Clientes que no han realizado compras ordenados por dni de cliente
            $consulta = "SELECT * FROM CLIENTE WHERE DNI NOT IN (SELECT DISTINCT CLIENTE FROM COMPRA) ORDER BY DNI";
            break;
        case 'ListadoClientesConComprasDadaPoblacion':
            //Datos de Clientes que han realizado compras de una población seleccionada ordenados por dni de cliente
            $consulta = "SELECT DISTINCT C.* FROM CLIENTE C JOIN COMPRA Co ON C.DNI = Co.CLIENTE WHERE C.POBLACION = ? ORDER BY C.DNI";
            $parametros = [$_POST['poblacion']];
            break;
        case 'ListadoClientesSinComprasDadaPoblacion':
            //Datos de Clientes que no han realizado compras de una población seleccionada ordenados por dni de cliente
            $consulta = "SELECT * FROM CLIENTE WHERE POBLACION = ? AND DNI NOT IN (SELECT DISTINCT CLIENTE FROM COMPRA) ORDER BY DNI";
            $parametros = [$_POST['poblacion']];
            break;
        case 'ListadoClientesConComprasValencia':
            //Datos de Clientes que han realizado compras con algún cliente de la población de Valencia ordenados por dni de cliente
            $consulta = "SELECT DISTINCT C.* FROM CLIENTE C JOIN COMPRA Co ON C.DNI = Co.CLIENTE WHERE C.POBLACION = 'Valencia' ORDER BY C.DNI";
            break;

        case 'ListadoClientesConTresOMasCompras':
            //Listado de clientes que han realizado 3 o más compras ordenados por dni de cliente
            $consulta = "SELECT C.* FROM CLIENTE C JOIN COMPRA Co ON C.DNI = Co.CLIENTE GROUP BY C.DNI HAVING COUNT(*) >= 3 ORDER BY C.DNI";
            break;
        case 'ListadoClientesConTresComprasOMasPorPoblacion':
            //Listado de clientes que han realizado 3 compras o más de una población seleccionada ordenados por dni de cliente
            $consulta = "SELECT C.* FROM CLIENTE C JOIN COMPRA Co ON C.DNI = Co.CLIENTE WHERE C.POBLACION = ? GROUP BY C.DNI HAVING COUNT(*) >= 3 ORDER BY C.DNI";
            $parametros = [$_POST['poblacion']];
            break;

            //Consultas con proveedores
        case 'ProveedorPorNif':
            //Datos de proveedor por NIF
            $consulta = "SELECT * FROM PROVEEDOR WHERE NIF = ?";
            $parametros = [$_POST['proveedor']];
            break;

        case 'ListadoProveedores':
            //Listado de todos los proveedores ordenados por nif de proveedor
            $consulta = "SELECT * FROM PROVEEDOR ORDER BY NIF";
            break;

        case 'ProveedoresEmpiezanPorTexto':
            //Datos de proveedores que empiezan por un texto seleccionado ordenados por nif de proveedor
            $consulta = "SELECT * FROM PROVEEDOR WHERE NOMBRE LIKE ? ORDER BY NIF";
            $parametros = [$_POST['parametro'] . '%'];
            break;

        case 'ProveedoresProductosPvpMayor1000':
            //Datos de proveedores con productos con precio mayor a 1000€ ordenados por nif de proveedor
            $consulta = "SELECT DISTINCT Pr.* FROM PROVEEDOR Pr JOIN PRODUCTO P ON Pr.NIF = P.PROVEEDOR WHERE P.PVP > 1000 ORDER BY Pr.NIF";
            break;

            //Consultas con productos
        case 'ProductoPorCodProd':
            //Datos de producto por COD_PROD
            $consulta = "SELECT * FROM PRODUCTO WHERE COD_PROD = ?";
            $parametros = [$_POST['producto']];
            break;

        case 'ListadoProductos':
            //Listado de todos los productos ordenados por codigo de producto
            $consulta = "SELECT * FROM PRODUCTO ORDER BY COD_PROD";
            break;

        case 'ProductosPvpMenorOIgual100':
            //Datos de productos con precio menor a 100 ordenados por codigo de producto
            $consulta = "SELECT * FROM PRODUCTO WHERE PVP <= 100 ORDER BY COD_PROD";
            break;

        case 'ProductosPVPMayorPromedio':
            //Productos con precio mayor al promedio ordenados por codigo de producto
            $consulta = "SELECT * FROM PRODUCTO WHERE PVP > (SELECT AVG(PVP) FROM PRODUCTO) ORDER BY COD_PROD";
            break;

        case 'PvpMaximoProductos':
            //PVP máximo de los productos
            $consulta = "SELECT MAX(PVP) as maximo FROM PRODUCTO";
            break;

        case 'PvpMinimoProductos':
            //PVP mínimo de los productos
            $consulta = "SELECT MIN(PVP) as minimo FROM PRODUCTO";
            break;

        case 'PvpPromedioProductos':
            //PVP promedio de los productos
            $consulta = "SELECT AVG(PVP) as promedio FROM PRODUCTO";
            break;

        case "ProductosNombreContieneTexto":
            //Productos cuyo nombre contiene un texto dado ordenados por codigo de producto
            $consulta = "SELECT * FROM PRODUCTO WHERE NOMBRE LIKE ? ORDER BY COD_PROD";
            $parametros = ['%' . $_POST['parametro'] . '%'];
            break;

        //consultas con compras
        case 'ListadoCompras':
            //Listado de todas las compras mostrando nombre y apellidos de cliente, código y nombre de producto, nombre de proveedor, fecha y unidades ordenados por dni de cliente y código de producto
            $consulta = "SELECT C.NOMBRE AS NOMBRE_CLIENTE, C.APELLIDOS, P.COD_PROD, P.NOMBRE AS NOMBRE_PRODUCTO, Pr.NOMBRE AS NOMBRE_PROVEEDOR, Co.FECHA, Co.UDES 
                         FROM COMPRA Co 
                         JOIN CLIENTE C ON Co.CLIENTE = C.DNI 
                         JOIN PRODUCTO P ON Co.PRODUCTO = P.COD_PROD 
                         JOIN PROVEEDOR Pr ON P.PROVEEDOR = Pr.NIF 
                         ORDER BY C.DNI, P.COD_PROD";
            break;

        case 'ComprasDeAnyo':
            //Datos de compras a partir de un año dado ordenados por fecha
            $consulta = "SELECT C.NOMBRE, C.APELLIDOS, P.NOMBRE AS PRODUCTO, Co.FECHA, Co.UDES 
                         FROM COMPRA Co 
                         JOIN CLIENTE C ON Co.CLIENTE = C.DNI 
                         JOIN PRODUCTO P ON Co.PRODUCTO = P.COD_PROD 
                         WHERE YEAR(Co.FECHA) >= ? 
                         ORDER BY Co.FECHA";
            $parametros = [$_POST['parametro']];
            break;

        case 'ComprasDeCliente':
            //Datos de compras de un cliente dado ordenados por dni de cliente
            $consulta = "SELECT C.NOMBRE, C.APELLIDOS, P.NOMBRE AS PRODUCTO, Co.FECHA, Co.UDES 
                         FROM COMPRA Co 
                         JOIN CLIENTE C ON Co.CLIENTE = C.DNI 
                         JOIN PRODUCTO P ON Co.PRODUCTO = P.COD_PROD 
                         WHERE Co.CLIENTE = ? 
                         ORDER BY C.DNI";
            $parametros = [$_POST['dni']];
            break;

        case 'ComprasDeProducto':
            //Datos de compras de un producto dado ordenados por código de producto
            $consulta = "SELECT C.NOMBRE, C.APELLIDOS, P.NOMBRE AS PRODUCTO, Co.FECHA, Co.UDES 
                         FROM COMPRA Co 
                         JOIN CLIENTE C ON Co.CLIENTE = C.DNI 
                         JOIN PRODUCTO P ON Co.PRODUCTO = P.COD_PROD 
                         WHERE Co.PRODUCTO = ? 
                         ORDER BY P.COD_PROD";
            $parametros = [$_POST['producto']];
            break;

        case 'ComprasDeProveedor':
            //Datos de compras de un proveedor dado ordenados por nif de proveedor
            $consulta = "SELECT C.NOMBRE, C.APELLIDOS, P.NOMBRE AS PRODUCTO, Pr.NOMBRE AS PROVEEDOR, Co.FECHA 
                         FROM COMPRA Co 
                         JOIN CLIENTE C ON Co.CLIENTE = C.DNI 
                         JOIN PRODUCTO P ON Co.PRODUCTO = P.COD_PROD 
                         JOIN PROVEEDOR Pr ON P.PROVEEDOR = Pr.NIF 
                         WHERE Pr.NIF = ? 
                         ORDER BY Pr.NIF";
            $parametros = [$_POST['proveedor']];
            break;

        case 'ComprasDePoblacion':
            //Datos de compras de una población dada ordenados por población
            $consulta = "SELECT C.NOMBRE, C.APELLIDOS, C.POBLACION, P.NOMBRE AS PRODUCTO, Co.FECHA 
                         FROM COMPRA Co 
                         JOIN CLIENTE C ON Co.CLIENTE = C.DNI 
                         JOIN PRODUCTO P ON Co.PRODUCTO = P.COD_PROD 
                         WHERE C.POBLACION = ? 
                         ORDER BY C.POBLACION";
            $parametros = [$_POST['poblacion']];
            break;

        case 'ComprasDeClientesValencia':
            //Datos de compras con algún cliente de la población de Valencia ordenados por dni de cliente   
            $consulta = "SELECT C.NOMBRE, C.APELLIDOS, C.POBLACION, P.NOMBRE AS PRODUCTO, Co.FECHA 
                         FROM COMPRA Co 
                         JOIN CLIENTE C ON Co.CLIENTE = C.DNI 
                         JOIN PRODUCTO P ON Co.PRODUCTO = P.COD_PROD 
                         WHERE C.POBLACION = 'Valencia' 
                         ORDER BY C.DNI";
            break;

        case 'ComprasConIgualOMasDe2Unidades':
            //Datos de compras con igual o más de 2 unidades ordenados por dni de cliente
            $consulta = "SELECT C.NOMBRE, C.APELLIDOS, P.NOMBRE AS PRODUCTO, Co.UDES 
                         FROM COMPRA Co 
                         JOIN CLIENTE C ON Co.CLIENTE = C.DNI 
                         JOIN PRODUCTO P ON Co.PRODUCTO = P.COD_PROD 
                         WHERE Co.UDES >= 2 
                         ORDER BY C.DNI";
            break;

        case 'ComprasConMasDe3productos':
            //Datos de compras con más de 3 productos ordenados por dni de cliente
            $consulta = "SELECT C.NOMBRE, C.APELLIDOS, P.NOMBRE AS PRODUCTO, Co.UDES 
                         FROM COMPRA Co 
                         JOIN CLIENTE C ON Co.CLIENTE = C.DNI 
                         JOIN PRODUCTO P ON Co.PRODUCTO = P.COD_PROD 
                         WHERE Co.UDES > 3 
                         ORDER BY C.DNI";
            break;

        case 'ComprasMinimo10Unidades':
            //Datos de compras con un mínimo de 10 unidades ordenados por dni de cliente
            $consulta = "SELECT C.NOMBRE, C.APELLIDOS, P.NOMBRE AS PRODUCTO, Co.UDES 
                         FROM COMPRA Co 
                         JOIN CLIENTE C ON Co.CLIENTE = C.DNI 
                         JOIN PRODUCTO P ON Co.PRODUCTO = P.COD_PROD 
                         WHERE Co.UDES >= 10 
                         ORDER BY C.DNI";
            break;

        default:
            break;
    }

    // Ejecuta la consulta si está definida
    if (isset($consulta)) {
        //ejecutamos la consulta con los parámetros (si los hay) y obtenemos un vector asociativo
        $stmt = $pdo->prepare($consulta);
        $stmt->execute($parametros);
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode($resultados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // Cierra la conexión (iguala a null)
    $pdo = null;

    // Devuelve los resultados como JSON si hay resultados
    exit;
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <title>Ejercicios Consulta</title>
</head>

<body>
    <h1>Consultas de la BD Empresa</h1>
    <form action="consultas.php" method="post">
        <label for="tipoConsulta">Tipo de consulta:</label>
        <select name="tipoConsulta" id="tipoConsulta">
            <option value="ClientePorDni">Cliente dado dni</option>
            <option value="ListadoClientes">Listado clientes</option>
            <option value="ClientesDadapoblacion">Clientes de una población</option>
            <option value="ListadoClientesPorPoblacion">Listado de clientes por población</option>
            <option value="NumeroClientesPorPoblacion">Número de clientes por población</option>
            <option value="ListadoClientesConCompras">Clientes con compras</option>
            <option value="ListadoClientesSinCompras">Clientes sin compras</option>
            <option value="ListadoClientesConComprasDadaPoblacion">Clientes con compras de una población</option>
            <option value="ListadoClientesSinComprasDadaPoblacion">Clientes sin compras de una población</option>
            <option value="ListadoClientesConComprasValencia">Clientes con compras de Valencia</option>
            <option value="ListadoClientesConTresOMasCompras">Clientes con 3 compras o más</option>
            <option value="ListadoClientesConTresComprasOMasPorPoblacion">Clientes con 3 compras o más de una población</option>
            <option value="ProveedorPorNif">Proveedor dado NIF</option>
            <option value="ListadoProveedores">Listado de proveedores</option>
            <option value="ProveedoresEmpiezanPorTexto">Proveedores que empiezan por un texto</option>
            <option value="ProveedoresProductosPvpMayor1000">Proveedores con productos con precio mayor a 1000€</option>
            <option value="ProductoPorCodProd">Producto dado codigo</option>
            <option value="ListadoProductos">Listado de productos</option>
            <option value="ProductosPvpMenorOIgual100">Productos con precio menor a 100</option>
            <option value="ProductosPVPMayorPromedio">Productos con precio mayor al promedio</option>
            <option value="PvpMaximoProductos">PVP máximo de los productos</option>
            <option value="PvpMinimoProductos">PVP mínimo de los productos</option>
            <option value="PvpPromedioProductos">PVP promedio de los productos</option>
            <option value="ProductosNombreContieneTexto">Productos cuyo nombre contiene un texto</option>
            <option value="ListadoCompras">Listado de compras</option>
            <option value="ComprasDeAnyo">Compras a partir de un año dado</option>
            <option value="ComprasDeCliente">Compras de un cliente dado</option>
            <option value="ComprasDeProducto">Compras de un producto dado</option>
            <option value="ComprasDeProveedor">Compras de un proveedor dado</option>
            <option value="ComprasDePoblacion">Compras de una población dada</option>
            <option value="ComprasDeClientesValencia">Compras con algún cliente de la población de Valencia</option>
            <option value="ComprasConIgualOMasDe2Unidades">Compras con 2 unidades o más</option>
            <option value="ComprasConMasDe3productos">Compras con más de 3 productos</option>
            <option value="ComprasMinimo10Unidades">Compras con un mínimo de 10 unidades</option>
        </select>
        </select>
        <label for="dni">dni:</label>
        <select name="dni" id="dni">
            <?php
            // Conecta a la base de datos (ajusta los detalles de la conexión según tu configuración)
            try {
                $pdo = new PDO('mysql:host=192.168.1.109;dbname=EMPRESA;charset=utf8mb4', 'developerphp', 'developerphp');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
                // Obtiene los dnis de la base de datos
                $query = "SELECT DNI FROM CLIENTE";
                $stmt = $pdo->query($query);
                
                // Recorre y muestra los dnis en el select simple como opciones
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='" . $row['DNI'] . "'>" . $row['DNI'] . "</option>";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            ?>
        </select>
        <label for="poblacion">población:</label>
        <select name="poblacion" id="poblacion">
            <?php
            // Conecta a la base de datos (ajusta los detalles de la conexión según tu configuración)
            // Reutilizamos $pdo si sigue abierta, o conectamos de nuevo
            
            // Obtiene los dnis de la base de datos
            $query = "SELECT DISTINCT POBLACION FROM CLIENTE WHERE POBLACION IS NOT NULL";
            $stmt = $pdo->query($query);

            // Recorre y muestra poblaciones en el select simple como opciones
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $row['POBLACION'] . "'>" . $row['POBLACION'] . "</option>";
            }
            ?>
        </select>
        <label for="proveedor">proveedor:</label>
        <select name="proveedor" id="proveedor">
            <?php
            // Conecta a la base de datos (ajusta los detalles de la conexión según tu configuración)
            
            // Obtiene los proveedores de la base de datos
            $query = "SELECT NIF, NOMBRE FROM PROVEEDOR";
            $stmt = $pdo->query($query);
            
            // Recorre y muestra los dnproveedores en el select simple como opciones
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $row['NIF'] . "'>" . $row['NOMBRE'] . " (" . $row['NIF'] . ")</option>";
            }
            ?>
        </select>
        <label for="producto">producto:</label>
        <select name="producto" id="producto">
            <?php
            // Conecta a la base de datos (ajusta los detalles de la conexión según tu configuración)
            
            // Obtiene los productos de la base de datos
            $query = "SELECT COD_PROD, NOMBRE FROM PRODUCTO";
            $stmt = $pdo->query($query);
            
            // Recorre y muestra los productos en el select simple como opciones
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $row['COD_PROD'] . "'>" . $row['NOMBRE'] . "</option>";
            }
            ?>
        </select>
        <label for="parametro">Parámetro de consulta:</label>
        <input type="text" name="parametro" id="parametro">
        <br>
        <input type="submit" value="Consultar">

</body>

</html>