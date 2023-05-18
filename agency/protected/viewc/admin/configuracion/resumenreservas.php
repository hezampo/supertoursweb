<?php

require_once("dompdf/dompdf_config.inc.php");
/**
 * Created by Arturo Bustamante M.
 * User: elite2016
 * Date: 18/02/16
 * Time: 13:42 PM
 */
set_time_limit(320);
ini_set('memory_limit', '356M');
/*Doo::loadController('I18nController');*/
ob_start();
//Doo::loadController('admin/ToursController');
/*Doo::loadModel('Reserve');*/
/*Doo::loadModel('Clientes');*/

//Doo::loadModel('Hotel_Reserves');
/*Doo::loadHelper('DooFile');*/


$conexion = mysql_connect("localhost", "root", "");
mysql_select_db("carlos_supertours", $conexion);


$codigoHTML = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<body>
<table width="100%" border="0" cellspacing="8" cellpadding="1">
  <tr>
     <td colspan="2"  bgcolor="skyblue"><CENTER><strong>TRANSPORTACION</strong></CENTER></td>
  
  </tr>
  ';



$sql = mysql_query("SELECT   r1.firsname as nombre,r1.lasname as apellido,r1.email, c2.phone,r1.pax as adult,r1.pax2 as child, r1.pax3 as inf, r1.fecha_salida, p1.place as lugar1, p1.address as direccion1, r1.deptime1, p2.place as lugar2, p2.address as direccion2,
	 r1.trip_no,  r1.fecha_retorno, p3.place as lugar3, p3.address as direccion3,
	 r1.deptime2, p4.place as lugar4, p4.address as direccion4, r1.trip_no2, r1.codconf FROM reservas r1
	 
					LEFT JOIN clientes c2 ON (r1.id_clientes=c2.id) 
					LEFT JOIN pickup_dropoff P1 ON (r1.pickup1=p1.id) 
					LEFT JOIN Pickup_dropoff P2 ON (r1.dropoff1=p2.id) 
					LEFT JOIN pickup_dropoff P3 ON (r1.pickup2=p3.id) 
					LEFT JOIN Pickup_dropoff P4 ON (r1.dropoff2=p4.id)
					
					WHERE r1.id='21171';");
while ($res = mysql_fetch_array($sql)) {
    $codigoHTML.='	
	<tr>
          
			<td><strong>NOMBRE:</strong></td>
            <td>' . $res['nombre'] . '</td>
        </tr>
        <tr>
            <td><strong>APELLIDO:</strong></td>
            <td>' . $res['apellido'] . '</td>
        </tr>
        <tr>
            <td><strong>E-MAIL:</strong></td>		
            <td>' . $res['email'] . '</td>               
        </tr>
        <tr>
            <td><strong>TELEFONO:</strong></td>		
            <td>' . $res['phone'] . '</td>               
        </tr>
        <tr>
            <td><strong>ADULT:</strong></td>		
            <td>' . $res['adult'] . '</td>               
        </tr>
        <tr>
            <td><strong>CHILD:</strong></td>		
            <td>' . $res['child'] . '</td>               
        </tr>
        <tr>
            <td><strong>INFANT:</strong></td>		
            <td>' . $res['inf'] . '</td>               
        </tr>
        <tr>
            <td><strong>FECHA DE SALIDA:</strong></td>		
            <td>' . $res['fecha_salida'] . '</td>               
        </tr>
        <tr>
            <td><strong>DESDE:</strong></td>		
            <td>' . $res['lugar1'] . '</td>               
        </tr>
        <tr>
            <td><strong>DIRECCION:</strong></td>		
            <td>' . $res['direccion1'] . '</td>               
        </tr>
        <tr>
            <td><strong>HORA DE SALIDA:</strong></td>		
            <td>' . $res['deptime1'] . '</td>               
        </tr>
        <tr>
            <td><strong>HASTA:</strong></td>		
            <td>' . $res['lugar2'] . '</td>               
        </tr>
        <tr>
            <td><strong>DIRECCION:</strong></td>		
            <td>' . $res['direccion2'] . '</td>               
        </tr>
        <tr>
            <td><strong>TRIP:</strong></td>		
            <td>' . $res['trip_no'] . '</td>               
        </tr>
        <tr>
            <td><strong>FECHA DE RETORNO:</strong></td>		
            <td>' . $res['fecha_retorno'] . '</td>               
        </tr>
        <tr>
            <td><strong>DESDE:</strong></td>		
            <td>' . $res['lugar3'] . '</td>               
        </tr>
        <tr>
            <td><strong>DIRECCION:</strong></td>		
            <td>' . $res['direccion3'] . '</td>               
        </tr>
        <tr>
            <td><strong>RETORNO:</strong></td>		
            <td>' . $res['deptime2'] . '</td>               
        </tr>
        <tr>
            <td><strong>HASTA:</strong></td>		
            <td>' . $res['lugar4'] . '</td>               
        </tr>
        <tr>
            <td><strong>DIRECCION:</strong></td>		
            <td>' . $res['direccion4'] . '</td>               
        </tr> 
        <tr>
            <td><strong>TRIP:</strong></td>		
            <td>' . $res['trip_no2'] . '</td>               
        </tr>       
        <tr>
            <td><strong>COD CONFIRMACION:</strong></td>
            <td>' . $res['codconf'] . '</td>										
	</tr>';
}
$codigoHTML.='
</table>
</body>
</html>';
$codigoHTML = utf8_encode($codigoHTML);
$dompdf = new DOMPDF();
$dompdf->load_html($codigoHTML);
ini_set("memory_limit", "256M");
$dompdf->render();
$dompdf->stream("Resumen Transportation.pdf");
?>
