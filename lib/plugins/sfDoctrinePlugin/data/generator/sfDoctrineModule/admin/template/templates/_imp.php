<h1>[?php echo <?php echo $this->getI18NString('list.title') ?> ?]</h1>
<table cellspacing="0">
  <thead>
	<tr>
	  [?php include_partial('<?php echo $this->getModuleName() ?>/imp_th_tabular' ?]
	</tr>
  </thead>
  <tbody>
	[?php foreach ($pager->getResults() as $i => $<?php echo $this->getSingularName() ?>): $odd = fmod(++$i, 2) ? 'odd' : 'even' ?]
	  <tr>
		[?php include_partial('<?php echo $this->getModuleName() ?>/list_td_tabular', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>)) ?]
	  </tr>
	[?php endforeach; ?]
  </tbody>
</table>