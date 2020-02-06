<div class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix">
  <?php //if (!$pager->getNbResults()): ?>
  <?php if (count($hasFilters) == 0): ?>

  <table>
    <caption class="fg-toolbar ui-widget-header ui-corner-top">
            <div id="sf_admin_filters_buttons" class="fg-buttonset fg-buttonset-multi ui-state-default">
        <a href="#sf_admin_filter" id="sf_admin_filter_button" class="fg-button ui-state-default fg-button-icon-left ui-corner-left"><?php echo UIHelper::addIconByConf('filters') . __('Filters', array(), 'sf_admin') ?></a>
        <?php echo link_to(UIHelper::addIconByConf('reset') . __('Reset', array(), 'sf_admin'), 'ventas_zona_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post', 'class' => 'fg-button ui-state-default fg-button-icon-left ui-corner-right')) ?></span>
      </div>
            <h1><span class="ui-icon ui-icon-triangle-1-s"></span> <?php echo __('Ventas por Zona', array(), 'messages') ?></h1>
    </caption>
    <tbody>
      <tr class="sf_admin_row ui-widget-content">
        <td align="center" height="30">
          <p align="center"><?php echo __('Debe elegir un filtro', array(), 'sf_admin') ?></p>
        </td>
      </tr>
    </tbody>
  </table>

  <?php else: ?>
  <?php
    if ($hasFilters->count() > 0) include_partial('admins/filtro_usado', array('configuration' => $configuration, 'filters' => $filters, 'hasFilters' => $hasFilters))
	?>
  <table>
    <caption class="fg-toolbar ui-widget-header ui-corner-top">
      <div id="sf_admin_filters_buttons" class="fg-buttonset fg-buttonset-multi ui-state-default">
        <a href="#sf_admin_filter" id="sf_admin_filter_button" class="fg-button ui-state-default fg-button-icon-left ui-corner-left"><?php echo UIHelper::addIconByConf('filters') . __('Filters', array(), 'sf_admin') ?></a>
        <?php $isDisabledResetButton = ($hasFilters->getRawValue()) ? '' : ' ui-state-disabled' ?>
        <?php echo link_to(UIHelper::addIconByConf('reset') . __('Reset', array(), 'sf_admin'), 'ventas_zona_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post', 'class' => 'fg-button ui-state-default fg-button-icon-left ui-corner-right'.$isDisabledResetButton)) ?></span>
      </div>
      <h1><span class="ui-icon ui-icon-triangle-1-s"></span> <?php echo __('Ventas por Zona', array(), 'messages') ?></h1>
    </caption>

    <thead class="ui-widget-header">
      <tr>
				<th id="sf_admin_list_batch_actions"  class="ui-state-default ui-th-column">
					<input id="sf_admin_list_batch_checkbox" type="checkbox" onclick="checkAll();total_a_pagar();" />
				</th>
        <?php	include_partial('vta_zona/list_th_tabular', array('sort' => $sort)) ?>
				<th class="sf_admin_text ui-state-default ui-th-column"><?php echo __('Descuento', array(), 'messages') ?></th>
				<th class="sf_admin_text ui-state-default ui-th-column"><?php echo __('Total', array(), 'messages') ?></th>
      </tr>
    </thead>

    <tbody>
      <?php 
				$tot_descuento = 0;
				$zona_id = 0;
				foreach ($pager->getResults() as $i => $ventas_zona): $odd = fmod(++$i, 2) ? ' odd' : '' ?>
        <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
					<?php include_partial('vta_zona/list_td_batch_actions', array('ventas_zona' => $ventas_zona, 'helper' => $helper)) ?>
          <?php include_partial('vta_zona/list_td_tabular', array('ventas_zona' => $ventas_zona)); ?>
					<td class="sf_admin_text">
						<?php 
							if (!empty($ventas_zona->grupo_porc_desc)) {
								$descuento = sprintf("%01.2f", $ventas_zona->grupo_porc_desc)." %";
							} elseif (!empty($ventas_zona->prod_porc_desc)) {
								$descuento = sprintf("%01.2f", $ventas_zona->prod_porc_desc)." %";
							} elseif (!empty($ventas_zona->grupo_precio_desc)) {
								$descuento = sprintf("$ %01.2f", $ventas_zona->grupo_precio_desc);
							} elseif (!empty($ventas_zona->prod_precio_desc)) {
								$descuento = sprintf("$ %01.2f", $ventas_zona->prod_precio_desc);
							} else {
								$descuento = '';
							}
							echo $descuento;
					?>
					</td>					
					<td class="sf_admin_text">
						<?php
							// $plata_devuelta = $ventas_zona->getDetalleResumen()->precio * $total_dev;
							if (!empty($ventas_zona->grupo_porc_desc)) {
								$descuento = ($ventas_zona->getDetalleResumen()->sub_total) * $ventas_zona->grupo_porc_desc / 100;
							} elseif (!empty($ventas_zona->prod_porc_desc)) {
								$descuento = ($ventas_zona->getDetalleResumen()->sub_total)  * $ventas_zona->prod_porc_desc / 100;
							} elseif (!empty($ventas_zona->grupo_precio_desc)) {
								$descuento = $ventas_zona->grupo_precio_desc;
							} elseif (!empty($ventas_zona->prod_precio_desc)) {
								$descuento = $ventas_zona->prod_precio_desc;
							} else {
								$descuento = 0;
							}
							echo sprintf("$ %01.2f", $descuento); 
							$tot_descuento += $descuento;
							$zona_id = $ventas_zona->zona_id;
							$array_descuentos[$ventas_zona->id] = $descuento;
						?>					
					</td>
				</tr>
      <?php endforeach;
				$sf_user->setAttribute('comision_zona', $zona_id);
			?>
        <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
					<td colspan="17" style="font-size:20px; text-align:center;" class="sf_admin_text"><b>Total de Comisiones: $ <span id="total_comisiones" style="color:red;">0</span></b></td>
				</tr>
    </tbody>
	</table>
	
  <table>
    <caption class="fg-toolbar ui-widget-header ui-corner-top">
      <h1><span class="ui-icon ui-icon-triangle-1-s"></span> <?php echo __('Devueltos por Zona', array(), 'messages') ?></h1>
    </caption>

    <thead class="ui-widget-header">
      <tr>
				<th id="sf_admin_list_batch_actions"  class="ui-state-default ui-th-column">
					<input id="sf_admin_list_batch_checkbox_dev" type="checkbox" onclick="checkAlldev();total_a_pagar();" />
				</th>
        <?php	include_partial('vta_zona/list_th_tabular_dev', array('sort' => $sort)) ?>
				<th class="sf_admin_text ui-state-default ui-th-column">
					<?php echo __('Descuento', array(), 'messages') ?>
				</th>
				<th class="sf_admin_text ui-state-default ui-th-column">
					<?php echo __('Total', array(), 'messages') ?>
				</th>
      </tr>
    </thead>

    <tbody>
      <?php 
				$q = Doctrine_Core::getTable('DevProducto')->createQuery('d');
				foreach ($configuration->getFormFilterFields($filters) as $name => $field) {
					@$valor = $hasFilters->getRaw($name);
					if ($name == 'fecha') {
						if (array_key_exists('from', $valor) && !empty($valor['from'])) $q->andWhere("d.fecha >= '".$valor['from']."'");
						if (array_key_exists('to', $valor) && !empty($valor['to'])) $q->andWhere("d.fecha <= '".$valor['to']."'");
					}
					if ($name == 'fecha_cobrado') {
						if (array_key_exists('from', $valor) && !empty($valor['from'])) $q->andWhere("d.fecha >= '".$valor['from']."'");
						if (array_key_exists('to', $valor) && !empty($valor['to'])) $q->andWhere("d.fecha <= '".$valor['to']."'");
					}
					if ($name == 'zona_id' && !empty($valor)) $q->andWhere("d.zona_id = $valor");
					if ($name == 'cliente_id' && !empty($valor)) $q->andWhere("d.cliente_id = $valor");
					if ($name == 'producto_id' && !empty($valor)) $q->andWhere("d.producto_id = $valor");
					// if ($name == 'grupoprod_id')
					if ($name == 'nro_lote' && !empty($valor['text'])) $q->andWhere("d.nro_lote = '".$valor['text']."'");
				}
				$q->orderBy('fecha DESC');
				$devueltos = $q->execute();
			
				$tot_descuento = 0;
				$zona_id = 0;
				$array_devueltos = array();
				foreach ($devueltos as $devuelto): ?>
        <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
					<?php include_partial('vta_zona/list_td_batch_actions_dev', array('devuelto' => $devuelto, 'helper' => $helper)) ?>
          <?php include_partial('vta_zona/list_td_tabular_dev', array('devuelto' => $devuelto));?>
					<td class="sf_admin_text">
						<?php
							$grupoprod_id = Doctrine_Core::getTable('Producto')->find($devuelto->producto_id)->grupoprod_id;
							$desc_zona_grupo = Doctrine_Core::getTable('DescuentoZona')->findByZonaIdAndGrupoprodId($devuelto->zona_id, $grupoprod_id);
							$desc_zona_prod = Doctrine_Core::getTable('DescuentoZona')->findByZonaIdAndProductoId($devuelto->zona_id, $devuelto->producto_id);
							
							if (!empty($desc_zona_grupo[0]->porc_desc)) {
								$descuento = sprintf("%01.2f", $desc_zona_grupo[0]->porc_desc)." %";
							} elseif (!empty($desc_zona_prod[0]->porc_desc)) {
								$descuento = sprintf("%01.2f", $desc_zona_prod[0]->porc_desc)." %";
							// } elseif (!empty($grupo_precio_desc)) {
								// $descuento = sprintf("$ %01.2f", $grupo_precio_desc);
							// } elseif (!empty($prod_precio_desc)) {
								// $descuento = sprintf("$ %01.2f", $prod_precio_desc);
							// } else {
								// $descuento = '';
							}
							echo $descuento;
					?>
					</td>					
					<td class="sf_admin_text">
						<?php
							if (!empty($desc_zona_grupo[0]->porc_desc)) {
								$descuento = ($devuelto->precio * $devuelto->cantidad) * ($desc_zona_grupo[0]->porc_desc/100);
							} elseif (!empty($desc_zona_prod[0]->porc_desc)) {
								$descuento = ($devuelto->precio * $devuelto->cantidad) * ($desc_zona_prod[0]->porc_desc/100);
							// } elseif (!empty($grupo_precio_desc)) {
								// $descuento = sprintf("$ %01.2f", $grupo_precio_desc);
							// } elseif (!empty($prod_precio_desc)) {
								// $descuento = sprintf("$ %01.2f", $prod_precio_desc);
							} else {
								$descuento = 0;
							}
							echo sprintf("$ %01.2f", $descuento); 
							$tot_descuento += $descuento;
							$zona_id = $ventas_zona->zona_id;
							$array_devueltos[$devuelto->id] = $descuento;
						?>					
					</td>
				</tr>
      <?php endforeach;	?>
        <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
					<td colspan="17" style="font-size:20px; text-align:center;" class="sf_admin_text"><b>Total Devoluciones: $ <span id="total_restar" style="color:red;">0</span></b></td>
				</tr>
    </tbody>
	</table>
	<table>
    <caption class="fg-toolbar ui-widget-header ui-corner-top">
      <h1><span class="ui-icon ui-icon-triangle-1-s"></span>Total a Pagar</h1>
    </caption>
		<tbody>
        <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
					<td colspan="17" style="font-size:20px; text-align:center;" class="sf_admin_text"><b>Total a Pagar: $ <span id="total_pagar" style="color:red;">0</span></b></td>
				</tr>
		<tbody>
	</table>
  <?php endif; ?>
