<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('carrito/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('carrito/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'carrito/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['producto_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['producto_id']->renderError() ?>
          <?php echo $form['producto_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['precio']->renderLabel() ?></th>
        <td>
          <?php echo $form['precio']->renderError() ?>
          <?php echo $form['precio'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['cantidad']->renderLabel() ?></th>
        <td>
          <?php echo $form['cantidad']->renderError() ?>
          <?php echo $form['cantidad'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['total']->renderLabel() ?></th>
        <td>
          <?php echo $form['total']->renderError() ?>
          <?php echo $form['total'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['observacion']->renderLabel() ?></th>
        <td>
          <?php echo $form['observacion']->renderError() ?>
          <?php echo $form['observacion'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['nro_lote']->renderLabel() ?></th>
        <td>
          <?php echo $form['nro_lote']->renderError() ?>
          <?php echo $form['nro_lote'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
