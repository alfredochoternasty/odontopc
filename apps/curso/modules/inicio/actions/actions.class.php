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
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->curso = Doctrine_Core::getTable('Curso')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->curso);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new CursoForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new CursoForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($curso = Doctrine_Core::getTable('Curso')->find(array($request->getParameter('id'))), sprintf('Object curso does not exist (%s).', $request->getParameter('id')));
    $this->form = new CursoForm($curso);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($curso = Doctrine_Core::getTable('Curso')->find(array($request->getParameter('id'))), sprintf('Object curso does not exist (%s).', $request->getParameter('id')));
    $this->form = new CursoForm($curso);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($curso = Doctrine_Core::getTable('Curso')->find(array($request->getParameter('id'))), sprintf('Object curso does not exist (%s).', $request->getParameter('id')));
    $curso->delete();

    $this->redirect('inicio/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $curso = $form->save();

      $this->redirect('inicio/edit?id='.$curso->getId());
    }
  }

  public function executeVolver(sfWebRequest $request)
  {
		$this->redirect('@inicio/index');
  }

  public function executeImprimirPagina(sfWebRequest $request)
  {
    $filtro = new $this->configuration->getFilterForm();
    $consulta = $filtro->buildQuery($this->getFilters());
	$pagina = $this->getUser()->getAttribute('inicio.page', '1', 'admin_module')-1;
	$consulta->limit(50)->offset($pagina * 50);
    $datos = $consulta->execute();
	$this->descargar_pdf($datos);
  }

  public function executeImprimirTodo(sfWebRequest $request)
  {
    $filtro = new $this->configuration->getFilterForm();
    $consulta = $filtro->buildQuery($this->getFilters());
    $datos = $consulta->execute();
	$this->descargar_pdf($datos);
  }
  
  public function descargar_pdf($datos)
  {    
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("imp", array("curso" => $datos)));
    $dompdf->set_paper('A4','portrait');
    $dompdf->render();
    $dompdf->stream("curso.pdf");    
    return sfView::NONE;
  }  
  

  public function executeExcelTodo(sfWebRequest $request)
  {
    $filtro = new $this->configuration->getFilterForm();
    $consulta = $filtro->buildQuery($this->getFilters());
    $datos = $consulta->execute();
    $this->descargar_excel($datos);
  }
  
  public function executeExcelPagina(sfWebRequest $request)
  {
    $filtro = new $this->configuration->getFilterForm();
    $consulta = $filtro->buildQuery($this->getFilters());
	$pagina = $this->getUser()->getAttribute('inicio.page', '1', 'admin_module')-1;
	$consulta->limit(50)->offset($pagina * 50);	
    $datos = $consulta->execute();
	$this->descargar_excel($datos);
  }
    
  public function descargar_excel($datos)
  {

  }  }