</div>
<script type="text/javascript">
var descuentos = <?php echo json_encode($array_descuentos, JSON_PRETTY_PRINT) ?>;
var devueltos = <?php echo json_encode($array_devueltos, JSON_PRETTY_PRINT) ?>;
function total_a_pagar() 
{
	var total = 0;
	var comisiones = 0;
	var restar = 0;
	var inputElements = $("input:checked");
	for(var i=0; inputElements[i]; ++i){
		if(inputElements[i].checked && inputElements[i].className == 'sf_admin_batch_checkbox'){
			comisiones += descuentos[inputElements[i].value];
			if (isNaN(comisiones)) 
				comisiones = 0;
		}
		if(inputElements[i].checked && inputElements[i].className == 'sf_admin_batch_checkbox_dev'){
			restar += devueltos[inputElements[i].value];
			if (isNaN(restar)) 
				restar = 0;
		}
	}
	$("#total_comisiones").text(comisiones.toFixed(2));
	$("#total_restar").text(restar.toFixed(2));
	total = comisiones-restar;
	$("#total_pagar").text(total.toFixed(2));
}

function checkAll()
{
  var boxes = document.getElementsByTagName('input'); 
	for(var index = 0; index < boxes.length; index++) { 
		box = boxes[index]; 
		if (box.type == 'checkbox' && box.className == 'sf_admin_batch_checkbox') {
			box.checked = document.getElementById('sf_admin_list_batch_checkbox').checked;
		}
	}
	return true;
}

function checkAlldev()
{
  var boxes = document.getElementsByTagName('input'); 
	for(var index = 0; index < boxes.length; index++) { 
		box = boxes[index]; 
		if (box.type == 'checkbox' && box.className == 'sf_admin_batch_checkbox_dev') {
			box.checked = document.getElementById('sf_admin_list_batch_checkbox_dev').checked;
		}
	}
	return true;
}

$(document).ready(function(){
	$( "input" ).on( "click", total_a_pagar);
});
</script>