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
	<script type="text/javascript" src="../estaticos/js/script.js"></script>
</head>
<body>
	<nav class="menuBuscar"></nav>
	<section class="contenedorCompleto">
		<?php 
			$q1 = "select * from cuadernoamigos where de='".$correo."' ORDER BY ID DESC limit 0,10";
			mysql_select_db($dbname);
			$r1 = mysql_query($q1);
			while($f1=mysql_fetch_array($r1))
			{
				print $f1['de'];
				print $f1['texto'];
			}
		?>
	</section>
	<aside class="barraDerecha">
		<ul class="menus">
			<a href="" class="itemPerfil">
				<li class="item"></li>
				<li class="item"></li>
				<li class="item"></li>
				<li class="item"></li>
				<li class="item"></li>
				<li class="item"></li>
				<li class="item"></li>
			</a>
		</ul>
	</aside>
	<aside class="barraIzquierda">
		<ul class="menus">
			<a href="" class="itemPerfil">
				<li class="item"></li>
				<li class="item"></li>
				<li class="item"></li>
				<li class="item"></li>
				<li class="item"></li>
				<li class="item"></li>
				<li class="item"></li>
			</a>
		</ul>
	</aside>
</body>
</html>