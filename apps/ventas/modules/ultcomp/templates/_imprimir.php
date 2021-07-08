<html>
<head>
</head>
<body>
<h2>Ultima compra de Clientes</h2>
<table border="1" cellspacing="0" cellpadding="1">
  <tr>
    <th style="background: #CCC;">Apellido</th>
    <th style="background: #CCC;">Nombre</th>
    <th style="background: #CCC;">Fecha</th>
    <th style="background: #CCC;">Telefono</th>
    <th style="background: #CCC;">Celular</th>
    <th style="background: #CCC;">Email</th>
  </tr>
  <?php foreach($listado as $fila):?>
  <tr>
    <td><?php echo $fila->getApellido() ?></td>
    <td><?php echo $fila->getNombre() ?></td>
    <td><?php echo implode("/", array_reverse(explode("-", $fila->getFecha()))) ?></td>
    <td><?php echo $fila->getTelefono() ?></td>
    <td><?php echo $fila->getCelular() ?></td>
    <td><?php echo $fila->getEmail() ?></td>
  </tr>
  <?php endforeach;?>
</table>
</body>
<html>