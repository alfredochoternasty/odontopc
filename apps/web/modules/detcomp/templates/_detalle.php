  <div class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix">
    <table style="border-collapse:separate;">
      <caption class="fg-toolbar ui-widget-header">
        <h1><span class="ui-icon"></span> <?php echo __('Detalle de la venta', array(), 'messages') ?></h1>
      </caption>    
      <thead class="ui-widget-header">
        <tr>
           <?php include_partial('detcomp/list_th_tabular', array('sort' => $sort)) ?>  
          <th id="sf_admin_list_th_actions" class="ui-state-default ui-th-column"><?php echo __('Actions', array(), 'sf_admin') ?></th>
        </tr>
      </thead>          
    <tbody>
    <tbody>
      <?php 
        $suma_total = 0;
        foreach ($pager2 as $i => $detalle_compra): 
          $odd = fmod(++$i, 2) ? ' odd' : '';
          $suma_total += $detalle_compra->getTotal();
          ?>
        <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
          <?php 
            include_partial('detcomp/list_td_tabular', array('detalle_compra' => $detalle_compra));
            include_partial('detcomp/list_td_actions', array('detalle_compra' => $detalle_compra, 'helper' => $helper));
          ?>
        </tr>
      <?php endforeach; ?>

      <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
        <td colspan="<?php echo $sf_user->hasGroup('Blanco')? 7 : 5; ?>" class="sf_admin_text">&nbsp;</td>
        <td style="text-align: right;" class="sf_admin_text">Total:</td>
        <td class="sf_admin_text">
          <?php echo $detalle_compra->getCompra()->TotalFormato(); ?>
        </td>
        <td class="sf_admin_text">&nbsp;</td>
      </tr>
      
    </tbody>
    </table>
  </div>