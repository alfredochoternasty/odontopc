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
<h2 id="header" style="width:100%;text-align:center;margin-top:2.5em">Listado de Ventas (solo totales) - <?php echo $listado[0]->getZona() ?></h2>
<?php if ($hasFilters->count() > 0) include_partial('admins/filtro_usado', array('configuration' => $configuration, 'filters' => $filters, 'hasFilters' => $hasFilters)) ?>
<div id="footer1">Impreso por: <?php echo $sf_user.' ('.date("d/m/Y H:i:s").')' ?></div>
<div id="footer2" class="page-number"></div>
<div id="content">
<table border="1" cellspacing="0" cellpadding="1" width="100%">
  <tr>
    <th style="background: #CCC;">Grupo</th>
    <th style="background: #CCC;">Producto</th>
    <th style="background: #CCC;">Vendido</th>
    <th style="background: #CCC;">Bonificados</th>
    <th style="background: #CCC;">Devueltos</th>
  </tr>
  <?php 
  
					$suma_total = 0;
					$suma_total_bon = 0;
					$suma_total_dev = 0;
					foreach ($listado as $vtas) {
						if (empty($ventas[$vtas->producto_id])) {
							if ($vtas->cantidad > 0) {
								$ventas[$vtas->producto_id] = array(
									'grupo' => $vtas->getGrupo(),
									'producto' => $vtas->getProducto(),
									'cantidad' => $vtas->cantidad,
									'bono' => 0,
									'dev' => 0,
								);
							} else {
								$ventas[$vtas->producto_id] = array(
									'grupo' => $vtas->getGrupo(),
									'producto' => $vtas->getProducto(),
									'cantidad' => 0,
									'bono' => 0,
									'dev' => ($vtas->cantidad * -1)?:0,
								);								
							}
						} else {
							if ($vtas->cantidad > 0) {
								$ventas[$vtas->producto_id]['cantidad'] += $vtas->cantidad;
								$ventas[$vtas->producto_id]['bono'] += 0;
							} else {
								$ventas[$vtas->producto_id]['dev'] += $vtas->cantidad * -1;
							}
						}
						if ($vtas->cantidad > 0) {
							$suma_total += $vtas->cantidad;
							$suma_total_bon += 0;
						} else {
							$suma_total_dev += $vtas->cantidad * -1;
						}
					}
					sort($ventas);
					foreach ($ventas as $vta): ?>
							<tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
								<td><?php echo $vta['grupo'] ?></td>
								<td><?php echo $vta['producto'] ?></td>
								<td><?php echo $vta['cantidad'] ?></td>
								<td><?php echo 0 ?></td>
								<td><?php echo $vta['dev'] ?></td>
							</tr>
        <?php endforeach;?>
  <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
    <td colspan="2" style="text-align: right; font-size:20px;"><b>Subtotal: </b> </td>
    <td style="font-size:20px;"><b><?php echo $suma_total ?></b></td>
    <td style="font-size:20px;"><b><?php echo $suma_total_bon ?></b></td>
    <td style="font-size:20px;"><b><?php echo $suma_total_dev ?></b></td>
  </tr>
  <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
<td colspan="5">&nbsp;</td>
  </tr>
  <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
    <td colspan="2" style="text-align: right; font-size:34px;"><b>Total: </b></td>
    <td colspan="3" style="font-size:34px;"><b><?php echo $suma_total + $suma_total_bon - $suma_total_dev ?></b></td>
  </tr>
</table>
<?php include_partial('global/pie_impresion') ?>