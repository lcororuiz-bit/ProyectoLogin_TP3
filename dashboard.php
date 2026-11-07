
<?php

session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de usuario</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>

    <div class="contenedor">

        <h1>¡Bienvenido!</h1>

        <p>
            Hola,
            <strong>
                <?= htmlspecialchars($_SESSION["nombre"]) ?>
                <?= htmlspecialchars($_SESSION["apellido"]) ?>
            </strong>
        </p>

        <p>
            Iniciaste sesión correctamente.
        </p>

        <p>
            Correo:
            <?= htmlspecialchars($_SESSION["correo"]) ?>
        </p>

        <a href="logout.php">
            <button type="button">Cerrar sesión</button>
        </a>

    </div>

</body>
</html>
