<html>
<head>
<title>Listado de control de stock</title>
<style type="text/css">
@page {
	margin: 2cm;
}

body {
	font-family: sans-serif;
	margin: 0.5cm 0;
	text-align: justify;
}

#header,
#footer {
	position: fixed;
	left: 0;
	right: 0;
	font-size: 0.9em;
}

#header {
	top: 0;
}

#footer {
	bottom: 0;
	border-top: 0.1pt solid #000000;
}

#header table {
	width: 100%;
	border-collapse: collapse;
	border: none;
}

#header td {
	padding: 0;
	width: 50%;
}

.page-number {
	text-align: right;
}

.page-number:before {
	content: "P?gina " counter(page);
}

hr {
	page-break-after: always;
	border: 0;
}

.lista_precios,
.lista_precios td{
	border: 1px solid #000000;
}
</style>
</head>
<body>
<div id="header">
  <table>
    <tr>
      <td>Impreso por: <?php echo $sf_user; ?></td>
      <td style="text-align: right;"><?php echo date("d/m/Y H:i:s"); ?></td>
    </tr>
  </table>
</div>
<div id="footer">
  <div style="float:right;text-align:right;" class="page-number"></div>
</div>
<h2>Listado para Control de Stock - <?php echo $listado[0]->getZona() ?></h2>
<table border="1" cellspacing="0" cellpadding="1" width="100%">
  <tr>
    <th style="background: #CCC;">Producto</th>
    <th style="background: #CCC;">Lote</th>
    <th style="background: #CCC;">Comprados</th>
    <th style="background: #CCC;">Vendidos</th>
    <th style="background: #CCC;">Stock</th>
    <th style="background: #CCC;">Ult. Movimiento<br>(Vta/Dev)</th>
  </tr>
  <?php 
	foreach($listado as $fila):
	?>
  <tr>
    <td><?php echo utf8_decode($fila->getProducto()->nombre) ?></td>
    <td><?php echo $fila->getNroLote() ?></td>
		<td style="text-align:center;"><?php echo $fila->getComprados() ?></td>
    <td style="text-align:center;"><?php echo (!empty($fila->vendidos))?$fila->vendidos - $fila->cant_dev:'0'; ?></td>
    <td style="text-align:center;"><?php echo $fila->stock_guardado ?></td>
    <td style="text-align:center;"><?php echo implode('/', array_reverse(explode('-', $fila->ult_venta))) ?></td>
  </tr>
  <?php endforeach;?>
</table>
</body>
<html>