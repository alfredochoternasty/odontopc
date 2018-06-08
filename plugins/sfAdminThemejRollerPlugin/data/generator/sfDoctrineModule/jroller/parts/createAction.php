  public function executeCreate(sfWebRequest $request){
    $this->form = $this->configuration->getForm();
    $this-><?php echo $this->getSingularName() ?> = $this->form->getObject();
    if ($request->hasParameter('rtn')){
      $<?php echo $this->getSingularName() ?>_id = $this->processForm($request, $this->form);
      return $this->renderText(json_encode($<?php echo $this->getSingularName() ?>_id));
    }else{
      $this->processForm($request, $this->form);
      $this->setTemplate('new');
    }
  }
