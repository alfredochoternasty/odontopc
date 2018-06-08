<?php

/**
 * trazaprod module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage trazaprod
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: configuration.php 12474 2008-10-31 10:41:27Z fabien $
 */
class BaseTrazaprodGeneratorConfiguration extends sfModelGeneratorConfiguration
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
	  return array(  '_show' => NULL,  '_edit' => NULL,  '_delete' => NULL,);
  
    return array(  '_edit' => NULL,  '_delete' => NULL,);
  }

  public function getListActions()
  {
    return array(  '_new' => NULL,  'imprimir' =>   array(    'label' => 'Imprimir',  ),);
  }

  public function getListBatchActions()
  {
    return array();
  }

  public function getListParams()
  {
    return '%%Producto2%% - %%cant_vendida%% - %%nro_lote%% - %%fecha_venta%% - %%Cliente%%';
  }

  public function getListLayout()
  {
    return 'tabular';
  }

  public function getListTitle()
  {
    return 'Traza de Productos';
  }

  public function getEditTitle()
  {
    return 'Modificar Traza';
  }

  public function getNewTitle()
  {
    return 'Nueva Traza';
  }

  public function getFilterDisplay()
  {
    return array(  0 => 'producto_id',  1 => 'nro_lote',  2 => 'fecha_venta',  3 => 'cliente_id',  4 => 'fecha_compra',);
  }

  public function getFormDisplay()
  {
    return array();
  }

  public function getEditDisplay()
  {
    return array(  0 => 'producto_id',  1 => 'cant_vendida',  2 => 'nro_lote',  3 => 'fecha_venta',  4 => 'cliente_id',);
  }

  public function getNewDisplay()
  {
    return array(  0 => 'producto_id',  1 => 'cant_vendida',  2 => 'nro_lote',  3 => 'fecha_venta',  4 => 'cliente_id',);
  }

  public function getListDisplay()
  {
    return array(  0 => 'Producto2',  1 => 'cant_vendida',  2 => 'nro_lote',  3 => 'fecha_venta',  4 => 'Cliente',);
  }

  public function getFieldsDefault()
  {
    return array(
      'id' => array(  'is_link' => true,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'producto_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'nro_lote' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Lote',),
      'nro_venta' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Venta',),
      'fecha_venta' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',  'date_format' => 'dd/MM/yyyy',),
      'cliente_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'fecha_compra' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',  'date_format' => 'dd/MM/yyyy',),
      'proveedor_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'numero_compra' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Compra',),
      'cant_vendida' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'cant_comprada' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'Producto2' => array(  'is_link' => false,  'is_real' => false,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Producto',),
    );
  }

  public function getFieldsList()
  {
    return array(
      'id' => array(),
      'producto_id' => array(),
      'nro_lote' => array(),
      'nro_venta' => array(),
      'fecha_venta' => array(),
      'cliente_id' => array(),
      'fecha_compra' => array(),
      'proveedor_id' => array(),
      'numero_compra' => array(),
      'cant_vendida' => array(),
      'cant_comprada' => array(),
    );
  }

  public function getFieldsFilter()
  {
    return array(
      'id' => array(),
      'producto_id' => array(),
      'nro_lote' => array(),
      'nro_venta' => array(),
      'fecha_venta' => array(),
      'cliente_id' => array(),
      'fecha_compra' => array(),
      'proveedor_id' => array(),
      'numero_compra' => array(),
      'cant_vendida' => array(),
      'cant_comprada' => array(),
    );
  }

  public function getFieldsForm()
  {
    return array(
      'id' => array(),
      'producto_id' => array(),
      'nro_lote' => array(),
      'nro_venta' => array(),
      'fecha_venta' => array(),
      'cliente_id' => array(),
      'fecha_compra' => array(),
      'proveedor_id' => array(),
      'numero_compra' => array(),
      'cant_vendida' => array(),
      'cant_comprada' => array(),
    );
  }

  public function getFieldsEdit()
  {
    return array(
      'id' => array(),
      'producto_id' => array(),
      'nro_lote' => array(),
      'nro_venta' => array(),
      'fecha_venta' => array(),
      'cliente_id' => array(),
      'fecha_compra' => array(),
      'proveedor_id' => array(),
      'numero_compra' => array(),
      'cant_vendida' => array(),
      'cant_comprada' => array(),
    );
  }

  public function getFieldsShow()
  {
    return array(
      'id' => array(),
      'producto_id' => array(),
      'nro_lote' => array(),
      'nro_venta' => array(),
      'fecha_venta' => array(),
      'cliente_id' => array(),
      'fecha_compra' => array(),
      'proveedor_id' => array(),
      'numero_compra' => array(),
      'cant_vendida' => array(),
      'cant_comprada' => array(),
    );
  }

  public function getFieldsNew()
  {
    return array(
      'id' => array(),
      'producto_id' => array(),
      'nro_lote' => array(),
      'nro_venta' => array(),
      'fecha_venta' => array(),
      'cliente_id' => array(),
      'fecha_compra' => array(),
      'proveedor_id' => array(),
      'numero_compra' => array(),
      'cant_vendida' => array(),
      'cant_comprada' => array(),
    );
  }


  /**
   * Gets the form class name.
   *
   * @return string The form class name
   */
  public function getFormClass()
  {
    return 'Traza2Form';
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
    return 'Traza2FormFilter';
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
    return 'View Trazaprod';
  }

  public function getShowDisplay()
  {
      return array(  0 => 'id',  1 => 'producto_id',  2 => 'nro_lote',  3 => 'nro_venta',  4 => 'fecha_venta',  5 => 'cliente_id',  6 => 'fecha_compra',  7 => 'proveedor_id',  8 => 'numero_compra',  9 => 'cant_vendida',  10 => 'cant_comprada',);
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
    return '';
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
