<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

<title>Listado de items</title>
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
	color: #3D6092;
	font-weight: bold;
}

#footer {
	color: #666;
	bottom: 0;
	border-top: 0.1pt solid #666;
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
	content: "Página " counter(page);
}

hr {
	page-break-after: always;
	border: 0;
}

.lista_precios,
.lista_precios td{
	border: 1px solid #3D6092;
}

</style>
</head>
<body>
<img src="images/nti_lista.jpg">
<hr>
<div id="header">
  <table>
    <tr>
      <td>Listado de Precios - <?php echo date("d/m/Y"); ?></td>
      <td style="text-align: right;">NTI Implantes</td>
    </tr>
  </table>
</div>

<div id="footer">
  <div style="float:left;">Todos los precios incluyen IVA</div>
  <div style="float:right;text-align:right;" class="page-number"></div>
</div>

<table width="100%" class="lista_precios">  
  <?php
	$count = 1;
  $grupo = 0;
  foreach($productos as $producto):
    $aux = $producto->getGrupoprodId();
    if($aux <> $grupo){
      $grupo = $aux;
      $count++;
      ?>
        <tr>
          <td colspan="3" style="background-color:#3D6092;color:#ffffff;font-weight:bold;"><?php echo $producto->getGrupo() ?></td>
        </tr>            
      <?php
    }
  ?>
  <tr>
    <td><?php echo $producto->getCodigo() ?></td>
    <td><?php echo $producto->getNombre() ?></td>
    <td>
			<?php 
				$precio = $producto->getPrecioVta();
				$iva = $precio * 0.21;
				$total = $precio + $iva;
				echo '$ '.sprintf("%01.2f", $total);
			?>
		</td>
  </tr>
  <?php 
    if($count >= 36){
      $count = 1;
      ?>
        <tr>
          <td colspan="3" style="background-color:#3D6092;color:#ffffff;font-weight:bold;"><?php echo $producto->getGrupo() ?></td>
        </tr>            
      <?php
    }
	$count++;
  endforeach;
  ?>
</table>
<p><b>Por compras superiores a 10-20-50-100 consultar promociones</b></p>

</body>
<html>