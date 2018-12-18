  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

    $obj = $this->getRoute()->getObject();
    $relations = $obj->getTable()->getRelations();

    $borrar = true;
	$rel = array();
    foreach ($relations as $name => $relation) {
		$valor = $obj->get($relation->getLocal());
		$campo = $relation->getForeign();
        if($relation->getType() == 1 && !empty($valor)){
          $rel = $relation->getTable()->findOneBy($campo, $valor);
          if(!empty($rel)){
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

    $this->redirect('@<?php echo $this->getUrlForAction('list') ?>');
  }
