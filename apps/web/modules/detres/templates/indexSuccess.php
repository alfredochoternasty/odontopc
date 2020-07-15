<?php use_helper('I18N', 'Date') ?>
<?php include_partial('detres/assets')?>

<div id="sf_admin_container">
  <?php include_partial('detres/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('detres/list_header', array('pager' => $pager)) ?>
  </div>

  
  <div id="sf_admin_content">
	<form action="<?php echo url_for('detalle_resumen_collection', array('action' => 'batch')) ?>" method="post" id="sf_admin_content_form">
		<div class="sf_admin_actions_block" style="font-family: Lucida Grande, Lucida Sans, Arial, sans-serif; margin:0px">
			<?php include_partial('detres/list_actions', array('helper' => $helper, 'pager' => $pager)) ?>
		</div>
		<?php include_partial('detres/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'hasFilters' => $hasFilters)) ?>
	</form>
  </div>

</div>
