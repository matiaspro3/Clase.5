<?php

/*	1- si es un ingreso lo guardo en ticket.txt
 	2- si es salida leo el archivo:
 	leer del archivo todos los datos, guardarlos en un array
	si la patente existe en el archivo .
	 sobreescribo el archivo con todas las patentes
	 y su horario si la patente solicitada
	... calculo el costo de estacionamiento a 
	20$ el segundo y lo muestro.
	si la patente no existe mostrar mensaje y 
	el boton que me redirija al index  
	3- guardar todo lo facturado en facturado.txt*/
//var_dump($_POST['estacionar']);
//var_dump($_POST);

//var_dump($_FILES);

//var_dump($_FILES['name']);

//------------------------------------------cargar foto--------------------
//var_dump($_FILES);

//var_dump($_FILES['name']);


//var_dump($archivo_destino);

//move_uploaded_file(ruta TEmporal Del Servidor,destino creado arriba)
	//$archivo_destino="Fotitos/".$_FILES['fotoAutito']['name'];
//move_uploaded_file($_FILES['fotoAutito']['tmp_name'], $archivo_destino);



/*

//grabar el archivo con el nombre de la patente mas la exten. que le doy.
$archivo_ext=$_FILES['fotoAutito']['name'];
$archivo_ext2=explode(".", $archivo_ext);
$patente=$_POST['patente'];
$archivo_destino2="Fotitos/".$patente.".".$archivo_ext2[1];
//var_dump($archivo_destino2);
//move_uploaded_file(ruta TEmporal Del Servidor,destino creado arriba)
move_uploaded_file($_FILES['fotoAutito']['tmp_name'], $archivo_destino2);
*/




//die();//termina aca 
////------------------------------------------cargar foto fin--------------------
$accion=$_POST['estacionar'];
$patente=$_POST['patente'];
$ahora=date("y-m-d h:i:s");
$listaDeAutos=array();
$listaAx=array();

//var_dump($accion);
if($accion=="ingreso")
{
	echo "Se guardo la patente $patente";
	$archivo_ext=$_FILES['fotoAutito']['name'];
	$archivo_ext2=explode(".", $archivo_ext);
	$archivo_destino2="Fotitos/".$patente.".".$archivo_ext2[1];
	move_uploaded_file($_FILES['fotoAutito']['tmp_name'], $archivo_destino2);

	$archivo=fopen("ticket.txt", "a");
	fwrite($archivo, $patente."@@@@".$ahora."@@@@".$archivo_destino2."\n");
	fclose($archivo);

}
else
{
 	$archivo=fopen("ticket.txt", "r");
 	while (!feof($archivo)) {
 		$renglon=fgets($archivo);
 		$auto=explode("@@@@", $renglon);
 		if ($auto[0]!="")
 				$listaDeAutos[]=$auto;

 	}
 	//var_dump($listaDeAutos);
 	fclose($archivo);
 	$esta=false;
 	foreach ($listaDeAutos as $auto) {
 		//echo $auto[0]."<br>";
 		//echo $auto[1]."<br>";
 		if ($auto[0] ==$patente)
 		{
 			$esta =true;
 			$fechainicio=$auto[1];
 			$diferencia=strtotime($ahora)-strtotime($fechainicio); //funcion que convierte el datetime en string
			echo "el tiempo trasncurrido es $diferencia <br>";
			//precio

 		}
 		else
 		{
 			if ($auto[0]!="") {
 				$listaAx[]=$auto;
 			}
 		}

 	}
//var_dump($listaAx[0]);
 	if ($esta)
 		{	

 			echo "El auto esta";

 			$archivo=fopen("ticket.txt", "w");
 			foreach ($listaAx as $auto) {
 				fwrite($archivo, $auto[0]."@@@@".$auto[1]."@@@@".$archivo_destino2."\n");
				

 			}	fclose($archivo);




		}
 		else echo "El auto NOOO esta";


	///echo "NO se guardo la patente $patente asdasdasd";




}
/* crea la tabla*/

$archivo=fopen("ticket.txt", "r");
echo "<table border=1>";
echo "<TH> Patente </TH><TH> Fecha </TH><TH> Foto </TH>";	//th =columnas ..tr=filas...td=datos
while (!feof($archivo)) {
 		$renglon=fgets($archivo);
 		$auto=explode("@@@@", $renglon);
 		if ($auto[0]!="")
 		{
 			echo "<tr>";
 		    //echo"<td>$auto[0]</td><td>$auto[1]</td><td>$auto[2]</td>";
 			//para mostras foto
 			echo"<td>$auto[0]</td><td>$auto[1]</td><td><img src=$auto[2] height=150 wight=150 ></td>"; // le agreggo el hig y el wight para que sea mas chicas
 			echo "</tr>";
 		}
 	}
 	fclose($archivo);
echo "</table>"
/* crea la tabla*/

/*muetsra las cosas 

$archivo=fopen("ticket.txt", "r");

while (!feof($archivo)) {
 		$renglon=fgets($archivo);
 		$auto=explode("@@@@", $renglon);
 		if ($auto[0]!="")
 		//echo" <br><br><br>".$auto[0]."--".$auto[1]."--".$auto[2];
 		
 	
 	}
 	fclose($archivo);

muetsra las cosas */


?>
<br>
<br>
<a href="index.php">volver</a>
