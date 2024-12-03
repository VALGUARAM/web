const userText = document.getElementById('user');
const passwordText = document.getElementById('password');

(function () {
	const formLogin = document.getElementById('form_inicioSesion');
	formLogin.onsubmit = function (e) {
		e.preventDefault();
		const formData = new FormData(formLogin);
		formData.append('usuario', userText.value);
		formData.append('contrasenia', passwordText.value);

		let xhr = new XMLHttpRequest();

		xhr.open("POST", "./CONTROLADORES/IniciarSesion.php", true);
		xhr.onreadystatechange = function () {
			console.log(xhr.readyState);
			if (xhr.readyState == XMLHttpRequest.DONE) {
				if (xhr.status == 200) {
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
								//alert(res.data);	
								window.location.replace("PaginaPrincipal.php");

								return;
							}
						} catch (error) {
							console.error("Ha ocurrido un error: " + error);
							alert("No se pudo obtener la respuesta del servidor");
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
})();