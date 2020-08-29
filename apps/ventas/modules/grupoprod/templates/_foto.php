<?php	
$base_url = $sf_user->getVarConfig('base_url');
if (!empty($grupoprod->foto_chica)) echo '<img src="'.$base_url.'/uploads/productos/'.$grupoprod->foto_chica.'">'; 
?>