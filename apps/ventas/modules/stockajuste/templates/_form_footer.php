<script>
jQuery(function($){
  $("#lote_ajuste_producto_id").change(function(event){
      var pid = $("#lote_ajuste_producto_id").find(':selected').val();
      var zid = $("#lote_ajuste_zona_id").find(':selected').val();
      $.ajax({
          url: 'get_lotes_producto?pid='+pid+'&zid='+zid,
          success: function(data) {
            $("#lote_ajuste_nro_lote").html('');
            $("#lote_ajuste_nro_lote").html(data);
          }
        });                  
  });
  
  $("form").submit(function(event) {
    if ($("#lote_ajuste_observacion").val().length < 1) {
      alert('El campo OBSERVACION no puede estar vacio');
      return false;
    }
  });
})
</script>