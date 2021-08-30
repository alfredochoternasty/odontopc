<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $curso->getId() ?></td>
    </tr>
    <tr>
      <th>Nombre:</th>
      <td><?php echo $curso->getNombre() ?></td>
    </tr>
    <tr>
      <th>Descripcion:</th>
      <td><?php echo $curso->getDescripcion() ?></td>
    </tr>
    <tr>
      <th>Fecha:</th>
      <td><?php echo $curso->getFecha() ?></td>
    </tr>
    <tr>
      <th>Hora:</th>
      <td><?php echo $curso->getHora() ?></td>
    </tr>
    <tr>
      <th>Lugar:</th>
      <td><?php echo $curso->getLugar() ?></td>
    </tr>
    <tr>
      <th>Precio:</th>
      <td><?php echo $curso->getPrecio() ?></td>
    </tr>
    <tr>
      <th>Mostrar precio:</th>
      <td><?php echo $curso->getMostrarPrecio() ?></td>
    </tr>
    <tr>
      <th>Logo:</th>
      <td><?php echo $curso->getLogo() ?></td>
    </tr>
    <tr>
      <th>Link mapa:</th>
      <td><?php echo $curso->getLinkMapa() ?></td>
    </tr>
    <tr>
      <th>Sitio web:</th>
      <td><?php echo $curso->getSitioWeb() ?></td>
    </tr>
    <tr>
      <th>Ini insc:</th>
      <td><?php echo $curso->getIniInsc() ?></td>
    </tr>
    <tr>
      <th>Fin insc:</th>
      <td><?php echo $curso->getFinInsc() ?></td>
    </tr>
    <tr>
      <th>Habilitado:</th>
      <td><?php echo $curso->getHabilitado() ?></td>
    </tr>
    <tr>
      <th>Permite insc:</th>
      <td><?php echo $curso->getPermiteInsc() ?></td>
    </tr>
    <tr>
      <th>Foto1:</th>
      <td><?php echo $curso->getFoto1() ?></td>
    </tr>
    <tr>
      <th>Foto2:</th>
      <td><?php echo $curso->getFoto2() ?></td>
    </tr>
    <tr>
      <th>Foto3:</th>
      <td><?php echo $curso->getFoto3() ?></td>
    </tr>
    <tr>
      <th>Foto4:</th>
      <td><?php echo $curso->getFoto4() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('inicio/edit?id='.$curso->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('inicio/index') ?>">List</a>
