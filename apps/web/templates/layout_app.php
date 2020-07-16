<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
  <head>
    <title>Odonto Venta</title>
		<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1">
		<meta name="mobile-web-app-capable" content="yes">
	<?php
		$base_url = $sf_user->getVarConfig('base_url');
		$favicon = $sf_user->getVarConfig('favicon');	
	?>
	
	<script src="<?php echo $base_url?>/web/sfAdminThemejRollerPlugin/js/jquery.min.js"></script>
    <?php use_helper('Date') ?>
	<style>
		.combo_grupos select, .combo_orden select {
		  width: 90%;
		  font-size: 10pt;
		  color: #000;
		  border-style: none;
		  height: 25px;
	      padding: 1px;
		}
		.combo_grupos, combo_orden {
		  margin: 2px;
		  width: 90%;
		  height: 25px;
		  border-style: none;
		  border-radius: 3px;
		  overflow: hidden;
		}
		.combo_grupos {
		  background: url(<?php echo $base_url?>/web/images/list.png) no-repeat #fff;
		  float:right;
		  margin-top:7px;
		  margin-right:5px;
		}
		.combo_orden {
		  background: url(<?php echo $base_url?>/web/images/sort.png) no-repeat #fff;
		  float:left;
		  margin-top:7px;
		  margin-left:5px;
		}
		.loader {
			position: fixed;
			left: 0px;
			top: 0px;
			width: 100%;
			height: 100%;
			z-index: 9999;
			background: url(<?php echo $base_url?>'/web/images/loader.gif') 50% 50% no-repeat rgb(249,249,249);
			opacity: .8;
		}
		.cant_prods{
			float: right;
			position: fixed;
			top: 5px;
			right: 4px;
			width: 20px;
			height: 20px;
			background-color: red;
			border-radius: 50%;
			text-align: center;
			padding: 1px;
			color: white;
			font-weight: bold;
		}
		
		.boton_arriba_derecha{position: fixed;right: 5pt;}
		.boton_abajo_1{bottom: 10px;}
		.boton_abajo_2{bottom: 70px;}
		
		a:link, a:visited, a:active,a:hover {text-decoration: none;outline:0;}
		.sidemenu {background:#fff;position:absolute;left:-400px;top:0;width:100%;height:100%;overflow:hidden;transition: left .5s;z-index:999}
		.sidemenu ul {list-style:none;padding:10px}
		.sidemenu ul li {display:flex;padding:10px; border-bottom: 1px solid #c3c3c3;}
		.sidemenu ul li a:link,.sidemenu ul li a:active,.sidemenu ul li a:visited {display:inline;padding:8px;color:#000;transition: 0.3s;}
		.sidemenu ul li a:hover {background:#FFF;}
		.sidemenu ul li img {display:inline;margin:5px; width:24px;height:24px;}
		.contenedor {display:inline;float:left;width:100%;padding:20px;transition: margin-left .5s;}
		.toggle {display:block;width:40px;height:40px;background:#f2f2f2 url(toggle.png) 50% 50% no-repeat}
		
		.boton_azul{
			position: absolute;
			left: 8%;
			height: 5%;
			width: 80%;
			color: #fff;
			font-size: 15pt;
			padding: 2%;
			background-color: #0787da;
			border: 1px solid #0660f7;
			display: flex;
			justify-content: center;
			align-items: center;
		}
		
		.boton_blanco{
			position: absolute;
			left: 8%;
			height: 5%;
			width: 80%;
			color: #0660f7;
			font-size: 15pt;
			padding: 2%;
			background-color: #fff;
			border: 1px solid #0660f7;
			display: flex;
			justify-content: center;
			align-items: center;
		}
		
		.boton_prod{
			display:inline;
			border: none;
			font: normal normal bold 8pt/normal Verdana, Geneva, sans-serif;
			color: #fff;
			background: #f4800c;
			height: 17pt;
		}
		
		.form_terminar {
			position: fixed;
			top: 110px;
			width:97%; 
			border: 1px solid #c3c3c3;
			margin:1%; 
			display:flex; 
			justify-content: center; 
			align-items: center;
			font-weight: bold;
		}
		.form_terminar input[type="radio"] {display: none;}

		.form_terminar label {
			display: inline-block;
			padding: 4px 11px;
			font-family: Arial;
			font-size: 16px;
			cursor: pointer;
			padding: 5%;
			margin: 3%;
			width: 85%;
			color: #000;
			display: flex;
			align-items: center;
		}

		.form_terminar img {margin-right: 10px;}
		.form_terminar input[type="radio"]:checked+label {background-color: #ff8000; color: #fff;}
		.contenido {position:fixed; top:50px; height: 90%; overflow: scroll; width:99%; font-family: verdana; font-size: small;}
		.contenido_boton {height: 80%;}
		.titulo {color: #ff800C;text-align: center;}
		.fila_contenido {width:97%; border: 1px solid #cccccc; margin:2%;}
		.fila_primario {font-weight: bold; color: #2982f3;}
		.fila_secundario {font-weight: bold;text-align: center;color: #a0a0a2;}
		.precio {text-align:right; font-weight: bold; color:#e20202; font-size:11pt;}
		.monto {text-align:right; font-weight: bold; font-size:12pt;}
		.monto_positivo {color:#ff0040}
		.monto_negativo {color:#008c46}
		
	</style>
	<script type="text/javascript">
		function abrir(){$(".sidemenu").css("left","0");}
		function cerrar(){$(".sidemenu").css("left","-400px");}
		$(document).ready(function(){$("#menu").click(function(e){abrir();});});
		$(document).ready(function(){$("#cerrar_menu").click(function(e){cerrar();});});
		$(document).ready(function(){$("#grupo_id").on("change",function(e){$("#grupos").submit();});});
		// $(window).load(function(){$(".loader").fadeOut("fast");});
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
	  <!-- <div class="loader"></div> -->
	  
	<div class="sidemenu">
    <div style="height:80px;background:#03528a">
		<table cellpadding="5px">
		  <tr>
			<td><img id="user" src="<?php echo $base_url?>/web/images/user.png"></td>
			<td width="80%" style="font-size:12pt;color:#fff;font-weight:bold;"><?php echo $sf_user->getGuardUser() ?></td>
			<td style="vertical-align:top"><img id="cerrar_menu" src="<?php echo $base_url?>/web/images/cross.png" width="16px" height="16px"></td>
		  </tr>
		</table>
    </div>
		<div style="height:20px;background:#F3F3F3;text-align:center;padding:2%;font-size:14pt;font-weight:bold;">
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
				<li><img src="<?php echo $base_url?>/web/images/logout.png"><a href="<?php echo url_for('@sf_guard_signout') ?>">Salir</a></li>
			</ul>
		</nav>
	</div>
	  
		<div style="width:100%; height:50px; background-color:#2982F3; position:fixed; top:0px; left:0px;">
			<table width="100%">
				<tr>
					<td width="35px"><img id="menu" src="<?php echo $base_url?>/web/images/app_menu.png" style="margin:5px;float:left;vertical-align:center;"></td>
					<td style="text-align:center;vertical-align:initial;"><img id="menu" height="40px" src="<?php echo $base_url?>/web/images/logo_chico.png"></td>
					<td width="35px"></td>
				</tr>
			</table>
		</div>
		<?php echo $sf_content ?>
  </body>
</html>