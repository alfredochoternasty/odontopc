<?php use_stylesheet('login.css') ?>
<?php use_stylesheet('reset.css') ?>

<form class="box login" action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
	<fieldset class="boxBody">
	  <?php 
    echo $form['username']->renderError();
    echo $form['username']->renderLabel();
    echo $form['username']->render();
	  echo $form['password']->renderLabel();
	  echo $form['password']->render();
    echo $form['_csrf_token']; 
    ?>
	</fieldset>
	<footer>
	  <input type="submit" class="btnLogin" value="Iniciar Sesión" tabindex="3">
	</footer>
</form>