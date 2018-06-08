<html>
<head>
<title>Listado de Productos</title>
</head>
<body>
<div id="header">
  <table>
    <tr>
      <td style="text-align: left;">Lista de Precios</td>
      <td style="text-align: right;">NTI Implantes</td>
    </tr>
  </table>
</div>
<table border="0" cellspacing="0" cellpadding="1" width="100%">
  <tr><td><h1>Lista de Precios</h1></td></tr>
  
  <?php $count = 1;
  $grupo = 0;
  foreach($productos as $producto):
    $count++;
    $aux = $producto->getGrupoprodId();
    if($aux <> $grupo){
      $grupo = $aux;
      $count += 3;
      ?>
      </table><br>
      <table border="1" cellspacing="0" cellpadding="1" width="100%">
        <tr>
          <th colspan="2" style="background: #CCC;"><?php echo $producto->getGrupo() ?></th>
        </tr>            
        <tr>
          <th style="background: #CCC;">Nombre</th>
          <th style="background: #CCC;">Precio Venta</th>
        </tr>      
      <?php
    }
  ?>
  <tr>
    <td><?php echo $producto->getNombre() ?></td>
    <td><?php echo '$ '.sprintf("%01.2f", $producto->getPrecioFinal($lista)) ?></td>
  </tr>
  <?php 
    if($count >= 37){
      $count = 2;
      ?>
      </table>
      <hr>
      <br />
      <table border="1" cellspacing="0" cellpadding="1" width="100%">
        <tr>
          <th colspan="2" style="background: #CCC;"><?php echo $producto->getGrupo() ?></th>
        </tr>                  
        <tr>
          <th width="30%" style="background: #CCC;">Nombre</th>
          <th width="10%" style="background: #CCC;">Precio Venta</th>
        </tr>
      <?php    
    }
  endforeach;
  ?>
</table>
</body>
<html>