<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Producto2', 'doctrine');

/**
 * BaseProducto2
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $codigo
 * @property string $nombre
 * @property integer $grupoprod_id
 * @property Grupoprod2 $Grupo
 * @property Doctrine_Collection $Traza2
 * @property Doctrine_Collection $compra2
 * 
 * @method integer             getId()           Returns the current record's "id" value
 * @method string              getCodigo()       Returns the current record's "codigo" value
 * @method string              getNombre()       Returns the current record's "nombre" value
 * @method integer             getGrupoprodId()  Returns the current record's "grupoprod_id" value
 * @method Grupoprod2          getGrupo()        Returns the current record's "Grupo" value
 * @method Doctrine_Collection getTraza2()       Returns the current record's "Traza2" collection
 * @method Doctrine_Collection getCompra2()      Returns the current record's "compra2" collection
 * @method Producto2           setId()           Sets the current record's "id" value
 * @method Producto2           setCodigo()       Sets the current record's "codigo" value
 * @method Producto2           setNombre()       Sets the current record's "nombre" value
 * @method Producto2           setGrupoprodId()  Sets the current record's "grupoprod_id" value
 * @method Producto2           setGrupo()        Sets the current record's "Grupo" value
 * @method Producto2           setTraza2()       Sets the current record's "Traza2" collection
 * @method Producto2           setCompra2()      Sets the current record's "compra2" collection
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseProducto2 extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('producto2');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('codigo', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('nombre', 'string', 100, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 100,
             ));
        $this->hasColumn('grupoprod_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Grupoprod2 as Grupo', array(
             'local' => 'grupoprod_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasMany('Traza2', array(
             'local' => 'id',
             'foreign' => 'producto_id'));

        $this->hasMany('compra2', array(
             'local' => 'id',
             'foreign' => 'producto_id'));
    }
}