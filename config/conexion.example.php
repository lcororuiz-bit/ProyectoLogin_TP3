<?php

$host = "localhost";
$dbname = "proyecto_login";
$user = "proyecto_user";
$password = "TU_CONTRASEÑA_LOCAL";

try {

    $conexion = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $user,
        $password
    );

    $conexion->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

} catch (PDOException $e) {

    error_log($e->getMessage());
    die("Error al conectar con la base de datos.");

}

?>
