//FUNCIÓN A LA QUE LLAMAMOS CON EL EVENTO ONSUBMIT
const eliminarProductos = (formulario) => {
    //Recogemos los valores del formulario
    let codigo = formulario.cod.value;
    let unidades = formulario.unidades.value;

    //Creamos la variable parámetros para mandarla en el header
    let parametros = 'codigo=' + codigo + '&unidades=' + unidades;

    //Creamos el xhttp
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            //En caso de que la respuesta sea ok, hacemos la siguiente función
            cargarCesta();
        }
    };
    xhttp.open("POST", "eliminar_json.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(parametros);

    return false;
}

//FUNCIÓN QUE ME DEVUELVE LA CESTA
const cargarCesta = () => {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            //Paso la cesta a formato JSON
            cesta = JSON.parse(this.responseText);
            tabla_cesta = crearTablaCesta(cesta);
            
            //Seleccionamos el div donde va nuestra cesta para insertarla
            let div_cesta = document.querySelector('#productos');
            div_cesta.insertAdjacentElement("beforebegin", tabla_cesta);
            
            //Seleccionamos el parrafo que muestra el precio total para eliminarlo
            let parrafo_eliminar = document.querySelector('#parrafo_eliminar');
            if (parrafo_eliminar !== null) {
                parrafo_eliminar.remove();
            }
            //Creamos el parrafo del precio total
            let parrafo_total = obtenerPrecioTotal(cesta);
            div_cesta.appendChild(parrafo_total);
        }
    };
    xhttp.open("GET", "cesta_json.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();
};


//FUNCIÓN PARA CREAR LA TABLA CON DOM
const crearTablaCesta = cesta => {
    //Si hay tabla, la eliminamos
    let eliminar_tabla = document.querySelector('#tabla_cesta');
    if (eliminar_tabla !== null) { eliminar_tabla.remove(); }
    //Creamos la nueva tabla
    let tabla_cesta = document.createElement("table");
    tabla_cesta.id = "tabla_cesta";

    //Creamos la cabecera de la tabla
    let cabecera = crear_fila(["Código", "Nombre", "Precio x", "Unidades", "Eliminar"], 'th');
    tabla_cesta.appendChild(cabecera);
    
    //Insertamos una fila por cada producto de la cesta   
    for (let i in cesta){
        //Creo una variable con el código
        let codigo = cesta[i]['producto'].codigo;
        
        let precio_total= cesta[i]['producto'].PVP * cesta[i]['unidades'];
        //Creo el formulario
        let formulario = crear_formulario("Eliminar", codigo, 'eliminarProductos');
        //Creamos la fila
        let fila_producto = crear_fila([codigo, cesta[i]['producto'].nombre_corto, cesta[i]['producto'].PVP+"x", cesta[i]['unidades'] +" = "+ precio_total ], "td");
        
        //Creo una celda para el formulario y lo inserto
        let celda_formulario = document.createElement("td");
        celda_formulario.appendChild(formulario);
        fila_producto.appendChild(celda_formulario);
        tabla_cesta.appendChild(fila_producto);
    }
    //Devolvemos la tabla
    return tabla_cesta;
};

//FUNCIÓN PARA CREAR LAS FILAS DE LA TABLA
const crear_fila = (campos, tipo) => {

    let fila = document.createElement('tr');
    for (let i = 0; i < campos.length; i++) {
        let celda = document.createElement(tipo);
        celda.textContent = campos[i];
        celda.appendChild = campos[i];
        fila.appendChild(celda);
    }
    return fila;
};

//FUNCIÓN PARA CREAR EL FORMULARIO DE LA TABLA
const crear_formulario = (texto, cod, funcion) => {
    //Creamos elemento formulario
    let formu = document.createElement("form");
    formu.setAttribute("onsubmit", funcion + '(this); return false;');
    
    //Creamos los input
    let unidades = document.createElement("input");
    unidades.type = "number";
    unidades.value = 1;
    unidades.setAttribute("name", "unidades");
    
    let codigo = document.createElement("input");
    codigo.value = cod;
    codigo.type = "hidden";
    codigo.name = "cod";
    
    let bsubmit = document.createElement("input");
    bsubmit.type = "submit";
    bsubmit.value = texto;
    bsubmit.name = "eliminar";
    
    //insertamos los inputs en el formulario
    formu.appendChild(unidades);
    formu.appendChild(codigo);
    formu.appendChild(bsubmit);
    
    return formu;
};


const obtenerPrecioTotal=(cesta)=>{
    
    let precio_total = 0;
    for (let i in cesta){
        precio_total += cesta[i]['producto'].PVP * cesta[i]['unidades'];
    }
    
    let parrafo = document.createElement('p');
    parrafo.textContent="Precio total: "+precio_total+" €";

    return parrafo;    
};