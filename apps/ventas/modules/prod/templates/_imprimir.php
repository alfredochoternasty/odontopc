<?php include_partial('global/cabecera_impresion') ?>
<table border="1" cellspacing="0" cellpadding="1" width="100%">
  <tr>
    <th style="background: #CCC;">Grupo</th>
    <th style="background: #CCC;">Nombre</th>
    <th style="background: #CCC;">Precio Venta</th>
  </tr>
  <?php $count = 0;
  foreach($productos as $producto):
    $count++;
  ?>
  <tr>
    <td><?php if($producto->getGrupoprodId()) echo $producto->getGrupo(); ?></td>
    <td><?php echo $producto->getNombre() ?></td>
    <td><?php echo '$ '.sprintf("%01.2f", round($producto->getPrecioVta()*1.21, 0)) ?></td>
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
<?php include_partial('global/pie_impresion') ?>