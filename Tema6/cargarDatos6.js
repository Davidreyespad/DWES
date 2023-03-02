const eliminarProductos = (formulario) => {

    let cod_producto = formulario.cod.value;
    let unidades_producto = formulario.unidades.value;

    console.log(cod_producto);
    let parametros = "cod=" + cod_producto + "&unidades" + unidades_producto + "&enviar= true";

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log("carga cesta");
            cargarCesta();
        }
    };
    xhttp.open("POST", "cesta_json.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(parametros);
    return false;
}


const cargarCesta = () => {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var arrayCesta = JSON.parse(xhttp.responseText);
            crearTablaCesta(arrayCesta);
        }
    };
    xhttp.open("GET", "cesta_json.php", true);
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

function crear_fila(array, tipo) {
    var fila = document.createElement("tr");
    if (tipo === "th") {
        for (var item of array) {
            var th = document.createElement("th");
            var p = document.createElement("p");

            p.textContent = item;
            th.appendChild(p);
            fila.appendChild(th);
        }
    } else if (tipo === "td") {
        var td = document.createElement("td");
        var p = document.createElement("p");
        
        if(array['familia'] === "CONSOL"){
            var infConsola
        }
    }
    return fila;
}

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



    /** function crear_fila(campos, modelo) {
     var fila = document.createElement("tr");
     for (let i = 0; i < campos.length; i++) {
     var celda = document.createElement(modelo);
     celda.innerHTML = campos[i];
     fila.appendChild(celda);
     }
     return fila;
     } */

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

    const prueba = (formulario) => {
        let cod_producto = formulario.cod.value;
        console.log("hola");
    }

    const eliminarProductos = (formulario) => {

        let cod_producto = formulario.cod.value;
        let unidades_producto = formulario.unidades.value;

        console.log(cod_producto);
        let parametros = "cod=" + cod_producto + "&unidades" + unidades_producto + "&enviar= true";

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log("carga cesta");
            }
        };
        xhttp.open("POST", "cesta_json.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(parametros);
        return false;
    }

    function cargarCesta() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var arrayCesta = JSON.parse(xhttp.responseText);
                crearTabla(arrayCesta);
            }
        };
        xhttp.open("GET", "cesta_json.php", true);
        xhttp.send();
        return false;
    }
    ;

    function eliminarrrProductos(formulario) {
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


