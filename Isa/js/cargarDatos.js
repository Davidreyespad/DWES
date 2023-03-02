const eliminarProductos = (formulario) =>{
    //Recogemos los valores que hay en el formulario
    const codigo = formulario.cod.value;
    const unidades = formulario.unidades.value;

                //console.log(codigo_eliminar);
                //console.log(unidades_eliminar);

    //Creamos la variable parametros para enviarla al header                
    const parametros = "codigo= " + codigo + "&unidades= " + unidades;

    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            //si la respuesta está bien, hacemos esto
            cargarCesta();
        }
    };
    xhttp.open("POST", "eliminar_json.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(parametros);

    return false;
};

//DEVUELVE LA CESTA
const cargarCesta = () => {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            //Pasamos la cesta a formato JSON
            cesta = JSON.parse(this.responseText);
            tabla_cesta = crearTablaCesta(cesta);
            
            //Seleccionamos el div donde vamos a meter la cesta
            let div_cesta = document.querySelector('#productos');
            div_cesta.insertAdjacentElement("beforebegin", tabla_cesta);
            
            //Seleccionamos el parrafor que muestra el precio para eliminarlo
            let parrafo_eliminar = document.querySelector('#parrafo_eliminar');
            if(parrafo_eliminar !== null){
                parrafo_eliminar.remove();
            }
            
            //creamos el parrafo con el precio
            let parrafo_total = obtenerPrecioTotal(cesta);
            div_cesta.appendChild(parrafo_total);
        }
    };
    xhttp.open("GET", "cesta_json.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();
};

const crearTablaCesta = cesta => {
    
    //Si ya hay una tabla se borra
    let eliminar_tabla = document.querySelector('#tabla_cesta');
    if(eliminar_tabla !== null){
        eliminar_tabla.remove();
    }

    //Creamos tabla y le damos ID
    let tabla_cesta = document.createElement("table");
    tabla_cesta.id = "tabla_cesta";
    
    //Creamos la cabecera
    let cabecera = crear_fila (["Código", "Descripción", "Precio", "Unidades", "Eliminar"], "TH");
    tabla_cesta.appendChild(cabecera);
    
    //Insertamos 1 fila por cada producto de la cesta
    for (let i in cesta){
        //Variable que tenga el codigo
        let codigo = cesta[i]['producto'].codigo;
        
        let precio_total = cesta[i]['producto'].PVP * cesta[i]['unidades'];
        
        //creamos formulario
        let formulario = crear_formulario("Eliminar", codigo, 'eliminarProductos');
        
        //Creamos fila
        let fila_producto = crear_fila([codigo, cesta[i]['producto'].nombre_corto, cesta[i]['producto'].PVP+"x", cesta[i]['unidades'] + " = " +precio_total], "td");
        
        //Creamos celda para el formulario
        let celda_formulario = document.creteElement("td");
        celda_formulario.appendChild(formulario);
        
        fila_producto.appendChild(celda_formulario);
        tabla_cesta.appendChild(fila_producto);
        
    }
    
    return tabla_cesta;
};


const crear_fila = (campos, tipo) => {
    let fila = document.createElement("tr");
    for (let i = 0; i < campos.length; i++) {
        let celda = document.createElement(tipo);
        celda.textContent = campos[i];
        celda.appendChild = campos[i];
        fila.appendChild(celda);
    }
    return fila;
};

const crearFormulario = (texto, cod, funcion) => {
    
    //Creamos elemento formulario
    let formu = document.createElement("form");
    formu.setAttribute("onsubmit", funcion + '(this); return false;');
    
    //Creamos los input
    let unidades = document.createElement("input");
    unidades.value = 1;
    unidades.type = "number";
    unidades.name = "unidades";
    unidades.setAttribute("name", "unidades")
    
    
    let codigo = document.createElement("input");
    codigo.value = cod;
    codigo.type = "hidden";
    codigo.name = "cod";
    
    
    let bsubmit = document.createElement("input");
    bsubmit.type = "submit";
    bsubmit.value = texto;
    bsubmit.name = "eliminar";
    
    formu.appendChild(unidades);
    formu.appendChild(codigo);
    formu.appendChild(bsubmit);
    
    
    return formu;
};

const obtenerPrecioTotal=(cesta)=>{
    let precio_total = 0;
    
    for(let i in cesta){
        precio_total += cesta[i]['producto'].PVP * cesta[i]['unidades'];
    }
    
    let parrafo = document.createElement('p');
    parrafo.textContent="Precio total: " +precio_total+" euros.";
    
    return parrafo;
};