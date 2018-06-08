<?php

/**
 * inicio module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage inicio
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: configuration.php 12474 2008-10-31 10:41:27Z fabien $
 */
class BaseInicioGeneratorConfiguration extends sfModelGeneratorConfiguration
{
  public function getCredentials($action)
  {
    if (0 === strpos($action, '_'))
    {
      $action = substr($action, 1);
    }

    return isset($this->configuration['credentials'][$action]) ? $this->configuration['credentials'][$action] : array();
  }

  public function getActionsDefault()
  {
    return array();
  }

  public function getFormActions()
  {
    return array(  '_delete' => NULL,  '_list' => NULL,  '_save' => NULL,  '_save_and_add' => NULL,);
  }

  public function getNewActions()
  {
    return array();
  }

  public function getEditActions()
  {
		//  added show view
	  // return array(  '_delete' => NULL,  '_list' => NULL,  '_show' => NULL,  '_save' => NULL,  '_save_and_add' => NULL,);
  
    return array();
  }

  public function getListObjectActions()
  {
		// =============== Added show view
	  return array();
  
    return array();
  }

  public function getListActions()
  {
    return array();
  }

  public function getListBatchActions()
  {
    return array();
  }

  public function getListParams()
  {
    return '%%nombre%% - %%nro_lote%% - %%stock%% - %%minimo_stock%%';
  }

  public function getListLayout()
  {
    return 'tabular';
  }

  public function getListTitle()
  {
    return 'Productos con Stock por debajo del Mínimo';
  }

  public function getEditTitle()
  {
    return 'Edit Inicio';
  }

  public function getNewTitle()
  {
    return 'New Inicio';
  }

  public function getFilterDisplay()
  {
    return array();
  }

  public function getFormDisplay()
  {
    return array();
  }

  public function getEditDisplay()
  {
    return array();
  }

  public function getNewDisplay()
  {
    return array();
  }

  public function getListDisplay()
  {
    return array(  0 => 'nombre',  1 => 'nro_lote',  2 => 'stock',  3 => 'minimo_stock',);
  }

