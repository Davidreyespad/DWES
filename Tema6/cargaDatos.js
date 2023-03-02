const eliminarProductos = (formulario) => {
    let productos = '';
    let cod_producto = formulario.cod_modif.value;
    let unidades_eliminar = formulario.unidades_modif.value;

    console.log(cod_producto);
    console.log(unidades_eliminar);
    let parametros = "cod=" + cod_producto + "&unidades" + unidades_eliminar + "&enviar= probando el envio de datos";

    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            crearTablaProductos(cod_producto);
        }
    };
    xhttp.open("POST", "eliminar.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(parametros);

    return false;
}



const crearTablaProductos = (productos) => {

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