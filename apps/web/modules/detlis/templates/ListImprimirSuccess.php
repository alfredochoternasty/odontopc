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
	font-size: 0.6em;
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
  content: "Pagina " counter(page);
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
      <td style="text-align: left;">Lista de Precios</td>
      <td style="text-align: right;">NTI Implantes</td>
    </tr>
  </table>
</div>
<table border="0" cellspacing="0" cellpadding="1" width="100%">
  <tr><td style="text-align: center;"><h1>Lista de Precios</h1></td></tr>
  
  <?php $count = 1;
  $grupo = 0;
  foreach($productos as $producto):
    $count++;
    $aux = $producto->getGrupoprodId();
    if($aux <> $grupo){
      $grupo = $aux;
      $count += 3;
      ?>
      </table><br>
      <table border="1" cellspacing="0" cellpadding="1" width="100%">
        <tr>
          <th colspan="2" style="background: #CCC;"><?php echo $producto->getGrupo() ?></th>
        </tr>            
        <tr>
          <th style="background: #CCC;">Nombre</th>
          <th style="background: #CCC;">Precio Venta</th>
        </tr>      
      <?php
    }
  ?>
  <tr>
    <td><?php echo $producto->getNombre() ?></td>
    <td><?php echo '$ '.sprintf("%01.2f", $producto->getPrecioFinal($lista)) ?></td>
  </tr>
  <?php 
    if($count >= 37){
      $count = 2;
      ?>
      </table>
      <hr>
      <br />
      <table border="1" cellspacing="0" cellpadding="1" width="100%">
        <tr>
          <th colspan="2" style="background: #CCC;"><?php echo $producto->getGrupo() ?></th>
        </tr>                  
        <tr>
          <th width="30%" style="background: #CCC;">Nombre</th>
          <th width="10%" style="background: #CCC;">Precio Venta</th>
        </tr>
      <?php    
    }
  endforeach;
  ?>
</table>

<div id="footer">
  <table>
    <tr>
      <td style="text-align: left;"><?php echo date('d/m/Y') ?></td>
      <td style="text-align: right;"><div class="page-number"></div></td>
    </tr>
  </table>
</div>
</body>
<html>