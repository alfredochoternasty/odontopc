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
.lista_precios td{
	border: 1px solid #3D6092;
	padding: 3pt;
}
</style>
</head>
<body>
	<div id="header">
		<table>
			<tr>
				<td>Listado de Precios - <?php echo date("d/m/Y"); ?></td>
				<td style="text-align: right;">Isetra</td>
			</tr>
		</table>
	</div>

<div id="footer">
  <div style="float:left;"></div>
  <div style="float:right;text-align:right;" class="page-number"></div>
</div>

<table width="100%" class="lista_precios">  
<?php
	$base_url = 'http://192.168.0.5/'.$sf_user->getVarConfig('base_url');
	$count = 1;
  $grupo = 0;
  foreach($productos as $producto):
    $aux = $producto->getGrupoprodId();
		$count++;
    if($aux <> $grupo){
			$count=1;
      $grupo = $aux;
      ?>
        <tr>
          <td colspan="<?php echo ($mostrar_foto===true)? 3:2 ?>" style="background-color:#3D6092;color:#ffffff;font-weight:bold;"><?php echo utf8_decode($producto->getGrupo()) ?></td>
        </tr>            
      <?php
    }
?>
	<tr>
<?php	
		$foto_grupo = '';
		if ($mostrar_foto) {
			if ($count == 1) {
				$foto_grupo = $producto->getGrupo()->getFotoChica();
				if (!empty($foto_grupo)) { 
					echo '<td colspan="3"><img src="'.$base_url.'/uploads/productos/'.$foto_grupo.'"></td></tr><tr>';
				}
			}
			if (empty($foto_grupo)) { 
				$foto_prod = $producto->getFotoChica();
				if (!empty($foto_prod)) {
					echo '<td><img src="'.$base_url.'/uploads/productos/'.$foto_prod.'"></td>';
				} else {
					echo '<td></td>';
				}
			}
		}
  ?>
    <td <?php echo (($mostrar_foto===true) && !empty($foto_grupo))?'colspan="2"':'' ?>>
			<?php echo utf8_decode($producto->nombre) ?><br>
			<span style="font-size:8pt;color:#999999">C&oacute;digo: <?php echo $producto->getCodigo() ?></span>
		</td>
    <td>
			<?php 
				$precio = $producto->precio_vta;
				$iva = round($precio * 0.21, 1);
				$total = round($precio + $iva);
				echo '$ '.sprintf("%01.2f", $total);
			?>
		</td>
  </tr>
  <?php 
  endforeach;
  ?>
</table>
</body>
<html>