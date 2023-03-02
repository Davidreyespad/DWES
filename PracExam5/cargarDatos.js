
const botoncito = document.querySelector("#java");


function cargarProductos(destino) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            var prod = document.getElementById("contenido");
            /*
             * var titulo = document.getElementById("titulo");
             * titulo.innerHTML = "Productos";
             */
            try {
                var productos = JSON.parse(this.responseText);
                prod.innerHTML = "";
                var mensaje = document.createElement("p");
                prod.appendChild(mensaje);
            } catch (e) {
                var mensaje = document.createElement("p");
                mensaje.innerHTML = "categoria sin productos";
                prod.innerHTML = "";
                prod.appendChild(mensaje);
            }
        }
        ;
        xhttp.open("GET", destino, true);
        xhttp.send();
        return false;
    };
    function crearTablaCesta(productos) {
        var tabla = document.createElement("table");
        var cabecera = crear_fila(["Codigo", "Nombre", "PVP", "Familia"], "th");
        tabla.appendChild(cabecera);
        for (var i in productos) {
            formu = crearFormulario("Eliminar", productos[i]['producto']['codigo'], "eliminarProductos");
            fila = crear_fila([productos[i]['producto']['codigo'], productos[i]['producto']['nombre_corto'], productos[i]['producto']['PVP'],
                productos[i]['producto']['unidades']], "td");
            celda_formulario = document.createElement("td");
            celda_formulario.appendChild(formu);
            fila.appendChild(celda_formulario);
            tabla.appendChild(fila);
        }
        return tabla;
    }

    function crear_fila(campos, modelo) {
        var fila = document.createElement("tr");
        for (let i = 0; i < campos.length; i++) {
            var celda = document.createElement(modelo);
            celda.innerHTML = campos[i];
            fila.appendChild(celda);
        }
        return fila;
    }

    function crearFormulario(texto, cod, funcion) {
        var formu = document.createElement("form");
        var unidades = document.createElement("input");
        unidades.value = 1;
        unidades.name = "unidades";
        var codigo = document.createElement("input");
        codigo.value = cod;
        codigo.type = "hidden";
        codigo.name = "cod";
        var submit = document.createElement("input");
        submit.type = "submit";
        submit.value = texto;
        formu.onsubmit = function () {
            return funcion(this);
        };
        formu.appendChild(unidades);
        formu.appendChild(codigo);
        formu.appendChild(submit);
        return formu;
    }

    function anadirProductos(formulario) {

        formulario.preventDefault;
        
        let cod_producto = formulario.cod_cargar.value;
        let unidades_producto = formulario.unidades_cargar.value;
        
        console.log(cod_producto);
        let parametros = "cod=" + formulario.elements['cod'].value + "&unidades" + unidades_producto + "&enviar= true";
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                cargarCesta();
                console.log("carga cesta");
            }
        };
        xhttp.open("POST", "anadir_json.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(parametros);
        return false;
    }

    function cargarCesta() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var contenido = document.getElementById("productos");
                contenido.innerHTML = "";
                try {
                    var filas = JSON.parse(this.responseText);
                    tabla = crearTablaCesta(filas);
                    contenido.appendChild(tabla);
                } catch (e) {
                    var mensaje = document.createElement("p");
                    mensaje.innerHTML = "No hay ningún producto";
                    contenido.appendChild(mensaje);
                }
            }
        };
        xhttp.open("GET", "cesta_json.php", true);
        xhttp.send();
        return false;
    }
    ;
    function eliminarProductos(formulario) {
        var xhttp = new XHLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                cargarCesta();
            }
        };
        var parametros = "cod=" + formulario.elements['cod'].value +
                "unidades=" + formulario.elements['unidades'].value;
        xhttp.open("POST", "eliminar_json.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(parametros);

        return false;
    }


}


