<html>
<head>
</head>
<body>
<h2>Listado de Clientes</h2>
<table border="1" cellspacing="0" cellpadding="1">
  <tr>
    <th style="background: #CCC;">Tipo</th>
    <th style="background: #CCC;">Apellido</th>
    <th style="background: #CCC;">Nombre</th>
    <th style="background: #CCC;">Tel&eacute;fono</th>
    <th style="background: #CCC;">Celular</th>
    <th style="background: #CCC;">Email</th>
    <th style="background: #CCC;">Localidad</th>
  </tr>
  <?php $saldo = 0; ?>
  <?php foreach($clientes as $cliente):?>
  <tr>
    <td><?php echo $cliente->getTipo() ?></td>
    <td><?php echo $cliente->getApellido() ?></td>
    <td><?php echo $cliente->getNombre() ?></td>
    <td><?php echo $cliente->getTelefono() ?></td>
    <td><?php echo $cliente->getCelular() ?></td>
    <td><?php echo $cliente->getEmail() ?></td>
    <td><?php if($cliente->getLocalidadId()) echo $cliente->getLocalidad(); ?></td>
  </tr>
  <?php endforeach;?>
</table>
</body>
<html>