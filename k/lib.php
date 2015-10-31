<?php

function SUBTRAER_INFORMACION($correo)

{
error_reporting(0);
include("./config.php");

$conexion_mysql = mysql_connect($mysql_host,$mysql_user,$mysql_pass);
mysql_select_db($mysql_db,$conexion_mysql);

$consulta = "SELECT nombre FROM datos where correo = '$correo'";

$query = mysql_query($consulta,$conexion_mysql);

$nombre = mysql_result($query,0,0);

$datos[] = $nombre;

$consulta = "SELECT apellido FROM datos where correo = '$correo'";

$query = mysql_query($consulta,$conexion_mysql);

$apellido = mysql_result($query,0,0);

$datos[] = $apellido;

$consulta = "SELECT sexo FROM datos where correo = '$correo'";

$query = mysql_query($consulta,$conexion_mysql);

$sexo = mysql_result($query,0,0);

$datos[] = $sexo;

$consulta = "SELECT contra1 FROM datos where correo = '$correo'";

$query = mysql_query($consulta,$conexion_mysql);

$contra1 = mysql_result($query,0,0);

$datos[] = $contra1;

$consulta = "SELECT correo FROM datos where correo = '$correo' ORDER BY id";

$query = mysql_query($consulta,$conexion_mysql);

$contra1 = mysql_result($query,0,0);

$datos[] = $correo;

$consulta = "SELECT id FROM datos where correo = '$correo'";

$query = mysql_query($consulta,$conexion_mysql);

$id = mysql_result($query,0,0);

$datos[] = $id;

$consulta = "SELECT nombrec FROM datos where correo = '$correo'";

$query = mysql_query($consulta,$conexion_mysql);

$nombrec = mysql_result($query,0,0);

$datos[] = $nombrec;

$consulta = "SELECT apellidoc FROM datos where correo = '$correo'";

$query = mysql_query($consulta,$conexion_mysql);

$apellidoc = mysql_result($query,0,0);

$datos[] = $apellidoc;

return($datos);

}

function TOTAL_ARRAY($array)

{

$a=0;
$contar=0;

while(isset($array[$a])){

$a=$a+1;

$contar=$contar+1;

}
return($contar);

}


function OBTENER_CORREOS()
{
error_reporting(0);
include("./config.php");
$display_errors = 'Off'; 
$conexion_mysql = mysql_connect($mysql_host,$mysql_user,$mysql_pass);

mysql_select_db($mysql_db,$conexion_mysql);

$consulta = "SELECT correo FROM datos ORDER BY id ";

$query = mysql_query($consulta,$conexion_mysql);
$row = mysql_fetch_assoc($query);
$tot = mysql_num_rows($query);
$a=0;

while(mysql_result($query,$a,0)){

$array_correos[]= mysql_result($query,$a,0);

$a=$a+1;

}

return($array_correos);
}

	
//usuario existe
function existe_usuario($correo)
{

include("./config.php");

$array_correos=OBTENER_CORREOS();

$total = TOTAL_ARRAY($array_correos);

for($a=0;$a<$total;$a++){

    if($array_correos[$a] == $correo){
	return(true);
	die;
	}
	
	
}

return(false);
die;

}

