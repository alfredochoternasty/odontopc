<?php

/**
 * Curso
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Curso extends BaseCurso
{
	public function __toString()
	{
		return empty($this->nombre)? '':$this->nombre;
	}
	
  public function getNomCurso(){
    return $this->nombre;
  }
  
  public function InscripcionDesdeHasta(){
    $inicio = implode('/', array_reverse(explode('-', $this->getIniInsc())));
    $fin = implode('/', array_reverse(explode('-', $this->getFinInsc())));
    return 'Desde el '.$inicio.' al '.$fin;
  }
  
}