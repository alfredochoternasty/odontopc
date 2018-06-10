<div style="position:relative" class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix">
  <?php if (!$pager->getNbResults()): ?>

  <table>
    <caption class="fg-toolbar ui-widget-header ui-corner-top">
       <h1><span class="ui-icon ui-icon-triangle-1-s"></span> <?php echo __('Productos con Stock por debajo del Mínimo', array(), 'messages') ?></h1>
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
  <?php if($sf_user->hasPermission('admin')): ?>
  <div style="position:absolute;top:0; right:0; width:45%;">
  <table>
    <caption class="fg-toolbar ui-widget-header ui-corner-top">
      <h1><span class="ui-icon ui-icon-triangle-1-s"></span> <?php echo __('Productos con Stock por debajo del Mínimo', array(), 'messages') ?></h1>
    </caption>

    <thead class="ui-widget-header">
      <tr><?php include_partial('inicio/list_th_tabular', array('sort' => $sort)) ?></tr>
    </thead>

    <tbody>
      <?php foreach ($pager->getResults() as $i => $producto): $odd = fmod(++$i, 2) ? ' odd' : '' ?>
        <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
          
          <?php //include_partial('inicio/list_td_tabular', array('producto' => $producto)) ?>
          <td class="sf_admin_text sf_admin_list_td_nombre">
            <?php echo $producto->getNombre() ?>
          </td>
          <td class="sf_admin_text sf_admin_list_td_nombre">
            <?php echo ""; ?>
          </td>
          <td class="sf_admin_text sf_admin_list_td_stock_actual">
            <?php echo $producto->getStockActual() ?>
          </td>
          <td class="sf_admin_text sf_admin_list_td_minimo_stock">
            <?php echo $producto->getMinimoStock() ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  </div>
  <?php endif; //del permiso?> 
  
  <div style="position:absolute;top:0; left:0; width:45%;">
  <table>
    <caption class="fg-toolbar ui-widget-header ui-corner-top">
      <h1><span class="ui-icon ui-icon-triangle-1-s"></span> Pedidos Pendientes</h1>
    </caption>

    <thead class="ui-widget-header">
      <tr>   
        <?php if($sf_user->hasPermission('admin')): ?>      
        <th class="sf_admin_text ui-state-default ui-th-column">
          <span style="display: block; padding: 5px 0px">Cliente</span>
        </th>
        <?php else: ?>
        <th class="sf_admin_text ui-state-default ui-th-column">
          <span style="display: block; padding: 5px 0px">Nro</span>
        </th>    
        <?php endif; ?>
        <th class="sf_admin_text ui-state-default ui-th-column">
            <span style="display: block; padding: 5px 0px">Fecha</span>
        </th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($pager2 as $i => $pedido): $odd = fmod(++$i, 2) ? ' odd' : '' ?>
        <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
        <?php if($sf_user->hasPermission('admin')): ?>
          <td class="sf_admin_text sf_admin_list_td_stock_actual">
            <?php echo $pedido->getCliente() ?>
          </td>
        <?php else: ?>
          <td class="sf_admin_text sf_admin_list_td_stock_actual">
            <?php echo $pedido->getId() ?>
          </td>
        <?php endif; ?>
          <td class="sf_admin_text sf_admin_list_td_nombre">
            <?php echo implode('/', array_reverse(explode('-', $pedido->getFecha()))) ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>  

  <?php endif; ?>
</div>

<?php if($sf_user->hasPermission('@cliente_seguimiento')): ?> 
  <div style="position:absolute;top:0; left:0; width:45%;">
  <table>
    <caption class="fg-toolbar ui-widget-header ui-corner-top">
      <h1>Prox. Contacto a Clientes</h1>
    </caption>

    <thead class="ui-widget-header">
      <tr> 
        <th class="sf_admin_text ui-state-default ui-th-column"><span style="display: block; padding: 5px 0px">Cliente</span></th>
        <th class="sf_admin_text ui-state-default ui-th-column"><span style="display: block; padding: 5px 0px">Fecha/hora</span></th>    
        <!--<th class="sf_admin_text ui-state-default ui-th-column"><span style="display: block; padding: 5px 0px">Comentario</span></th>
        <th class="sf_admin_text ui-state-default ui-th-column"><span style="display: block; padding: 5px 0px">&nbsp;</span></th> -->
      </tr>
    </thead>

    <tbody>
      <?php foreach ($pager3 as $i => $contacto):  ?>
        <tr class="sf_admin_row ui-widget-content">
          <td class="sf_admin_text sf_admin_list_td_stock_actual"><?php echo $contacto->getCliente() ?></td>
          <td class="sf_admin_text sf_admin_list_td_stock_actual"><?php echo  implode('/', array_reverse(explode('-', $contacto->getProxContacFecha()))) ." - ". $contacto->getProxContacHora()." (".$contacto->getTipoTiempoContac().")"; ?></td>
          <td class="sf_admin_text sf_admin_list_td_nombre"><?php echo $contacto->getProxContactComent() ?></td>
          <td style="white-space: nowrap;">
            <ul class="sf_admin_td_actions fg-buttonset fg-buttonset-single">
              <li class="sf_admin_action_edit">
                <?php //echo link_to('realizada', 'cliseg/edit?id='.$contacto->getId(), array('class' => 'fg-button-mini fg-button ui-state-default fg-button-icon-left ')) ?>
              </li>
            </ul>
          </td>

        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>  
  </div>
<?php endif; ?>

</div>