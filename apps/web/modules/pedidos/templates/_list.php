<div class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix">
  <?php if (!$pager->getNbResults()): ?>

  <table>
    <caption class="fg-toolbar ui-widget-header ui-corner-top">
            <h1><span class="ui-icon ui-icon-triangle-1-s"></span> <?php echo __('Pedidos Pendientes', array(), 'messages') ?></h1>
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
            <h1><span class="ui-icon ui-icon-triangle-1-s"></span> <?php echo __('Pedidos Pendientes', array(), 'messages') ?></h1>
    </caption>

    <thead class="ui-widget-header">
      <tr>
        
        <?php include_partial('pedidos/list_th_tabular', array('sort' => $sort)) ?>

                  <th id="sf_admin_list_th_actions" class="ui-state-default ui-th-column"><?php echo __('Actions', array(), 'sf_admin') ?></th>
              </tr>
    </thead>

    <tfoot>
      <tr>
        <th colspan="6">
          <div class="ui-state-default ui-th-column ui-corner-bottom">
            <?php include_partial('pedidos/pagination', array('pager' => $pager)) ?>
          </div>
        </th>
      </tr>
    </tfoot>

    <tbody>
      <?php foreach ($pager->getResults() as $i => $pedido): $odd = fmod(++$i, 2) ? ' odd' : '' ?>
        <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
          
          <?php include_partial('pedidos/list_td_tabular', array('pedido' => $pedido)) ?>

                      <?php include_partial('pedidos/list_td_actions', array('pedido' => $pedido, 'helper' => $helper)) ?>
                  </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <?php endif; ?>
</div>
