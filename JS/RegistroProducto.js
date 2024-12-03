var fechaExp_select  = document.getElementById('fecha_Exp');
const hoy = new Date();
hoy.setFullYear(hoy.getFullYear() + 1);
const dia = hoy.getDate();
const mes = hoy.getMonth() + 1; 
const fechaSiguiente = hoy.getFullYear() + '-' + (mes < 10 ? '0' : '') + mes + '-' + (dia < 10 ? '0' : '') + dia;
const MAX_VIDEO_SIZE_BYTES = 16 * 1024 * 1024; // 16 MB en bytes


fechaExp_select.value = fechaSiguiente;

function validarFormulario(event) {
    event.preventDefault();

    var ExpNombres = /^[a-zA-ZÀ-ÿ0-9\s]*$/;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
    var allowedVideoExtensions = /(\.mp4|\.mov)$/i;


    var nombre_text = document.getElementById('name').value;
    var descProd_text = document.getElementById('DescProd').value;
    var catProdt_text = document.getElementById('CatProd').value;
    var radioSeleccionado = document.querySelector('input[name="inlineRadioOptions"]:checked');
    var precio_text = document.getElementById('precio').value;
    var imagen  = document.getElementById('image').files[0];
    var imagen2 = document.getElementById('image2').files[0];
    var imagen3 = document.getElementById('image3').files[0];
    var video = document.getElementById('video').files[0];
    var stock_text = document.getElementById('stock').value;
    var fechaExpiracion  = document.getElementById('fecha_Exp');

    var errores = [];


    if (nombre_text === "") {
        errores.push("-Nombre esta vacio");
    }
    else if (!ExpNombres.test(nombre_text)) {
        errores.push("-El nombre solo debe contener letras y espacios");
    }

   
    if (!imagen) {
        errores.push("-Se tiene que seleccionar al una imagen");
    } else {
        if (!allowedExtensions.exec(imagen.name)) {
            errores.push("-Solo formato .jpg/.png en la imagen");
        }
    }
    if(!imagen2){
        errores.push("-Se tiene que seleccionar al una 2da imagen");

    }else{
        if (!allowedExtensions.exec(imagen2.name)) {
            errores.push("-Solo formato .jpg/.png en la imagen");
        }
    }

    if(!imagen3){
        errores.push("-Se tiene que seleccionar al una 3ra imagen");
    }else{
        if (!allowedExtensions.exec(imagen3.name)) {
            errores.push("-Solo formato .jpg/.png en la imagen");
        }
    }
    if(!video){
        errores.push("-Se tiene que seleccionar un video");
    }else{
        if (!allowedVideoExtensions.exec(video.name)) {
            errores.push("-Solo formato .mp4/.mov en el video");
        }
    }

    if(descProd_text === ""){
        errores.push("-Descripción esta vacio");
    }

    if(catProdt_text === ""){
        errores.push("-Seleccione una categoría");
    }
    
    var valorSeleccionado = null;
    if (radioSeleccionado) {
        valorSeleccionado = radioSeleccionado.value;
        console.log("valoseleccionado " + valorSeleccionado);
    } else {
        errores.push('-Ningún radio button seleccionado');
    }

    if(valorSeleccionado == 0){//si el producto no es cotizable, necesita tener un precio
        if(precio_text === ""){
            errores.push('-No se ingreso un precio');
        }
    }else{
        precio_text = null;
    }
    
    if(stock_text == ""){
        errores.push('-No se ingreso un stock');
    }

    var fechaActual = new Date();
    if (new Date(fechaExpiracion.value) < fechaActual) {
        errores.push("-La fecha de expiración no puede ser una fecha anterior al día de hoy");
       
    }        

    if (errores.length > 0) {
        alert("Falta la siguiente informacion:\n\n" + errores.join("\n"));
        return false;
    }
    else {
        console.log("0 errores");
        var formData = new FormData();  // Crear un objeto FormData
        formData.append('nombre', nombre_text);
        formData.append('descripcion', descProd_text); 
        formData.append('categoria',catProdt_text);
        formData.append('cotizable', valorSeleccionado);
        formData.append('precio', precio_text);
        formData.append('imagen', imagen);
        formData.append('imagen2', imagen2);
        formData.append('imagen3', imagen3);
        formData.append('video',video);
        formData.append('stock', stock_text);
        formData.append('fechaExp', fechaExpiracion.value);

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "./CONTROLADORES/RegistroProducto.php", true);
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
                                window.location.replace("AgregarProducto.php");
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

document.addEventListener('DOMContentLoaded', function () {
    const imagen1Input = document.getElementById('image');
    const imagen2Input = document.getElementById('image2');
    const imagen3Input = document.getElementById('image3');

    // Función para habilitar/deshabilitar imagen2 y imagen3
    function habilitarImagenes() {
        if (imagen1Input.files.length > 0) {
            imagen2Input.disabled = false;
        } else {
            imagen2Input.disabled = true;
            imagen3Input.disabled = true;
        }
    }

    // Escuchar cambios en imagen1 para habilitar/deshabilitar las otras imágenes
    imagen1Input.addEventListener('change', habilitarImagenes);
});

document.addEventListener('DOMContentLoaded', function () {
    const imagen2Input = document.getElementById('image2');
    const imagen3Input = document.getElementById('image3');

    // Función para habilitar/deshabilitar imagen2 y imagen3
    function habilitarImagenes2() {
        if (imagen2Input.files.length > 0) {
            imagen3Input.disabled = false;
        } else {
            imagen3Input.disabled = true;
        }
    }

    // Escuchar cambios en imagen1 para habilitar/deshabilitar las otras imágenes
    imagen2Input.addEventListener('change', habilitarImagenes2);
});

document.addEventListener('DOMContentLoaded', function () {
    const radioOPSI = document.getElementById('radioOPSI');
    const radioOPNO = document.getElementById('radioOPNO');
    const precioInput = document.getElementById('precio');

    // Función para habilitar/deshabilitar el campo de precio
    function habilitarPrecio() {
        precioInput.disabled = !radioOPNO.checked;
        precioInput.value="";
    }

    // Escuchar cambios en los radio buttons para habilitar/deshabilitar el campo de precio
    radioOPSI.addEventListener('change', habilitarPrecio);
    radioOPNO.addEventListener('change', habilitarPrecio);

    // Llamar a la función inicialmente para establecer el estado inicial
    habilitarPrecio();
});

document.addEventListener('DOMContentLoaded', function () {
    const precioInput = document.getElementById('precio');

    // Función para validar la entrada en el campo de precio
    function validarPrecio(event) {
        const inputChar = String.fromCharCode(event.charCode);
        const regex = /^[0-9.]+$/;

        if (!regex.test(inputChar)) {
            event.preventDefault();
        }
    }

    // Escuchar el evento keypress para validar la entrada mientras se escribe
    precioInput.addEventListener('keypress', validarPrecio);
});

document.addEventListener('DOMContentLoaded', function () {
    const precioInput = document.getElementById('stock');

    // Función para validar la entrada en el campo de precio
    function validarStock(event) {
        const inputChar = String.fromCharCode(event.charCode);
        const regex = /^[0-9]+$/;

        if (!regex.test(inputChar)) {
            event.preventDefault();
        }
    }

    // Escuchar el evento keypress para validar la entrada mientras se escribe
    precioInput.addEventListener('keypress', validarStock);
});
/*
//VGVR
const formulario = document.getElementById('forms');
const nombre_text = document.getElementById('name');
const DescProd_text = document.getElementById('DescProd');
const CatProd_text = document.getElementById('CatProd');
const precio_text = document.getElementById('precio');
const image_text = document.getElementById('image');
const image2_text = document.getElementById('image2');
const image3_text = document.getElementById('image3');
const video_text = document.getElementById('video');
const Stock_text = document.getElementById('Stock');

var camposFaltantes = [];

(function () {
    const formProduct = document.getElementById('form');
    formProduct.onsubmit = function (e) {
        e.preventDefault();
      

        if (!checkInputs()) {
            console.error("Algo falló en la validación");
            alert("Campos no válidos: " + camposFaltantes.join(", ") );
            return;
        } else {
            const formData = new FormData(formProduct);
            formData.append('nombreProd', nombre_text.value);
            formData.append('descripcion', DescProd_text.value);
            formData.append('categoria', CatProd_text.value);
            formData.append('precio', precio_text.value);
            formData.append('imagen', image_text.value);
            formData.append('video', video_text.value);//??
            formData.append('inventario', Stock_text.value);
            formData.append('imagen2', image2_text.value);
            formData.append('imagen3', image3_text.value);

            

            let xhr = new XMLHttpRequest();

            xhr.open("POST", "./CONTROLADORES/RegistroProducto.php", true);
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
                                    window.location.replace("PaginaPrincipal.php");
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
    const nombreValue = nombre_text.value;
    const DescProdValue = DescProd_text.value;
    const CatProdtValue = CatProd_text.value;
    const precioValue = precio_text.value;
    const StockValue = Stock_text.value;
    const imagenValue = image_text.files[0];
    const videoValue = video_text.files[0];
    const imagen2Value = image2_text.files[0];
    const imagen3Value = image3_text.files[0];

    
    var resp = 0;

    if(nombreValue == null ||  DescProdValue == null || CatProdtValue == null 
    || precioValue == null || StockValue == null ||  imagenValue == null || videoValue == null ||  imagen2Value == null ||  imagen3Value == null ){
            camposFaltantes.push("FALTAN CAMPOS POR LLENAR");
            return false;
    }else{
       
            
        const tiposImagenPermitidos = ['image/jpeg', 'image/png']; // Tipos de imagen permitidos
        if (!tiposImagenPermitidos.includes(imagenValue.type)) {
            camposFaltantes.push("Formato_Imagen_invalido");
            resp++;
        }

        const tiposvideoPermitidos = ['video/mp4']; // Tipos de video permitidos
        if (!tiposvideoPermitidos.includes(videoValue.type)) {
            camposFaltantes.push("Formato_video_invalido");
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

// Función para manejar el evento de cambio en el input de tipo file
document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.getElementById('video');

    function handleFileInputChange(event) {
        const fileInput = event.target; // Obtener el input de tipo file
        const file = fileInput.files[0]; // Obtener el archivo seleccionado (el primer archivo si hay más de uno)

        if (file && file.size > MAX_VIDEO_SIZE_BYTES) {
        // El tamaño del archivo excede el límite
            alert("El video es demasiado grande. Por favor, selecciona un video más pequeño.");
            fileInput.value = ''; // Limpiar el valor del input para que el usuario pueda seleccionar otro archivo
        } 
}
    fileInput.addEventListener('change', handleFileInputChange);
});