<div class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix">
  <?php if (!$pager->getNbResults()): ?>
  <table>
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
       <h1><span class="ui-icon ui-icon-triangle-1-s"></span> <?php echo __('Emails enviados', array(), 'messages') ?></h1>
    </caption>

    <thead class="ui-widget-header">
      <tr><?php include_partial('cursmail/list_th_tabular', array('sort' => $sort)) ?></tr>
    </thead>

    <tbody>
      <?php foreach ($pager->getResults() as $i => $curso_mail_enviado): $odd = fmod(++$i, 2) ? ' odd' : '' ?>
        <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
          <?php include_partial('cursmail/list_td_tabular', array('curso_mail_enviado' => $curso_mail_enviado)) ?>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <?php endif; ?>
</div>