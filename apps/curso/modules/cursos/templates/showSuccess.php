<?php if ($curso->getHabilitado() == 'SI'){ ?>
  <?php if ($sf_user->hasFlash('notice')){ ?>
      <div class="success"><?php echo $sf_user->getFlash('notice') ?></div>
  <?php } ?>
  <img style="margin-left:10px;" src="/uploads/cursos/<?php echo $curso->getLogo()?>" />
  <?php if($curso->getDescripcion() != ''){ ?>
  <div style="width:60%; font-family: verdana; padding-left:10px;">
    <p style="padding:5px;"><?php echo $curso->getDescripcion() ?></p>
  </div>
  <?php } ?>
  
  <ul style="font-family: verdana;">
    <li><strong>Fecha: </strong><?php echo implode('/', array_reverse(explode('-', $curso->getFecha()))) ?> <strong>- Hora: </strong><?php echo $curso->getHora() ?></li>
    <li><strong>Lugar: </strong><?php echo $curso->getLugar() ?> <strong>- Mapa: </strong><a href="<?php echo $curso->getLinkMapa() ?>" target="_blank" alt="Enlace mapas de google">Enlace mapas de google</a></li>
  
  <?php if($curso->getMostrarPrecio() == 'SI'){ ?>
      <li><strong>Precio: </strong><?php echo $curso->getPrecio() ?></li>
    <?php } ?>

    <?php if($curso->getPermiteInsc() == 'SI'){ ?>
    <li><strong>Inscripcion: </strong><?php echo $curso->InscripcionDesdeHasta() ?></li>
	<?php } ?>
	
	<?php if ($curso->getFoto1() != '') { ?>
    <li><strong>Programa: </strong><a href="src="/uploads/cursos/<?php echo $curso->getFoto1() ?>" alt="programa del curso">Descargar en este enlace</a></li>
    <?php } ?>
  </ul>
  <?php if ($curso->getPermiteInsc() == 'SI'){ ?>
    <?php if ($curso->getIniInsc() <= date("Y-m-d") && $curso->getFinInsc() >= date("Y-m-d")){ ?>
      <?php if ($sf_user->hasFlash('notice')){ ?>
          <div class="success"><?php echo $sf_user->getFlash('notice') ?></div>
      <?php }else{ ?>
      <form id="form_inscripcion" action="<?php echo url_for('cursos/inscribir?cid='.$curso->getId()) ?>" method="post" style="margin-left:10px;" onsubmit="return function(){var valor = document.getElementById('email').value;if( valor == null || valor.length == 0 || /^\s+$/.test(valor)){return false;}}">
        <?php if ($sf_user->hasFlash('error')): ?>
            <div class="error"><?php echo $sf_user->getFlash('error') ?></div>
        <?php endif; ?>
        </div>
        <div>
          <label for="nombre">Nombre y Apellido: </label>
          <input id="nombre" type="text" name="nombre" value="<?php echo $sf_user->getAttribute('nombre') ?>" /><br/><br/>
          <label for="email">Email: </label>
          <input id="email" type="text" name="email" value="<?php echo $sf_user->getAttribute('email') ?>" /><br/><br/>
          <br>Necesitamos verificar que eres una persona, para eso escribe el resultado de la siguiente operaci&oacute;n matem&aacute;tica<br>
          <label for="verif"><?php echo $sf_user->getAttribute('captcha') ?></label>
          <input id="verif" type="text" name="verif" value="" /><br/><br/>    
          <input type="submit" value="Inscribirse a este Curso" class="myButton" />
        </div>
      </form>
      <?php } ?>
    <?php } ?>
  <?php } ?>
<?php }else{ ?>
  <div class="error">Curso No Disponible</div>
<?php } ?>