<html>
<head>
<style type="text/css">
body {font-family:sans-serif; font-size:0.7em;}
#filtro_utilizado {font-size:0.6em;margin-bottom:0.9em;}
#header {margin-bottom:0.1em;}
.page-number {text-align: right;}
.page-number:before {content: "Página " counter(page);}
hr {page-break-after: always;border: 0;}
#footer1 {position:fixed; bottom:0; left:0; width:70%; font-size: 0.5em;}
#footer2 {position:fixed; bottom:0; right:0; width:20%}
</style>
</head>
<body>
<img src="images/logo_nti.png" width=204 height=77 style="position:absolute;left:0;top:-20;"><br>
<h2 id="header" style="width:100%;text-align:center;margin-top:2.5em">Stock por debajo del minimo</h2>
<br>
<div id="footer1">Impreso por: <?php echo $sf_user.' ('.date("d/m/Y H:i:s").')' ?></div>
<div id="footer2" class="page-number"></div>
<div id="content">
<table cellspacing="0" border="1px" width="100%">
  <thead>
	<tr>
    <th style="background: #CCC;">Producto</th>
    <th style="background: #CCC;">Actual</th>
    <th style="background: #CCC;">Minimo</th>
  </tr>
  </thead>
  <tbody>
	<?php foreach ($datos as $i => $dato): ?>
	  <tr>
      <td><?php echo $dato->nombre ?></td>
      <td><?php echo $dato->stock ?></td>
      <td><?php echo $dato->minimo_stock ?></td>
	  </tr>
	<?php endforeach ?>
  </tbody>
</table>
</div>
</body>
</html>
