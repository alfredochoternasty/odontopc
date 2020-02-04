<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>Odonto Venta</title>
	<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1">
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
    <?php use_helper('Date') ?>
    <?php 
		
		$base_url = $sf_user->getVarConfig('base_url');
		$favicon = $sf_user->getVarConfig('favicon');
		$jquery = $sf_user->getVarConfig('jquery_theme');
		$cssmenu = $sf_user->getVarConfig('cssmenu');
		
		if (!empty($favicon)) echo '<link rel="shortcut icon" href="'.$base_url.'/web/images/'.$favicon.'" />';
		if (!empty($jquery) && $jquery == 'S') echo '<link rel="stylesheet" type="text/css" media="screen" href="'.$base_url.'/web/sfAdminThemejRollerPlugin/css/jquery/redmond/jquery-ui.custom.css" />';
		if (!empty($cssmenu)) echo '<link rel="stylesheet" type="text/css" media="screen" href="'.$base_url.'/web/css/'.$cssmenu.'" />';
		?>
  </head>
  <body style="margin:0px">
		<div style="width:100%; height:50px; background-color:#7EB1EA;">
			<img src="/odontopc/web/images/app_menu.png" style="margin:10px;float:left; vertical-align:center;">
			<img src="/odontopc/web/images/shopping-cart.png" style="margin:10px;float:right; vertical-align:center;">
		</div>
		<br>
		<?php echo $sf_content ?>
  </body>
</html>
<script type="text/javascript"> $(".chzn-select").chosen();</script>