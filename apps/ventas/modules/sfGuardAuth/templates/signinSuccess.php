<?php use_stylesheet('reset.css') ?>
<?php $login_css = $sf_user->getVarConfig('login_css'); ?>
<?php use_stylesheet($login_css) ?>
<?php $logo_login = $sf_user->getVarConfig('logo_login'); ?>
<div class="cabecera"><img src="/images/<?php echo $logo_login ?>"></div>
<?php echo get_partial('sfGuardAuth/signin_form', array('form' => $form)) ?>