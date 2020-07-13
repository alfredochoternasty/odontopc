<div style="position:absolute;top:0; left:0; width:45%;">
  <table>
    <caption class="fg-toolbar ui-widget-header ui-corner-top">
      <h1>Pedidos Nuevos</h1>
    </caption>

    <thead class="ui-widget-header">
      <tr>
        <th class="ui-state-default" style="height:2em;">Nro</th>
        <th class="ui-state-default" style="height:2em;">Fecha</th>
        <th class="ui-state-default" style="height:2em;">Cliente</th>
        <th class="ui-state-default" style="height:2em;">Entrega</th>
        <th class="ui-state-default" style="height:2em;"></th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($pager2 as $i => $pedido): $odd = fmod(++$i, 2) ? ' odd' : '' ?>
        <tr class="sf_admin_row ui-widget-content <?php echo $odd ?>">
          <td class="sf_admin_text"><?php echo $pedido->getId() ?></td>
          <td class="sf_admin_text"><?php echo implode('/', array_reverse(explode('-', $pedido->getFecha()))) ?></td>
          <td class="sf_admin_text"><?php echo $pedido->getCliente() ?></td>
          <td class="sf_admin_text"><?php echo $pedido->getDireccionEntrega() ?></td>
          <td style="white-space: nowrap;">
            <ul class="sf_admin_td_actions fg-buttonset fg-buttonset-single">
              <li class="sf_admin_action_detalle">
                <?php echo link_to('Ver Detalle', 'pedidos/ListDetalle?id='.$pedido->getId(), 'class=fg-button-mini fg-button ui-state-default fg-button-icon-left ') ?>
              </li>
            </ul>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
