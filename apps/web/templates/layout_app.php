<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>Odonto Venta</title>
	<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1">
	<meta name="mobile-web-app-capable" content="yes">
	<script src="/web/sfAdminThemejRollerPlugin/js/jquery.min.js"></script>
    <?php use_helper('Date') ?>
	<style>
		.combo_grupos select, .combo_orden select {
		  /*background: transparent;*/
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
		  background: url(/web/images/list.png) no-repeat #fff;
		  float:right;
		  margin-top:7px;
		  margin-right:5px;
		}
		.combo_orden {
		  background: url(/web/images/sort.png) no-repeat #fff;
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
			background: url('/web/images/loader.gif') 50% 50% no-repeat rgb(249,249,249);
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
		a:link, a:visited, a:active,a:hover {text-decoration: none;outline:0;}
		.sidemenu {background:#fff;position:absolute;left:-300px;top:0;width:300px;height:100%;overflow:hidden;transition: left .5s;z-index:999}
		.sidemenu ul {list-style:none;padding:10px}
		.sidemenu ul li {display:flex;padding:10px;}
		.sidemenu ul li a:link,.sidemenu ul li a:active,.sidemenu ul li a:visited {display:inline;padding:8px;color:#000;transition: 0.3s;}
		.sidemenu ul li a:hover {background:#FFF;}
		.sidemenu ul li img {display:inline;margin:5px; width:24px;height:24px;}
		.contenedor {display:inline;float:left;width:100%;padding:20px;transition: margin-left .5s;}
		.toggle {display:block;width:40px;height:40px;background:#f2f2f2 url(toggle.png) 50% 50% no-repeat}
	</style>
	<script type="text/javascript">
		function abrir(){$(".sidemenu").css("left","0");}
		function cerrar(){$(".sidemenu").css("left","-300px");}
		$(document).ready(function(){$("#menu").click(function(e){abrir();});});
		$(document).ready(function(){$("#cerrar_menu").click(function(e){cerrar();});});
		$(document).ready(function(){$("#grupo_id").on("change",function(e){$("#grupos").submit();});});
		$(window).load(function(){$(".loader").fadeOut("fast");});
		function validar(p_form) {
			var cant = p_form['cantidad'].value;
			if (cant != '') {
				return true;
			} else {
				alert('Para poder relizar el pedido debe ingresar la cantidad');
				p_form['cantidad'].focus();
				return false;
			}
		}
	</script>
  </head>
  <body style="margin:0px;font-family:sans-serif;">
	  <div class="loader"></div>
	  
<div class="sidemenu">
    <div style="height:80px;background:#03528a">
		<table cellpadding="5px">
		  <tr>
			<td><img id="user" src="/web/images/user.png"></td>
			<td width="80%" style="font-size:12pt;color:#fff;font-weight:bold;"><?php echo $sf_user->getGuardUser() ?></td>
			<td style="vertical-align:top"><img id="cerrar_menu" src="/web/images/cross.png" width="16px" height="16px"></td>
		  </tr>
		</table>
    </div>
	<div style="height:20px;background:#F3F3F3;text-align:center;padding:5px;">
		<span style="font-weight:bold;font-size:12pt;">Saldo</span>
		<span style="margin-left:4px;font-weight:bold;font-size:12pt;color:#F00">$ XXXX,XX</span>
	</div>
		<nav>
			<ul>
				<li><img src="/web/images/implante.png"><a href="<?php echo url_for('@producto2') ?>">Lista de Productos</a></li>
				<li><img src="/web/images/box.png"><a href="#">Pedidos</a></li>
				<li><img src="/web/images/cta_cte.png"><a href="#">Cuenta Corriente</a></li>
				<li><img src="/web/images/facturas.png"><a href="#">Facturas</a></li>
				<li><img src="/web/images/logout.png"><a href="<?php echo url_for('@sf_guard_signout') ?>">Salir</a></li>
			</ul>
		</nav>
	</div>
	  
		<div style="width:100%; height:50px; background-color:#2982F3; position:fixed; top:0px; left:0px;">
			<img id="menu" src="/web/images/app_menu.png" style="margin:10px;float:left;vertical-align:center;">
			<a href="carrito/index">
			<img id="carrito" src="/web/images/shopping-cart.png" style="margin:10px;float:right; vertical-align:center;">
			</a>
			<?php 
			if (!empty($sf_user->getAttribute('pid'))) {
				$ped_cant_prods = count(Doctrine::getTable('DetallePedido')->findByPedidoId($sf_user->getAttribute('pid', 0)));
				if (!empty($ped_cant_prods)) echo '<div class="cant_prods">'.$ped_cant_prods.'</div>';
	  		}
			?>
		</div>
	  	<div style="width:100%; height:auto; background-color:#fff; margin-top:90px;">
		<?php echo $sf_content ?>
	    </div>
  </body>
</html>