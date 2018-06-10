



<?php 
  header("Content-Disposition: attachment; filename=\"clientes.xls\"");
  header("Content-Type: application/vnd.ms-excel");
  
  echo 'Listado de Clientes' . "\r\n";











  $titulos = array('Tipo', 'Apellido', 'Nombre', 'Teléfono', 'Celular', 'Email', 'Localidad');
  $flag = false;
  foreach($clientes as $cliente):

        if (!$flag) {
            echo utf8_encode(implode("\t", $titulos)) . "\r\n";
            $flag = true;
        }  
        $fila = array($cliente->getTipo(), $cliente->getApellido(), $cliente->getNombre(), $cliente->getTelefono(), $cliente->getCelular(), $cliente->getEmail(), $cliente->getLocalidad());







        $string = implode("\t", array_values($fila));
        echo utf8_decode($string)."\r\n"; 
  endforeach;



?>