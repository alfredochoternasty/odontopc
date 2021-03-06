function truncar (x, posiciones = 0) {
  var s = x.toString()
  var l = s.length
  var decimalLength = s.indexOf('.') + 1
  var numStr = s.substr(0, decimalLength + posiciones)
  return Number(numStr)
}

function roundToTwo(num) {    
    return +(Math.round(num + "e+2")  + "e-2");
}

jQuery(function($){
// $("#cliente_cuit").mask("99-99999999-9",{placeholder:" "});
// $("#proveedor_cuit").mask("99-99999999-9",{placeholder:" "});
// $("#cliente_seguimiento_hora").mask("99:99",{placeholder:" "});
// $("#cliente_seguimiento_prox_contac_hora").mask("99:99",{placeholder:" "});
// $("#curso_hora").mask("99:99",{placeholder:" "});
$("#curso_mail_enviado_tipo_envio").change(function(event){
	var id = $("#curso_mail_enviado_tipo_envio").find(':selected').val();
	if (id == 3) {
		alert('Seguro que desea enviar información del curso a TODOS LOS CLIENTES ??');
	}
});
$("#resumen_tipofactura_id").change(function(event){
	var id = $("#resumen_tipofactura_id").find(':selected').val();
	if (id == 4) {
		$('#resumen_remito_id').attr('disabled', true);
	} else {
		$('#resumen_remito_id').attr('value', '');
		$('#resumen_remito_id').attr('disabled', false);
	}
});

  $("#promocion_grupos").change(function(event){
    var id = $("#promocion_grupos").find(':selected').val();
    $.ajax({
        url: 'GetProductosGrupo?gid='+id,
        // dataType: "json",
        success: function(data) {
					$(".sf_admin_form_field_productos ul").html(data);
					
				},
      });
  });
});

//pedidos 
$(document).ready(function(){
  $("#detalle_pedido_producto_id").change(function(event){
    var id = $("#detalle_pedido_producto_id").find(':selected').val();
    $.ajax({
        url: 'actprecio?pid='+id,
        dataType: "json",
        success: function(data) {
          $("#detalle_pedido_precio").attr('value', data);
          var cantidad = $("#detalle_pedido_cantidad").val();
          var total = data * cantidad;
          $("#detalle_pedido_total").attr('value', total.toFixed(2));
        },
      });
  });
  
  $("#detalle_pedido_cantidad").change(function(event){
      var cantidad = parseInt($("#detalle_pedido_cantidad").val());
      var precio = $("#detalle_pedido_precio").val();
      var total = cantidad * precio;
      $("#detalle_pedido_total").attr('value', total.toFixed(2));                
  });  
});


$(document).ready(function(){
  $("#producto_total").bind("propertychange keyup input paste", function(event){
		var total = $("#producto_total").val();
		total = total * 1;
		var precio = roundToTwo(total / 1.21);
		var iva = total - precio;
		$("#producto_iva").attr('value', iva.toFixed(2));
		$("#producto_precio_vta").attr('value', precio.toFixed(2));
	});
});





//PRESUPUESTO 
$(document).ready(function(){
  $("#detalle_presupuesto_producto_id").change(function(event){
    var id = $("#detalle_presupuesto_producto_id").find(':selected').val();
    var pid = $("#detalle_presupuesto_presupuesto_id").val();
    $.ajax({
        url: 'actprecio?pid='+id+'&prid='+pid,
        dataType: "json",
        success: function(data) {
          $("#detalle_presupuesto_precio").attr('value', data);
          var cantidad = $("#detalle_presupuesto_cantidad").val();
          var subtotal = data * cantidad;
          var iva = subtotal * 0.21;
          var total = subtotal + iva; 
					$("#detalle_presupuesto_sub_total").attr('value', subtotal.toFixed(2));
          $("#detalle_presupuesto_total").attr('value', total.toFixed(2));
          $("#detalle_presupuesto_iva").attr('value', iva.toFixed(2));
        }
      });
  });
  
  $("#detalle_presupuesto_precio").bind("propertychange keyup input paste", function(event){
		calcular_precio_presupuesto();
	});
  
  $("#detalle_presupuesto_cantidad").bind("propertychange keyup input paste", function(event){
		calcular_precio_presupuesto();
  });
	
  $("#detalle_presupuesto_descuento").change(function(event){
		calcular_precio_presupuesto();
  });
	
	function calcular_precio_presupuesto() {
		var cantidad = $("#detalle_presupuesto_cantidad").val();
		var descuento = $("#detalle_presupuesto_descuento").find(':selected').val();
		var precio = $("#detalle_presupuesto_precio").val();
		if (descuento > 0) {
			precio = precio - (precio * (descuento/100))
		}
		if ($('#detalle_presupuesto_iva').length){
			var subtotal = cantidad * precio;
			var iva = subtotal * 0.21;
			var total = subtotal + iva;    
			$("#detalle_presupuesto_iva").attr('value', iva.toFixed(2));
			$("#detalle_presupuesto_sub_total").attr('value', subtotal.toFixed(2));
		}else{
			var total = cantidad * precio;
		}
		$("#detalle_presupuesto_total").attr('value', total.toFixed(2));		
	}
});