//nuevo usuario
function nuevo_usuario($correo,$nombre,$apellido,$sexo,$contra1,$nombrec,$pellidoc)
{

$correo = trim(strtolower($correo));
$nombre =addslashes($nombre);
$nombre = ucfirst($nombre);
$apellido =addslashes($apellido);
$apellido = ucfirst($apellido);
$nombrec = trim(strtolower($nombrec));
$apellidoc = trim(strtolower($apellidoc));
$sexo = trim(strtolower($sexo));
$contra1 = trim(strtolower(md5($contra1)));

include("./config.php");

$conexion_mysql = mysql_connect($mysql_host,$mysql_user,$mysql_pass);

mysql_select_db($mysql_db,$conexion_mysql);

mysql_query("INSERT INTO datos(correo,nombre,apellido,sexo,contra1,nombrec,apellidoc) VALUES('$correo','$nombre','$apellido','$sexo','$contra1','$nombrec','$pellidoc')",$conexion_mysql);

mysql_query("INSERT INTO conect VALUES('$correo',1)",$conexion_mysql); 	

mysql_query("INSERT INTO ue VALUES('$correo',1)",$conexion_mysql); 

mysql_query("INSERT INTO ua VALUES('$correo',1)",$conexion_mysql); 

mysql_query("INSERT INTO rec VALUES('$correo',1)",$conexion_mysql);

mysql_query("INSERT INTO nur(correo,nombre,apellido) VALUES('$correo','$nombre','$apellido')",$conexion_mysql);

mysql_query("INSERT INTO comentarios VALUES('$correo','$nombre','$apellido','$comentario')",$conexion_mysql);

mysql_query("CREATE TABLE $correo('$correo')",$conexion_mysql);

if(ereg("lino",$sexo)){

  

copy("../img/he.png","../imgperfil/$correo.jpg");
copy("../fondos/slider1.jpg","../fondos/$correo.jpg");
copy("../cuaderno/comentario","../cuaderno/$correo");
copy("../tercerimg/slider3.jpg","../tercerimg/$correo.jpg");
  mkdir('../album/'.$correo, 0777);
  mkdir('../videos/'.$correo, 0777);
  mkdir('../portafolio/'.$correo, 0777);




}else{

copy("../img/she.jpg","../imgperfil/$correo.jpg");
copy("../img/slider1.jpg","../fondos/$correo.jpg");
copy("../cuaderno/comentario","../cuaderno/$correo");
copy("../tercerimg/slider3.jpg","../tercerimg/$correo.jpg");
  mkdir('../album/'.$correo, 0777);
  mkdir('../videos/'.$correo, 0777);
  mkdir('../portafolio/'.$correo, 0777);

}
}
//escribir en el cuaderno
function RAYAR_CUADERNO($correo){
include("./config.php");

$descriptor_cuaderno=fopen("../cuaderno/$correo","r");

echo '<center><table border=0 BACKGROUND="../img/cuaderno.png" WIDTH="90%" HEIGHT="90%" class="cuaderno"><td ALIGN=left VALIGN=top>';

$entrada=0;



while($linea=fgets($descriptor_cuaderno)){

if(ereg("-----------",$linea)){
	$entrada=($entrada+1);
	if($entrada==$entradas_max){

		die;
	}

}


	if(ereg("<<",$linea)){
		$vector_correo=explode("-",$linea);
		$correo_persona=$vector_correo[1];

	}elseif(ereg(">>",$linea)){
		$vector_linea=explode("-",$linea);
		$espacio=chr(32);
		$linea_lista=implode($espacio,$vector_linea);
			if(trim($correo_persona)=="Kimvex"){
				echo '<IMG SRC="../fotos/Kimvex.jpg" ALT="Foto" BORDER=1 WIDTH=50 HEIGTH=60>
					<b><i><h4>'.$linea_lista.'</h4></i></b>   ';
			}elseif(trim($correo_persona)==trim($correo)){

				echo '<IMG SRC="../imgperfil/'.$correo.'.jpg" ALT="Foto" BORDER=1 WIDTH=50 HEIGTH=60>
					<b><i><h4>'.$linea_lista.'</h4></i></b>   ';

			}else{

				echo '<a href="./perp.php?correo='.$correo_persona.'" target="_self" class="cuaderno_link"><IMG SRC="../imgperfil/'.$correo_persona.'.jpg" ALT="Foto" BORDER=1 WIDTH=50 HEIGTH=60>
					<b><i><h4>'.$linea_lista.'</a></h4></i></b>   ';

			}

	}elseif(ereg("-----",$linea)){
		echo "<br><center><b>$linea</b></center><br>";
		
		}else{
		echo "$linea<br>";
	}
}

echo '</td></table></center><A NAME="final"></A>';


fclose($descriptor_cuaderno);




}




//escribir en el cuaderno

