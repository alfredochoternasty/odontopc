<?php $login_css = $sf_user->getVarConfig('login_css'); ?>
<?php use_stylesheet('reset.css') ?>
<?php use_stylesheet($login_css) ?>
<?php $base_url = $sf_user->getVarConfig('base_url'); ?>
<?php $logo_login = $sf_user->getVarConfig('logo_login'); ?>
<div class="cabecera"><img src="<?php echo $base_url ?>/images/<?php echo $logo_login ?>"></div>
<?php echo get_partial('sfGuardAuth/signin_form', array('form' => $form)) ?>