//resumen
$(document).ready(function(){
  $("#resumen_cliente_id").change(function(event){
    var id = $("#resumen_cliente_id").find(':selected').val();
    $.ajax({
        url: 'datoscliente?cid='+id,
        dataType: "json",
        success: function(data) {
          $("#resumen_cuit").attr('value', data.cuit);
          $("#resumen_afip").attr('value', data.afip);
          $("#resumen_saldo_pesos").attr('value', data.saldo_pesos);
          $("#resumen_saldo_dolar").attr('value', data.saldo_dolar);
        },
      });
			
    $.ajax({
        url: 'gettipofacli?cid='+id,
        dataType: "json",
        success: function(data) {
          $("#resumen_tipofactura_id").html(data);
        },
      });
  });
	
	$("#resumen_tipofactura_id").change(function(event){
    var fid = $("#resumen_tipofactura_id").find(':selected').val();
		if (fid == 4) {
			$("#resumen_remito_id").attr('value', '');
			$(".sf_admin_form_field_remito_id").hide();
			$(".sf_admin_form_field_comp_asoc_id").hide();
			$(".sf_admin_form_field_nro_factura").show();
			$.ajax({
					url: 'getnroremito',
					dataType: "json",
					success: function(data) {
						$("#resumen_nro_factura").attr('value', data);
					}
			});
		} else if (fid == 5 || fid == 7) {
			$(".sf_admin_form_field_comp_asoc_id").show();
			var cid = $("#resumen_cliente_id").find(':selected').val();
			$.ajax({
					url: 'getcompasoc?cid='+cid+'&fid='+fid,
					dataType: "json",
					success: function(data) {
						$("#resumen_comp_asoc_id").html(data);
					},
			});
		} else {
			$("#resumen_nro_factura").attr('value', '');
      $(".sf_admin_form_field_nro_factura").hide();
      $(".sf_admin_form_field_comp_asoc_id").hide();
			$(".sf_admin_form_field_remito_id").show();
		}
  });
	
})

