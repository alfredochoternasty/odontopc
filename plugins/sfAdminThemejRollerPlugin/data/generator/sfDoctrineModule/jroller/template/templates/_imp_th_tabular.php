<?php 
$imprimir = $this->configuration->getValue('show.display');
foreach ($this->configuration->getValue('list.display') as $name => $field): 
if (in_array($name, $imprimir) || in_array('_'.$name, $imprimir)) {
?>
<th><?php echo $field->getConfig('label', '', true) ?></th>
<?php }
endforeach ?>
