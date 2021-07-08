<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Sistema de Ventas</title>
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
		
		if (!empty($favicon)) echo '<link rel="shortcut icon" href="/images/'.$favicon.'" />';
		if (!empty($jquery) && $jquery == 'S') echo '<link rel="stylesheet" type="text/css" media="screen" href="/sfAdminThemejRollerPlugin/css/jquery/redmond/jquery-ui.custom.css" />';
		if (!empty($cssmenu)) echo '<link rel="stylesheet" type="text/css" media="screen" href="/css/'.$cssmenu.'" />';
		?>
  </head>
  <body style="margin:0px">
  <?php 
  if ($sf_user->isAuthenticated()): // if de login
    $id = $sf_user->getGuardUser()->getId();
		
		if($mostrar_cabecera == 'S'){ ?>
			<header>
					<div id="logo">
						<img src="/images/<?php echo $logo_cabecera ?>">
					</div>
					<div id="info">
						<b>Usuario: <?php echo $sf_user->getGuardUser() ?></b><br>
						<b>Versión del Sistema: 5.6</b><br>
						Fecha Actualización: 08/07/2021
					</div>
					<?php if (date("Ymd") == '20210708') { ?>
					<img src="/images/new.png" style="position: absolute;right: 0px;top: 0px;">
					<?php } ?>
			</header>
		<?php 
		} 
		?>

		<div id="nav">
				<?php
					/* para que esto funcione tuve que modificar la clase sfDoctrineGuardPlugin	- getAllPermissions */
					$statement = Doctrine_Manager::getInstance()->connection(); 
					$sql = 'select name, description, padre from sf_guard_permission where id >=1000 order by id';
					$results = $statement->execute($sql);
					$bandera = 0;
					echo "<ul><li>".link_to("Inicio","@homepage")."</li>";
					foreach ($results as $r){
						if ($r['padre'] == 1000 && ($sf_user->hasPermission($r['name']) || $sf_user->isSuperAdmin())) {
							echo $bandera?"</ul></li>":"";
							if ($r['name'] == 'Pedidos') {
								echo '<li style="margin-right:10px;"><a href="javascript:void();">'.$r['name'];
								include_component('ped', 'CantPedNuevos');
							} else {
								echo '<li><a href="javascript:void();">'.$r['name']."</a>";
							}
							echo "</a><ul>";
							$bandera = 1;
						}
						if ($r['name'] == 'Cambiar Clave') {
							echo "<li>".link_to($r['name'], "sfGuardUser/clave?id=".$id)."</li>";
						} else {
							if ($r['padre'] > 1000 && ($sf_user->hasPermission($r['name']) || $sf_user->isSuperAdmin())) {
								echo "<li>".link_to($r['name'], $r['description'])."</li>";
							}
						}
					}
					echo $bandera?"</ul></li>":"";
					echo "<li class='menu'>".link_to("Salir", "sf_guard_signout")."</li>";
					echo "</ul>";
				?>    	
    </div>
    <?php endif; //del login ?>
		
    
    <?php echo $sf_content ?>
    
  </body>
</html>
<script type="text/javascript"> $(".chzn-select").chosen();</script>