$(document).ready(function(){
  $("#detalle_resumen_producto_id").change(function(event){
    var pid = $("#detalle_resumen_producto_id").find(':selected').val();
    var rid = $("#detalle_resumen_resumen_id").val();
    $.ajax({
        url: 'actprecio?pid='+pid+'&rid='+rid,
        dataType: "json",
        success: function(data) {
					var valor = data.split('=');
          $("#detalle_resumen_precio").attr('value', valor[0]);
          var cantidad = 0;
          var total = valor[0] * cantidad;
          $("#detalle_resumen_total").attr('value', parseFloat(total).toFixed(2));
        }
      });
  });
  
  $("#detalle_resumen_precio").bind("propertychange keyup input paste", function(event){
    var precio = $("#detalle_resumen_precio").val();
    var cantidad = $("#detalle_resumen_cantidad").val();
    if ($('#detalle_resumen_iva').length){
      var subtotal = cantidad * precio;
      var iva = subtotal * 0.21;
      var total = subtotal + iva;    
      $("#detalle_resumen_iva").attr('value', iva.toFixed(2));
      $("#detalle_resumen_sub_total").attr('value', subtotal.toFixed(2));
    }else{
      var total = cantidad * precio;
    }
    $("#detalle_resumen_total").attr('value', parseFloat(total).toFixed(2));
  });
  
  $("#detalle_resumen_producto_id").change(function(event){
      var pid = $("#detalle_resumen_producto_id").find(':selected').val();
			var rid = $("#detalle_resumen_resumen_id").val();
      $.ajax({
          url: 'get_lotes_producto?pid='+pid+'&rid='+rid,
          success: function(data) {
            $("#detalle_resumen_nro_lote").html('');
            $("#detalle_resumen_nro_lote").html(data);
          }
        });                  
  });
  
  $("#detalle_resumen_nro_lote").change(function(event){
    var lid = $("#detalle_resumen_nro_lote").find(':selected').val();
    var pid = $("#detalle_resumen_producto_id").find(':selected').val();
		var rid = $("#detalle_resumen_resumen_id").val();
      $.ajax({
          url: 'get_cantidad_lote?lid='+lid+'&pid='+pid+'&rid='+rid,
          success: function(data) {
            $("#detalle_resumen_cantidad").html('');
            $("#detalle_resumen_cantidad").html(data);
            $("#detalle_resumen_bonificados").html('');
            $("#detalle_resumen_bonificados").html('<option value="0">0</option>'+data);
						calcular_precio();
          }
        });

      $.ajax({
          url: 'get_prod_remito?lid='+lid+'&pid='+pid,
          success: function(data) {
            $("#detalle_resumen_det_remito_id").html('');
            $("#detalle_resumen_det_remito_id").html(data);
          }
        });
			
  });
  
  $("#detalle_resumen_det_remito_id").change(function(event){
		var drid = $("#detalle_resumen_det_remito_id").val();
      $.ajax({
          url: 'get_stock_remito?drid='+drid,
          success: function(data) {
            $("#detalle_resumen_cantidad").html('');
            $("#detalle_resumen_cantidad").html(data);
            $("#detalle_resumen_bonificados").html('');
            $("#detalle_resumen_bonificados").html('<option value="0">0</option>'+data);
						calcular_precio();
          }
        });	
  });


	function calcular_precio() {
		var cantidad = $("#detalle_resumen_cantidad").find(':selected').val();
		var descuento = $("#detalle_resumen_descuento").find(':selected').val();
		var precio = $("#detalle_resumen_precio").val();

		if ($('#detalle_resumen_iva').length) {
			precio = precio - precio * descuento/100
			var subtotal = cantidad * precio;
			var iva = (subtotal * 0.21);
			var total = Math.round(subtotal + iva);
			iva = total - subtotal;
			$("#detalle_resumen_iva").attr('value', iva.toFixed(2));
			$("#detalle_resumen_sub_total").attr('value', subtotal.toFixed(2));
		}else{
			var subtotal = cantidad * precio;
			var total = cantidad * precio;
			$("#detalle_resumen_sub_total").attr('value', subtotal.toFixed(2));
		}
		
		$("#detalle_resumen_total").attr('value', total.toFixed(2));		
	}
	
	
  $("#detalle_resumen_cantidad").change(function(event){
		calcular_precio();
  });
	
  $("#detalle_resumen_descuento").change(function(event){
		calcular_precio();
  });
    
});

//FACTURA COMPRAS
$(document).ready(function(){
  $("#det_fact_compra_precio").bind("propertychange keyup input paste", function(event){
    var precio = $("#det_fact_compra_precio").val();
    var cantidad = $("#det_fact_compra_cantidad").val();
    var subtotal = cantidad * precio;
    var iva = (subtotal * 21)/100;
    var total = subtotal + iva;
    $("#det_fact_compra_subtotal").attr('value', subtotal.toFixed(2));
    $("#det_fact_compra_iva").attr('value', iva.toFixed(2));
    $("#det_fact_compra_total").attr('value', total.toFixed(2));
  });
  
  $("#det_fact_compra_cantidad").bind("propertychange keyup input paste", function(event){
    var precio = $("#det_fact_compra_precio").val();
    var cantidad = $("#det_fact_compra_cantidad").val();
    var subtotal = cantidad * precio;
    var iva = (subtotal * 21)/100;
    var total = subtotal + iva;
    $("#det_fact_compra_subtotal").attr('value', subtotal.toFixed(2));
    $("#det_fact_compra_iva").attr('value', iva.toFixed(2));
    $("#det_fact_compra_total").attr('value', total.toFixed(2));
  });  
});

