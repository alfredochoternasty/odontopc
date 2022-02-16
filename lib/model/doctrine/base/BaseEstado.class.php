<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Estado', 'doctrine');

/**
 * BaseEstado
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $nombre
 * @property string $categoria
 * @property Doctrine_Collection $Envio
 * 
 * @method integer             getId()        Returns the current record's "id" value
 * @method string              getNombre()    Returns the current record's "nombre" value
 * @method string              getCategoria() Returns the current record's "categoria" value
 * @method Doctrine_Collection getEnvio()     Returns the current record's "Envio" collection
 * @method Estado              setId()        Sets the current record's "id" value
 * @method Estado              setNombre()    Sets the current record's "nombre" value
 * @method Estado              setCategoria() Sets the current record's "categoria" value
 * @method Estado              setEnvio()     Sets the current record's "Envio" collection
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseEstado extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('estado');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('nombre', 'string', 50, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 50,
             ));
        $this->hasColumn('categoria', 'string', 50, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 50,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Envio', array(
             'local' => 'id',
             'foreign' => 'estado_id'));
    }
}