<html>
<head>
</head>
<body>
<h2>Detalle</h2>
<p><b>Nombre y Apellido:</b>&nbsp;&nbsp;<?php echo $resumen->getCliente() ?></p>
<p><b>Nro:</b>&nbsp;&nbsp;<?php echo $resumen->getId() ?></p>
<?php 
$ped = $resumen->getPedidoId();
if(!empty($ped)){ ?>
  <p><b>Nº de Pedido:</b>&nbsp;&nbsp;<?php echo $ped; ?></p>
<?php 
}
?>
<p><b>Fecha :</b>&nbsp;&nbsp;<?php echo date("d/m/Y", strtotime($resumen->getFecha())) ?></p>
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
    <th style="background: #CCC;">Bonificados</th>
    <th style="background: #CCC;">Lote</th>
    <th style="background: #CCC;">Fecha Vto</th>
  </tr>
  <?php 
  foreach($resumen->getDetalle() as $detalle):
	$moneda = $resumen->getLista()->getMoneda()->getSimbolo()
  ?>
  <tr>
    <td><?php
      $iva = $detalle->getObservacion();
      if(!empty($iva)) $iva .= " - ";
      echo  $iva.$detalle->getProducto();
    ?></td>
    <td><?php echo $detalle->getCantidad() ?></td>
    <td><?php echo $detalle->PrecioFormato() ?></td>
    <?php if($sf_user->hasGroup('Blanco')): ?>    
      <td><?php echo $detalle->SubTotalFormato() ?></td>
      <td><?php echo $detalle->IvaFormato() ?></td>      
    <?php endif; ?>
    <td><?php echo $detalle->TotalFormato() ?></td>
    <td><?php echo $detalle->getBonificados() ?></td>
    <td><?php echo $detalle->getNroLote() ?></td>
    <td><?php echo implode('/', array_reverse(explode('-', $detalle->getLote()->getFechaVto()))) ?></td>
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
    <td><?php echo $resumen->getTotalResumenFormato() ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
<html>