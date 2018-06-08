<html>
<head>
</head>
<body>
<p><b>Nro:</b>&nbsp;&nbsp;<?php echo $detcomp[0]->getCompra()->getNumero() ?></p>
<p><b>Fecha :</b>&nbsp;&nbsp;<?php echo date("d/m/Y", strtotime($detcomp[0]->getCompra()->getFecha())) ?></p>
<table border="1" cellspacing="0" cellpadding="1">
  <tr>
    <th style="background: #CCC;">Producto</th>
    <th style="background: #CCC;">Cantidad</th>
    <th style="background: #CCC;">Precio Unitario</th>
    <?php if($sf_user->hasGroup('Blanco')): ?>    
      <th style="background: #CCC;">Sub Total</th>
      <th style="background: #CCC;">Iva</th>
    <?php endif; ?>    
    <th style="background: #CCC;">Total</th>
    <th style="background: #CCC;">Lote</th>
  </tr>
  <?php 
  foreach($detcomp as $detalle):
	$moneda = $detalle->getCompra()->getMoneda()->getSimbolo()
  ?>
  <tr>
    <td><?php echo $detalle->getProducto() ?></td>
    <td><?php echo $detalle->getCantidad() ?></td>
    <td><?php echo $detalle->PrecioFormato() ?></td>
    <?php if($sf_user->hasGroup('Blanco')): ?>    
      <td><?php echo $detalle->SubTotalFormato() ?></td>
      <td><?php echo $detalle->IvaFormato() ?></td>      
    <?php endif; ?>
    <td><?php echo $detalle->TotalFormato() ?></td>
    <td><?php echo $detalle->getNroLote() ?></td>
  </tr>
  <?php endforeach;?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <?php if($sf_user->hasGroup('Blanco')): ?>    
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    <?php endif; ?>
    <td style="background: #CCC;">Total:&nbsp;</td>
    <td><?php echo $detalle->getCompra()->TotalFormato() ?></td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
<html>