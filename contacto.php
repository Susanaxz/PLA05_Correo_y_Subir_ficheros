<?php
	const CHAR_CODE = "A1B2C3D4E5F6G7H8I9J0K1L2M3N4O5P6Q7R8S9T0U1V2W3X4Z5";

	//inicializar variables
	
	//comprobar si se ha pulsado el botón de enviar
	
		//recuperar y validar datos obligatorios
			
		//si se ha seleccionado un fichero moverlo a la carpeta 'archivos'
			
		//confeccionar y enviar mensaje de correo
			
		//guardar correo enviado en el archivo de log en formato csv;

	//confeccionar filas de la tabla con los correos enviados

?>
<!DOCTYPE html>
<html>
<head>
	<title>IEM</title>
	<meta charset="UTF-8">
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
	<link rel="icon" href="img/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="css/page.css" type="text/css" />
</head>
<body>
	<div class="wraper">
		<div class="content">
			<div class="slider" >
				<img src="img/iem_3.jpg" /><img src="img/iem_4.jpg" />
		    </div>

		    <div class="sections">
		    	<h1 style="text-align:center">LOCALIZACIÓN DEL CENTRO Y CONTACTO</h1><br><br>
		    	<div class="contacto">
					<h2>CONTACTO</h2>
					<p>Los campos marcados con * son obligatorios.</p><br>
					<form name="form" method="post" action='#' enctype="multipart/form-data">
						<label for="nombre">Nombre: * </label><input type="text" name="nombre" id="nombre"><br><br>
						<label for="email">Email: * </label><input type="email" name="email" id="email" placeholder="nom@mail.com"><br><br>
						<label for="telefono">Teléfono: </label><input type="tel" name="telefono" id="telefono"><br><br>
						<label>Mensaje: *</label><br><br>
						<textarea id="comentario" name="comentario" placeholder="Introduzca aquí su pregunta o comentario" ></textarea><br><br>
						<input type="file" name="fichero"><br><br>
						<input id="enviar" type="submit" name="enviar" value="Enviar"><br><br>
						<span id='mensajes'></span>
					</form>
					<hr>
					<div class='correo'></div>
					<hr>
					<div class='log'>
						<table></table>
					</div>
				</div>
		    </div>
		</div>
	</div>
</body>
</html> 
