<?php use_helper('I18N', 'Date') ?>
<?php include_partial('cursmail/assets') ?>

<div id="sf_admin_container">
  <?php include_partial('cursmail/flashes') ?>
      <?php include_partial('cursmail/list_enviar', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'hasFilters' => $hasFilters)) ?>
      <ul class="sf_admin_actions">
        <?php include_partial('cursmail/list_batch_actions', array('helper' => $helper)) ?>
      </ul>
</div>
