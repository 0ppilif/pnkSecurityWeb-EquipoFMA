<?php
function conectar() {
    // En XAMPP usará estos por defecto si no existe el .env aún. En AWS usará los del sistema.
    $host = getenv('DB_HOST') ?: "127.0.0.1";
    $user = getenv('DB_USER') ?: "root";
    $pass = getenv('DB_PASS') ?: "";
    $db   = getenv('DB_NAME') ?: "pnk_security";
    $port = getenv('DB_PORT') ?: 3307; // Ajusta al puerto de tu MariaDB local si es necesario

    $con = mysqli_connect($host, $user, $pass, $db, $port);
    if (!$con) {
        die("Error de conexión a la base de datos.");
    }
    return $con;
}

// ... (mantén aquí abajo las funciones quitarespacios() y moneda_chilena() intactas) ...