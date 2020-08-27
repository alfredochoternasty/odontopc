<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title>Listado de Inscriptos</title>
</head>
<body>

<table border="1" cellspacing="0" cellpadding="1" width="100%">
  <tr>
    <th colspan="5"><?php echo $inscriptos[0]->getCurso(); ?></th>
  </tr>
  <tr>
    <th style="background: #CCC;">&nbsp;</th>
    <th style="background: #CCC;">Nombre</th>
    <th style="background: #CCC;">Email</th>
    <th style="background: #CCC;">Tipo Insc.</th>
    <th style="background: #CCC;">Fecha Insc.</th>
  </tr>
  <?php $count = 0;
  foreach($inscriptos as $inscripto):
    $count++;
  ?>
  <tr>
    <td><?php echo $count ?></td>
    <td><?php echo $inscripto->getNombre() ?></td>
    <td><?php echo $inscripto->getCorreo() ?></td>
    <td><?php echo $inscripto->getTipoInscripcion() ?></td>
    <td><?php echo implode('/', array_reverse(explode('-', $inscripto->getFecha()))) ?></td>    
  </tr>
  <?php 
    if($count == 42 || $count == 84 || $count == 124){
      ?>
      </table>
      <br><br>
      <table border="1" cellspacing="0" cellpadding="1" width="100%">
        <tr>
          <th colspan="5"><?php echo $inscriptos[0]->getCurso(); ?></th>
        </tr>      
        <tr>
          <th style="background: #CCC;">&nbsp;</th>
          <th style="background: #CCC;">Nombre</th>
          <th style="background: #CCC;">Email</th>
          <th style="background: #CCC;">Tipo Insc.</th>
          <th style="background: #CCC;">Fecha Insc.</th>
        </tr>
      <?php    
    }
  endforeach;
  ?>
</table>
</body>
<html>