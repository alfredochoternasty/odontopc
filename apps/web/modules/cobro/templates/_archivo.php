<?php
$base_url = $sf_user->getVarConfig('base_url');
if (!empty($cobro->archivo)) echo link_to(image_tag('bill.png'), $base_url.'/web/uploads/cobros/'.$cobro->archivo, array('target' => '_blank'));
?>