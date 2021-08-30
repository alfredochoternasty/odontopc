<h1>Cursos List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Nombre</th>
      <th>Descripcion</th>
      <th>Fecha</th>
      <th>Hora</th>
      <th>Lugar</th>
      <th>Precio</th>
      <th>Mostrar precio</th>
      <th>Logo</th>
      <th>Link mapa</th>
      <th>Sitio web</th>
      <th>Ini insc</th>
      <th>Fin insc</th>
      <th>Habilitado</th>
      <th>Permite insc</th>
      <th>Foto1</th>
      <th>Foto2</th>
      <th>Foto3</th>
      <th>Foto4</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($cursos as $curso): ?>
    <tr>
      <td><a href="<?php echo url_for('inicio/show?id='.$curso->getId()) ?>"><?php echo $curso->getId() ?></a></td>
      <td><?php echo $curso->getNombre() ?></td>
      <td><?php echo $curso->getDescripcion() ?></td>
      <td><?php echo $curso->getFecha() ?></td>
      <td><?php echo $curso->getHora() ?></td>
      <td><?php echo $curso->getLugar() ?></td>
      <td><?php echo $curso->getPrecio() ?></td>
      <td><?php echo $curso->getMostrarPrecio() ?></td>
      <td><?php echo $curso->getLogo() ?></td>
      <td><?php echo $curso->getLinkMapa() ?></td>
      <td><?php echo $curso->getSitioWeb() ?></td>
      <td><?php echo $curso->getIniInsc() ?></td>
      <td><?php echo $curso->getFinInsc() ?></td>
      <td><?php echo $curso->getHabilitado() ?></td>
      <td><?php echo $curso->getPermiteInsc() ?></td>
      <td><?php echo $curso->getFoto1() ?></td>
      <td><?php echo $curso->getFoto2() ?></td>
      <td><?php echo $curso->getFoto3() ?></td>
      <td><?php echo $curso->getFoto4() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('inicio/new') ?>">New</a>
