<div class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix">
  <?php if (count($hasFilters) == 0):  ?>

  <table>
    <caption class="fg-toolbar ui-widget-header ui-corner-top">
            <div id="sf_admin_filters_buttons" class="fg-buttonset fg-buttonset-multi ui-state-default">
        <a href="#sf_admin_filter" id="sf_admin_filter_button" class="fg-button ui-state-default fg-button-icon-left ui-corner-left"><?php echo UIHelper::addIconByConf('filters') . __('Filters', array(), 'sf_admin') ?></a>
        <?php echo link_to(UIHelper::addIconByConf('reset') . __('Reset', array(), 'sf_admin'), 'dev_producto_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post', 'class' => 'fg-button ui-state-default fg-button-icon-left ui-corner-right ui-state-disabled')) ?></span>
      </div>
            <h1><span class="ui-icon ui-icon-triangle-1-s"></span> <?php echo __('Productos Devueltos', array(), 'messages') ?></h1>
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
        <?php echo link_to(UIHelper::addIconByConf('reset') . __('Reset', array(), 'sf_admin'), 'dev_producto_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post', 'class' => 'fg-button ui-state-default fg-button-icon-left ui-corner-right'.$isDisabledResetButton)) ?></span>
      </div>
            <h1><span class="ui-icon ui-icon-triangle-1-s"></span> <?php echo __('Productos Devueltos', array(), 'messages') ?></h1>
    </caption>

    <thead class="ui-widget-header">
      <tr>
        
        <?php include_partial('devprod/list_th_tabular', array('sort' => $sort)) ?>

                  <th id="sf_admin_list_th_actions" class="ui-state-default ui-th-column"><?php echo __('Actions', array(), 'sf_admin') ?></th>
              </tr>
    </thead>

    <tfoot>
      <tr>
        <th colspan="12">
          <div class="ui-state-default ui-th-column ui-corner-bottom">
            <?php include_partial('devprod/pagination', array('pager' => $pager)) ?>
          </div>
        </th>
      </tr>
    </tfoot>

    <tbody>
				<?php /*
					if ($hasFilters->count() > 0) {
						echo '<tr><td> Filtro utilizado: ';
						foreach ($configuration->getFormFilterFields($filters) as $name => $field) {
							@$valor = $hasFilters->getRaw($name);
							$tag = $field->getConfig('label');
							$tag = empty($tag)?$name:$tag;							
							if (!empty($valor)) echo $tag.' = '.$valor;
						}
						echo '</td></tr>';
					} */
				?>
      <?php foreach ($pager->getResults() as $i => $dev_producto): $odd = fmod(++$i, 2) ? ' odd' : '' ?>
        <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
          
          <?php include_partial('devprod/list_td_tabular', array('dev_producto' => $dev_producto)) ?>

                      <?php include_partial('devprod/list_td_actions', array('dev_producto' => $dev_producto, 'helper' => $helper)) ?>
                  </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <?php endif; ?>
</div>
