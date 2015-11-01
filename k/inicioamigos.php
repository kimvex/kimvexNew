<?php 
session_start();

if(!isset($_SESSION['correo'])){
	print "<meta http-equiv='Refresh' content='1:url=../index'>";
	die;
}

$correo = $_SESSION['correo'];

include('lib.php');
include('config.php');
$datos = SUBTRAER_INFORMACION($correo);

$nombre = $datos[0];
$apellido = $datos[1];

CONECTADO($correo);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php print "$nombre $apellido"; ?></title>
	<link rel="stylesheet" type="text/css" href="../estaticos/css/normalize.css">
	<link rel="stylesheet" type="text/css" href="../estaticos/css/estilo.css">
	<script src="../estaticos/lib/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="../estaticos/js/script.js"></script>
	<?php include('../estaticos/css/css.php'); ?>
</head>
<body>
	<nav class="menuBuscar"></nav>
	<section class="contenedorCompleto">
		<?php 
			$q1 = "select * from cuadernoamigos where correo='".$correo."' ORDER BY ID DESC limit 0,10";
			mysql_select_db($dbname);
			$r1 = mysql_query($q1);
			while($f1=mysql_fetch_array($r1))
			{ 
				if($f1['de'] != $correo){
		?>
		<article class="publicacion">
			<header class="cabeceraPublicacion">
				<img src="../estaticos/img/imgperfil/<?php print $f1['de']?>.jpg" class="imagenPerfilPublicacion">
				<h3><?php print $f1['nombre'];?></h3>
				<span><?php print $f1['fecha']; ?></span>
			</header>
			<section class="sectionPublicacion">
				<?php print $f1['texto']; ?>
			</section>
			<footer class="pieDePublicacion">
				<?php print $f1['ID']; ?>
			</footer>
		</article>
		<?php
				}
			}
		?>
	</section>
	<aside class="barraDerecha">
		<ul class="menus">
			<a href="index" class="itemPerfil">
				<li class="item itemPerfil"></li>
			</a>
			<li class="item"></li>
			<li class="item"></li>
			<li class="item"></li>
			<li class="item"></li>
			<li class="item"></li>
			<li class="item"></li>
		</ul>
	</aside>
	<aside class="barraIzquierda">
		<ul class="menus">
			<a href="" class="itemPerfil">
				<li class="item"></li>
			</a>
			<li class="item"></li>
			<li class="item"></li>
			<li class="item"></li>
			<li class="item"></li>
			<li class="item"></li>
			<li class="item"></li>
		</ul>
	</aside>
</body>
</html>