//FACTURA DE VENTA
$(document).ready(function(){
  $("#detalle_venta_producto_id").change(function(event){
      var id = $("#detalle_venta_producto_id").find(':selected').val();
      $.ajax({
          url: 'actprecio?pid='+id,
          dataType: "json",
          success: function(data) {
            $("#detalle_venta_precio").attr('value', data);
            var cantidad = $("#detalle_venta_cantidad").val();
            var subtotal = data * cantidad;
            $("#detalle_venta_subtotal").attr('value', subtotal.toFixed(2));
            var iva = subtotal * 0.21;
            $("#detalle_venta_iva").attr('value', iva.toFixed(2));
            $("#detalle_venta_total").attr('value', subtotal + iva);
          }
        });                  
  });
  
  $("#detalle_venta_precio").bind("propertychange keyup input paste", function(event){
    var precio = $("#detalle_venta_precio").val();
    var cantidad = $("#detalle_venta_cantidad").val();
    var subtotal = cantidad * precio;
    var iva = (subtotal * 21)/100;
    var total = subtotal + iva;
    $("#detalle_venta_subtotal").attr('value', subtotal.toFixed(2));
    $("#detalle_venta_iva").attr('value', iva.toFixed(2));
    $("#detalle_venta_total").attr('value', total.toFixed(2));
  });  
  
  $("#detalle_venta_cantidad").bind("propertychange keyup input paste", function(event){
    var precio = $("#detalle_venta_precio").val();
    var cantidad = $("#detalle_venta_cantidad").val();
    var subtotal = cantidad * precio;
    var iva = (subtotal * 21)/100;
    var total = subtotal + iva;
    $("#detalle_venta_subtotal").attr('value', subtotal.toFixed(2));
    $("#detalle_venta_iva").attr('value', iva.toFixed(2));
    $("#detalle_venta_total").attr('value', total.toFixed(2));
  });
});

//COMPRAS - calcula el el total al cargar la cantidad
$(document).ready(function(){	
	$("#detalle_compra_tiene_vto").change(function(event){
      var valor = $("#detalle_compra_tiene_vto").find(':selected').val();
      if (valor == 1){
        $(".sf_admin_form_field_fecha_vto").show();
      }else{
				$("#detalle_compra_fecha_vto").attr('value', '');
        $(".sf_admin_form_field_fecha_vto").hide();
      }
  });
	
  $("#compra_tipofactura_id").change(function(event){
      var tfid = $("#compra_tipofactura_id").find(':selected').val();
      var pid = $("#compra_proveedor_id").find(':selected').val();
			if (tfid == 4) {
				$.ajax({
						url: 'getnroremito?pid='+pid,
						dataType: "json",
						success: function(data) {
							$("#compra_numero").attr('value', data);
						}
					});
			}
  });
  
});


