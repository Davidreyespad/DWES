
const botoncito = document.querySelector("#java");


const cargarProductos = () => {

};

const anadirProductos = (formulario) => {

    formulario.preventDefault;

    let cod_producto = formulario.cod_cargar.value;
    let unidades_producto = formulario.unidades_cargar.value;
    
    console.log(cod_producto);


    let parametros = "codigo = " + cod_producto + "&unidades" + unidades_producto + "&enviar= true";

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

const cargarCesta = () => {
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            try {

            } catch {

            }
        }
    };

    xhttp.open("GET", "cesta_json.php", true);
    xhttp.send();

    return false;
};