function ESCRIBIR_CUADERNO($correo_from,$correo_to,$texto){
	
	$datos_from =  SUBTRAER_INFORMACION($correo_from);
	
	$descriptor_cuaderno_obtener = fopen("../cuaderno/$correo_to","r");		
	
	while(!feof($descriptor_cuaderno_obtener)){
		
		$pre=fgets($descriptor_cuaderno_obtener);
		
		$cuaderno = $cuaderno.$pre;
	}
	
	
	$intro_correo ="<<-$correo_from";
	
	$intro="$datos_from[0]-$datos_from[1]->>";
	
	$descriptor_cuaderno=fopen("../cuaderno/$correo_to","w");
	
	fwrite($descriptor_cuaderno,trim($intro_correo)."\n");
	fwrite($descriptor_cuaderno,trim($intro)."\n");
	
	$contar=0;
	
	$valor=80;
	
	for($a=0;$a<1000;$a++){
		
		
		if(isset($texto[$a])){
			
			if($contar==$valor){
				
				fwrite($descriptor_cuaderno,"\n");
				$valor=($valor+80); $a=($a-1);
			}else{
				
				fwrite($descriptor_cuaderno,"$texto[$a]");
				
			}
			$contar=($contar+1);
			
		}else{}
		
	}
	
	
	fwrite($descriptor_cuaderno,"\n");
	fwrite($descriptor_cuaderno,"--------------------------------\n");
	fwrite($descriptor_cuaderno,"$cuaderno");
	fclose($descriptor_cuaderno);
	
	
}

//Escribir cuaderno_descarga


function ESCRIBIR_CUADERNO_DESCARGA($correo_from,$correo_to,$texto){
	
	
	$datos_from= SUBTRAER_INFORMACION($correo_from);
	
	
$descriptor_cuaderno_obtener = fopen("../cuaderno/$correo_to","r");

while(!feof($descriptor_cuaderno_obtener)){

	$pre=fgets($descriptor_cuaderno_obtener);

	$cuderno = $cuaderno.$pre;

}




$intro_correo="<<-$correo_from";

$intro="$datos_from[0]-$datos_from[1]->>";


$descriptor_cuaderno=fopen("../cuaderno/$correo_to","w");

fwrite($descriptor_cuaderno,trim($intro_correo)."\n");
fwrite($descriptor_cuaderno,trim($intro)."\n");

$contar=0;

$valor=80;

for($a=0;$a<1000;$a++){

if(isset($texto[$a])){
	
	if($contar==$valor){
		fwrite($descriptor_correo,"\n");
		$val=($val+80);	$a=($a-1);
	}else{
	

	fwrite($descriptor_cuaderno,"$texto[$a]");

	}
$contar=($contar+1);

}else{}

	
}

fwrite($descriptor_cuaderno,"\n");
fwrite($descriptor_cuaderno,"------------------------\n");
fwrite($descriptor_cuaderno,"$cuaderno");
fclose($descriptor_cuaderno);





}

			
//checar contraeña si son correcatas

function checar_contra($correo,$contra1){
	
		$datos=SUBTRAER_INFORMACION($correo);
		
		$contra1=md5($contra1);
		$contra1_base=$datos[3];
		
		if($contra1_base==$contra1){
			
			return(true);
			
		}else{
			
			return(false);
		}
}

//cambiar contrasena
function CAMBIAR_CONTRASENA($correo,$contra1){

$contra1=md5($contra1);


include("./config.php"); // Incluimos la configuracion

$conexion_mysql = mysql_connect($mysql_host,$mysql_user,$mysql_pass); //conectamos con la base de datos

mysql_select_db($mysql_db,$conexion_mysql); //seleccionamos la base de datos 

mysql_query("UPDATE datos SET contra1 = '$contra1' WHERE correo = '$correo'",$conexion_mysql);  // ingresamos



}

			
//coencatdos ala red

function EN_LINEA($correo){
	
	include("./config.php");
	
	
	$conexion_mysql=mysql_connect($mysql_host,$mysql_user,$mysql_pass);
	
	mysql_select_db($mysql_db,$conexion_mysql);
	
	mysql_query("UPDATE conect SET conect = 1 where correo ='$correo'",$conexion_mysql);
	
}
				
//desconectados de la red

function NO_EN_LINEA($correo){
	
	include("./config.php");
	
	$conexion_mysql=mysql_connect($mysql_host,$mysq_user,$mysql_pass);
	
	mysql_select_db($mysql_db,$conexion_mysql);
	
	mysql_query("UPDATE conect SET conect = 0 where correo ='$correo'",$conexion_mysql);
	
}

/////////////////////////////////////////////////////////////////////////////////////7



function CONECTADO($correo)

