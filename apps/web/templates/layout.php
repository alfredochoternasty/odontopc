<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>Odonto Venta</title>
	<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1">
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
    <?php use_helper('Date') ?>
    <?php 
		
    $entorno = sfConfig::get('sf_environment');
		if($entorno == 'dev'){
			$prefijo = '/odontopc';
		} else {
			$prefijo = '';
		}
		
		if($sf_user->hasGroup('Blanco')): ?>
			<link rel="shortcut icon" href="/web/images/favicon_b.ico" />
      <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $prefijo ?>/web/sfAdminThemejRollerPlugin/css/jquery/redmond/jquery-ui.custom.css" />
      <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $prefijo ?>/web/css/cssmenu_b.css" />
    <?php else: ?> 
			<link rel="shortcut icon" href="/web/images/favicon_n.ico" />
			<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $prefijo ?>/web/css/cssmenu_n.css" />
    <?php endif; ?>
  </head>
  <body style="margin:0px">
  <?php 
  if ($sf_user->isAuthenticated()): // if de login
    $id = $sf_user->getGuardUser()->getId();
		
		if($sf_user->hasGroup('Blanco')){ ?>
			<div id="nti_header">
				<center>
				<div id="img_nti_header">
					<br>
					<b>Usuario: <?php echo $sf_user->getGuardUser() ?></b><br>
					<b>Versión del Sistema: 2.6</b><br>
					Fecha Actualización: 15/05/2019
				</div>
				</center>
			</div>
		<?php 
		} 
		?>
        
		<div id="cssmenu">
			<center>
				<?php
					/* para que esto funcione tuve que modificar la clase sfDoctrineGuardPlugin	- getAllPermissions */
					$statement = Doctrine_Manager::getInstance()->connection();  
					$sql = 'select name, description, padre from sf_guard_permission where id >=10 order by id';
					$results = $statement->execute($sql);
					$bandera = 0;
					echo "<ul><li>".link_to("Inicio","@homepage")."</li>";
					foreach ($results as $r){
						
						if ($r['padre'] == 0 && ($sf_user->hasPermission($r['name']) || $sf_user->isSuperAdmin())) {
							echo $bandera?"</ul></li>":"";
							echo "<li class='has-sub'><a href='#'><span>".$r['name']."</span></a><ul>";
							$bandera = 1;
						}
						if ($r['name'] == 'Cambiar Clave') {
							echo "<li>".link_to($r['name'], "sfGuardUser/edit?id=".$id)."</li>";
						} else {
							if ($r['padre'] > 0 && ($sf_user->hasPermission($r['name']) || $sf_user->isSuperAdmin())) {
								echo "<li>".link_to($r['name'], $r['description'])."</li>";
							}
						}
					}
					echo $bandera?"</ul></li>":"";
					echo "<li>".link_to("Salir", "sf_guard_signout")."</li></ul>";
				?>    	
      </center>
    </div>

    <?php endif; //del login ?>
    
    <?php echo $sf_content ?>
    
  </body>
</html>
<script type="text/javascript"> $(".chzn-select").chosen();</script>