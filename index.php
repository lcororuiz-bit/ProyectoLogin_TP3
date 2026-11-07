
<?php
session_start();
require_once "config/conexion.php";

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $correo = trim($_POST["correo"]);
    $password = $_POST["password"];

    if (empty($correo) || empty($password)) {

        $mensaje = "Completá todos los campos.";

    } else {

        $consulta = $conexion->prepare(
            "SELECT * FROM usuarios WHERE correo = ?"
        );

        $consulta->execute([$correo]);

        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($password, $usuario["password"])) {

            session_regenerate_id(true);

            $_SESSION["usuario_id"] = $usuario["id"];
            $_SESSION["nombre"] = $usuario["nombre"];
            $_SESSION["apellido"] = $usuario["apellido"];
            $_SESSION["correo"] = $usuario["correo"];

            header("Location: dashboard.php");
            exit();

        } else {

            $mensaje = "Correo o contraseña incorrectos.";

        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="css/estilos.css">
    <script src="js/validaciones.js" defer></script>
</head>

<body>

    <div class="contenedor">

        <h1>Bienvenido</h1>

        <p>Ingresá a tu cuenta</p>

        <?php if ($mensaje != ""): ?>
            <p class="mensaje">
                <?= htmlspecialchars($mensaje) ?>
            </p>
        <?php endif; ?>

        <form method="POST" onsubmit="return validarLogin()">

            <input
                type="email"
                name="correo"
                placeholder="Correo electrónico"
                required
            >

            <input
                type="password"
                name="password"
                placeholder="Contraseña"
                required
            >

            <button type="submit">Ingresar</button>

        </form>

        <p>¿No tenés una cuenta?
            <a href="registro.php">Crear cuenta</a>
        </p>

    </div>

</body>
</html>

