<?php include_partial('global/cabecera_impresion') ?>
<h2 id="titulo">Productos con stock por debajo del m&iacute;nimo</h2>
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
      <td><?php echo utf8_decode($dato->nombre) ?></td>
      <td><?php echo $dato->stock ?></td>
      <td><?php echo $dato->minimo_stock ?></td>
	  </tr>
	<?php endforeach ?>
  </tbody>
</table>
<?php include_partial('global/pie_impresion') ?>