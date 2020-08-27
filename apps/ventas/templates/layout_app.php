<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
  <head>
    <title>NTI implantes Pedidos</title>
		<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1">
		<meta name="mobile-web-app-capable" content="yes">
		<?php
			use_helper('Date');
			$base_url = $sf_user->getVarConfig('base_url');
			$favicon = $sf_user->getVarConfig('favicon');	
		?>
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $base_url?>/web/css/app.css">
	
		<script src="<?php echo $base_url?>/web/sfAdminThemejRollerPlugin/js/jquery.min.js"></script>
		<style>
			#loader {
				position: fixed;
				left: 0px;
				top: 0px;
				width: 100%;
				height: 100%;
				z-index: 9999;
				background: url('<?php echo $base_url?>/web/images/loader.gif') 50% 50% no-repeat rgb(249,249,249);
				opacity: .8;
			}			
		</style>
		<script type="text/javascript">
			function abrir_menu(){$(".sidemenu").css("left","0");}
			function abrir_promo(){
				$("#promociones").css("bottom","0px");
				$("#promociones").css("height","87%");
				$("#abrir_promo").css("display","none");
				$("#cerrar_promo").css("display","revert");
			}
			function cerrar_menu(){$(".sidemenu").css("left","-1000px");}
			function cerrar_promo(){
				$("#promociones").css("bottom","0px");
				$("#promociones").css("height","30px");
				$("#cerrar_promo").css("display","none");
				$("#abrir_promo").css("display","revert");
			}
			$(document).ready(function(){$("#menu").click(function(e){abrir_menu();});});
			$(document).ready(function(){$("#cerrar_menu").click(function(e){cerrar_menu();});});
			$(document).ready(function(){$("#abrir_promo").click(function(e){abrir_promo();});});
			$(document).ready(function(){$("#cerrar_promo").click(function(e){cerrar_promo();});});
			$(document).ready(function(){$("#grupo_id").on("change",function(e){$("#grupos").submit();});});
			$(window).load(function(){$("#loader").fadeOut("fast");});
			function validar(p_form) {
				var cant = p_form['cantidad'].value;
				if (cant != '' && cant > 0) {
					return true;
				} else {
					alert('Para poder relizar el pedido debe ingresar una cantidad');
					p_form['cantidad'].focus();
					return false;
				}
			}
		</script>
  </head>
  <body style="margin:0px;font-family:sans-serif;">
	<div id="loader"></div>
	<div class="sidemenu">
    <div id="user_info">
			<div id="user_img"><img src="<?php echo $base_url?>/web/images/user.png"></div>
			<div id="user_name"><?php echo $sf_user->getGuardUser() ?></div>
			<div id="cerrar_menu"><img id="cerrar_menu" src="<?php echo $base_url?>/web/images/cross.png" width="16px" height="16px"></div>			
    </div>		
		<div id="saldo">
			<span>Saldo</span><span style="margin-left:4px;color:#F00;">
			<?php
				$clientes = Doctrine::getTable('Cliente')->findByUsuarioId($sf_user->getGuardUser()->getId());
				echo "$ ".$clientes[0]->getSaldoCtaCte(1, null, true);
			?>
			</span>
		</div>
		<nav>
			<ul>
				<li><img src="<?php echo $base_url?>/web/images/implante.png"><a href="<?php echo url_for('@producto2') ?>">Lista de Productos</a></li>
				<li><img src="<?php echo $base_url?>/web/images/box.png"><a href="<?php echo url_for('ped/pedidos') ?>">Pedidos</a></li>
				<li><img src="<?php echo $base_url?>/web/images/cta_cte.png"><a href="<?php echo url_for('ctacte/ver') ?>">Cuenta Corriente</a></li>
				<li><img src="<?php echo $base_url?>/web/images/facturas.png"><a href="<?php echo url_for('facafip/ver') ?>">Facturas</a></li>
				<li><img src="<?php echo $base_url?>/web/images/password.png"><a href="<?php echo url_for('usuario/edit?id='.$sf_user->getGuardUser()->getId()) ?>">Cambiar Clave</a></li>
				<li><img src="<?php echo $base_url?>/web/images/logout.png"><a href="<?php echo url_for('@sf_guard_signout') ?>">Salir</a></li>
			</ul>
		</nav>
	</div>
	
		<div id="header_app">
			<table>
				<tr>
					<td width="25%"><img id="menu" src="<?php echo $base_url?>/web/images/app_menu.png"></td>
					<td width="50%" style="text-align: center;"><img id="logo" src="<?php echo $base_url?>/web/images/logo_chico.png"></td>
					<td width="25%"></td>
				</tr>
			</table>
		</div>

		<?php echo $sf_content ?>
  </body>
</html>