<?php 
	session_start();
	include('config.php');
	$correo = $_SESSION['correo'];

	if(!isset($_SESSION['cargadas'])) $_SESSION['cargada'] = 10;

	$q1 = "select * from cuadernoamigos where correo='".$correo."' ORDER BY ID DESC limit ".$_SESSION['cargadas'].",10";
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
	$_SESSION['cargadas']+=10;
?>