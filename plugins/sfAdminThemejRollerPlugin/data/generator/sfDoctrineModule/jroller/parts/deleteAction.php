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

    $this->redirect('@<?php echo $this->getUrlForAction('list') ?>');
  }
