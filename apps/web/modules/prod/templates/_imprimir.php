<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

<title>Listado de Productos</title>
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
	color: #666;
	font-size: 0.9em;
}

#header {
  top: 0;
	border-bottom: 0.1pt solid #666;
}

#footer {
  bottom: 0;
  border-top: 0.1pt solid #666;
}

#header table,
#footer table {
	width: 100%;
	border-collapse: collapse;
	border: none;
}

#header td,
#footer td {
  padding: 0;
	width: 50%;
}

.page-number {
  text-align: right;
}

.page-number:before {
  content: " " counter(page);
}

hr {
  page-break-after: always;
  border: 0;
}
</style>
</head>
<body>
<div id="header">
  <table>
    <tr>
      <td>Listado de Productos</td>
      <td style="text-align: right;">NTI Implantes</td>
    </tr>
  </table>
</div>

<div id="footer">
  <div class="page-number"></div>
</div>

<table border="1" cellspacing="0" cellpadding="1" width="100%">
  <tr>
    <th style="background: #CCC;">Grupo</th>
    <th style="background: #CCC;">Nombre</th>
    <th style="background: #CCC;">Precio Venta</th>
    <th style="background: #CCC;">Stock Actual</th>
    <th style="background: #CCC;">Stock M&iacute;nimo</th>
    <th style="background: #CCC;">Gen. Comisi&oacute;n</th>
  </tr>
  <?php $count = 0;
  foreach($productos as $producto):
    $count++;
  ?>
  <tr>
    <td><?php if($producto->getGrupoprodId()) echo $producto->getGrupo(); ?></td>
    <td><?php echo $producto->getNombre() ?></td>
    <td><?php echo '$ '.sprintf("%01.2f", $producto->getPrecioVta()) ?></td>
    <td><?php echo $producto->getStockActual() ?></td>
    <td><?php echo $producto->getMinimoStock() ?></td>
    <td><?php echo $producto->getGeneraComision() ?></td>
  </tr>
  <?php 
    if($count == 500){
      $count = 0;
      ?>
      </table>
      <hr>
      <br />
      <table border="1" cellspacing="0" cellpadding="1" width="100%">
        <tr>
          <th width="20%" style="background: #CCC;">Grupo</th>
          <th width="30%" style="background: #CCC;">Nombre</th>
          <th width="10%" style="background: #CCC;">Precio Venta</th>
          <th width="10%" style="background: #CCC;">Stock Actual</th>
          <th width="10%" style="background: #CCC;">Stock M&iacute;nimo</th>
          <th width="20%" style="background: #CCC;">Gen. Comisi&oacute;n</th>
        </tr>
      <?php    
    }
  endforeach;
  ?>
</table>
</body>
<html>