<div class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix">
  <?php if (!$pager->getNbResults()): ?>

  <table>
    <caption class="fg-toolbar ui-widget-header ui-corner-top">
            <div id="sf_admin_filters_buttons" class="fg-buttonset fg-buttonset-multi ui-state-default">
        <a href="#sf_admin_filter" id="sf_admin_filter_button" class="fg-button ui-state-default fg-button-icon-left ui-corner-left"><?php echo UIHelper::addIconByConf('filters') . __('Filters', array(), 'sf_admin') ?></a>
        <?php echo link_to(UIHelper::addIconByConf('reset') . __('Reset', array(), 'sf_admin'), 'vta_fact_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post', 'class' => 'fg-button ui-state-default fg-button-icon-left ui-corner-right')) ?></span>
      </div>
            <h1><span class="ui-icon ui-icon-triangle-1-s"></span> <?php echo __('Listado de Ventas Facturadas', array(), 'messages') ?></h1>
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
        <?php echo link_to(UIHelper::addIconByConf('reset') . __('Reset', array(), 'sf_admin'), 'vta_fact_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post', 'class' => 'fg-button ui-state-default fg-button-icon-left ui-corner-right'.$isDisabledResetButton)) ?></span>
      </div>
            <?php 
            if(array_key_exists('fecha', $hasFilters)){
              $fechas = $hasFilters['fecha']; 
              $fd = implode('/', array_reverse(explode('-', $fechas['from'])));
              $fa = implode('/', array_reverse(explode('-', $fechas['to'])));
            ?>
            <h1><span class="ui-icon ui-icon-triangle-1-s"></span> <?php echo __('Listado de Ventas Facturadas desde '.$fd.' hasta '.$fa, array(), 'messages') ?></h1>
            <?php
            }else{
            ?>
            <h1><span class="ui-icon ui-icon-triangle-1-s"></span> <?php echo __('Listado de Ventas Facturadas', array(), 'messages') ?></h1>
            <?php
            }
            ?>
    </caption>

    <thead class="ui-widget-header">
      <tr>
        
        <?php include_partial('listfvta/list_th_tabular', array('sort' => $sort)) ?>

              </tr>
    </thead>

    <tfoot>
      <tr>
        <th colspan="2">

        </th>
      </tr>
    </tfoot>

    <tbody>
      <?php
		$ver_solo_totales = $sf_user->getAttribute('totales', true);
        $cant = 0;
        $prod = '';
        foreach ($pager->getResults() as $i => $vta_fact): 
          $odd = fmod(++$i, 2) ? ' odd' : '';
          $aux = $vta_fact->getProducto();
          if($aux <> $prod): 
            if($cant > 0):
            ?>
            <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
              <td>&nbsp;</td>
              <td style="text-align:right;"><b>Total de <?php echo $prod ?>:</b></td>
              <td><b><?php echo $cant; ?></b></td>
            </tr>      
            <?php endif; ?>
			<?php if(!$ver_solo_totales): ?>
            <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
              <td colspan="3" style="background: #87B6D9; text-align:center;"><h2><b><?php echo $vta_fact->getProducto(); ?></b></h2></td>
            </tr>          
			<?php endif; ?>
          <?php
            $prod = $aux;
            $cant = 0;
          endif;
          $cant += $vta_fact->getCantidad();
      ?>
        <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
          <?php 
		  if(!$ver_solo_totales){
            include_partial('listfvta/list_td_tabular', array('vta_fact' => $vta_fact));
		  }
           ?>
        </tr>
      <?php endforeach; ?>
      <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
        <td>&nbsp;</td>
        <td style="text-align:right;"><b>Total de <?php echo $prod ?>:</b></td>
        <td><?php echo $cant; ?></td>
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
