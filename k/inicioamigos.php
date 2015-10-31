<?php 
session_start();

include('config.php');

if(!isset($_SESSION['correo'])){
	print "<meta http-equiv='Refresh' content='1:url=../index'>";
	die;
}

$correo = $_SESSION['correo'];

include('lib');

$datos = SUBTRAER_INFORMACION($correo);

$nombre = $datos[0];
$apellido = $datos[1];

CONECTADO($correo);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo "$nombre $apellido"; ?></title>
</head>
<body>

</body>
</html>