<html>
<head>
<style type="text/css">
body {font-family:sans-serif; font-size:0.7em;}
#filtro_utilizado {font-size:0.6em;margin-bottom:0.9em;}
#header {margin-bottom:0.1em;}
.page-number {text-align: right;}
.page-number:before {content: "Página " counter(page);}
hr {page-break-after: always;border: 0;}
#footer1 {position:fixed; bottom:0; left:0; width:70%; font-size: 0.5em;}
#footer2 {position:fixed; bottom:0; right:0; width:20%}
</style>
</head>
<body>
<img src="images/logo_nti.png" width=204 height=77 style="position:absolute;left:0;top:-20;">
<h2 id="header" style="width:100%;text-align:center;margin-top:2.5em">Listado de Ventas</h2>
<?php if ($hasFilters->count() > 0) include_partial('admins/filtro_usado', array('configuration' => $configuration, 'filters' => $filters, 'hasFilters' => $hasFilters)) ?>
<div id="footer1">Impreso por: <?php echo $sf_user.' ('.date("d/m/Y H:i:s").')' ?></div>
<div id="footer2" class="page-number"></div>
<div id="content">
<table border="1" cellspacing="0" cellpadding="1">
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
  <?php $suma_total = 0; ?>
  <?php foreach($listado as $fila):
    if ($fila->cantidad > 0) :
  ?>
  <tr>
    <?php $suma_total += $fila->getTotal(); ?>
    <td><?php echo $fila->getResumen() ?></td>
    <td><?php echo implode("/", array_reverse(explode("-", $fila->getFecha()))) ?></td>
    <td><?php echo $fila->getCliente() ?></td>
    <td><?php echo $fila->getNombre() ?></td>
    <td><?php echo '$ '.sprintf("%01.2f", $fila->getPrecio()) ?></td>
    <td><?php echo $fila->getCantidad() ?></td>
    <td><?php echo '$ '.sprintf("%01.2f", $fila->getSubTotal()) ?></td>
    <td><?php echo '$ '.sprintf("%01.2f", $fila->getIva()) ?></td>
    <td><?php echo '$ '.sprintf("%01.2f", $fila->getTotal()) ?></td>
    <td><?php echo $fila->getNroLote() ?></td>
  </tr>
  <?php endif; ?> 
  <?php endforeach; ?> 
</table>
<?php include_partial('global/pie_impresion') ?>