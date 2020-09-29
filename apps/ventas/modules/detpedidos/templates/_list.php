<div class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix">
  <?php if (!$pager->getNbResults()): ?>

  <table>
    <caption class="fg-toolbar ui-widget-header ui-corner-top">
            <h1><span class="ui-icon ui-icon-triangle-1-s"></span> <?php echo __('Detalle de pedido', array(), 'messages') ?></h1>
    </caption>
    <tbody>
      <tr class="sf_admin_row ui-widget-content">
        <td align="center" height="30">
          <p align="center"><?php echo __('No result', array(), 'sf_admin') ?></p>
        </td>
      </tr>
    </tbody>
  </table>

  <?php 
    else: 
    $detalle = $pager->getResults();
    $pedido = $detalle[0]->getPedido();
    include_partial('datos_pedido', array('pedido' => $pedido));
  ?>
  
  <table>
    <caption class="fg-toolbar ui-widget-header ui-corner-top">
            <h1><span class="ui-icon ui-icon-triangle-1-s"></span> <?php echo __('Detalle de pedido', array(), 'messages') ?></h1>
    </caption>

    <thead class="ui-widget-header">
      <tr>
        <?php if (empty($pedido->vendido)): ?> 
        <?php endif; ?>
        <?php include_partial('detpedidos/list_th_tabular', array('sort' => $sort)) ?>

                  <th id="sf_admin_list_th_actions" class="ui-state-default ui-th-column"><?php echo __('Actions', array(), 'sf_admin') ?></th>
              </tr>
    </thead>

    <tfoot>
      <tr>
        <th colspan="8">
          <div class="ui-state-default ui-th-column ui-corner-bottom">
            <?php include_partial('detpedidos/pagination', array('pager' => $pager)) ?>
          </div>
        </th>
      </tr>
    </tfoot>
    
    <tbody>
      <?php 
        $suma_total = 0;
        foreach ($pager->getResults() as $i => $detalle_pedido): 
          $odd = fmod(++$i, 2) ? ' odd' : '';
          $suma_total += $detalle_pedido->getTotal();
          ?>
        <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
          <?php 
            include_partial('detpedidos/list_td_tabular', array('detalle_pedido' => $detalle_pedido));
            $vendido = $detalle_pedido->getPedido()->getVendido();
            if($vendido == 0){
              include_partial('detpedidos/list_td_actions', array('detalle_pedido' => $detalle_pedido, 'helper' => $helper));
            }else{ ?>
              <td style="white-space: nowrap;"></td>
           <?php }
          ?>
        </tr>
      <?php endforeach; ?>
      
    </tbody>    
  </table>

  <?php endif; ?>
</div>
