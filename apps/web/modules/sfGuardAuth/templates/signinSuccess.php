<?php use_stylesheet('login.css') ?>
<?php use_stylesheet('reset.css') ?>
<?php $base_url = $sf_user->getVarConfig('base_url'); ?>
<div class="cabecera"><img src="<?php echo $base_url ?>/web/images/logo_nti.png"></div>
<?php echo get_partial('sfGuardAuth/signin_form', array('form' => $form)) ?>