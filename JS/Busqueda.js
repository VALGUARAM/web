

function buscarProducto() {

    let nombreProd = document.getElementById('mi_navbar').value;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "./CONTROLADORES/BuscarProducto.php", true);

    let formData = new FormData();
    formData.append("nombreProd", nombreProd);
    xhr.send(formData);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == XMLHttpRequest.DONE ) {

            if(xhr.status == 200){
                try {
                    let res = JSON.parse(xhr.responseText);
                    console.log(res);
                    console.log(res.Descripcion);
                    alert(res.Precio);
                }
                catch(error){
                    console.error("Ha ocurrido un error: " + error);
                    alert("Ha ocurrido un error al procesar la respuesta del servidor.");
                }
            }
        };
    
    }
}

/*
function buscarProductoCategoria() {

    //let nombreProd = document.getElementById('mi_navbar').value;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "./CONTROLADORES/BuscarPorCategoria.php", true);

    let formData = new FormData();
    formData.append("idCategoria", idCategoria);
    xhr.send(formData);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == XMLHttpRequest.DONE ) {

            if(xhr.status == 200){
                try {
                    let res = JSON.parse(xhr.responseText);
                    console.log(res);
                    console.log(res.Descripcion);
                    a
                }
                catch(error){
                    console.error("Ha ocurrido un error: " + error);
                    alert("Ha ocurrido un error al procesar la respuesta del servidor.");
                }
            }
        };
    
    }
}

*/

