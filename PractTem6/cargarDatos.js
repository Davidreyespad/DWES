
const borrado = document.getElementById("borrar");

borrado.addEventListener("click", eliminarProducto);

const eliminarProducto = (formulario) => {
    

}

function mostrarNombre() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var titulo = document.getElementById("title");
            titulo.textContent = "Prueba Con exito";
        }

        xhttp.open("GET", "prueba.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send();
    }
}


function cargarProductos(enlace) {
    var cadena = enlace.target.value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            var contenedorProductos = document.getElementById("productos");
            contenedorProductos.innerHTML = "";

            var titulo = document.getElementById("title");
            titulo.textContent = "Listado de productos";

            var titulo_encabezado = document.getElementById("titulo_encabezado");
            titulo_encabezado.textContent = "Listado de productos";

            try {
                var productos = JSON.parse(this.responseText);
                if (productos.length === 0) {
                    let mensaje_vacio = document.createElement("P");
                    mensaje_vacio.textContent = "No existen productos de la familia seleccionada";
                    contenedorProductos.appendChild(mensaje_vacio);
                } else {
                    var tabla = crearTablaProductos(productos);
                    contenedorProductos.appendChild(tabla);
                }

                var volver = document.createElement("p");
                var enlace = document.createElement("a");
                enlace.setAttribute("href", "login.php");
                enlace.textContent = "Volver al login";

                volver.appendChild(enlace);
                contenedorProductos.appendChild(volver);
            } catch (e) {
                var mensajeError = document.createElement("p");
                mensajeError.innerHTML = e;
                contenedorProductos.appendChild(mensajeError);
            }
        }
        ;
        xhttp.open("GET", "prueba.php?nombre=" + cadena, true);
        xhttp.send();
        return false;
    };
}