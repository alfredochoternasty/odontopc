<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php 
		
		$base_url = $sf_user->getVarConfig('base_url');
		$favicon = $sf_user->getVarConfig('favicon');
		$jquery = $sf_user->getVarConfig('jquery_theme');
		$cssmenu = $sf_user->getVarConfig('cssmenu');
		$mostrar_cabecera = $sf_user->getVarConfig('mostrar_cabecera');
		$logo_cabecera = $sf_user->getVarConfig('logo_cabecera');
    
    ?>
		<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1">
		<meta name="mobile-web-app-capable" content="yes">
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
    <?php use_helper('Date') ?>
    <?php 
		
		$base_url = $sf_user->getVarConfig('base_url');
		$favicon = $sf_user->getVarConfig('favicon');
		$jquery = $sf_user->getVarConfig('jquery_theme');
		$cssmenu = $sf_user->getVarConfig('cssmenu');
		$mostrar_cabecera = $sf_user->getVarConfig('mostrar_cabecera');
		$logo_cabecera = $sf_user->getVarConfig('logo_cabecera');
		
		if (!empty($favicon)) echo '<link rel="shortcut icon" href="'.$base_url.'/images/'.$favicon.'" />';
		if (!empty($jquery) && $jquery == 'S') echo '<link rel="stylesheet" type="text/css" media="screen" href="'.$base_url.'/sfAdminThemejRollerPlugin/css/jquery/redmond/jquery-ui.custom.css" />';
		?>
    <style>
		.sf_admin_flashes {
			margin: 20px;
			font-size: 1.5em;
			font-weight: bold;
		}
		
    .grid-container {
      display: grid;
      grid-gap: 70px;
      justify-items: center;
      align-items: center;
			grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
			margin: 30px;
    }

    .grid-item1 {
      text-align: center;
      width: 300px;
      height: 300px;
    }
		
		.button {
			text-decoration:none; text-align:center; 
			 padding:11px 32px; 
			 border:solid 1px #004F72; 
			 -webkit-border-radius:4px;
			 -moz-border-radius:4px; 
			 border-radius: 4px; 
			 font:14px Arial, Helvetica, sans-serif; 
			 font-weight:bold; 
			 color:#ffffff; 
			 background-color:#3BA4C7; 
			 background-image: -moz-linear-gradient(top, #3BA4C7 0%, #1982A5 100%); 
			 background-image: -webkit-linear-gradient(top, #3BA4C7 0%, #1982A5 100%); 
			 background-image: -o-linear-gradient(top, #3BA4C7 0%, #1982A5 100%); 
			 background-image: -ms-linear-gradient(top, #3BA4C7 0% ,#1982A5 100%); 
			 filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1982A5', endColorstr='#1982A5',GradientType=0 ); 
			 background-image: linear-gradient(top, #3BA4C7 0% ,#1982A5 100%);   
			 -webkit-box-shadow:0px 0px 2px #bababa, inset 0px 0px 1px #ffffff; 
			 -moz-box-shadow: 0px 0px 2px #bababa,  inset 0px 0px 1px #ffffff;  
			 box-shadow:0px 0px 2px #bababa, inset 0px 0px 1px #ffffff;  
		}
    </style>
  </head>
	<body style="margin:0px;font-family:sans-serif;">
			<header style="height: 200px; padding: 0px;text-align: center;">
					<div><img src="<?php echo $base_url?>/images/<?php echo $logo_cabecera ?>"></div>
          <div style="background-color: #135c88;text-align: center;"><img src="<?php echo $base_url?>/images/fondo_cursos.png"></div>
			</header>
    <?php echo $sf_content ?>
  </body>
</html>
