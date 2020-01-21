<html>
<head>
</head>
<body>
<h2>Venta Nro: &nbsp;&nbsp;<?php echo $resumen->getId() ?></h2>
<p><b>Nombre y Apellido:</b>&nbsp;&nbsp;<?php echo $resumen->getCliente() ?></p>
<?php 
$ped = $resumen->getPedidoId();
if(!empty($ped)){ ?>
  <p><b>N? de Pedido:</b>&nbsp;&nbsp;<?php echo $ped; ?></p>
<?php 
}
?>
<p><b>Fecha :</b>&nbsp;&nbsp;<?php echo date("d/m/Y", strtotime($resumen->getFecha())) ?></p>
<table border="1" cellspacing="0" cellpadding="1" width="100%">
  <tr>
    <th style="background: #CCC;">Producto</th>
    <th style="background: #CCC;">Precio Unitario</th>
    <th style="background: #CCC;">Cantidad</th>
    <th style="background: #CCC;">Subtotal</th>
    <th style="background: #CCC;">Descuento</th>
    <th style="background: #CCC;">Total</th>
    <th style="background: #CCC;">Lote</th>
  </tr>
  <?php 
  foreach($resumen->getDetalle() as $detalle):
	$moneda = $resumen->getLista()->getMoneda()->getSimbolo()
  ?>
  <tr>
    <td><?php
		echo  utf8_decode($detalle->getProducto());
    ?></td>
    <td><?php echo $detalle->PrecioFormato() ?></td>
    <td><?php echo $detalle->getCantidad() ?></td>
    <td><?php echo $detalle->SubTotalFormato() ?></td>
    <td><?php echo empty($detalle->descuento)? '':$detalle->descuento.'%' ?></td>
    <td><?php echo $detalle->TotalFormato() ?></td>
    <td><?php echo $detalle->getNroLote() ?></td>
  </tr>
  <?php endforeach;?>
  <tr>
    <td colspan="4">&nbsp;</td>
    <td style="background: #CCC;">Total:&nbsp;</td>
    <td><?php echo $resumen->getTotalResumenFormato() ?></td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
<html>