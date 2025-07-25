
<?php
//Inicializacion de variables por si no se entra en la pagina desde el Formulario, para el html no lea variables no definidas
$nif = $nombre = $apellidos = $email = $nota = $mensaje = $qualificacio = $cuadritos_html = '';
$err_msg = '';
$errores = [];

// Obtencion de datos mediante funcion isset() y operador de fusion de null ??
if (isset($_POST['Enviar'])) { // Verifico si se ha pulsado el boton 'Enviar'
	$nif = $_POST['nif'] ?? null;
	$nombre = $_POST['nombre'] ?? null;
	$apellidos = $_POST['apellidos'] ?? null;
	$email = isset($_POST['email']) ? trim($_POST['email']) : null; //trima espacios y devuelve null si no esta definido
	$nota = $_POST['nota'] ?? null;
	$mensaje = $_POST['mensaje'] ?? null;

	// Validacion de datos
	try {
		if (!$nif || !preg_match('/^\d{8}[A-Za-z]$/', $nif)) { //preg_match(patron, sujeto)
			$errores[] = ("Nif: no informat o invalid");
		}
		if (!$nombre || !preg_match('/^[\p{L}\s\-]+$/u', $nombre)) { //patron: alfabeticos con acentos, guiones y espacios
			$errores[] = ("Nom: no informat o invalid");
		}
		if (!$apellidos || !preg_match('/^[\p{L}\s\-]+$/u', $apellidos)) { //patron: alfabeticos con acentos, guiones y espacios
			$errores[] = ("Cognoms: no informat o invalid");
		}
		if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)){ 
			$errores[] = ("Email: no informat o invalid");
		}
		if (!is_numeric($nota) || $nota < 0 || $nota > 10) {
			$errores[] = ("Nota: no informat o invalid");
		}
		else {
			$qualificacio = get_qualificacio($nota);
			$cuadritos_html = generarCuadritos($nota);
		}
		if (!$mensaje) { 
			$errores[] = ("Missatge: no informat o invalid");
		}

		if (!empty($errores)) {
			throw new Exception("--Errors de validació--");
		} 
	} catch (Exception $error) {
		$err_msg = $error->getMessage(); 
	}
//	print_r($_POST); // DEBUG
}

// Funció auxiliar: Retorna la qualificació
function get_qualificacio($nota) {
	if ($nota < 5) {
		$res = 'Suspens';
	}
	elseif ($nota <= 6) {
		$res = 'Aprovat';
	}
	elseif ($nota <= 9) {
		$res = 'Notable';
	}
	else {
		$res = 'Excel·lent';
	}
	return $res;
}

//Funció auxiliar: genera cuadrets de color segons la nota
function generarCuadritos($nota): string { // Asegura un tipo string para el retorno
	$cuadritos = '';
	for ($i = 1; $i <= $nota; $i++) {
		if ($i <= 4) {
			$color = 'rojo';
		} elseif ($i <= 6) {
			$color = 'amarillo';
		} elseif ($i <= 8) {
			$color = 'verde';
		} else {
			$color = 'azul';
		}

		$cuadritos .= "<aside class='$color'></aside>"; // "." operador para concatenar strings
	}
	return $cuadritos;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>PLA01_Show_data</title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css?v=1.0">
</head>
<body>
	<div class='container'>
		<h1 class='centrar'>PLA01: MOSTRAR DADES</h1>
		<div class='card'>
			<input type="text" placeholder="nif" disabled value='<?php echo htmlspecialchars($nif) ?>'><br><br> 
			<input type="text" placeholder="nom" disabled value='<?php echo htmlspecialchars($nombre) ?>'>
			<input type="text" placeholder="cognoms" disabled value='<?php echo htmlspecialchars($apellidos) ?>'><br><br>
			<input type="text" placeholder="qualificació" disabled value='<?php echo htmlspecialchars($qualificacio) ?>'><?= $cuadritos_html ?><br><br>
			<input type="text" placeholder="email" disabled value='<?php echo htmlspecialchars($email) ?>'><br><br>
			<textarea  cols='22' rows='5' disabled><?php echo htmlspecialchars($mensaje) ?></textarea><br>
			<?php if (!empty($err_msg)): ?>
				<?php foreach ($errores as $error): ?>
					<?php echo htmlspecialchars($error); ?>
					<br>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</body>
</html>
