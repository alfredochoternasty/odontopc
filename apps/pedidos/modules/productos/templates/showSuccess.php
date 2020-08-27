<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $producto->getId() ?></td>
    </tr>
    <tr>
      <th>Codigo:</th>
      <td><?php echo $producto->getCodigo() ?></td>
    </tr>
    <tr>
      <th>Nombre:</th>
      <td><?php echo $producto->getNombre() ?></td>
    </tr>
    <tr>
      <th>Grupoprod:</th>
      <td><?php echo $producto->getGrupoprodId() ?></td>
    </tr>
    <tr>
      <th>Precio vta:</th>
      <td><?php echo $producto->getPrecioVta() ?></td>
    </tr>
    <tr>
      <th>Moneda:</th>
      <td><?php echo $producto->getMonedaId() ?></td>
    </tr>
    <tr>
      <th>Genera comision:</th>
      <td><?php echo $producto->getGeneraComision() ?></td>
    </tr>
    <tr>
      <th>Mueve stock:</th>
      <td><?php echo $producto->getMueveStock() ?></td>
    </tr>
    <tr>
      <th>Minimo stock:</th>
      <td><?php echo $producto->getMinimoStock() ?></td>
    </tr>
    <tr>
      <th>Stock actual:</th>
      <td><?php echo $producto->getStockActual() ?></td>
    </tr>
    <tr>
      <th>Ctr fact grupo:</th>
      <td><?php echo $producto->getCtrFactGrupo() ?></td>
    </tr>
    <tr>
      <th>Orden grupo:</th>
      <td><?php echo $producto->getOrdenGrupo() ?></td>
    </tr>
    <tr>
      <th>Activo:</th>
      <td><?php echo $producto->getActivo() ?></td>
    </tr>
    <tr>
      <th>Grupo2:</th>
      <td><?php echo $producto->getGrupo2() ?></td>
    </tr>
    <tr>
      <th>Grupo3:</th>
      <td><?php echo $producto->getGrupo3() ?></td>
    </tr>
    <tr>
      <th>Lista:</th>
      <td><?php echo $producto->getListaId() ?></td>
    </tr>
    <tr>
      <th>Foto:</th>
      <td><?php echo $producto->getFoto() ?></td>
    </tr>
    <tr>
      <th>Foto chica:</th>
      <td><?php echo $producto->getFotoChica() ?></td>
    </tr>
    <tr>
      <th>Descripcion:</th>
      <td><?php echo $producto->getDescripcion() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('productos/edit?id='.$producto->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('productos/index') ?>">List</a>
