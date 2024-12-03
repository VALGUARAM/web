function validarFormulario(event) {
    event.preventDefault();

    //var ExpUsuario = /^[a-zA-Z0-9_-]{3,}$/;
    var ExpContra = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!.;_|#/()+%*?&-])[A-Za-z\d@$!.;_|#/()+%*?&-]{8,}$/;
    var ExpNombres = /^[a-zA-ZÀ-ÿ\s ]{1,}$/;
    var ExpCorreo = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

    var usuario_text = document.getElementById('user').value;
    var nombre_text = document.getElementById('name').value;
    var apellidoPat_text = document.getElementById('lastName').value;
    var apellidoMat_text = document.getElementById('lastName2').value;
    var fechaNac_select  = document.getElementById('Fecha_Nac');
    var correo_text = document.getElementById('Email').value;
    var genero_select  = document.getElementById('genero').value;
    var contrasenia_text = document.getElementById('txt_Pass').value;
    var conf_contrasena_text = document.getElementById('txt_Pass2').value;
    var imagen_inicial = document.getElementById('imagenPerfil').value;
    var filePath = document.getElementById('imagenInput').files[0];


    var errores = [];

    if (usuario_text === "") {
        errores.push("-Ingrese un rol");
    }

    if (nombre_text === "") {
        errores.push("-Nombre(s) esta vacio");
    }
    else if (!ExpNombres.test(nombre_text)) {
        errores.push("-Nombre(s) solo debe contener letras y espacios");
    }

    if (apellidoPat_text === "") {
        errores.push("-Apellidos esta vacio");
    }
    else if (!ExpNombres.test(apellidoPat_text)) {
        errores.push("-Apellido Paterno solo debe contener letras y espacios");
    }

    if (apellidoMat_text === "") {
        errores.push("-Apellidos esta vacio");
    }
    else if (!ExpNombres.test(apellidoMat_text)) {
        errores.push("-Apellido Materno solo debe contener letras y espacios");
    }

    if (correo_text === "") {
        errores.push("-No se ha ingresado un correo");
    }
    else if (!ExpCorreo.test(correo_text)) {
        errores.push("-Ingrese un correo electrónico valido");
    }

    if(contrasenia_text === conf_contrasena_text){
        if (contrasenia_text === "") {
            errores.push("-Ingrese una contraseña");
        }
        else if (!ExpContra.test(contrasenia_text)) {
            errores.push("-La contraseña debe tener 8 caracteres y minimo: \n*una mayuscula \n*una minuscula \n*un numero \n*un caracter especial");
        }
    }else{
        errores.push("- La contraseña no coincide con la confimación");
    }

    if(!filePath){
        var foto_perfil = imagen_inicial;
    }else{
        if (!allowedExtensions.exec(filePath.name)) {
            errores.push("-Solo formato .jpg/.png en la imagen");
        }else{
            var foto_perfil = filePath;
          
        }
       
    }


    if (genero_select === "") {
        errores.push("-Ingrese un genero");
    }

    var fechaActual = new Date();
      
    if (new Date(fechaNac_select.value) > fechaActual) {
        errores.push("Fecha_Nacimiento_Invalida");
    }   
    
    


    if (errores.length > 0) {
        alert("Falta la siguiente informacion:\n\n" + errores.join("\n"));
        return false;
    }
    else {
        console.log("0 errores");
        console.log(contrasenia_text);
        var formData = new FormData();  // Crear un objeto FormData
        formData.append('Nombre', nombre_text); 
        formData.append('Ape_Pat', apellidoPat_text);
        formData.append('Ape_Mat', apellidoMat_text);
        formData.append('Correo', correo_text);
        formData.append('Fecha_Nac', fechaNac_select.value);
        formData.append('Genero', genero_select);
        formData.append('Contrasenia', contrasenia_text);
        formData.append('Imagen', foto_perfil);
      
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "./CONTROLADORES/ModificarUsuario.php", true);
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
                                window.location.replace("InicioSesion.php");
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


document.getElementById('imagenInput').addEventListener('change', function(event) {
    const file = event.target.files[0]; // Obtener el archivo seleccionado

    if (file) {
        // Verificar si el archivo es una imagen
        if (file.type && file.type.indexOf('image') === -1) {
            alert('El archivo seleccionado no es una imagen.');
            return;
        }

        // Crear un lector de archivos para leer el contenido de la imagen
        const reader = new FileReader();

        reader.onload = function(e) {
            // Actualizar la imagen en <img> con la nueva imagen cargada
            document.getElementById('imagenPerfil').src = e.target.result;

        };
       
       
        // Leer el contenido del archivo como URL base64
        reader.readAsDataURL(file);
    }
});







/*
const expresiones = {
    usuario: /^[a-zA-Z0-9\_\-]{4,16}$/,
    nombre: /^[A-ZÑa-zñáéíóúÁÉÍÓÚ'° ]+$/,
    password: /(?=(.*[0-9]))(?=.*[\!@#$%^&*()\\[\]{}\-_+=|:;"'<>,./?])(?=.*[a-z])(?=(.*[A-Z]))(?=(.*)).{8,}/,
    correo: /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/
};  


(function () {
    const formModificarUsuario = document.getElementById('form_ModificarUsuario');

	formModificarUsuario.onsubmit = function (e) {
        e.preventDefault();

		if (!checkInputs()) {
            console.error("Algo falló en la validación");
            alert("Campos no válidos: " + camposFaltantes.join(", ") );
            return;
        } else {
			const formData = new FormData(formModificarUsuario);
        	formData.append('usuario', userText.value);
        	formData.append('nombre', nombreText.value);
        	formData.append('apPaterno', apPaternoText.value);
        	formData.append('apMaterno', apMaternoText.value);
        	formData.append('fechaNac', fechaNacText.value);
        	formData.append('correo', correoText.value);
        	formData.append('sexo', sexoText.value);
			formData.append('contrasenia', contraseniaText.value);
        	formData.append('contraseniaConfim', contraseniaConfirmText.value);
        
            alert(userText.value + nombreText.value +apPaternoText.value+ apMaternoText.value+fechaNacText.value+correoText.value+ sexoText.value+ contraseniaText.value)
            
        	let xhr = new XMLHttpRequest();

			xhr.open("POST", "./CONTROLADORES/ModificarUsuario1.php", true);
			xhr.onload = function () {
			console.log(xhr.readyState);

			if (xhr.readyState == XMLHttpRequest.DONE) {
				if (xhr.status === 200) {
					if (xhr.response) {

						console.log(xhr.response);

						try {
							let res = JSON.parse(xhr.response);
							if (res.success != true) 
							{
								alert(res.msg);
								return;
							} else {
								//DEBE REDIRIGIR AL LOGIN
								alert(res.msg);
								window.location.replace("InicioSesion.php");
								return;
							}
						} catch (error) {
							console.error("Ha ocurrido un error: " + error);
							alert(xhr.response);
						}
					} else {
						console.error("La respuesta del servidor está vacía");
						alert("La respuesta del servidor está vacía");
					}
				} else {
					console.error("Ha ocurrido un error en la solicitud: " + xhr.status);
                    alert(xhr.status);
				}
			}
			}
			xhr.send(formData);
    	}


	}
	
})();

function checkInputs(){
    camposFaltantes = []; 
    const usuarioValue = userText.value;
    const nombreValue = nombreText.value;
    const apellidoPatValue = apPaternoText.value;
    const apellidoMatValue = apMaternoText.value;
    const correoValue = correoText.value;
    const fechaNacValue = fechaNacText.value;
    const generoValue = sexoText.value; 
    const contrasenaValue = contraseniaText.value;
    
    var resp = 0;

    if(usuarioValue == null ||  nombreValue == null ||  apellidoPatValue == null || apellidoMatValue == null 
    || correoValue == null ||  generoValue == -1 ||    contrasenaValue == null){
            camposFaltantes.push("FALTAN CAMPOS POR LLENAR");
            return false;
    }else{
        if (!expresiones.usuario.test(usuarioValue)) {
            camposFaltantes.push("Usuario_SOLO_LETRAS_Y_NUMEROS");
            resp++;
        }
        if (!expresiones.nombre.test(nombreValue)) {
            camposFaltantes.push("Nombre_SOLO_LETRAS");
            resp++;
         }
        
        if (!expresiones.nombre.test(apellidoPatValue)) {
            camposFaltantes.push("Apellido_Paterno_SOLO_LETRAS");
            resp++;
        }
        if (!expresiones.nombre.test(apellidoMatValue)) {
            camposFaltantes.push("Apellido_Materno_SOLO_LETRAS");
            resp++;
        }
          
        var fechaActual = new Date();
      
        if (new Date(fechaNacValue) > fechaActual) {
            camposFaltantes.push("Fecha_Nacimiento_Invalida");
            resp++;
        }         
    
        if (!expresiones.correo.test(correoValue)) {
            camposFaltantes.push("Formato_de_correo_invalido");
            resp++;
        }
            
     
            
        if (!expresiones.password.test(contrasenaValue)) {
            camposFaltantes.push("Formato_Contraseñia_invalido");
            resp++;
        }


        if (resp > 0){
            return false;
        }else{
            return true;       
        }
    }
 
};
*/
