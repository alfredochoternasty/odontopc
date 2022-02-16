<?php
 
class insccursoComponents extends sfComponents
{
  public function executeCantInscNuevos()
  {
    $nuevos_inscriptos = Doctrine::getTable('CursoInscripcion')->CantInscNuevosPorZona();
    $this->cant_inscriptos_nuevos = count($nuevos_inscriptos);
  }
}

?>