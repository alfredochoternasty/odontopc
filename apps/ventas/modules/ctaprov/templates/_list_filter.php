<div class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix">
  <?php if (!$pager->getNbResults()): ?>

  <table>
    <caption class="fg-toolbar ui-widget-header ui-corner-top">
            <div id="sf_admin_filters_buttons" class="fg-buttonset fg-buttonset-multi ui-state-default">
        <a href="#sf_admin_filter" id="sf_admin_filter_button" class="fg-button ui-state-default fg-button-icon-left ui-corner-left"><?php echo UIHelper::addIconByConf('filters') . __('Filters', array(), 'sf_admin') ?></a>
        <?php echo link_to(UIHelper::addIconByConf('reset') . __('Reset', array(), 'sf_admin'), 'cta_cte_prov_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post', 'class' => 'fg-button ui-state-default fg-button-icon-left ui-corner-right')) ?></span>
      </div>
            <h1><span class="ui-icon ui-icon-triangle-1-s"></span> <?php echo __('Listado de Cuenta Corriente de Proveedor', array(), 'messages') ?></h1>
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
        <?php echo link_to(UIHelper::addIconByConf('reset') . __('Reset', array(), 'sf_admin'), 'cta_cte_prov_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post', 'class' => 'fg-button ui-state-default fg-button-icon-left ui-corner-right'.$isDisabledResetButton)) ?></span>
      </div>
            <h1><span class="ui-icon ui-icon-triangle-1-s"></span> <?php echo __('Listado de Cuenta Corriente', array(), 'messages') ?></h1>
    </caption>

    <thead class="ui-widget-header">
      <tr>
        
        <?php include_partial('ctaprov/list_th_tabular', array('sort' => $sort)) ?>

              </tr>
    </thead>

    <tbody>
      <?php
      $saldo_periodo = 0;
      foreach ($pager->getResults() as $i => $cta_cte): 
        $odd = fmod(++$i, 2) ? ' odd' : '';
        $saldo_periodo += $cta_cte->getDebe() - $cta_cte->getHaber();
        $prov = $cta_cte->getProveedor();
        $cuenta = $cta_cte->getCuenta()->getId();
        $moneda = $cta_cte->getMoneda();
      ?>
        <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
          <?php include_partial('ctaprov/list_td_tabular', array('cta_cte' => $cta_cte, 'hasFilters' => $hasFilters)) ?>
        </tr>
      <?php 
      endforeach; 
      $fechas = $hasFilters->offsetGet('fecha');
      if(!isset($fechas)):
      ?>
      <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
        <td colspan="5" style="text-align: right;" class="sf_admin_text sf_admin_list_td_numero">Saldo desde el <?php echo implode('/', array_reverse(explode('-', $fechas['from']))) ?> al <?php echo implode('/', array_reverse(explode('-', $fechas['to']))) ?></td>
        <td class="sf_admin_text"><?php echo sprintf($moneda->getSimbolo()." %01.2f", $saldo_periodo) ?></td>
      </tr>
      <?php 
      endif;
      ?>
      <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
        <td colspan="6" style="text-align: right;" class="sf_admin_text sf_admin_list_td_numero">Saldo total </td>
        <td class="sf_admin_text sf_admin_list_td_numero"><?php echo sprintf($moneda->getSimbolo()." %01.2f", $prov->getSaldoCtaCte($cuenta)) ?></td>
      </tr>
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
