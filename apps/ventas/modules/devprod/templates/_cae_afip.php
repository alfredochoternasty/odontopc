<?php	
if ($dev_producto->afip_estado > 0) echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/tick.png');
if ($dev_producto->afip_estado > 1) echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/error.png', 'alt="'.$dev_producto->afip_mensaje.'"');
if (empty($dev_producto->afip_estado) && !empty($dev_producto->afip_mensaje)) echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/error.png', 'alt="'.$dev_producto->afip_mensaje.'"');
?>