  public function getFieldsDefault()
  {
    return array(
      'id' => array(  'is_link' => true,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'codigo' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'nombre' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'grupoprod_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'precio_vta' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'moneda_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'genera_comision' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Boolean',),
      'mueve_stock' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Boolean',),
      'minimo_stock' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Mínimo',),
      'stock_actual' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Stock',),
      'ctr_fact_grupo' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Boolean',),
      'orden_grupo' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'activo' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Boolean',),
      'grupo2' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'grupo3' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
    );
  }

  public function getFieldsList()
  {
    return array(
      'id' => array(),
      'codigo' => array(),
      'nombre' => array(),
      'grupoprod_id' => array(),
      'precio_vta' => array(),
      'moneda_id' => array(),
      'genera_comision' => array(),
      'mueve_stock' => array(),
      'minimo_stock' => array(),
      'stock_actual' => array(),
      'ctr_fact_grupo' => array(),
      'orden_grupo' => array(),
      'activo' => array(),
      'grupo2' => array(),
      'grupo3' => array(),
    );
  }

  public function getFieldsFilter()
  {
    return array(
      'id' => array(),
      'codigo' => array(),
      'nombre' => array(),
      'grupoprod_id' => array(),
      'precio_vta' => array(),
      'moneda_id' => array(),
      'genera_comision' => array(),
      'mueve_stock' => array(),
      'minimo_stock' => array(),
      'stock_actual' => array(),
      'ctr_fact_grupo' => array(),
      'orden_grupo' => array(),
      'activo' => array(),
      'grupo2' => array(),
      'grupo3' => array(),
    );
  }

  public function getFieldsForm()
  {
    return array(
      'id' => array(),
      'codigo' => array(),
      'nombre' => array(),
      'grupoprod_id' => array(),
      'precio_vta' => array(),
      'moneda_id' => array(),
      'genera_comision' => array(),
      'mueve_stock' => array(),
      'minimo_stock' => array(),
      'stock_actual' => array(),
      'ctr_fact_grupo' => array(),
      'orden_grupo' => array(),
      'activo' => array(),
      'grupo2' => array(),
      'grupo3' => array(),
    );
  }

  public function getFieldsEdit()
  {
    return array(
      'id' => array(),
      'codigo' => array(),
      'nombre' => array(),
      'grupoprod_id' => array(),
      'precio_vta' => array(),
      'moneda_id' => array(),
      'genera_comision' => array(),
      'mueve_stock' => array(),
      'minimo_stock' => array(),
      'stock_actual' => array(),
      'ctr_fact_grupo' => array(),
      'orden_grupo' => array(),
      'activo' => array(),
      'grupo2' => array(),
      'grupo3' => array(),
    );
  }

  public function getFieldsShow()
  {
    return array(
      'id' => array(),
      'codigo' => array(),
      'nombre' => array(),
      'grupoprod_id' => array(),
      'precio_vta' => array(),
      'moneda_id' => array(),
      'genera_comision' => array(),
      'mueve_stock' => array(),
      'minimo_stock' => array(),
      'stock_actual' => array(),
      'ctr_fact_grupo' => array(),
      'orden_grupo' => array(),
      'activo' => array(),
      'grupo2' => array(),
      'grupo3' => array(),
    );
  }

  public function getFieldsNew()
  {
    return array(
      'id' => array(),
      'codigo' => array(),
      'nombre' => array(),
      'grupoprod_id' => array(),
      'precio_vta' => array(),
      'moneda_id' => array(),
      'genera_comision' => array(),
      'mueve_stock' => array(),
      'minimo_stock' => array(),
      'stock_actual' => array(),
      'ctr_fact_grupo' => array(),
      'orden_grupo' => array(),
      'activo' => array(),
      'grupo2' => array(),
      'grupo3' => array(),
    );
  }


  /**
   * Gets the form class name.
   *
   * @return string The form class name
   */
  public function getFormClass()
  {
    return 'ProductoForm';
  }

  public function getFormOptions()
  {
    return array();
  }

  public function hasFilterForm()
  {
    return true;
  }

  /**
   * Gets the filter form class name
   *
   * @return string The filter form class name associated with this generator
   */
  public function getFilterFormClass()
  {
    return 'ProductoFormFilter';
  }

	  protected function getConfig()
  {
    $configuration = parent::getConfig();
    $configuration['show'] = $this->getFieldsShow();
    return $configuration;
  }

  protected function compile()
  {
    parent::compile();
    
    $config = $this->getConfig();
    
    // add configuration for the show view 
    $this->configuration['show'] = array( 'fields'         => array(),
                                          'title'          => $this->getShowTitle(),
                                          'actions'        => $this->getShowActions(),
                                          'display'        => $this->getShowDisplay(),
                                        ) ;

    foreach (array('show') as $context)
    {
      foreach ($this->configuration[$context]['actions'] as $action => $parameters)
      {
        $this->configuration[$context]['actions'][$action] = $this->fixActionParameters($action, $parameters);
      }
    }


  }

  public function getShowActions()
  {
    return array(  '_list' => NULL,  '_edit' => NULL, '_delete' => NULL);
  }

  
  public function getShowTitle()
  {
    return 'View Inicio';
  }

  public function getShowDisplay()
  {
      return array(  0 => 'id',  1 => 'codigo',  2 => 'nombre',  3 => 'grupoprod_id',  4 => 'precio_vta',  5 => 'moneda_id',  6 => 'genera_comision',  7 => 'mueve_stock',  8 => 'minimo_stock',  9 => 'stock_actual',  10 => 'ctr_fact_grupo',  11 => 'orden_grupo',  12 => 'activo',  13 => 'grupo2',  14 => 'grupo3',);
  }

  public function getFilterForm($filters)
  {
    $class = $this->getFilterFormClass();

    return new $class($filters, $this->getFilterFormOptions());
  }

  public function getFilterFormOptions()
  {
    return array();
  }

  public function getFilterDefaults()
  {
    return array();
  }

  public function getPager($model)
  {
    $class = $this->getPagerClass();

    return new $class($model, $this->getPagerMaxPerPage());
  }

  public function getPagerClass()
  {
    return 'sfDoctrinePager';
  }

  public function getPagerMaxPerPage()
  {
    return 20;
  }

  public function getDefaultSort()
  {
    return array(null, null);
  }

  public function getTableMethod()
  {
    return 'ProdutosSinStock';
  }

  public function getTableCountMethod()
  {
    return '';
  }

  public function getConnection()
  {
    return null;
  }
}
