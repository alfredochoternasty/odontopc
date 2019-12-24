<?php 
$imprimir = $this->configuration->getValue('show.display');
foreach ($this->configuration->getValue('list.display') as $name => $field) : 
if (in_array($name, $imprimir) || in_array('_'.$name, $imprimir)) {
?>
<td>[?php echo <?php echo $this->renderField($field) ?> ?]</td>
<?php
}
endforeach
?>