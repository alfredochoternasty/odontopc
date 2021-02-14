<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//Es" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="es" xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

<title>Lista de precios NTI Implantes</title>
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
	content: "P?gina " counter(page);
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
	$dir_fotos = sfConfig::get('sf_upload_dir').'/productos/';
	$count = 1;
  $grupo = 0;
  foreach($productos as $producto):
    $aux = $producto->getGrupoprodId();
		$count++;
    if($aux <> $grupo){
			$count=1;
      $grupo = $aux;
			$foto_grupo = !empty($producto->getGrupo()->foto);
      ?>
        <tr style="background-color:#3D6092;color:#ffffff;font-weight:bold;">
					<td colspan="<?php echo !$mostrar_foto?2:3 ?>">
						<?php 
							if ($foto_grupo && $mostrar_foto) echo '<img src="'.$dir_fotos.$producto->getGrupo()->getImagen().'">';
							echo '&nbsp;&nbsp;&nbsp;'.$producto->getGrupo();
						?>
					</td>
        </tr>            
      <?php
    }
?>
	<tr>
		<?php 
			if (!$foto_grupo && $mostrar_foto) echo '<td width="150px"><img witdh="150" height="80" src="'.$dir_fotos.$producto->getImagen().'"></td>'; 
		?>
    <td <?php if ($foto_grupo && $mostrar_foto) echo 'colspan="2"' ?>>
			<?php echo $producto->nombre ?><br>
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
<p><b>Por compras superiores a 10-20-50-100 consultar promociones</b></p>

</body>
<html>