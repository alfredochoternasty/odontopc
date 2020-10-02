<?php include_partial('global/cabecera_impresion') ?>
<h1 id="header" style="width:100%;text-align:center;margin-top:2.5em">Listado de Ventas</h1>
<?php if ($hasFilters->count() > 0) include_partial('admins/filtro_usado', array('configuration' => $configuration, 'filters' => $filters, 'hasFilters' => $hasFilters)) ?>
<table border="1" cellspacing="0" cellpadding="1" width="100%">
  <tr>
    <th style="background: #CCC;">Venta</th>
    <th style="background: #CCC;">Fecha</th>
    <th style="background: #CCC;">Cliente</th>
    <th style="background: #CCC;">Producto</th>
    <th style="background: #CCC;">Precio</th>
    <th style="background: #CCC;">Cant.</th>
    <th style="background: #CCC;">Neto</th>
    <th style="background: #CCC;">iva</th>
    <th style="background: #CCC;">Total</th>
    <th style="background: #CCC;">Lote</th>
  </tr>
  <?php $suma_total = $suma_neto = $suma_iva = $suma_cantidad = 0; ?>
  <?php foreach($listado as $fila):
    if ($fila->cantidad > 0) :
  ?>
  <tr>
    <?php 
        $suma_total += $fila->getDetalleResumen()->total;
        $suma_neto += $fila->getDetalleResumen()->precio * ($fila->cantidad);
        $suma_iva += $fila->getDetalleResumen()->iva;
        $suma_cantidad += $fila->cantidad;
    ?>
    <td><?php echo $fila->getResumen() ?></td>
    <td><?php echo implode("/", array_reverse(explode("-", $fila->getFecha()))) ?></td>
    <td><?php echo $fila->getCliente() ?></td>
    <td><?php echo $fila->getProducto() ?></td>
    <td><?php echo '$ '.sprintf("%01.2f", $fila->getDetalleResumen()->precio) ?></td>
    <td><?php echo $fila->getCantidad() ?></td>
    <td><?php echo '$ '.sprintf("%01.2f", $fila->getDetalleResumen()->precio * ($fila->cantidad)) ?></td>
    <td><?php echo '$ '.sprintf("%01.2f", $fila->getDetalleResumen()->iva) ?></td>
    <td><?php echo '$ '.sprintf("%01.2f", $fila->getDetalleResumen()->total) ?></td>
    <td><?php echo $fila->getNroLote() ?></td>
  </tr>
  <?php endif; ?> 
  <?php endforeach; ?> 
  <tr>
    <td colspan="5"></td>
    <td><?php echo $suma_cantidad ?></td>
    <td><?php echo '$ '.sprintf("%01.2f", $suma_neto) ?></td>
    <td><?php echo '$ '.sprintf("%01.2f", $suma_iva) ?></td>
    <td><?php echo '$ '.sprintf("%01.2f", $suma_total) ?></td>
    <td></td>
  </tr>
</table>
<?php include_partial('global/pie_impresion') ?>