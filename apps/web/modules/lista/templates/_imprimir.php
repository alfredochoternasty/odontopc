<html>
<head>
</head>
<body>
<div id="header">
  <table>
    <tr>
      <td>Listado de Productos</td>
      <td style="text-align: right;">NTI Implantes</td>
    </tr>
  </table>
</div>

<div id="footer">
  <div class="page-number"></div>
</div>

<table border="1" cellspacing="0" cellpadding="1" width="100%">
  <tr>
    <th style="background: #CCC;">Grupo</th>
    <th style="background: #CCC;">Producto</th>
    <th style="background: #CCC;">Precio Venta</th>
  </tr>
  <?php $count = 0;
  foreach($listas as $lista):
    $count++;
  ?>
  <tr>
		<td><?php echo empty($lista->grupo_id)?$lista->getProducto()->getGrupo():$lista->getGrupo() ?></td>
    <td><?php echo empty($lista->producto_id)?$lista->getProductoGrupo():$lista->getProducto() ?></td>
    <td><?php echo $lista->getMoneda()->getSimbolo().' '.sprintf("%01.2f", $lista->getPrecio()) ?></td>
  </tr>
  <?php 
    if($count == 43){
      $count = 0;
      ?>
      </table>
      <br />
      <table border="1" cellspacing="0" cellpadding="1" width="100%">
        <tr>
          <th width="20%" style="background: #CCC;">Grupo</th>
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