<?php
if (extension_loaded('pdo_mysql')) {
    echo "✅ El driver de MySQL está instalado y cargado.";
} else {
    echo "❌ ERROR: El driver NO está cargado. Revisa la instalación.";
}
phpinfo(); // Esto te mostrará toda la config
?>