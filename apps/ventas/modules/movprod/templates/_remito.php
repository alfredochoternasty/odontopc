<?php 
if (!empty($movimiento_producto->getDetalleResumen()->det_remito_id)) echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/tick.png');
?>