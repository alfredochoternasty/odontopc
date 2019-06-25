<?php foreach ($this->configuration->getValue('list.display') as $name => $field): ?>
	<th><?php echo $field->getConfig('label', '', true) ?></th>
<?php endforeach; ?>
