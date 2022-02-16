<?php use_helper('I18N', 'Date') ?>

<div style="margin: 10px 0;font-size: 1.15em;font-weight: bold;font-family: Lucida Grande, Lucida Sans, Arial, sans-serif;">
<?php if ($sf_user->hasFlash('notice')): ?>
  <div style="padding: 10px;-moz-border-radius: 5px;-webkit-border-radius: 5px;border: 1px solid #fad42e;background: #fbec88 url(images/ui-bg_flat_55_fbec88_40x100.png) 50% 50% repeat-x;color: #363636;">
    <span style="
    width: 16px;
    height: 16px;
    float: left;
    background-repeat: no-repeat;
    background-position: -16px -144px;
    background-image: url(images/ui-icons_2e83ff_256x240.png);
    "></span>&nbsp;
    <?php echo __($sf_user->getFlash('notice'), array(), 'sf_admin') ?>
  </div>
<?php endif; ?>
</div>

<div class="grid-container">
<?php foreach ($cursos as $curso): ?>
      <div class="grid-item1">
        <table>
          <tr><td><img height="100%" width="100%" src="<?php echo url_for('inicio/GetImagen?img='.$curso->getLogo()) ?>"></td></tr>
          <tr><td style="height:50px;text-align:center;"><a href="<?php echo url_for('insc_curso/new?cid='.$curso->id) ?>" class="button"/>Consulta por Inscripci&oacute;n</a></td></tr>
        </table>
      </div>
<?php endforeach; ?>
</div>