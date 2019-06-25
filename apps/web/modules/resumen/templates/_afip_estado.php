<?php	
if ($resumen->afip_estado > 0) echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/tick.png');
if ($resumen->afip_estado > 1) echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/error.png', 'alt="'.$resumen->afip_mensaje.'"');
if (empty($resumen->afip_estado) && !empty($resumen->afip_mensaje)) echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/error.png', 'alt="'.$resumen->afip_mensaje.'"');
?>