<?php

/**
 * inicio actions.
 *
 * @package    odontopc
 * @subpackage inicio
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class inicioActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->cursos = Doctrine_Core::getTable('Curso')
      ->createQuery('a')
      ->where("fecha > current_date")
      ->andWhere("habilitado = 'SI'")
      ->orderBy("fecha asc, zona_id asc")
      ->execute();
  }
  
  public function executeGetImagen(sfWebRequest $request)
  {
	  $img = $request->getParameter('img');
	  list($nom, $ext) = explode('.', $img);
	  $img = new sfImage(sfConfig::get('sf_upload_dir').'/cursos/'.$img, 'image/'.$ext);
	  $response = $this->getResponse();
	  $response->setContentType($img->getMIMEType());
	  $response->setContent($img);
	  return sfView::NONE;
  }
}
