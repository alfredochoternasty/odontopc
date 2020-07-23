<div style="width: 50%; float: left;" class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix">
  <table>
    <caption class="fg-toolbar ui-widget-header ui-corner-top">
      <h1><span class="ui-icon ui-icon-triangle-1-s"></span><?php echo $titulo_cuadro ?></h1>
    </caption>

    <thead class="ui-widget-header">
      <tr style="height: 30px;">
        <th class="sf_admin_text sf_admin_list_th_nombre ui-state-default ui-th-column">Producto</th>
        <th id="sf_admin_list_th_actions" class="ui-state-default ui-th-column">Acciones</th>
      </tr>
    </thead>

    <tfoot>
      <tr>
        <th colspan="8">
          <div class="ui-state-default ui-th-column ui-corner-bottom"></div>
        </th>
      </tr>
    </tfoot>

    <tbody>
      <?php foreach ($productos as $i => $producto): $odd = fmod(++$i, 2) ? ' odd' : '' ?>
        <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
          <td class="sf_admin_text sf_admin_list_td_nombre"><?php echo $producto->getProducto(); ?></td>
          <td style="white-space: nowrap;">
            <ul class="sf_admin_td_actions fg-buttonset fg-buttonset-single">
              <?php echo link_to('Borrar', 'promo/'.$accion.'?pid='.$producto, 'class=fg-button-mini fg-button ui-state-default fg-button-icon-left ') ?>
            </ul>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

</div>