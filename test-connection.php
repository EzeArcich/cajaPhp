<?php
// test_connection.php
require_once 'config/db.php';

try {
    // Realiza una consulta para obtener la versión del servidor MySQL
    $versionQuery = "SELECT VERSION() as version";
    $versionResult = $db->query($versionQuery);
    $version = $versionResult->fetchColumn();

    echo "Conexión exitosa a la base de datos. Versión del servidor MySQL: " . $version;
} catch (PDOException $e) {
    // Si hay un error en la conexión, muestra el mensaje de error
    echo "Error de conexión: " . $e->getMessage();
}
?>
