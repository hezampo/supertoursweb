<?php

include 'ClienteController.php'; 


$usuario = new ClienteController(); 
echo $usuario ->index();






/*if(isset($_POST['term'])) {
	$term = $_POST['term'];
	
	$conexion = mysql_connect("localhost","root","")
or die ("Fallo en el establecimiento de la conexi�n");


mysql_select_db("supertourdb")
or die("Error en la selecci�n de la base de datos");

$sql ="select username from clientes where username LIKE '%$term%' ORDER BY username ASC LIMIT 7";

mysql_query($sql);
$result = mysql_query($sql) or die("La siguiente consulta contiene alg�n error:<br>nSQL: <b>$sql</b>");
while ($row = mysql_fetch_array($result))

{ 
echo $row['username']."<br/><br/>"; 
}
	echo "capturando";
		}	
	else { echo "no capturado";}
 
*/
?>












