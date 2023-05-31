<?php

//inicializar variables
$fichero = ''; // es el atributo name del input file
$errores = [];
$nombre = '';
$email = '';
$telefono = '';
$comentario = '';
$extensionesPermitidas = ['jpg', 'jpeg', 'png', 'svg', 'pdf'];
$nombreFichero = '';



//comprobar si se ha pulsado el botón de enviar
if (isset($_POST['enviar'])) {
	//recuperar y validar datos obligatorios
	try {
		if (empty($_POST['nombre'])) {
			$errores[] = 'El nombre no puede estar vacío';
		} else {
			$nombre = $_POST['nombre'];
		}
		if (empty($_POST['email'])) {
			$errores[] = ('El email no puede estar vacío');
		} else {
			$email = $_POST['email'];
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$errores[] = "El email no es válido";
			}
		}

		if (empty($_POST['comentario'])) {
			$errores[] = ('El comentario no puede estar vacío');
		} else {
			$comentario = $_POST['comentario'];
		}

		//si se ha seleccionado un fichero moverlo a la carpeta 'archivos'
		if (isset($_FILES['fichero']) && $_FILES['fichero']['error'] == 0) {
			$nombreFichero = $_FILES['fichero']['name'];
			$directorioDestino = "archivos/";

			// validaciones del fichero
			if ($_FILES['fichero']['size'] > 100000) {
				$errores[] = ('El fichero no puede ocupar más de 100 KB');
			}
			if (!in_array(pathinfo($nombreFichero, PATHINFO_EXTENSION), $extensionesPermitidas)) {
				$errores[] = ('La extensión del fichero no está permitida, el archivo debe ser de tipo jpg, jpeg, png o svg');
			}
			//comprobar si el fichero ya existe
			if (file_exists($directorioDestino . $nombreFichero)) {
				$errores[] = 'El fichero ya existe';
			}

			// Comprueba si se ha pulsado el botón de enviar y no hay errores
			if (isset($_POST['enviar']) && count($errores) == 0) {
				// Si se ha pulsado el botón de enviar y no hay errores, incluye el archivo sendMail.php
				include 'sendMail.php';
				// Luego, llama a la función sendMail
				sendMail($nombre, $email, $telefono, $comentario, $nombreFichero);
			}
		}
	} catch (Exception $e) {
		$errores[] = $e->getMessage();
	}

	// Mover el fichero a la carpeta de destino una vez que se ha validado que no hay errores y devolver un mensaje de exito
	if (count($errores) == 0 && isset($_FILES['fichero'])) {
		if (!is_dir($directorioDestino)) {
			mkdir($directorioDestino, 0777, true);
		}
		if (!move_uploaded_file($_FILES['fichero']['tmp_name'], $directorioDestino . $nombreFichero)) {
			$errores[] = "Error al mover el archivo a la carpeta de destino.";
		}
	}
}



	//confeccionar y enviar mensaje de correo

	//recuperar y validar datos obligatorios

	//si se ha seleccionado un fichero moverlo a la carpeta 'archivos'

	//confeccionar y enviar mensaje de correo

	//guardar correo enviado en el archivo de log en formato csv;

	//confeccionar filas de la tabla con los correos enviados 


if (isset($_POST['enviar']) && count($errores) == 0) {
	sendMail($nombre, $email, $telefono, $comentario, $nombreFichero);
}


?>

<!DOCTYPE html>
<html>

<head>
	<title>IEM</title>
	<meta charset="UTF-8">
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
	<link rel="icon" href="img/favicon.ico" type="image/x-icon">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/page.css" type="text/css" />
</head>

<body>
	<div class="wraper">
		<div class="content">
			<div class="slider">
				<img src="img/iem_3.jpg" /><img src="img/iem_4.jpg" />
			</div>

			<div class="sections">
				<h1 style="text-align:center">LOCALIZACIÓN DEL CENTRO Y CONTACTO</h1><br><br>
				<div class="contacto">
					<h2>CONTACTO</h2>
					<p>Los campos marcados con * son obligatorios.</p><br>
					<form name="form" method="post" action='#' enctype="multipart/form-data">
						<label for="nombre">Nombre: * </label><input type="text" name="nombre" id="nombre" value="<?php echo $nombre ?? null; ?>"><br><br>
						<label for="email">Email: * </label><input type="email" name="email" id="email" placeholder="nom@mail.com" value="<?php echo $email ?? null; ?>  "><br><br>
						<label for="telefono">Teléfono: </label><input type="tel" name="telefono" id="telefono" value="<?php echo $telefono ?? null; ?>"><br><br>
						<label>Mensaje: *</label><br><br>
						<textarea id="comentario" name="comentario" placeholder="Introduzca aquí su pregunta o comentario" value="<?php echo $comentario ?? null; ?>  "></textarea><br><br>
						<input type="file" name="fichero"><br><br>
						<input id="enviar" type="submit" name="enviar" value="Enviar"><br><br>
						<span id='mensajes'></span>
					</form>
					<hr>
					<div class='correo'></div>
					<hr>
					<div class='log'>
						<table>
							<p class='errores'><?php echo implode('<br>', $errores); ?></p>
	<?php
							// Iniciar tabla
							echo '<table>';

								// Loop a través de las entradas de registro
								
								foreach($logEntries as $entry) {
								// Dividir la entrada por comas para obtener los campos individuales
								$fields = explode(", ", $entry);

								// Iniciar fila de tabla
								echo '<tr>';

									// Loop a través de los campos y agregarlos a la tabla
									foreach($fields as $field) {
									echo '<td>' . $field . '</td>';
									}

									// Terminar fila de tabla
									echo '</tr>';
								}

								// Terminar tabla
								echo '</table>';
								?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>