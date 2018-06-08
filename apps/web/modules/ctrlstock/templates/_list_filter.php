<?php $ver_solo_totales = $sf_user->getAttribute('totales', true); ?>
<div class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix">
  <?php if (!$pager->getNbResults()): ?>

  <table>
    <caption class="fg-toolbar ui-widget-header ui-corner-top">
            <div id="sf_admin_filters_buttons" class="fg-buttonset fg-buttonset-multi ui-state-default">
        <a href="#sf_admin_filter" id="sf_admin_filter_button" class="fg-button ui-state-default fg-button-icon-left ui-corner-left"><?php echo UIHelper::addIconByConf('filters') . __('Filters', array(), 'sf_admin') ?></a>
        <?php echo link_to(UIHelper::addIconByConf('reset') . __('Reset', array(), 'sf_admin'), 'control_stock_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post', 'class' => 'fg-button ui-state-default fg-button-icon-left ui-corner-right')) ?></span>
      </div>
            <h1><span class="ui-icon ui-icon-triangle-1-s"></span> <?php echo __('Listado de Control de Stock', array(), 'messages') ?></h1>
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
        <?php echo link_to(UIHelper::addIconByConf('reset') . __('Reset', array(), 'sf_admin'), 'control_stock_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post', 'class' => 'fg-button ui-state-default fg-button-icon-left ui-corner-right'.$isDisabledResetButton)) ?></span>
      </div>
            <h1><span class="ui-icon ui-icon-triangle-1-s"></span> <?php echo $ver_solo_totales?"Listado solo totales para Control de Stock":"Listado detallado para Control de Stock" ?></h1>
    </caption>

    <thead class="ui-widget-header">
      <tr>
        <?php 
          if($ver_solo_totales){
            include_partial('ctrlstock/list_th_tabular_tot', array('sort' => $sort));
          }else{
            include_partial('ctrlstock/list_th_tabular_det', array('sort' => $sort));
          }
        ?>
      </tr>
    </thead>

    <tfoot>
      <tr>
        <th colspan="<? echo $ver_solo_totales? 10:13 ?>">
          <div class="ui-state-default ui-th-column ui-corner-bottom"></div>
        </th>
      </tr>
    </tfoot>

    <tbody>
      <?php 
      $tot_vend = 0;
      $tot_bono = 0;
      $tot_tot = 0;
      $suma_total_vend = 0;
      $suma_total_bon = 0;
      $suma_total_tot = 0;
      $suma_tot_lote = 0;
      $productos = $pager->getResults();
      $anterior = $productos[0];
      foreach ($pager->getResults() as $i => $control_stock): 
        if($ver_solo_totales){
          if($control_stock->getProductoId() != $anterior->getProductoId() && $tot_tot > 0){
            $suma_tot_lote += $anterior->getStockSinLote();
            $suma_total_vend += $tot_vend;
            $suma_total_bon += $tot_bono;
            $suma_total_tot += $tot_tot;          
            ?>
            <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
              <td><?php echo $anterior->getProducto() ?></td>
              <td><?php echo $tot_vend ?></td>
              <td><?php echo $tot_bono ?></td>
              <td><?php echo $tot_tot ?></td>
              <td><?php echo $anterior->getStockSinLote() ?></td>
            </tr>          
          <?php 
            $anterior = $control_stock;
            $tot_vend = $control_stock->getCantidadVendida();
            $tot_bono = $control_stock->getCantidadBonificados();
            $tot_tot = $control_stock->getCantidadTotal();
          } else{
            $tot_vend += $control_stock->getCantidadVendida();
            $tot_bono += $control_stock->getCantidadBonificados();
            $tot_tot += $control_stock->getCantidadTotal();
          }
        }else{ ?>
          <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
            <td><?php echo $control_stock->getProductoNombre() ?></td>
            <td><?php echo format_date($control_stock->getFechaVta(), "dd/MM/yyyy") ?></td>
            <td><?php echo $control_stock->getNroLote() ?></td>
            <td><?php echo $control_stock->getCantidadVendida() ?></td>
            <td><?php echo $control_stock->getCantidadBonificados() ?></td>
            <td><?php echo $control_stock->getCantidadTotal() ?></td>
            <td><?php echo $control_stock->getStockActual() ?></td>
            <td><?php echo $control_stock->getStockSinLote() ?></td>
          </tr>
        <?php 
        }
      endforeach;
        if($ver_solo_totales){
            $suma_tot_lote += $anterior->getStockSinLote();
            $suma_total_vend += $tot_vend;
            $suma_total_bon += $tot_bono;
            $suma_total_tot += $tot_tot;         
            ?>
            <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
              <td><?php echo $anterior->getProducto() ?></td>
              <td><?php echo $tot_vend ?></td>
              <td><?php echo $tot_bono ?></td>
              <td><?php echo $tot_tot ?></td>
              <td><?php echo $anterior->getStockSinLote() ?></td>
            </tr>
            <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
              <td><b>Total: </b></td>
              <td><?php echo $suma_total_vend ?></td>
              <td><?php echo $suma_total_bon ?></td>
              <td><?php echo $suma_total_tot ?></td>
              <td><?php echo $suma_tot_lote ?></td>
            </tr>
          <?php 
        }
      ?>
    </tbody>
  </table>

  <?php endif; ?>
</div>
