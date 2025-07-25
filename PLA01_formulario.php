<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>PLA01_Form...</title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>
<body>
	<div class='container'>
		<h1 class='centrar'>PLA01: FORMULARI</h1>
		<!-- 
		El metode _POST, per enviar dades al servidor, es un array 
		que s'emporta TOTS els inputs del formulari i l'atribut 'action' 
		li diu on es processaran (en el fitxer PLA01_mostrardatos.php).
		-->
		<form method="post" action="PLA01_mostrardatos.php">
			<label for='nif'>Nif</label>
			<input type="text" name="nif" id='nif'><br><br>
			<label for='nombre'>Nom</label>
			<input type="text" name="nombre" id='nombre'><br><br>
			<label for='apellidos'>Cognoms</label>
			<input type="text" name="apellidos" id='apellidos'><br><br>
			<label for='email'>Email</label>
			<input type="email" name="email" id='email'><br><br>
			<label for='nota'>Nota exàmen</label>
			<input type="number" name="nota" id='nota'><br><br>
			<label for='mensaje'>Missatge</label>
			<textarea name='mensaje' id='mensaje' cols='22' rows='5'></textarea><br><br>
			<label></label>
			<input type="submit" name="Enviar">
		</form>
	</div>
</body>
</html>