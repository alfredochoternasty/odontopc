<?php echo "[?php include_partial('global/cabecera_impresion', array('titulo' => '".$this->configuration->getValue('list.title')."', 'configuration' => \$configuration, 'filters' => \$filters, 'hasFilters' => \$hasFilters)) ?]" ?>
<table cellspacing="0" border="1px" width="100%">
  <thead>
	<tr>
	  [?php include_partial('<?php echo $this->getModuleName() ?>/imp_th_tabular') ?]
	</tr>
  </thead>
  <tbody>
	[?php foreach ($<?php echo $this->getSingularName() ?>s as $i => $<?php echo $this->getSingularName() ?>): ?]
	  <tr>
		[?php include_partial('<?php echo $this->getModuleName() ?>/imp_td_tabular', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>)) ?]
	  </tr>
	[?php endforeach ?]
  </tbody>
</table>
[?php include_partial('global/pie_impresion') ?]