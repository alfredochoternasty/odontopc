<div class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix">
  <?php if (!$pager->getNbResults()): ?>

  <table>
    <caption class="fg-toolbar ui-widget-header ui-corner-top">
            <h1><span class="ui-icon ui-icon-triangle-1-s"></span> <?php echo __('Detalle del presupuesto', array(), 'messages') ?></h1>
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
            <h1><span class="ui-icon ui-icon-triangle-1-s"></span> <?php echo __('Detalle del presupuesto', array(), 'messages') ?></h1>
    </caption>

    <thead class="ui-widget-header">
      <tr>
        <th id="sf_admin_list_batch_actions"  class="ui-state-default ui-th-column"><input id="sf_admin_list_batch_checkbox" type="checkbox" onclick="checkAll();" /></th>
        <?php include_partial('detpresu/list_th_tabular', array('sort' => $sort)) ?>

                  <th id="sf_admin_list_th_actions" class="ui-state-default ui-th-column"><?php echo __('Actions', array(), 'sf_admin') ?></th>
              </tr>
    </thead>

    <tfoot>
      <tr>
        <th colspan="11">
          <div class="ui-state-default ui-th-column ui-corner-bottom">
            <?php include_partial('detpresu/pagination', array('pager' => $pager)) ?>
          </div>
        </th>
      </tr>
    </tfoot>

    <tbody>
      <?php 
      $suma_total = 0;
      foreach ($pager->getResults() as $i => $detalle_presupuesto): 
        $odd = fmod(++$i, 2) ? ' odd' : '';
        $suma_total += $detalle_presupuesto->total;
      ?>
        <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
        <?php include_partial('detpresu/list_td_batch_actions', array('detalle_presupuesto' => $detalle_presupuesto, 'helper' => $helper)) ?>
          
          <?php include_partial('detpresu/list_td_tabular', array('detalle_presupuesto' => $detalle_presupuesto)) ?>

                      <?php include_partial('detpresu/list_td_actions', array('detalle_presupuesto' => $detalle_presupuesto, 'helper' => $helper)) ?>
                  </tr>
      <?php endforeach; ?>
      
      <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
      <td colspan="7" class="sf_admin_text">&nbsp;</td>
      <td style="text-align: right;" class="sf_admin_text">Total:</td>
      <td class="sf_admin_text">
        <?php echo sprintf("$ "."%01.2f", $suma_total) ?>
      </td>
      <td class="sf_admin_text">&nbsp;</td>
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
