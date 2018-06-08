<html>
<head>
</head>
<body>
<h2>Cantidad de Productos Vendidos Facturados</h2>
<table border="1" cellspacing="0" cellpadding="1">
  <tr>
    <th style="background: #CCC;">Fecha</th>
    <th style="background: #CCC;">Producto</th>
    <th style="background: #CCC;">Cantidad</th>
  </tr>
  <?php 
	$ver_solo_totales = $sf_user->getAttribute('totales', false) ;
    $cant = 0;
    $prod = '';  
    foreach($vta_fact as $vta):
      $aux = $vta->getProducto();
      if($aux <> $prod): 
        if($cant > 0): ?>
        <tr>
          <td>&nbsp;</td>
          <td><b>Total de <?php echo utf8_decode($prod) ?></b></td>
          <td><b><?php echo $cant ?></b></td>
        </tr>
      <?php endif;
	  if(!$ver_solo_totales):
	  ?>
        <tr>
          <td colspan="3"><b><?php echo utf8_decode($vta->getNombreProd()) ?></b></td>
        </tr>
      <?php     
	  endif;
        $prod = $aux;
        $cant = 0;
      endif;
      $cant += $vta->getCantidad();
	  if(!$ver_solo_totales):
      ?>
        <tr>
          <td><?php echo $vta->getFecha() ?></td>
          <td><?php echo utf8_decode($vta->getNombreProd()) ?></td>
          <td><?php echo $vta->getCantidad() ?></td>
        </tr>
	  
  <?php endif;
	endforeach;?>
        <tr>
          <td>&nbsp;</td>
          <td><b>Total de <?php echo utf8_decode($prod) ?></b></td>
          <td><b><?php echo $cant ?></b></td>
        </tr>
  <tr>
    <td colspan='3'> fecha impresión <?php echo date('d/m/Y')?></td>
  </tr>
</table>
</body>
<html>