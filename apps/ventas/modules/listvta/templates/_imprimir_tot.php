<?php include_partial('global/cabecera_listado', array('titulo' => 'Listado de Ventas (solo totales)', 'configuration' => $configuration, 'filters' => $filters, 'hasFilters' => $hasFilters)) ?>
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
<?php include_partial('global/pie_listado') ?>