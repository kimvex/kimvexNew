<style>
html{
background:url(../img/fondo.jpg);
}
</style>
<html>
<?php

error_reporting(0);
$usuario=$_POST['user'];
$password=$_POST['pass'];

$correo = $usuario;

$correo = trim($correo);

$correo = strtolower($correo);





$contra1 = $password;

$contra1 = trim($contra1);

$contra = strtolower($contra1);


include("./lib.php");




if(existe_usuario($correo)){

	if(checar_contra($correo,$contra1)){

		echo '<br><br><br>
		<center><IMG SRC="../img/loading.gif" ALT="Cargando" BORDER=0 WIDTH=600 HEIGTH=200 align=center></center><br>
		<h1><center>Espere Por favor....</center></h1><br><br><br><center><h1>si la pagina tarda en cargar da click en >> <a href="./login">Recargar</a></h1></center>';


include('config.php');

 function ip()
    {
 
        if (isset($_SERVER["HTTP_CLIENT_IP"]))
        {
            return $_SERVER["HTTP_CLIENT_IP"];
        }
        elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
        {
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        }
        elseif (isset($_SERVER["HTTP_X_FORWARDED"]))
        {
            return $_SERVER["HTTP_X_FORWARDED"];
        }
        elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]))
        {
            return $_SERVER["HTTP_FORWARDED_FOR"];
        }
        elseif (isset($_SERVER["HTTP_FORWARDED"]))
        {
            return $_SERVER["HTTP_FORWARDED"];
        }
        else
        {
            return $_SERVER["REMOTE_ADDR"];
        }
 
    }
   $ipr=ip();
   
   date_default_timezone_set("America/Lima"); $fecha = date("j/m/Y");
   
   date_default_timezone_set("America/Lima"); $hora= date("g:i a");
   	$links = mysql_connect($mysql_host,$mysql_user,$mysql_pass);
mysql_select_db($mysql_db,$links);
$sqls="INSERT INTO uso (ip,poc,dia,hora,correo) VALUES ('".$ipr."','pc','".$fecha."','".$hora."','".$correo."')";
mysql_query($sqls,$links);

	echo "<meta http-equiv='Refresh' content='1;url=./inicioamigos'>";
		session_start();
		$_SESSION['correo']=$correo;
		die;

	}else{

		echo '<SCRIPT LANGUAGE="JavaScript">
		alert("Correo O Clave Incorrectos!! -- Porfavor Intente Nuevamente ");
		</SCRIPT>';

		echo "<meta http-equiv='Refresh' content='1;url=../index'>";
		die;
	}

}else{

echo '<SCRIPT LANGUAGE="JavaScript">
alert("Correo O Clave Incorrectos!! -- Porfavor Intente Nuevamente ");
</SCRIPT>';

echo "<meta http-equiv='Refresh' content='1;url=../index'>";
die;

}

?>
