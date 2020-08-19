<?php use_helper('I18N', 'Date') ?>
<?php include_partial('registro/assets') ?>

<div id="sf_admin_container" style="margin-top:20%">
  <p style="text-align:center; font-size:1.3rem; font-weigth:bold;">
    Gracias <?php echo $cliente->apellido.' '.$cliente->nombre ?> por registrarte, se envi&oacute; un email a <?php echo $cliente->email ?> con el usuario y la clave para ingresar
    <br><br><a href="<?php echo url_for('@homepage') ?>">Ir al inicio</a>
  </p>
</div>
