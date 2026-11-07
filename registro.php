
<?php
require_once "config/conexion.php";

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = trim($_POST["nombre"]);
    $apellido = trim($_POST["apellido"]);
    $correo = trim($_POST["correo"]);
    $password = $_POST["password"];
    $confirmar = $_POST["confirmar"];

    if (
        empty($nombre) || empty($apellido) ||
        empty($correo) || empty($password) ||
        empty($confirmar)
    ) {
        $mensaje = "Todos los campos son obligatorios.";

    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $mensaje = "El correo electrónico no es válido.";

    } elseif ($password !== $confirmar) {
        $mensaje = "Las contraseñas no coinciden.";

    } else {

        $consulta = $conexion->prepare(
            "SELECT id FROM usuarios WHERE correo = ?"
        );
        $consulta->execute([$correo]);

        if ($consulta->fetch()) {
            $mensaje = "Este correo ya está registrado.";

        } else {

            $hash = password_hash($password, PASSWORD_DEFAULT);

            $insertar = $conexion->prepare(
                "INSERT INTO usuarios
                (nombre, apellido, correo, password)
                VALUES (?, ?, ?, ?)"
            );

            $insertar->execute([
                $nombre,
                $apellido,
                $correo,
                $hash
            ]);

            $mensaje = "¡Usuario registrado correctamente!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear cuenta</title>
    <link rel="stylesheet" href="css/estilos.css">
    <script src="js/validaciones.js" defer></script>
</head>

<body>

    <div class="contenedor">

        <h1>Crear cuenta</h1>

        <p>Registrate para ingresar al sistema</p>

        <?php if ($mensaje != ""): ?>
            <p class="mensaje">
                <?= htmlspecialchars($mensaje) ?>
            </p>
        <?php endif; ?>

        <form method="POST" onsubmit="return validarRegistro()">

            <input type="text" name="nombre"
                placeholder="Nombre" required>

            <input type="text" name="apellido"
                placeholder="Apellido" required>

            <input type="email" name="correo"
                placeholder="Correo electrónico" required>

            <input type="password" id="password"
                name="password" placeholder="Contraseña" required>

            <input type="password" id="confirmar"
                name="confirmar" placeholder="Confirmar contraseña" required>

            <button type="submit">Crear cuenta</button>

        </form>

        <p>¿Ya tenés cuenta?
            <a href="index.php">Iniciar sesión</a>
        </p>

    </div>

</body>
</html>

