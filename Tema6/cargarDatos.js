
const boton = document.querySelector("#java");

boton.addEventListener("click", anadirProductos);

const cargarProductos = () => {

}

const anadirProductos = (formulario) =>{
    
    boton.preventDefault;
    
    let codigo_producto = boton.cod.value;
    let unidades_producto = boton.unidades.value;
    
    let parametros = "codigo = " +codigo_producto+"&unidades"+ unidades_producto+ "&enviar= true";
    
    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            cargarCesta();
        }
    };
    
    xhttp.open("POST", "anadir_json.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(parametros);
    
    return false;
}

const cargarCesta = () =>{
    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            
        }
    };
    
    xhttp.open("GET", "cesta_json.php", true);
    xhttp.send();
    
    return false;
}