{



include("./config.php"); // Incluimos la configuracion

$conexion_mysql = mysql_connect($mysql_host,$mysql_user,$mysql_pass); //conectamos con la base de datos

mysql_select_db($mysql_db,$conexion_mysql); //seleccionamos la base de datos 

mysql_query("UPDATE conect SET conect = 1 where correo = '$correo'",$conexion_mysql);  // ingresamos



}


/////////////////////////////////////////////////////////////////////////////////////7


function DESCONECTADO($correo)

{



include("./config.php"); // Incluimos la configuracion

$conexion_mysql = mysql_connect($mysql_host,$mysql_user,$mysql_pass); //conectamos con la base de datos

mysql_select_db($mysql_db,$conexion_mysql); //seleccionamos la base de datos 

mysql_query("UPDATE conect SET conect = 0 where correo = '$correo'",$conexion_mysql);  // ingresamos



}


/////////////////////////////////////////////////////////////////////////////////////7

/////////////////////////////////////////////////////////////////////////////////////7



function LISTA_CONECTADOS()

{


error_reporting(0);
include("./config.php"); // Incluimos la configuracion

$conexion_mysql = mysql_connect($mysql_host,$mysql_user,$mysql_pass); //conectamos con la base de datos

mysql_select_db($mysql_db,$conexion_mysql); //seleccionamos la base de datos 

$consulta = "SELECT correo FROM conect where conect = 1"; // elaboramos la consulta

$query = mysql_query($consulta,$conexion_mysql);  // elaboramos la consulta

$i=0;

while(mysql_result($query,$i,0)){

$array_correos[]=mysql_result($query,$i,0);

$i=($i+1);

}


return($array_correos);




}


/////////////////////////////////////////////////////////////////////////////////////7

function LISTAR_CHAT($correo)

{

$conectados = LISTA_CONECTADOS();

$total_conectados = TOTAL_ARRAY($conectados);

for($i=0;$i<$total_conectados;$i++){


	if($correo!=$conectados[$i]){

		$datos = SUBTRAER_INFORMACION($conectados[$i]);

		$nombre = $datos[0];
		$apellido = $datos[1];


echo '<a href="javascript:void(0)" onclick="javascript:chatWith(\''.$nombre.'_'.$apellido.'\')" >';

		echo '<IMG SRC="../imgperfil/'.$conectados[$i].'.jpg" ALT="Foto" BORDER=1 WIDTH=40 HEIGTH=20 align="center"> '.$nombre.' '.$apellido.'</a><br><br>';

	}

}

}


//////////////////////////////////////////////////////////////////////////////////////////////


function DESECHAR($texto)

{

$espacio = chr(32);

$vector = explode($espacio,$texto);

$listo = $vector[0];

return($listo);

}

