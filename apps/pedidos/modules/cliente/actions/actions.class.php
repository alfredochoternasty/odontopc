<?php

/**
 * cliente actions.
 *
 * @package    odontopc
 * @subpackage cliente
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class clienteActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->sf_guard_users = Doctrine_Core::getTable('SfGuardUser')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->sf_guard_user = Doctrine_Core::getTable('SfGuardUser')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->sf_guard_user);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new SfGuardUserForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new SfGuardUserForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($sf_guard_user = Doctrine_Core::getTable('SfGuardUser')->find(array($request->getParameter('id'))), sprintf('Object sf_guard_user does not exist (%s).', $request->getParameter('id')));
    $this->form = new SfGuardUserForm($sf_guard_user);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($sf_guard_user = Doctrine_Core::getTable('SfGuardUser')->find(array($request->getParameter('id'))), sprintf('Object sf_guard_user does not exist (%s).', $request->getParameter('id')));
    $this->form = new SfGuardUserForm($sf_guard_user);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($sf_guard_user = Doctrine_Core::getTable('SfGuardUser')->find(array($request->getParameter('id'))), sprintf('Object sf_guard_user does not exist (%s).', $request->getParameter('id')));
    $sf_guard_user->delete();

    $this->redirect('cliente/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $sf_guard_user = $form->save();

      $this->redirect('cliente/edit?id='.$sf_guard_user->getId());
    }
  }

  public function executeVolver(sfWebRequest $request)
  {
		$this->redirect('@cliente/index);
  }

  public function executeImprimirPagina(sfWebRequest $request)
  {
    $filtro = new $this->configuration->getFilterForm();
    $consulta = $filtro->buildQuery($this->getFilters());
	$pagina = $this->getUser()->getAttribute('cliente.page', '1', 'admin_module')-1;
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
    $dompdf->load_html($this->getPartial("imp", array("sf_guard_user" => $datos)));
    $dompdf->set_paper('A4','portrait');
    $dompdf->render();
    $dompdf->stream("sf_guard_user.pdf");    
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
	$pagina = $this->getUser()->getAttribute('cliente.page', '1', 'admin_module')-1;
	$consulta->limit(50)->offset($pagina * 50);	
    $datos = $consulta->execute();
	$this->descargar_excel($datos);
  }
    
  public function descargar_excel($datos)
  {

  }  }
