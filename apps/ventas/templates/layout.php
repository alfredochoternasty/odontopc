<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
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
		$logo_cabecera = $sf_user->getVarConfig('logo_cabecera');
		
		if (!empty($favicon)) echo '<link rel="shortcut icon" href="'.$base_url.'/images/'.$favicon.'" />';
		if (!empty($jquery) && $jquery == 'S') echo '<link rel="stylesheet" type="text/css" media="screen" href="'.$base_url.'/sfAdminThemejRollerPlugin/css/jquery/redmond/jquery-ui.custom.css" />';
		if (!empty($cssmenu)) echo '<link rel="stylesheet" type="text/css" media="screen" href="'.$base_url.'/css/'.$cssmenu.'" />';
		?>
		
		<script type="text/javascript">
			function abrir(){$(".menujq").css("left","0");}
			function cerrar(){$(".menujq").css("left","-400px");}
			$(document).ready(function(){$("#menu").click(function(e){abrir();});});
			$(document).ready(function(){$("#cerrar_menu").click(function(e){cerrar();});});
			$(document).ready(function(){
				$('.menujq > ul > li:has(ul)').addClass('desplegable');
				$('.menujq > ul > li > a').click(function() {
					var comprobar = $(this).next();
					$('.menujq li').removeClass('activa');
					$(this).closest('li').addClass('activa');
					if((comprobar.is('ul')) && (comprobar.is(':visible'))) {
						$(this).closest('li').removeClass('activa');
						comprobar.slideUp('normal');
					}
					if((comprobar.is('ul')) && (!comprobar.is(':visible'))) {
						$('.menujq ul ul:visible').slideUp('normal');
						comprobar.slideDown('normal');
					}
				});
			});
		</script>
  </head>
  <body style="margin:0px">
  <?php 
  if ($sf_user->isAuthenticated()): // if de login
    $id = $sf_user->getGuardUser()->getId();
		
		if($mostrar_cabecera == 'S'){ ?>
			<header>
					<div id="logo">
						<img src="<?php echo $base_url?>/images/<?php echo $logo_cabecera ?>">
					</div>
					<div id="info">
						<b>Usuario: <?php echo $sf_user->getGuardUser() ?></b><br>
						<b>Versión del Sistema: 5.0</b><br>
						Fecha Actualización: 27/07/2020
					</div>
					<?php if (date("Ymd") == '20200727') { ?>
					<img src="<?php echo $base_url ?>/images/new.png" style="position: absolute;right: 0px;top: 0px;">
					<?php } ?>
			</header>
		<?php 
		} 
		?>
 		<div class="header" style="width:100%; height:60px; background-color:#eaeaea; position:fixed; top:0px; left:0px;">
			<img id="menu" src="<?php echo $base_url?>/images/menu.png" style="margin:10px;float:left">			
		</div>
		<div id="nav" class="menujq">
			<img id="cerrar_menu" src="<?php echo $base_url?>/images/back.png" style="position: absolute;top: 5px; right: 10px;">
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
							echo "<li><a href='javascript:void();'>".$r['name'];
							if ($r['name'] == 'Pedidos') include_component('ped', 'CantPedNuevos');	
							echo "</a><ul>";
							$bandera = 1;
						}
						if ($r['name'] == 'Cambiar Clave') {
							echo "<li>".link_to($r['name'], "sfGuardUser/clave?id=".$id)."</li>";
						} else {
							if ($r['padre'] > 0 && ($sf_user->hasPermission($r['name']) || $sf_user->isSuperAdmin())) {
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