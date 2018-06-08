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
      <td>Listado de Precios</td>
      <td style="text-align: right;">NTI Implantes</td>
    </tr>
  </table>
</div>

<div id="footer">
  <div class="page-number"></div>
</div>

<table border="1" cellspacing="0" cellpadding="1" width="100%">
  <?php $count = 0;
  $moneda = Doctrine::getTable('ListaPrecio')->find($lista)->getMoneda()->getSimbolo();
  $grupo = '';
  foreach($productos as $producto):        
    $count++;
    if($todos == 'si'){
      if($producto->getGrupoprodId() !=  $grupo){
        echo '<tr><td colspan="2" style="background: #CCC;">'.$producto->getGrupo().'</td></tr>';
        $grupo = $producto->getGrupoprodId();
      }
    }
    try{
      echo '<tr><td>'.$producto->getNombre().'</td>';
    }catch(Exception $e){
      $nom = $producto->getProducto();
      if($nom == '') $nom = $producto->getGrupo();
      echo '<tr><td>'.$nom.'</td>';
    }
    if($producto->getGrupoprodId()){
      $prods_grupo = Doctrine::getTable('Producto')->findByGrupoprodId($producto->getGrupoprodId());
      if(empty($prods_grupo[1])){
        $prec = '-'; //'Error, este grupo no tiene productos!';
      }else{
        $prec = $prods_grupo[1]->getPrecioFinal($lista);
      }
    }else{
      $prec = $producto->getProducto()->getPrecioFinal($lista);
    }
    ?>
      <td><?php echo is_numeric($prec)? $moneda.' '.sprintf("%01.2f", $prec) : $prec; ?></td>
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
          <th width="30%" style="background: #CCC;">Nombre</th>
          <th width="10%" style="background: #CCC;">Precio Venta</th>
        </tr>
      <?php    
    }
  endforeach;
  ?>
</table>
</body>
<html>