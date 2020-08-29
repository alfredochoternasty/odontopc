<?php	
$base_url = $sf_user->getVarConfig('base_url');
if (!empty($producto->foto_chica)) echo '<img src="'.$base_url.'/uploads/productos/'.$producto->foto_chica.'">'; 
?>