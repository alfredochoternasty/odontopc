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
		$mostrar_cabecera = $sf_user->getVarConfig('mostrar_cabecera');
		
		if (!empty($favicon)) echo '<link rel="shortcut icon" href="'.$base_url.'/web/images/'.$favicon.'" />';
		if (!empty($jquery) && $jquery == 'S') echo '<link rel="stylesheet" type="text/css" media="screen" href="'.$base_url.'/web/sfAdminThemejRollerPlugin/css/jquery/redmond/jquery-ui.custom.css" />';
		if (!empty($cssmenu)) echo '<link rel="stylesheet" type="text/css" media="screen" href="'.$base_url.'/web/css/'.$cssmenu.'" />';
		?>
  </head>
  <body style="margin:0px">
  <?php 
  if ($sf_user->isAuthenticated()): // if de login
    $id = $sf_user->getGuardUser()->getId();
		
		if($mostrar_cabecera == 'S'){ ?>
			<div class="cabecera">
				<center>
					<div class="img_cabecera">
						<br>
						<b>Usuario: <?php echo $sf_user->getGuardUser() ?></b><br>
						<b>Versión del Sistema: 5.0</b><br>
						Fecha Actualización: 17/07/2020
					</div>
					<?php if (date("Ymd") == '20200717') { ?>
					<img src="<?php echo $prefijo ?>/web/images/new.png" style="position: absolute;right: 0px;top: 0px;">
					<?php } ?>
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
							echo "<li class='has-sub'><a href='#'><span>".$r['name']."</span>";
							if ($r['name'] == 'Pedidos') include_component('ped', 'CantPedNuevos');	
							echo "</a><ul>";
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
					echo "<li>".link_to("Salir", "sf_guard_signout")."</li>";
					echo "</ul>";
				?>    	
      </center>
    </div>
    <?php endif; //del login ?>
		
    
    <?php echo $sf_content ?>
    
  </body>
</html>
<script type="text/javascript"> $(".chzn-select").chosen();</script>