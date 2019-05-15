<html>
<head>
</head>
<body>
<h2>Pago</h2>
<h2>Fecha: <?php echo $pago->fecha ?></h2>
<h2><?php echo $pago->getRevendedor(); ?></h2>
<h3>Facturas</h3>
<table border="1" cellspacing="0" cellpadding="1" width="100%">
  <tr>
    <th style="background: #CCC;">Fecha</th>
    <th style="background: #CCC;">Factura</th>
    <th style="background: #CCC;">Cliente</th>
  </tr>
  <?php $suma_total = 0; ?>
  <?php foreach($facturas as $fila):?>
  <tr>
    <td><?php echo implode("/", array_reverse(explode("-", $fila->getFecha()))) ?></td>
    <td><?php echo $fila ?></td>
    <td><?php echo $fila->getCliente() ?></td>
  </tr>
  <?php endforeach;?> 
</table>
</body>
<html>