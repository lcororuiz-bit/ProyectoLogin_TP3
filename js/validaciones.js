
function validarLogin() {

    const formulario = document.querySelector("form");

    const correo = formulario.elements["correo"].value.trim();
    const password = formulario.elements["password"].value.trim();

    if (correo === "" || password === "") {
        alert("Completá todos los campos.");
        return false;
    }

    return true;
}


function validarRegistro() {

    const formulario = document.querySelector("form");

    const nombre = formulario.elements["nombre"].value.trim();
    const apellido = formulario.elements["apellido"].value.trim();
    const correo = formulario.elements["correo"].value.trim();
    const password = formulario.elements["password"].value;
    const confirmar = formulario.elements["confirmar"].value;

    if (
        nombre === "" ||
        apellido === "" ||
        correo === "" ||
        password === "" ||
        confirmar === ""
    ) {
        alert("Completá todos los campos.");
        return false;
    }

    if (password !== confirmar) {
        alert("Las contraseñas no coinciden.");
        return false;
    }

    return true;
}

