<div class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix">
  <?php if (!$pager->getNbResults()): ?>

  <table>
    <caption class="fg-toolbar ui-widget-header ui-corner-top">
            <h1><span class="ui-icon ui-icon-triangle-1-s"></span> <?php echo __('Detalle de Compra', array(), 'messages') ?></h1>
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
            <h1><span class="ui-icon ui-icon-triangle-1-s"></span> <?php echo __('Detalle de Compra', array(), 'messages') ?></h1>
    </caption>

    <thead class="ui-widget-header">
      <tr>
        
        <?php include_partial('detcomp/list_th_tabular', array('sort' => $sort)) ?>

                  <th id="sf_admin_list_th_actions" class="ui-state-default ui-th-column"><?php echo __('Actions', array(), 'sf_admin') ?></th>
              </tr>
    </thead>

    <tbody>
      <?php foreach ($pager->getResults() as $i => $detalle_compra): $odd = fmod(++$i, 2) ? ' odd' : '' ?>
        <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
          <?php include_partial('detcomp/list_td_tabular', array('detalle_compra' => $detalle_compra)) ?>
          <?php include_partial('detcomp/list_td_actions', array('detalle_compra' => $detalle_compra, 'helper' => $helper)) ?>
        </tr>
      <?php endforeach; ?>
    </tbody>
    
    <tfoot>
      <tr>
        <th colspan="<?php echo $sf_user->hasGroup('Blanco')? 10 : 8; ?>">
          <div class="ui-state-default ui-th-column ui-corner-bottom">&nbsp;</div>
        </th>
      </tr>
    </tfoot>
    
  </table>

  <?php endif; ?>
</div>