// agregar amigos
function amigos($correo) 
{
	
	include("./config.php");
$consulta="select estado from amigo where correo='$correo' and correo_amigo='$correo'";
$ejecuta=mysql_query($consulta) or die("Problemas en el select:".mysql_error());
$cantidad=mysql_num_rows($ejecuta);
$consulta1="select estado from amigo where correo='$correo' and correo_amigo='$correo'";
$ejecuta1=mysql_query($consulta1) or die ("Problemas en el select:".mysql_error());
$cantidad1=mysql_num_rows($ejecuta1);
if($cantidad > 0)
{
$row = mysql_fetch_assoc($ejecuta);
switch($row['estado'])
{
case 'pendiente':
echo '<div class="amigos">Ya mandaste petición</div>';
echo $reg['nombre'];
break;
case 'aceptado':
echo '<a href="perfil.php?correo='.$correo.'">Ir</a>';
break;

}
}
elseif($cantidad1 > 0)
{
$row1= mysql_fetch_assoc($ejecuta1);
switch($row1['estado'])
{
case 'pendiente':
echo '<div class="amigos">
<form action="agregara.php" method="post">
<input type="hidden" name="id" value="'.$reg['correo'].'">
<input type="hidden" name="accion" value="modificar">
<input type="submit" value="Aceptar petición">
</form>
</div>';
echo $correo;
break;
case 'aceptado':
echo '<a href="perfil.php?correo='.$correo.'">ir</a>';
break;
}
}
else
{
echo '<div class="amigos">
<form action="./agr.php" method="post">
<input type="hidden" name="id" value="'.$correo.'">
<input type="hidden" name="accion" value="insertar">
<input type="submit" value="Agregar Amigos">
</form>
</div>';

}
}
function quepienso($correo){
include("./config.php");

$descriptor_qp=fopen("../queopinas/$correo","r");

echo '<center><table border=1 BACKGROUND="../img/cuaderno.png" WIDTH="80%" HEIGHT="200%" class="cuaderno"><td ALIGN=left VALIGN=top>';

$entrada=0;



while($linea=fgets($descriptor_qp)){

if(ereg("-----------",$linea)){
	$entrada=($entrada);
	if($entrada==$entradas_max){

		die;
	}

}


	if(ereg("<<",$linea)){
		$vector_correo=explode("-",$linea);
		$correo_persona=$vector_correo[1];

	}elseif(ereg(">>",$linea)){
		$vector_linea=explode("-",$linea);
		$espacio=chr(32);
		$linea_lista=implode($espacio,$vector_linea);
			if(trim($correo_persona)=="Kimvex"){
				echo '<IMG SRC="../fotos/Kimvex.jpg" ALT="Foto" BORDER=1 WIDTH=50 HEIGTH=60>
					<b><i><h4>'.$linea_lista.'</h4></i></b>   ';
			}elseif(trim($correo_persona)==trim($correo)){

				echo '<IMG SRC="../imgperfil/'.$correo.'.jpg" ALT="Foto" BORDER=1 WIDTH=50 HEIGTH=60>
					<b><i><h4>'.$linea_lista.'</h4></i></b>   ';

			}else{

				echo '<a href="./publick.php?correo='.$correo_persona.'" target="_self" class="cuaderno_link"><IMG SRC="../imgperfil/'.$correo_persona.'.jpg" ALT="Foto" BORDER=1 WIDTH=50 HEIGTH=60>
					<b><i><h4>'.$linea_lista.'</a></h4></i></b>   ';

			}

	}elseif(ereg("-----",$linea)){
		echo "<br><center><b>$linea</b></center><br>";
		
		}else{
		echo "$linea<br>";
	}
}

echo '</td></table></center><A NAME="final"></A>';


fclose($descriptor_qp);




}
function escribir_quepienso($correo_from,$correo_to,$texto){
	
	
	$datos_from =  SUBTRAER_INFORMACION($correo_from);
	
	$descriptor_qp_obtener = fopen("../queopinas/$correo_to","r");		
	
	while(!feof($descriptor_qp_obtener)){
		
		$pre=fgets($descriptor_qp_obtener);
		
		$qp = $qp.$pre;
	}
	
	
	$intro_correo ="<<-$correo_from";
	
	$intro="$datos_from[0]-$datos_from[1]->>";
	
	$descriptor_qp=fopen("../queopinas/$correo_to","w");
	
	fwrite($descriptor_qp,trim($intro_correo)."\n");
	fwrite($descriptor_qp,trim($intro)."\n");
	
	$contar=0;
	
	$valor=80;
	
	for($a=0;$a<100;$a++){
		
		
		if(isset($texto[$a])){
			
			if($contar==$valor){
				
				fwrite($descriptor_qp,"\n");
				$valor=($valor+80); $a=($a-1);
			}else{
				
				fwrite($descriptor_qp,"$texto[$a]");
				
			}
			$contar=($contar+1);
			
		}else{}
		
	}
	
	
	fwrite($descriptor_qp,"\n");
	fwrite($descriptor_qp,"--------------------------------\n");
	fwrite($descriptor_qp,"$qp");
	fclose($descriptor_qp);
	
	
}

function nu(){
	
error_reporting(0);

include("./config.php"); // Incluimos la configuracion

$conexion_mysql = mysql_connect($mysql_host,$mysql_user,$mysql_pass); //conectamos con la base de datos

mysql_select_db($mysql_db,$conexion_mysql); //seleccionamos la base de datos 

$consulta = "select id_logueado from amigos where id_amigo='$correo' and Estado='1'"; // elaboramos la consulta

$query = mysql_query($consulta,$conexion_mysql);  // elaboramos la consulta

$i=0;

while(mysql_result($query,$i,0)){
if($query['Estado'] == '1'){
$array_correos[]=mysql_result($query,$i,0);
$query['Estado'];
$i=($i+1);
}
}


return($array_correos);
}

function cht($correo)

{
include('./lis.php');




}
function chtcel($correo)

{
include('./lis.php');




}