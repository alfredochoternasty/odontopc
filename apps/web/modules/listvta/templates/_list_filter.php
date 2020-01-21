<div class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix">
  <?php if (!$pager->getNbResults()): ?>

  <table>
    <caption class="fg-toolbar ui-widget-header ui-corner-top">
            <div id="sf_admin_filters_buttons" class="fg-buttonset fg-buttonset-multi ui-state-default">
        <a href="#sf_admin_filter" id="sf_admin_filter_button" class="fg-button ui-state-default fg-button-icon-left ui-corner-left"><?php echo UIHelper::addIconByConf('filters') . __('Filters', array(), 'sf_admin') ?></a>
        <?php echo link_to(UIHelper::addIconByConf('reset') . __('Reset', array(), 'sf_admin'), 'listado_ventas_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post', 'class' => 'fg-button ui-state-default fg-button-icon-left ui-corner-right')) ?></span>
      </div>
            <h1><span class="ui-icon ui-icon-triangle-1-s"></span> <?php echo __('Listado de Ventas', array(), 'messages') ?></h1>
    </caption>
    <tbody>
      <tr class="sf_admin_row ui-widget-content">
        <td align="center" height="30">
          <p align="center"><?php echo __('No result', array(), 'sf_admin') ?></p>
        </td>
      </tr>
    </tbody>
  </table>

  <?php else: ?>

  <table>
    <caption class="fg-toolbar ui-widget-header ui-corner-top">
            <div id="sf_admin_filters_buttons" class="fg-buttonset fg-buttonset-multi ui-state-default">
        <a href="#sf_admin_filter" id="sf_admin_filter_button" class="fg-button ui-state-default fg-button-icon-left ui-corner-left"><?php echo UIHelper::addIconByConf('filters') . __('Filters', array(), 'sf_admin') ?></a>
        <?php $isDisabledResetButton = ($hasFilters->getRawValue()) ? '' : ' ui-state-disabled' ?>
        <?php echo link_to(UIHelper::addIconByConf('reset') . __('Reset', array(), 'sf_admin'), 'listado_ventas_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post', 'class' => 'fg-button ui-state-default fg-button-icon-left ui-corner-right'.$isDisabledResetButton)) ?></span>
      </div>
            <h1><span class="ui-icon ui-icon-triangle-1-s"></span> <?php echo __('Listado de Ventas', array(), 'messages') ?></h1>
    </caption>

    <thead class="ui-widget-header">
      <tr>        
        <?php 
				$ver_solo_totales = $sf_user->getAttribute('totales', true);
				include_partial('listvta/list_th_tabular', array('sort' => $sort)); 
				if(!$ver_solo_totales){
				?>
        <th class="sf_admin_text sf_admin_list_th_nro_lote ui-state-default ui-th-column">

        </th>
				<?php }?>
      </tr>
    </thead>

    <tfoot>
      <tr>
        <th colspan="14">
          <div class="ui-state-default ui-th-column ui-corner-bottom">
            <?php include_partial('listvta/pagination', array('pager' => $pager)) ?>
          </div>
        </th>
      </tr>
    </tfoot>

    <tbody>
      <?php 
      $ver_solo_totales = $sf_user->getAttribute('totales', true);      
      $suma_cant = 0;
      $suma_bon = 0;
      $suma_total = 0;
      $suma_total_bon = 0;
      $productos = $pager->getResults();
      $anterior = $productos[0];
      foreach ($pager->getResults() as $i => $listado_ventas): 
        if($ver_solo_totales){
          $actual = $listado_ventas;
          if($actual->getProductoId() != $anterior->getProductoId()){
            ?>
            <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
              <td><?php echo $anterior->getGrupoNombre() ?></td>
              <td><?php echo $anterior->getProducto() ?></td>
              <td><?php echo $suma_cant ?></td>
              <td><?php echo $suma_bon ?></td>
            </tr>
            <?php 
            $anterior = $actual;
            $suma_cant = $actual->getCantidad();
            $suma_bon = $actual->getBonificados();
            $suma_total += $actual->getCantidad();
            $suma_total_bon += $actual->getBonificados();
          }else{
            $suma_cant += $actual->getCantidad();
            $suma_bon += $actual->getBonificados();
            $suma_total += $actual->getCantidad();
            $suma_total_bon += $actual->getBonificados();
          }
        }else{ ?>
          <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
            <td><?php echo $listado_ventas->getResumenId() ?></td>
            <td><?php echo false !== strtotime($listado_ventas->getFecha()) ? format_date($listado_ventas->getFecha(), "dd/MM/yyyy") : '&nbsp;' ?></td>
            <td><?php echo $listado_ventas->getMoneda() ?></td>
            <td><?php echo $listado_ventas->getClienteApellido() ?></td>
            <td><?php echo $listado_ventas->getClienteNombre() ?></td>
            <td><?php echo $listado_ventas->getTipoClienteNombre() ?></td>
            <td><?php echo $listado_ventas->getGrupoNombre() ?></td>
            <td><?php echo $listado_ventas->getProductoNombre() ?></td>
            <td><?php echo $listado_ventas->PrecioFormato() ?></td>
            <td><?php echo $listado_ventas->getCantidad() ?></td>
            <td><?php echo $listado_ventas->getBonificados() ?></td>
            <td><?php echo $listado_ventas->TotalFormato() ?></td>
            <td><?php echo $listado_ventas->getNroLote() ?></td>
          </tr>
        <?php 
        }
      endforeach; 
      if($ver_solo_totales){
          ?>
          <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
            <td><?php echo $anterior->getGrupoNombre() ?></td>
            <td><?php echo $anterior->getProducto() ?></td>
            <td><?php echo $suma_cant ?></td>
            <td><?php echo $suma_bon ?></td>
          </tr>
          <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
            <td colspan="2" style="text-align: right"><b>Total: </b> </td>
            <td><b><?php echo $suma_total ?></b></td>
            <td><b><?php echo $suma_total_bon ?></b></td>
          </tr>
          <?php 
      }
      ?>
    </tbody>
  </table>

  <?php endif; ?>
</div>

<script type="text/javascript">
/* <![CDATA[ */
function checkAll()
{
  var boxes = document.getElementsByTagName('input'); for(var index = 0; index < boxes.length; index++) { box = boxes[index]; if (box.type == 'checkbox' && box.className == 'sf_admin_batch_checkbox') box.checked = document.getElementById('sf_admin_list_batch_checkbox').checked } return true;
}
/* ]]> */
</script>
