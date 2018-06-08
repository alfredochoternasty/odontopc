  <div class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix">
    <table style="border-collapse:separate;">
      <caption class="fg-toolbar ui-widget-header">
        <h1><span class="ui-icon"></span> <?php echo __('Detalle de la venta', array(), 'messages') ?></h1>
      </caption>    
      <thead class="ui-widget-header">
        <tr>
           <?php include_partial('detres/list_th_tabular', array('sort' => $sort)) ?>  
          <th id="sf_admin_list_th_actions" class="ui-state-default ui-th-column"><?php echo __('Actions', array(), 'sf_admin') ?></th>
        </tr>
      </thead>          
    <tbody>
    <tbody>
      <?php 
        $suma_total = 0;
        foreach ($pager2 as $i => $detalle_resumen): 
          $odd = fmod(++$i, 2) ? ' odd' : '';
          $suma_total += $detalle_resumen->getTotal();
          ?>
        <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
          <?php 
            include_partial('detres/list_td_tabular', array('detalle_resumen' => $detalle_resumen));
            include_partial('detres/list_td_actions', array('detalle_resumen' => $detalle_resumen, 'helper' => $helper));
          ?>
        </tr>
      <?php endforeach; ?>

      <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
        <td colspan="4" class="sf_admin_text">&nbsp;</td>
        <td style="text-align: right;" class="sf_admin_text">Total:</td>
        <td class="sf_admin_text">
          <?php echo sprintf($detalle_resumen->SimboloMoneda()." %01.2f", $suma_total) ?>
        </td>
        <td colspan="2" class="sf_admin_text">&nbsp;</td>
      </tr>
      
    </tbody>
    </table>
  </div>