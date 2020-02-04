<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('productos/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('productos/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'productos/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['codigo']->renderLabel() ?></th>
        <td>
          <?php echo $form['codigo']->renderError() ?>
          <?php echo $form['codigo'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['nombre']->renderLabel() ?></th>
        <td>
          <?php echo $form['nombre']->renderError() ?>
          <?php echo $form['nombre'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['grupoprod_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['grupoprod_id']->renderError() ?>
          <?php echo $form['grupoprod_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['precio_vta']->renderLabel() ?></th>
        <td>
          <?php echo $form['precio_vta']->renderError() ?>
          <?php echo $form['precio_vta'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['minimo_stock']->renderLabel() ?></th>
        <td>
          <?php echo $form['minimo_stock']->renderError() ?>
          <?php echo $form['minimo_stock'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['stock_actual']->renderLabel() ?></th>
        <td>
          <?php echo $form['stock_actual']->renderError() ?>
          <?php echo $form['stock_actual'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['ctr_fact_grupo']->renderLabel() ?></th>
        <td>
          <?php echo $form['ctr_fact_grupo']->renderError() ?>
          <?php echo $form['ctr_fact_grupo'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['orden_grupo']->renderLabel() ?></th>
        <td>
          <?php echo $form['orden_grupo']->renderError() ?>
          <?php echo $form['orden_grupo'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['activo']->renderLabel() ?></th>
        <td>
          <?php echo $form['activo']->renderError() ?>
          <?php echo $form['activo'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['grupo2']->renderLabel() ?></th>
        <td>
          <?php echo $form['grupo2']->renderError() ?>
          <?php echo $form['grupo2'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['grupo3']->renderLabel() ?></th>
        <td>
          <?php echo $form['grupo3']->renderError() ?>
          <?php echo $form['grupo3'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['lista_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['lista_id']->renderError() ?>
          <?php echo $form['lista_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['foto']->renderLabel() ?></th>
        <td>
          <?php echo $form['foto']->renderError() ?>
          <?php echo $form['foto'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['descripcion']->renderLabel() ?></th>
        <td>
          <?php echo $form['descripcion']->renderError() ?>
          <?php echo $form['descripcion'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['iva']->renderLabel() ?></th>
        <td>
          <?php echo $form['iva']->renderError() ?>
          <?php echo $form['iva'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['total']->renderLabel() ?></th>
        <td>
          <?php echo $form['total']->renderError() ?>
          <?php echo $form['total'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
