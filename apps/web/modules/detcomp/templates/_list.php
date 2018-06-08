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
      <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
        <td colspan="<?php echo $sf_user->hasGroup('Blanco')? 7 : 5; ?>" class="sf_admin_text">&nbsp;</td>
        <td style="text-align: right;" class="sf_admin_text">Total:</td>
        <td class="sf_admin_text">
          <?php echo $detalle_compra->getCompra()->TotalFormato(); ?>
        </td>
        <td class="sf_admin_text">&nbsp;</td>
      </tr>
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

<script type="text/javascript">
/* <![CDATA[ */
function checkAll()
{
  var boxes = document.getElementsByTagName('input'); for(var index = 0; index < boxes.length; index++) { box = boxes[index]; if (box.type == 'checkbox' && box.className == 'sf_admin_batch_checkbox') box.checked = document.getElementById('sf_admin_list_batch_checkbox').checked } return true;
}
/* ]]> */
</script>
