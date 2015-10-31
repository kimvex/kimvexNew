<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Kimvex</title>
	<link rel="stylesheet" type="text/css" href="estaticos/css/normalize.css">
	<link rel="stylesheet" type="text/css" href="estaticos/css/estilo.css">
	<script type="text/javascript" src="estaticos/js/script.js"></script>
</head>
<body>
	<section class="fondoInicio">
		<div class="fondoInicioImg" id="fondoInicioImg">
			<h1 class="h1Kimvex">kimvex</h1>
			<div class="cajaEntrada">			
				<form method="post" action="./k/login" name="login">
					<input type="mail" name="user" placeholder="tu_correo@kimvex.com" value="@kimvex.com" required id="correo" class="correo">
					<input type="password" name="pass" placeholder="Contraseña" id="contra" class="contra" required>
					<input type="submit" value="Entrar" class="entrar">
				</form>
			</div>
		</div>
	</section>
	<footer class="pieInicio">
		<ul class="pieInicioLista">
			<li class="inicioItem">
				<a href="datos/quienes">¿Quienes somos?</a>
			</li>
			<li class="inicioItem">
				<a href="datos/quieres">¿Quieres ser parte de nosotros?</a>
			</li>
			<li class="inicioItem">
				<a href="datos/terminos">Términos y Condiciones</a>
			</li>
			<li class="inicioItem">
				<a href="datos/politicas">Políticas de privacidad</a>
			</li>
		</ul>
	</footer>
</body>
</html>