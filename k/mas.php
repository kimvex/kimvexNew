<?php 
	session_start();
	print "Hola";
	include('config.php');
	$correo = $_SESSION['correo'];

	if(!isset($_SESSION['cargadas'])){
		$_SESSION['cargadas'] = 10;
	} 
	print $_SESSION['cargadas'];
	$q1 = "select * from cuadernoamigos where correo='".$correo."' ORDER BY ID DESC limit 0,10";
	mysql_select_db($dbname);
	$r1 = mysql_query($q1);
	while($f1=mysql_fetch_array($r1))
	{ 
		print $_SESSION['cargadas']+"dd";
		if($f1['de'] != $correo){
?>
<link rel="stylesheet" type="text/css" href="../estaticos/css/normalize.css">
<link rel="stylesheet" type="text/css" href="../estaticos/css/estilo.css">
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
	$_SESSION['cargadas']+=10;
?>