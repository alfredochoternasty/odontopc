<?php use_stylesheet('login.css') ?>
<?php use_stylesheet('reset.css') ?>
<form class="form-login" action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
	<div class="msg_error"><?php echo $form['username']->renderError() ?></div>
	<input class="form-componente user_icon" type="text" name="signin[username]" placeholder="Usuario">
	<input class="form-componente pass_icon" type="password" name="signin[password]" placeholder="Clave">
  <?php echo $form['_csrf_token']; ?>
	<button class="boton-login" type="submit">Ingresar</button>
</form>