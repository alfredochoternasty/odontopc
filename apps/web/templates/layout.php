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
  if ($sf_user->isAuthenticated()): 
          $id = $sf_user->getGuardUser()->getId();
  ?>
  <?php if($sf_user->hasGroup('Blanco')): ?>
    <div id="nti_header">
      <center>
      <div id="img_nti_header"></div>
      </center>
    </div>
  <?php endif; ?>
    
    <?php if($sf_user->hasPermission('cliente')): ?>    
  	<div id="cssmenu">
      <center>
  		<ul>
        <li><?php echo link_to("Inicio","@homepage")?></li>
        <li class='has-sub '><a href='#'><span>Usuario</span></a>
          <ul>
            <li><?php echo link_to("Cambiar Clave ","sfGuardUser/edit?id=".$id)?></li>
          </ul>
        </li>
        <li class='has-sub '><a href='#'><span>Pedidos</span></a>
          <ul>
            <li><?php echo link_to("Nuevo Pedido","@nuevo_pedido")?></li>
            <li><?php echo link_to("Pedido Pendientes","ped/index")?></li>
            <li><?php echo link_to("Pedido Cerrados","pedcerr/index")?></li>
          </ul>
        </li>
        <li><?php echo link_to("Salir","sf_guard_signout")?></li>
      </ul>
      </center>
    </div>        
    <?php endif; ?>
    
    <?php if($sf_user->hasPermission('traza')): ?>    
  	<div id="cssmenu">
      <center>
  		<ul>
        <li><?php echo link_to("Inicio","@cliente")?></li>
        <li class='has-sub '><a href='#'><span>Clientes</span></a>
          <ul>
            <li><?php echo link_to("Administraci&oacute;n de Clientes","@cliente")?></li>
          </ul>
        </li>
        <li class='has-sub '><a href='#'><span>Producto</span></a>
          <ul>
            <li><?php echo link_to("Productos","@producto2")?></li>
            <li><?php echo link_to("Grupo de Productos","@grupoprod2")?></li>
            <li><?php echo link_to("Ventas Realizadas","@traza2")?></li>
          </ul>
        </li>
        <li class='has-sub '><a href='#'><span>Proveedor</span></a>
          <ul>
            <li><?php echo link_to("Proveedores","@proveedor")?></li>
            <li><?php echo link_to("Compras","@compra2")?></li>
          </ul>
        </li>
        <li><?php echo link_to("Salir","sf_guard_signout")?></li>
      </ul>
      </center>
    </div>        
    <?php endif; ?>
    
    <?php if($sf_user->hasPermission('datos') || $sf_user->hasPermission('admin')): ?>    
  	<div id="cssmenu">
      <center>
  		<ul>
        <li><?php echo link_to("Inicio","@homepage")?></li>
        <li class='has-sub '><a href='#'><span>Ventas</span></a>
          <ul>
            <li><?php echo link_to("Nueva Venta","resumen/new")?></li>
            <li><?php echo link_to("Ventas Realizadas","@resumen")?></li>
            <li><?php echo link_to("Devolver Producto","@dev_producto")?></li>
            <li><?php echo link_to("Listado de Ventas","@listado_ventas")?></li>
          </ul>
        </li>
        <li class='has-sub '><a href='#'><span>Pedidos</span></a>
          <ul>
            <li><?php echo link_to("Pedidos Pendientes","@pedido_pedidos")?></li>
            <li><?php echo link_to("Pedidos Vendidos","@pedido_pedvend")?></li>
          </ul>
        </li>
        <li class='has-sub '><a href='#'><span>Clientes</span></a>
          <ul>                
            <li><?php echo link_to("Administraci&oacute;n de Clientes","@cliente")?></li>
            <li><?php echo link_to("Cobros","@cobro")?></li>
            <li><?php echo link_to("Listado Cobros Realizados","@listado_cobros")?></li>
            <li><?php echo link_to("Listado de Saldos","@cliente_saldos")?></li>
            <li><?php echo link_to("Listado de Cuenta Corriente","@ctacte")?></li>
            <li><?php echo link_to("Ultima compra por cliente","@cliente_ultima_compra")?></li>
            <li><?php echo link_to("Seguimiento de clientes","@cliente_seguimiento")?></li>
          </ul>
        </li>
        <li class='has-sub '><a href='#'><span>Proveedores</span></a>
          <ul>        
            <li><?php echo link_to("Administraci&oacute;n de Proveedores","@proveedor")?></li>
            <li><?php echo link_to("Compras","@compra")?></li>            
            <li><?php echo link_to("Pagos","@pago")?></li>
            <li><?php echo link_to("Listado de Cuenta Corriente","@cta_cte_prov")?></li>
            <li><?php echo link_to("Listado de compras","@listado_compras")?></li>
          </ul>
        <li>
        <li class='has-sub '><a href='#'><span>Productos</span></a>
          <ul>
            <li><?php echo link_to("Administraci&oacute;n de Productos","@producto")?></li>
            <li><?php echo link_to("Administraci&oacute;n de Presupuestos","@presupuesto")?></li>
            <li><?php echo link_to("Grupo de Productos","@grupoprod")?></li>
            <li><?php echo link_to("Administraci&oacute;n de Lista de Precios","@lista_precio")?></li>
            <li><?php echo link_to("Listado y Modificación de Stock","@lote")?></li>
            <li><?php echo link_to("Traza de Productos","@producto_traza")?></li>
            <li><?php echo link_to("Listado de Control de Stock","@control_stock")?></li>
          </ul>
        </li>
        <li class='has-sub '><a href='#'><span>Cursos</span></a>
          <ul>
            <li><?php echo link_to("Administraci&oacute;n de Cursos","@curso")?></li>
            <li><?php echo link_to("Inscriptos a Cursos","@curso_inscripcion")?></li>
            <li><?php echo link_to("Asistencia de Inscriptos","@curso_inscripcion_curasis")?></li>
            <li><?php echo link_to("Mails Enviados","@curso_mail_enviado")?></li>
          </ul>
        </li>
        <li class='has-sub '><a href='#'><span>Configuraci&oacute;n</span></a>
          <ul>
            <li><?php echo link_to("Ciudades","@localidad")?></li>
            <li><?php echo link_to("Provincias","@provincia")?></li>	
            <li><?php echo link_to("Bancos","@banco")?></li>	
            <li><?php echo link_to("Cambiar Clave","sfGuardUser/edit?id=".$id)?></li>
            <li><?php echo link_to("Actualizar desde Negro","inicio/act_local")?></li>
            <li><?php echo link_to("Actualizar desde Blanco.","inicio/act_exp")?></li>
            <?php if($sf_user->hasPermission('admin')): ?>
            <li><?php echo link_to("Cuentas para Compras","@cuenta")?></li>
            <li><?php echo link_to("Tipos de Clientes","@tipo_cliente")?></li>
            <li><?php echo link_to("Cond. Fiscal","@condicion_fiscal")?></li>
            <li><?php echo link_to("Tipos de Facturas","@tipo_factura")?></li>
            <li><?php echo link_to("Tipos de Cobros/Pagos","@tipo_cobro_pago")?></li>            
            <li><?php echo link_to("Tipos de Monedas","@tipo_moneda")?></li>         
            <li><?php echo link_to("Usuarios","@admin_user")?></li>            
            <li><?php echo link_to("Grupos","@sf_guard_group")?></li>            
            <li><?php echo link_to("Permisos","@sf_guard_permission")?></li>            
            <?php endif; ?>
          </ul>
        </li>
        <li><?php echo link_to("Salir","sf_guard_signout")?></li>
      </ul>
      </center>
    </div>
    <?php endif; // del permiso?>
    <?php endif; //del login
    ?>
    
    <?php echo $sf_content ?>
    
  </body>
</html>
<script type="text/javascript"> $(".chzn-select").chosen();</script>