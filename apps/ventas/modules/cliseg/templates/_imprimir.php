<html>
<head>
</head>
<body>
<h2>Ultima compra de Clientes</h2>
<table border="1" cellspacing="0" cellpadding="1">
  <tr>
    <th style="background: #CCC;">Cliente</th>
    <th style="background: #CCC;">Motivo</th>
    <th style="background: #CCC;">Fecha - Hora</th>
    <th style="background: #CCC;">Via de<br>Contacto</th>
    <th style="background: #CCC;">Respuesta</th>
    <th style="background: #CCC;">Comentario</th>
    <th style="background: #CCC;">Prox. Fecha - Hora</th>
	<th style="background: #CCC;">Comentario</th>
	<th style="background: #CCC;">Hecho</th>
	<th style="background: #CCC;">Usuario</th>
  </tr>
  <?php foreach($listado as $fila):?>
  <tr>
    <td><?php echo $fila->getCliente() ?></td>
    <td><?php echo $fila->getTipoMotivo() ?></td>
    <td><?php echo implode("/", array_reverse(explode("-", $fila->getFecha()))).' - '.$fila->getHora() ?></td>
    <td><?php echo $fila->getTipoContacto() ?></td>
    <td><?php echo $fila->getTipoRespuesta() ?></td>
    <td><?php echo $fila->getComentario() ?></td>
    <td><?php echo implode("/", array_reverse(explode("-", $fila->getProxContacFecha()))).' - '.$fila->getProxContacHora() ?></td>
	<td><?php echo $fila->getProxContactComent() ?></td>
    <td><?php echo $fila->getRealizadaFormato() ?></td>
    <td><?php echo $fila->getSfGuardUser() ?></td>	
  </tr>
  <?php endforeach;?>
</table>
</body>
<html>