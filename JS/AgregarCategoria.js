function validarFormulario(event) {
    event.preventDefault();

    var ExpNombres = /^[a-zA-ZÀ-ÿ\s ]{1,}$/;

    var nombre_text = document.getElementById('nombreCategoria').value;
    var descripcion_text = document.getElementById('DescCategoria').value;


    var errores = [];

    if (nombre_text === "") {
        errores.push("-Ingrese un nombre a la categoria");
    }else if(!ExpNombres.test(nombre_text)){
        errores.push("-El nombre solo debe contener letras y espacios");
    }


    if (descripcion_text === "") {
        errores.push("-Ingese una descripcion ");
    }else if(!ExpNombres.test(descripcion_text)){
        errores.push("-La descripción solo debe contener letras y espacios");
    }

    if (errores.length > 0) {
        alert("Falta la siguiente informacion:\n\n" + errores.join("\n"));
        return false;
    }
    else {
        console.log("0 errores");

        var formData = new FormData();  // Crear un objeto FormData
        formData.append('nombre', nombre_text);
        formData.append('descripcion', descripcion_text); 

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "./CONTROLADORES/RegistroCategoria.php", true);
        // No necesitas establecer el Content-Type para FormData, se establece automáticamente
        // xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
        xhr.onreadystatechange = function () {
            if (xhr.readyState == XMLHttpRequest.DONE ) {

                if(xhr.status == 200){
                    if(xhr.response){
                        console.log(xhr.response);
                        try {
                            let res = JSON.parse(xhr.responseText);
                            if (res.success) {
                                alert(res.msg);
                                window.location.replace("AgregarCategoria.php");
                            } else {
                                console.error("Error en la consulta: " + res.msg);
                                alert("Error en la consulta: " + res.msg);
                            }
                        }
                        catch(error){
                            console.error("Ha ocurrido un error: " + error);
                            alert("Ha ocurrido un error al procesar la respuesta del servidor.");
                        }
                    }else{
                        console.error("La respuesta del servidor está vacía");
                        alert("La respuesta del servidor está vacía");
                    }
                }else{
                    console.error("Ha ocurrido un error en la solicitud: " + xhr.status);
                    alert("Ha ocurrido un error en la solicitud: " + xhr.status);
                }
                
                
            }
        };
    
        xhr.send(formData); // Enviar FormData

    }
}

