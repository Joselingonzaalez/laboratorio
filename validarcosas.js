function validabien() {
    // Declaracion de las variables
    var rango, nombre, usuario, cedula, clave;

    // Recuperacion de datos para el login y el singup
    rango = document.getElementById("rango").value;
    nombre = document.getElementById("nombre").value;
    usuario = document.getElementById("usuario").value;
    cedula = document.getElementById("cedula").value;
    clave = document.getElementById("clave").value;

    // Comprobacion de espacios en blanco
    if (rango === "" || nombre === "" || usuario === "" || cedula === "" || clave === "") {
        alert("Campos vacíos");
        return false;
    }

    //compruebo que los caracteres sean los permitidos
    if(!( /^[a-zA-Z, ]*$/.test(nombre))) {
        alert("el nombre no puede poseer caracteres numericos");
        return false;
    }
    
    /*if(!( /^[a-zA-Z, ]*$/.test(apellido))) {
        alert("el apellido no puede poseer caracteres numericos");
        return false;
    }*/

    /* Validacion del correo
    if (!(/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i).test(correo)){
        alert("El correo ingresado no es valido");
        return false;
    }*/

}

function validalogin(){
    // Comprobacion de espacios en blanco
    if (correo === "" || clave === "") {
        alert("Por favor, ingrese la información requerida en cada campo");
        return false;
    }
}

/*function validaproducto(){

    var nombre_producto, tipo_producto, precio_producto, cantidad_producto;

    //Recuperacion de datos del producto
    nombre_producto = document.getElementById("nombreprod");
    tipo_producto = document.getElementById("tipoprod");
    precio_producto = document.getElementById("precioprod");
    cantidad_producto = document.getElementById("cantidadprod");
    //Comprobacion de los espacios en blanco
    if (nombre_producto === "" || tipo_producto === "" || precio_producto === "" || cantidad_producto === "") {
        alert("Por favor ingrese la información requerida en cada campo");
        return false;
    }
}*/