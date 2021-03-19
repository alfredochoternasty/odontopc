<div class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix">
  <?php if (!$pager->getNbResults()): ?>

  <table>
    <caption class="fg-toolbar ui-widget-header ui-corner-top">
            <div id="sf_admin_filters_buttons" class="fg-buttonset fg-buttonset-multi ui-state-default">
        <a href="#sf_admin_filter" id="sf_admin_filter_button" class="fg-button ui-state-default fg-button-icon-left ui-corner-left"><?php echo UIHelper::addIconByConf('filters') . __('Filters', array(), 'sf_admin') ?></a>
        <?php echo link_to(UIHelper::addIconByConf('reset') . __('Reset', array(), 'sf_admin'), 'cobro_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post', 'class' => 'fg-button ui-state-default fg-button-icon-left ui-corner-right')) ?></span>
      </div>
            <h1><span class="ui-icon ui-icon-triangle-1-s"></span> <?php echo __('Cobros Realizados', array(), 'messages') ?></h1>
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

  <?php
    if ($hasFilters->count() > 0) include_partial('admins/filtro_usado', array('configuration' => $configuration, 'filters' => $filters, 'hasFilters' => $hasFilters))
	?>

  <table>
    <caption class="fg-toolbar ui-widget-header ui-corner-top">
            <div id="sf_admin_filters_buttons" class="fg-buttonset fg-buttonset-multi ui-state-default">
        <a href="#sf_admin_filter" id="sf_admin_filter_button" class="fg-button ui-state-default fg-button-icon-left ui-corner-left"><?php echo UIHelper::addIconByConf('filters') . __('Filters', array(), 'sf_admin') ?></a>
        <?php $isDisabledResetButton = ($hasFilters->getRawValue()) ? '' : ' ui-state-disabled' ?>
        <?php echo link_to(UIHelper::addIconByConf('reset') . __('Reset', array(), 'sf_admin'), 'cobro_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post', 'class' => 'fg-button ui-state-default fg-button-icon-left ui-corner-right'.$isDisabledResetButton)) ?></span>
      </div>
            <h1><span class="ui-icon ui-icon-triangle-1-s"></span> <?php echo __('Cobros Realizados', array(), 'messages') ?></h1>
    </caption>

    <thead class="ui-widget-header">
      <tr>
                  <th id="sf_admin_list_batch_actions"  class="ui-state-default ui-th-column"><input id="sf_admin_list_batch_checkbox" type="checkbox" onclick="checkAll();" /></th>
        
        <?php include_partial('cobro/list_th_tabular', array('sort' => $sort)) ?>

                  <th id="sf_admin_list_th_actions" class="ui-state-default ui-th-column"><?php echo __('Actions', array(), 'sf_admin') ?></th>
              </tr>
    </thead>

    <tfoot>
      <tr>
        <th colspan="10">
          <div class="ui-state-default ui-th-column ui-corner-bottom">
            <?php include_partial('cobro/pagination', array('pager' => $pager)) ?>
          </div>
        </th>
      </tr>
    </tfoot>

    <tbody>
      <?php 
        $suma_total = 0;
        foreach ($pager->getResults() as $i => $cobro): 
          $odd = fmod(++$i, 2) ? ' odd' : '';
          $suma_total += $cobro->getMonto();
      ?>
        <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
          <?php include_partial('cobro/list_td_batch_actions', array('cobro' => $cobro, 'helper' => $helper)) ?>
          <?php include_partial('cobro/list_td_tabular', array('cobro' => $cobro)) ?>
          <?php include_partial('cobro/list_td_actions', array('cobro' => $cobro, 'helper' => $helper)) ?>
        </tr>
      <?php endforeach; ?>
        <tr class="sf_admin_row ui-widget-content" style="font-size:14pt;">
          <td colspan="4" style="text-align: right;" class="sf_admin_foreignkey">Total en esta p&aacute;gina:</td>
          <td style="width:150px;" class="sf_admin_foreignkey"><?php echo '$ '.number_format($suma_total, 2, ',', '.'); ?></td>
          <td colspan="5" class="sf_admin_foreignkey">&nbsp;</td>
        </tr>
      <?php if (!empty($total)): ?>
        <tr class="sf_admin_row ui-widget-content" style="font-size:14pt;">
          <td colspan="4" style="text-align: right;" class="sf_admin_foreignkey">Total del filtro:</td>
          <td style=" width:150px;" class="sf_admin_foreignkey"><?php echo '$ '.number_format($total, 2, ',', '.'); ?></td>
          <td colspan="5" class="sf_admin_foreignkey">&nbsp;</td>
        </tr>
      <?php endif; ?>
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
