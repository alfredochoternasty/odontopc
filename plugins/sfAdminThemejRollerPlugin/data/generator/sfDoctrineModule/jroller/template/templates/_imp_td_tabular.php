<?php foreach ($this->configuration->getValue('list.display') as $name => $field) : ?>
<td>[?php echo <?php echo $this->renderField($field) ?> ?]</td>;
<?php endforeach ?>