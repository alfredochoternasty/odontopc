<?php

/**
 * cli module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage cli
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: configuration.php 12474 2008-10-31 10:41:27Z fabien $
 */
class BaseCliGeneratorConfiguration extends sfModelGeneratorConfiguration
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
	  // return array(  '_list' => NULL,  '_save' => NULL,  '_save_and_add' => NULL,  'generar_usuario' => NULL,);
  
    return array(  '_list' => NULL,  '_save' => NULL,  '_save_and_add' => NULL,  'generar_usuario' => NULL,);
  }

  public function getListObjectActions()
  {
		// =============== Added show view
	  return array(  '_delete' => NULL,  '_edit' => NULL,);
  
    return array(  '_delete' => NULL,  '_edit' => NULL,);
  }

  public function getListActions()
  {
    return array(  '_new' => NULL,  'imprimir' =>   array(    'label' => 'Imprimir',  ),);
  }

  public function getListBatchActions()
  {
    return array(  'desactivar' => NULL,  'activar' => NULL,);
  }

  public function getListParams()
  {
    return '%%_c_fiscal%% - %%apellido%% - %%nombre%% - %%_direccion%% - %%_telefonos%% - %%email%% - %%activo%%';
  }

  public function getListLayout()
  {
    return 'tabular';
  }

  public function getListTitle()
  {
    return 'Administraci&oacute;n de Clientes';
  }

  public function getEditTitle()
  {
    return 'Modificar Cliente';
  }

  public function getNewTitle()
  {
    return 'Nuevo Cliente';
  }

  public function getFilterDisplay()
  {
    return array(  0 => 'apellido',  1 => 'nombre',  2 => 'sexo',  3 => 'localidad_id',  4 => 'lista_id',  5 => 'activo',);
  }

  public function getFormDisplay()
  {
    return array(  0 => 'tipo_id',  1 => 'activo',  2 => 'cuit',  3 => 'condicionfiscal_id',  4 => 'dni',  5 => 'apellido',  6 => 'nombre',  7 => 'sexo',  8 => 'lista_id',  9 => 'localidad_id',  10 => 'domicilio',  11 => 'telefono',  12 => 'celular',  13 => 'fax',  14 => 'email',  15 => 'observacion',);
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
    return array(  0 => '_c_fiscal',  1 => 'apellido',  2 => 'nombre',  3 => '_direccion',  4 => '_telefonos',  5 => 'email',  6 => 'activo',);
  }

  public function getFieldsDefault()
  {
    return array(
      'id' => array(  'is_link' => true,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'tipo_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',  'help' => 'Tipo de Cliente',),
      'dni' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'help' => 'Número de documento sin puntos \'.\'',),
      'cuit' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'help' => 'Número de CUIT sin guion \'-\'',),
      'condicionfiscal_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',  'label' => 'Cond. Fiscal',),
      'genera_comision' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Boolean',  'label' => 'Genera <br>Comisión',  'help' => 'Indica si se obtiene una comisión por las compras del cliente',),
      'sexo' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'apellido' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'nombre' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'fecha_nacimiento' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'domicilio' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'localidad_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',  'label' => 'Ciudad',  'help' => 'Si la ciudad no existe puede agregar un nueva',),
      'telefono' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Teléfono',  'help' => 'Número de teléfono fijo',),
      'celular' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'help' => 'Número de teléfono celular',),
      'fax' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'help' => 'Número de Fax',),
      'email' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'observacion' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'usuario_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'lista_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'activo' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Boolean',),
      'lista' => array(  'is_link' => false,  'is_real' => false,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'help' => 'Lista de precios para este cliente cuando hace el pedido via la parte de pedidos',),
    );
  }

  public function getFieldsList()
  {
    return array(
      'id' => array(),
      'tipo_id' => array(),
      'dni' => array(),
      'cuit' => array(),
      'condicionfiscal_id' => array(),
      'genera_comision' => array(),
      'sexo' => array(),
      'apellido' => array(),
      'nombre' => array(),
      'fecha_nacimiento' => array(),
      'domicilio' => array(),
      'localidad_id' => array(),
      'telefono' => array(),
      'celular' => array(),
      'fax' => array(),
      'email' => array(),
      'observacion' => array(),
      'usuario_id' => array(),
      'lista_id' => array(),
      'activo' => array(),
    );
  }

  public function getFieldsFilter()
  {
    return array(
      'id' => array(),
      'tipo_id' => array(),
      'dni' => array(),
      'cuit' => array(),
      'condicionfiscal_id' => array(),
      'genera_comision' => array(),
      'sexo' => array(),
      'apellido' => array(),
      'nombre' => array(),
      'fecha_nacimiento' => array(),
      'domicilio' => array(),
      'localidad_id' => array(),
      'telefono' => array(),
      'celular' => array(),
      'fax' => array(),
      'email' => array(),
      'observacion' => array(),
      'usuario_id' => array(),
      'lista_id' => array(),
      'activo' => array(),
    );
  }

  public function getFieldsForm()
  {
    return array(
      'id' => array(),
      'tipo_id' => array(),
      'dni' => array(),
      'cuit' => array(),
      'condicionfiscal_id' => array(),
      'genera_comision' => array(),
      'sexo' => array(),
      'apellido' => array(),
      'nombre' => array(),
      'fecha_nacimiento' => array(),
      'domicilio' => array(),
      'localidad_id' => array(),
      'telefono' => array(),
      'celular' => array(),
      'fax' => array(),
      'email' => array(),
      'observacion' => array(),
      'usuario_id' => array(),
      'lista_id' => array(),
      'activo' => array(),
    );
  }

  public function getFieldsEdit()
  {
    return array(
      'id' => array(),
      'tipo_id' => array(),
      'dni' => array(),
      'cuit' => array(),
      'condicionfiscal_id' => array(),
      'genera_comision' => array(),
      'sexo' => array(),
      'apellido' => array(),
      'nombre' => array(),
      'fecha_nacimiento' => array(),
      'domicilio' => array(),
      'localidad_id' => array(),
      'telefono' => array(),
      'celular' => array(),
      'fax' => array(),
      'email' => array(),
      'observacion' => array(),
      'usuario_id' => array(),
      'lista_id' => array(),
      'activo' => array(),
    );
  }

  public function getFieldsShow()
  {
    return array(
      'id' => array(),
      'tipo_id' => array(),
      'dni' => array(),
      'cuit' => array(),
      'condicionfiscal_id' => array(),
      'genera_comision' => array(),
      'sexo' => array(),
      'apellido' => array(),
      'nombre' => array(),
      'fecha_nacimiento' => array(),
      'domicilio' => array(),
      'localidad_id' => array(),
      'telefono' => array(),
      'celular' => array(),
      'fax' => array(),
      'email' => array(),
      'observacion' => array(),
      'usuario_id' => array(),
      'lista_id' => array(),
      'activo' => array(),
    );
  }

  public function getFieldsNew()
  {
    return array(
      'id' => array(),
      'tipo_id' => array(),
      'dni' => array(),
      'cuit' => array(),
      'condicionfiscal_id' => array(),
      'genera_comision' => array(),
      'sexo' => array(),
      'apellido' => array(),
      'nombre' => array(),
      'fecha_nacimiento' => array(),
      'domicilio' => array(),
      'localidad_id' => array(),
      'telefono' => array(),
      'celular' => array(),
      'fax' => array(),
      'email' => array(),
      'observacion' => array(),
      'usuario_id' => array(),
      'lista_id' => array(),
      'activo' => array(),
    );
  }


  /**
   * Gets the form class name.
   *
   * @return string The form class name
   */
  public function getFormClass()
  {
    return 'ClienteForm';
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
    return 'ClienteFormFilter';
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
    return 'View Cli';
  }

  public function getShowDisplay()
  {
      return array(  0 => 'id',  1 => 'tipo_id',  2 => 'dni',  3 => 'cuit',  4 => 'condicionfiscal_id',  5 => 'genera_comision',  6 => 'sexo',  7 => 'apellido',  8 => 'nombre',  9 => 'fecha_nacimiento',  10 => 'domicilio',  11 => 'localidad_id',  12 => 'telefono',  13 => 'celular',  14 => 'fax',  15 => 'email',  16 => 'observacion',  17 => 'usuario_id',  18 => 'lista_id',  19 => 'activo',);
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
    return 'retrieveConJoins';
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
