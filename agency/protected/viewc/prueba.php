<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
</head>
<?php print_r($data['lista']);

?>
<body>
<div align="center"><table width="200" border="1">
  <tr>
    <td width="65">Nombre</td>
    <td width="93">Apellido</td>
    <td width="20">E_mail</td>
  </tr>
  <tr>
  <?php  


  foreach($data['lista'] as $e):    ?>
         <tr>
    <td><?php  echo $e['nombre'];?></td>
    <td><?php  echo $e['apellido'];?></td>
    <td><?php  echo $e['correo'];?></td>
    </tr>
    <?php endforeach;?>
    
  
</table>

</div>
</body>
</html>
