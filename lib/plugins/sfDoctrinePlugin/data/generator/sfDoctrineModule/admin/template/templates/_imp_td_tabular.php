<?php 
foreach ($this->configuration->getValue('list.display') as $name => $field) {
echo $this->addCredentialCondition(sprintf(<<<EOF
<td>[?php echo %s ?]</td>
EOF
, strtolower($field->getType()), $name, $this->renderField($field)), $field->getConfig())
} ?>