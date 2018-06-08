<html>
<head>
</head>
<body>
<h2>Listado solo totales para Control de Stock</h2>
<table border="1" cellspacing="0" cellpadding="1">
  <tr>
    <th style="background: #CCC;">Producto</th>
    <th style="background: #CCC;">Cant. Vendidos</th>
    <th style="background: #CCC;">Cant. Bonificados</th>
    <th style="background: #CCC;">Total</th>
    <th style="background: #CCC;">Stock s/Lote</th>
  </tr>
  <?php 
  $tot_vend = 0;
  $tot_bono = 0;
  $tot_tot = 0;
  $suma_total_vend = 0;
  $suma_total_bon = 0;
  $suma_total_tot = 0;
  $suma_tot_lote = 0;
  $anterior = $listado[0];
  foreach($listado as $control_stock):
    if($control_stock->getProductoId() != $anterior->getProductoId() && $tot_tot > 0){
      $suma_tot_lote += $anterior->getStockSinLote();
      $suma_total_vend += $tot_vend;
      $suma_total_bon += $tot_bono;
      $suma_total_tot += $tot_tot;          
    ?>
      <tr>
        <td><?php echo $anterior->getProducto() ?></td>
        <td><?php echo $tot_vend ?></td>
        <td><?php echo $tot_bono ?></td>
        <td><?php echo $tot_tot ?></td>
        <td><?php echo $anterior->getStockSinLote() ?></td>
      </tr>
  <?php 
      $anterior = $control_stock;
      $tot_vend = $control_stock->getCantidadVendida();
      $tot_bono = $control_stock->getCantidadBonificados();
      $tot_tot = $control_stock->getCantidadTotal();
    } else{
      $tot_vend += $control_stock->getCantidadVendida();
      $tot_bono += $control_stock->getCantidadBonificados();
      $tot_tot += $control_stock->getCantidadTotal();
    }
  endforeach; 
  $suma_tot_lote += $anterior->getStockSinLote();
  $suma_total_vend += $tot_vend;
  $suma_total_bon += $tot_bono;
  $suma_total_tot += $tot_tot;           
  ?>
    <tr>
      <td><b>Total: </b></td>
      <td><?php echo $suma_total_vend ?></td>
      <td><?php echo $suma_total_bon ?></td>
      <td><?php echo $suma_total_tot ?></td>
      <td><?php echo $suma_tot_lote ?></td>
    </tr>  
</table>
</body>
<html>