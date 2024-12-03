
function consultaPedido() {

    let fecha = document.getElementById('Text_ConPed').value;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../CONTROLADORES/ConsultaPedidos.php", true);

    let formData = new FormData();
    formData.append("fechaPedido", fecha);
    xhr.send(formData);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == XMLHttpRequest.DONE ) {

            if(xhr.status == 200){
                try {
                    console.log(xhr.responseText);
                    let res = JSON.parse(xhr.responseText);
                    console.log(res);
                    document.getElementById('tabla_ConPed').innerHTML = "";
                    res.forEach(row => {
                       
                        document.getElementById('tabla_ConPed').innerHTML += 
                        `
                        <tr>
                            <td>${row.Fecha_Compra}</td>
                            <td>${row.Nombre_Categoria}</td>
                            <td>${row.Nombre_Producto}</td>
                            <td>${row.Precio}</td>
                            
                        </tr>
                        `
                    })
                  
                }
                catch(error){
                    console.error("Ha ocurrido un error: " + error);
                    alert("Ha ocurrido un error al procesar la respuesta del servidor.");
                }
            }
        };
    
    }
}