//DEVOLUCION DE PRODUCTO
$(document).ready(function(){
	
  $("#dev_producto_producto_id").change(function(event){
      var cid = $("#dev_producto_cliente_id").find(':selected').val();
      var pid = $("#dev_producto_producto_id").find(':selected').val();
      $.ajax({
          url: 'get_vtas_cliente?cid='+cid+'&pid='+pid,
          //dataType: "json",
          success: function(data) {
            $("#dev_producto_resumen_id").html('');
            $("#dev_producto_resumen_id").html(data);
          }
        });                  
  });
  
  $("#dev_producto_resumen_id").change(function(event){
      var pid = $("#dev_producto_producto_id").find(':selected').val();
      var rid = $("#dev_producto_resumen_id").find(':selected').val();
			
      $.ajax({
          url: 'get_lote?rid='+rid+'&pid='+pid,
          //dataType: "json",
          success: function(data) {
            $("#dev_producto_nro_lote").html('');
            $("#dev_producto_nro_lote").html(data);
          }
        });
  }); 
  
  $("#dev_producto_nro_lote").change(function(event){
      var pid = $("#dev_producto_producto_id").find(':selected').val();
      var rid = $("#dev_producto_resumen_id").find(':selected').val();
			var lid = $("#dev_producto_nro_lote").find(':selected').val();
			
      $.ajax({
				url: 'get_vta_lotes?rid='+rid+'&pid='+pid+'&lid='+lid,
				success: function(data) {
					$("#dev_producto_cantidad").html('');
					$("#dev_producto_cantidad").html(data);
				}
			});
  });
	
	$("#dev_producto_nro_lote").change(function(event){
      var pid = $("#dev_producto_producto_id").find(':selected').val();
      var rid = $("#dev_producto_resumen_id").find(':selected').val();
			var lid = $("#dev_producto_nro_lote").find(':selected').val();
			$.ajax({
				url: 'buscarprecio?rid='+rid+'&pid='+pid+'&lid='+lid,
				dataType: "json",
				success: function(data) {
					$("#dev_producto_precio_unitario").attr('value', data.precio_vta);
					$("#dev_producto_descuento").attr('value', data.descuento);
					$("#dev_producto_precio").attr('value', data.precio);
					$("#dev_producto_iva").attr('value', data.iva);
					$("#dev_producto_total").attr('value', data.total);
				}
			});
  });

  $("#dev_producto_cantidad").change(function(event){
		var precio_u = $("#dev_producto_precio").val();	
		var iva_u = $("#dev_producto_iva").val();
    
		var cantidad = $("#dev_producto_cantidad").find(':selected').val();      
	  var precio = parseFloat(precio_u) * parseFloat(cantidad);
	  var iva = parseFloat(iva_u) * parseFloat(cantidad);
    var total = parseFloat(precio) + parseFloat(iva);
    
		$("#dev_producto_total").attr('value', total.toFixed(2));
    $("#dev_producto_iva").attr('value', iva.toFixed(2));   
  });   
  
});

//NOTA DE CREDITO
$(document).ready(function(){
  $("#notacred_dev_producto_cliente_id").change(function(event){
      var cid = $("#notacred_dev_producto_cliente_id").find(':selected').val();
      $.ajax({
          url: 'get_vtas_cliente?cid='+cid,
          success: function(data) {
            $("#notacred_dev_producto_resumen_id").html('');
            $("#notacred_dev_producto_resumen_id").html(data);
          }
        });                  
  });
  
});


$(document).ready(function() { 
    $('#dialogo_cliente_localidad').dialog({
    autoOpen: false,
    modal: true,
    height: 300,
    width: 600,
    open: function(evt,ui){
        $.ajax({
          url: $('.sf_admin_action_list a').attr('href')+'/../loc/cargar',
          success: function(data){
            $('#dialogo_cliente_localidad').html(data);
          }
        });    
    },    
    buttons: {
      "Guardar": function() { 
        $.ajax({
          type: "POST",
          url: $('.sf_admin_action_list a').attr('href')+'/../cli/guardarnuevalocalidad?loc='+$('#localidad_nombre').val()+'&prov='+$("#localidad_provincia_id").find(':selected').val(),
          dataType: "json",
          success: function(data){
            $('#cliente_localidad_id').append('<option value="'+data+'" selected="selected">'+$("#localidad_nombre").val()+'</option>');
            $("#cliente_localidad_id_chzn").remove();
            $("#cliente_localidad_id").removeClass('chzn-done');
            $(".chzn-select").chosen();
            $('#dialogo_cliente_localidad').dialog("close"); 
          }
        });
      }, 
      "Cerrar": function() { 
        $(this).dialog("close");
      } 
    }
  });

  $('#boton_cliente_localidad').click(function() { 
    $('#dialogo_cliente_localidad').dialog('open'); 
    return false; 
    });
}); 

$(document).ready(function() { 
    $('#dialogo_detalle_compra_producto').dialog({
    autoOpen: false,
    modal: true,
    height: 500,
    width: 600,
    open: function(evt,ui){
        $.ajax({
          url: $('.sf_admin_action_list a').attr('href')+'/../prod/new',
          success: function(data){
            $('#dialogo_detalle_compra_producto').html(data);
            $('#dialogo_detalle_compra_producto .sf_admin_actions_form').hide();
            $('#dialogo_detalle_compra_producto .ui-widget-header').hide();
          }
        });    
    },    
    buttons: {
      "Guardar": function() { 
        $.ajax({
          type: "POST",
          //url: $('.sf_admin_action_list a').attr('href')+'/../detcomp/guardarnuevoproducto?'+$('#form_producto').serialize(),
          url: $('#form_producto').attr('action')+'?rtn=json&'+$('#form_producto').serialize(),
          dataType: "json",
          success: function(data){
            $('#detalle_compra_producto_id').append('<option value="'+data+'" selected="selected">'+$("#producto_nombre").val()+'</option>');
            $("#detalle_compra_producto_id_chzn").remove();
            $("#detalle_compra_producto_id").removeClass('chzn-done');
            $(".chzn-select").chosen();
            $('#dialogo_detalle_compra_producto').dialog("close"); 
          }
        });
      }, 
      "Cerrar": function() { 
        $(this).dialog("close");
      } 
    }
  });

  $('#boton_detalle_compra_producto').click(function() { 
    $('#dialogo_detalle_compra_producto').dialog('open'); 
    return false; 
    });
}); 


