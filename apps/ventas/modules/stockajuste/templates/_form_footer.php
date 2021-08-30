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
})
</script>