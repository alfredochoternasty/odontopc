<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>Odonto Venta</title>
    <link rel="shortcut icon" href="../images/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
    <?php use_helper('Date') ?>
    <?php if($sf_user->hasGroup('Blanco')): ?>
      <link rel="stylesheet" type="text/css" media="screen" href="/web/sfAdminThemejRollerPlugin/css/jquery/redmond/jquery-ui.custom.css" />
      <link rel="stylesheet" type="text/css" media="screen" href="/web/css/cssmenu_b.css" />
    <?php endif; ?>    
  </head>
  <body style="margin:0px">
  <?php 
  if ($sf_user->isAuthenticated()): // if de login
    $id = $sf_user->getGuardUser()->getId();
		
		if($sf_user->hasGroup('Blanco')){ ?>
			<div id="nti_header">
				<center>
				<div id="img_nti_header"></div>
				</center>
			</div>
		<?php 
		}
	endif; //del login ?>
   
  <?php echo $sf_content ?>
    
  </body>
</html>