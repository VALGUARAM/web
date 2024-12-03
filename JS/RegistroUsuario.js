var fechaNac_select  = document.getElementById('fecNacimiento');
const hoy = new Date().toISOString().slice(0, 10);
fechaNac_select.value = hoy;

function validarFormulario(event) {
    event.preventDefault();

    //var ExpUsuario = /^[a-zA-Z0-9_-]{3,}$/;
    var ExpContra = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!.;_|#/()+%*?&-])[A-Za-z\d@$!.;_|#/()+%*?&-]{8,}$/;
    var ExpNombres = /^[a-zA-ZÀ-ÿ\s ]{1,}$/;
    var ExpCorreo = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;


    var usuario_text = document.getElementById('user').value;
    var nombre_text = document.getElementById('name').value;
    var apellidoPat_text = document.getElementById('lastname').value;
    var apellidoMat_text = document.getElementById('lastname2').value;
    var correo_text = document.getElementById('mail').value;
    var genero_select  = document.getElementById('genero').value;
    var rol_select = document.getElementById('rol').value;
    var contrasena_text = document.getElementById('password').value;
    var filePath = document.getElementById('imagen').files[0];


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

    if (!filePath) {
        errores.push("-No se ha seleccionado ninguna imagen");
    } else {
        if (!allowedExtensions.exec(filePath.name)) {
            errores.push("-Solo formato .jpg/.png en la imagen");
        }
    }

    if (contrasena_text === "") {
        errores.push("-Ingrese una contraseña");
    }
    else if (!ExpContra.test(contrasena_text)) {
        errores.push("-La contraseña debe tener 8 caracteres y minimo: \n*una mayuscula \n*una minuscula \n*un numero \n*un caracter especial");
    }

    if (genero_select === "") {
        errores.push("-Ingrese un genero");
    }
    if (rol_select === "") {
        errores.push("-Ingrese un rol");
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
        var formData = new FormData();  // Crear un objeto FormData
        formData.append('usuario', usuario_text);
        formData.append('nombre', nombre_text); 
        formData.append('apePaterno', apellidoPat_text);
        formData.append('apeMaterno', apellidoMat_text);
        formData.append('correo', correo_text);
        formData.append('fechaNac', fechaNac_select.value);
        formData.append('genero', genero_select);
        formData.append('imagen', filePath);
        formData.append('contrasenia', contrasena_text);
        formData.append('rol', rol_select);

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "./CONTROLADORES/RegistroUsuario.php", true);
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



/*const formulario = document.getElementById('form');
const usuario_text = document.getElementById('user');
const nombre_text = document.getElementById('name');
const apellidoPat_text = document.getElementById('lastname');
const apellidoMat_text = document.getElementById('lastname2');
const correo_text = document.getElementById('mail');
const fechaNac_select  = document.getElementById('fecNacimiento');
const genero_select  = document.getElementById('genero');
const rol_select = document.getElementById('rol');
const contrasena_text = document.getElementById('password');
var filePath = document.getElementById("imagen").files[0];
var camposFaltantes = [];
var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
const hoy = new Date().toISOString().slice(0, 10);
fechaNac_select.value = hoy;

const expresiones = {
    usuario: /^[a-zA-Z0-9\_\-]{4,16}$/,
    nombre: /^[A-ZÑa-zñáéíóúÁÉÍÓÚ'° ]+$/,
    password: /(?=(.*[0-9]))(?=.*[\!@#$%^&*()\\[\]{}\-_+=|:;"'<>,./?])(?=.*[a-z])(?=(.*[A-Z]))(?=(.*)).{8,}/,
    correo: /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/
};  
    

(function () {
    const formLogin = document.getElementById('form_Registro');
    formLogin.onsubmit = function (e) {
        e.preventDefault();
      

        if (!checkInputs()) {
            console.error("Algo falló en la validación");
            alert("Campos no válidos: " + camposFaltantes.join(", ") );
            return;
        } else {
            const formData = new FormData(formLogin);
            formData.append('usuario', usuario_text.value);
            formData.append('nombre', nombre_text.value);
            formData.append('apePaterno', apellidoPat_text.value);
            formData.append('apeMaterno', apellidoMat_text.value);
            formData.append('correo', correo_text.value);
            formData.append('fechaNac', fechaNac_select.value);
            formData.append('genero', genero_select.value);
            formData.append('rol', rol_select.value);
            formData.append('contrasenia', contrasena_text.value);
            formData.append("imagen", filePath);

          

            let xhr = new XMLHttpRequest();

            xhr.open("POST", "./CONTROLADORES/RegistroUsuario.php", true);
            xhr.onreadystatechange = function () {
                console.log(xhr.readyState);

                if (xhr.readyState == XMLHttpRequest.DONE) {
                    if (xhr.status == 200) {
                        if (xhr.response) {
                            console.log(xhr.response);

                            try {
                                let res = JSON.parse(xhr.response);
                                if (res.success != true) {
                                    console.error("Error en la consulta");
                                    alert(res.msg);
                                    return;
                                } else {
                                    alert(res.msg);
                                    window.location.replace("InicioSesion.php");
                                    return;
                                }
                            } catch (error) {
                                console.error("Ha ocurrido un error: " + error);
                                alert("Ha ocurrido un error al procesar la respuesta del servidor.");
                            }
                        } else {
                            console.error("La respuesta del servidor está vacía");
                            alert("La respuesta del servidor está vacía");
                        }
                    } else {
                        console.error("Ha ocurrido un error en la solicitud: " + xhr.status);
                        alert("Ha ocurrido un error en la solicitud: " + xhr.status);
                    }
                }
            };
            xhr.send(formData);
        }
    };
})();

function checkInputs(){
    camposFaltantes = []; 
    const usuarioValue = usuario_text.value;
    const nombreValue = nombre_text.value;
    const apellidoPatValue = apellidoPat_text.value;
    const apellidoMatValue = apellidoMat_text.value;
    const correoValue = correo_text.value;
    const fechaNacValue = fechaNac_select.value;
    const generoValue = genero_select.value;
    const rolValue = rol_select.value;   
    const contrasenaValue = contrasena_text.value;
    
    var resp = 0;

    if(usuarioValue == null ||  nombreValue == null ||  apellidoPatValue == null || apellidoMatValue == null 
    || correoValue == null ||  generoValue == -1 ||  rolValue == -1 ||  contrasenaValue == null){
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

        if (!filePath) {
                camposFaltantes.push("-No se ha seleccionado ninguna imagen");
                console.log(filePath);
        } else {
            if (!allowedExtensions.exec(filePath.name)) {
                camposFaltantes.push("-Solo formato .jpg/.png en la imagen");
            }
        }
        
       // const tiposImagenPermitidos = ['image/jpeg', 'image/png']; // Tipos de imagen permitidos
       // if (!tiposImagenPermitidos.includes(imagenValue.type)) {
           // camposFaltantes.push("Formato_Imagen_invalido");
           // resp++;
        //}
            
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
 
};*/