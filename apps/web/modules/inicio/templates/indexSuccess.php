<?php use_helper('I18N', 'Date') ?>
<?php include_partial('inicio/assets') ?>

<div id="sf_admin_container">
	<?php include_partial('inicio/flashes') ?>
	<div id="sf_admin_content">
    <?php if(!$sf_user->hasPermission('traza')): ?>    
		<?php include_partial('inicio/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'hasFilters' => $hasFilters, 'pager2' => $pager2, 'pager3' => $pager3)) ?>
    <?php endif; ?>
	</div>
</div>
