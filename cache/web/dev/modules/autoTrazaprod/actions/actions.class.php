<?php

require_once(dirname(__FILE__).'/../lib/BaseTrazaprodGeneratorConfiguration.class.php');
require_once(dirname(__FILE__).'/../lib/BaseTrazaprodGeneratorHelper.class.php');

/**
 * trazaprod actions.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage trazaprod
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: actions.class.php 12493 2008-10-31 14:43:26Z fabien $
 */
class autoTrazaprodActions extends sfActions
{
  public function preExecute()
  {
    $this->configuration = new trazaprodGeneratorConfiguration();

    if (!$this->getUser()->hasCredential($this->configuration->getCredentials($this->getActionName())))
    {
      $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
    }

    $this->dispatcher->notify(new sfEvent($this, 'admin.pre_execute', array('configuration' => $this->configuration)));

    $this->helper = new trazaprodGeneratorHelper();
  }

  public function executeIndex(sfWebRequest $request)
  {
    // sorting
    if ($request->getParameter('sort'))
    {
      $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
    }

    // pager
    if ($request->getParameter('page'))
    {
      $this->setPage($request->getParameter('page'));
    }

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();

    // has filters? (usefull for activate reset button)
    $this->hasFilters = $this->getUser()->getAttribute('trazaprod.filters', $this->configuration->getFilterDefaults(), 'admin_module');
  }

  public function executeFilter(sfWebRequest $request)
  {
    $this->setPage(1);

    if ($request->hasParameter('_reset'))
    {
      $this->setFilters($this->configuration->getFilterDefaults());

      $this->redirect('@traza2');
    }

    $this->filters = $this->configuration->getFilterForm($this->getFilters());

    $this->filters->bind($request->getParameter($this->filters->getName()));
    if ($this->filters->isValid())
    {
      $this->setFilters($this->filters->getValues());

      $this->redirect('@traza2');
    }

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();

    $this->setTemplate('index');
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = $this->configuration->getForm();
    $this->traza2 = $this->form->getObject();
  }

  public function executeCreate(sfWebRequest $request){
    $this->form = $this->configuration->getForm();
    $this->traza2 = $this->form->getObject();
    if ($request->hasParameter('rtn')){
      $traza2_id = $this->processForm($request, $this->form);
      return $this->renderText(json_encode($traza2_id));
    }else{
      $this->processForm($request, $this->form);
      $this->setTemplate('new');
    }
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->traza2 = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->traza2);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->traza2 = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->traza2);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

    $obj = $this->getRoute()->getObject();
    $relations = $obj->getTable()->getRelations();
    
    $borrar = true;
    foreach ($relations as $name => $relation) {
        if($relation->getType() == 1){
          $rel = $relation->getTable()->findOneBy($relation->getForeign(), $obj->get($relation->getLocal()));
          if($rel){
            $borrar = false;
            break;
          }
        }
    }
        
    if($borrar){
      $this->getRoute()->getObject()->delete();
      $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
    }else{
      $this->getUser()->setFlash('error', 'No se puede borrar, el registro esta siendo referenciado.');
    }

    $this->redirect('@traza2');
  }


  protected function processForm(sfWebRequest $request, sfForm $form){
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()){
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
      $traza2 = $form->save();
      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $traza2)));
      if ($request->hasParameter('_save_and_add')){
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');
        $this->redirect('@traza2_new');
      }else{
        if ($request->hasParameter('rtn')){
          return $traza2->getId();
        }else{
          $this->getUser()->setFlash('notice', $notice);
          //$this->redirect(array('sf_route' => 'traza2_edit', 'sf_subject' => $traza2));
          $this->redirect('@traza2');
        }
      }
    }else{
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }

  protected function getFilters()
  {
    return $this->getUser()->getAttribute('trazaprod.filters', $this->configuration->getFilterDefaults(), 'admin_module');
  }

  protected function setFilters(array $filters)
  {
    return $this->getUser()->setAttribute('trazaprod.filters', $filters, 'admin_module');
  }

  protected function getPager()
  {
    $pager = $this->configuration->getPager('Traza2');
    $pager->setQuery($this->buildQuery());
    $pager->setPage($this->getPage());
    $pager->init();

    return $pager;
  }

  protected function setPage($page)
  {
    $this->getUser()->setAttribute('trazaprod.page', $page, 'admin_module');
  }

  protected function getPage()
  {
    return $this->getUser()->getAttribute('trazaprod.page', 1, 'admin_module');
  }

  protected function buildQuery()
  {
    $tableMethod = $this->configuration->getTableMethod();
    if (is_null($this->filters))
    {
      $this->filters = $this->configuration->getFilterForm($this->getFilters());
    }

    $this->filters->setTableMethod($tableMethod);

    $query = $this->filters->buildQuery($this->getFilters());

    $this->addSortQuery($query);

    $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
    $query = $event->getReturnValue();

    return $query;
  }

  protected function addSortQuery($query)
  {
    if (array(null, null) == ($sort = $this->getSort()))
    {
      return;
    }

    $query->addOrderBy($sort[0] . ' ' . $sort[1]);
  }

  protected function getSort()
  {
    if (!is_null($sort = $this->getUser()->getAttribute('trazaprod.sort', null, 'admin_module')))
    {
      return $sort;
    }

    $this->setSort($this->configuration->getDefaultSort());

    return $this->getUser()->getAttribute('trazaprod.sort', null, 'admin_module');
  }

  protected function setSort(array $sort)
  {
    if (!is_null($sort[0]) && is_null($sort[1]))
    {
      $sort[1] = 'asc';
    }

    $this->getUser()->setAttribute('trazaprod.sort', $sort, 'admin_module');
  }

	public function executeShow(sfWebRequest $request)
	{
	  $this->traza2 = Doctrine::getTable('Traza2')->find($request->getParameter('id'));
	  $this->forward404Unless($this->traza2);
	  $this->form = $this->configuration->getForm($this->traza2);
	}


}
