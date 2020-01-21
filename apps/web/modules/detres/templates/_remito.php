<html>
<head>
</head>
<body>
<h2>Remito Nro: &nbsp;&nbsp;<?php echo $resumen->getId() ?></h2>
<p><b>Nombre y Apellido:</b>&nbsp;&nbsp;<?php echo $resumen->getCliente() ?></p>
<?php 
$ped = $resumen->getPedidoId();
if(!empty($ped)){ ?>
  <p><b>N� de Pedido:</b>&nbsp;&nbsp;<?php echo $ped; ?></p>
<?php 
}
?>
<p><b>Fecha :</b>&nbsp;&nbsp;<?php echo date("d/m/Y", strtotime($resumen->getFecha())) ?></p>
<table border="1" cellspacing="0" cellpadding="1" width="100%">
  <tr>
    <th style="background: #CCC;">Producto</th>
    <th style="background: #CCC;">Cantidad</th>
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
    <td><?php echo $detalle->getNroLote() ?></td>
    <td><?php echo implode('/', array_reverse(explode('-', $detalle->getLote()->getFechaVto()))) ?></td>
  </tr>
  <?php endforeach;?>
</table>
<br/>

</body>
<html>