$(document).ready(function() { 
    $('#dialogo_resumen_cliente').dialog({
    autoOpen: false,
    modal: true,
    height: 500,
    width: 600,
    open: function(evt,ui){
        $.ajax({
          url: $('.sf_admin_action_list a').attr('href')+'/../cli/cargar',
          success: function(data){
            $('#dialogo_resumen_cliente').html(data);
            $('#boton_cliente_localidad').hide();
            $(".chzn-select").chosen();
          }
        });    
    },    
    buttons: {
      "Guardar": function() { 
        $.ajax({
          type: "POST",
          url: $('.sf_admin_action_list a').attr('href')+'/../resumen/guardarnuevocliente?'+$('#form_cliente').serialize(),
          dataType: "json",
          success: function(data){
            $('#resumen_cliente_id').append('<option value="'+data+'" selected="selected">'+$("#cliente_apellido").val()+ ' ' + $("#cliente_nombre").val()+'</option>');
            $("#resumen_cliente_id_chzn").remove();
            $("#resumen_cliente_id").removeClass('chzn-done');
            $(".chzn-select").chosen();
            $('#dialogo_resumen_cliente').dialog("close"); 
          }
        });
      }, 
      "Cerrar": function() { 
        $(this).dialog("close");
      } 
    }
  });

  $('#boton_resumen_cliente_id').click(function() { 
    $('#dialogo_resumen_cliente').dialog('open'); 
    return false; 
    });
}); 

$(document).ready(function() { 
    $('#dialogo_cobro_banco').dialog({
    autoOpen: false,
    modal: true,
    height: 500,
    width: 600,
    open: function(evt,ui){
        $.ajax({
          url: $('.sf_admin_action_list a').attr('href')+'/../banco/cargar',
          success: function(data){
            $('#dialogo_cobro_banco').html(data);
            $(".chzn-select").chosen();
          }
        });    
    },    
    buttons: {
      "Guardar": function() { 
        $.ajax({
          type: "POST",
          url: $('.sf_admin_action_list a').attr('href')+'/../cobro/guardarnuevobanco?'+$('#form_banco').serialize(),
          dataType: "json",
          success: function(data){
            $('#cobro_banco_id').append('<option value="'+data+'" selected="selected">'+$("#banco_nombre").val()+'</option>');
            $("#cobro_banco_id_chzn").remove();
            $("#cobro_banco_id").removeClass('chzn-done');
            $(".chzn-select").chosen();
            $('#dialogo_cobro_banco').dialog("close"); 
          }
        });
      }, 
      "Cerrar": function() { 
        $(this).dialog("close");
      } 
    }
  });

  $('#boton_cobro_banco_id').click(function() { 
    $('#dialogo_cobro_banco').dialog('open'); 
    return false; 
    });
}); 

jQuery.extend({
 getURLParam: function(strParamName){
	  var strReturn = "";
	  var strHref = window.location.href;
	  var bFound=false;
	  
	  var cmpstring = strParamName + "=";
	  var cmplen = cmpstring.length;

	  if ( strHref.indexOf("?") > -1 ){
	    var strQueryString = strHref.substr(strHref.indexOf("?")+1);
	    var aQueryString = strQueryString.split("&");
	    for ( var iParam = 0; iParam < aQueryString.length; iParam++ ){
	      if (aQueryString[iParam].substr(0,cmplen)==cmpstring){
	        var aParam = aQueryString[iParam].split("=");
	        strReturn = aParam[1];
	        bFound=true;
	        break;
	      }
	      
	    }
	  }
	  if (bFound==false) return null;
	  return strReturn;
	}
});