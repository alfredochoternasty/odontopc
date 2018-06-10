<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Grupoprod', 'doctrine');

/**
 * BaseGrupoprod
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $nombre
 * @property string $color
 * @property Doctrine_Collection $Productos
 * @property Doctrine_Collection $DetFactCompra
 * @property Doctrine_Collection $DetLisPrecio
 * @property Doctrine_Collection $ListadoVentas
 * @property Doctrine_Collection $ListadoCompras
 * @property Doctrine_Collection $ControlStock
 * 
 * @method integer             getId()             Returns the current record's "id" value
 * @method string              getNombre()         Returns the current record's "nombre" value
 * @method string              getColor()          Returns the current record's "color" value
 * @method Doctrine_Collection getProductos()      Returns the current record's "Productos" collection
 * @method Doctrine_Collection getDetFactCompra()  Returns the current record's "DetFactCompra" collection
 * @method Doctrine_Collection getDetLisPrecio()   Returns the current record's "DetLisPrecio" collection
 * @method Doctrine_Collection getListadoVentas()  Returns the current record's "ListadoVentas" collection
 * @method Doctrine_Collection getListadoCompras() Returns the current record's "ListadoCompras" collection
 * @method Doctrine_Collection getControlStock()   Returns the current record's "ControlStock" collection
 * @method Grupoprod           setId()             Sets the current record's "id" value
 * @method Grupoprod           setNombre()         Sets the current record's "nombre" value
 * @method Grupoprod           setColor()          Sets the current record's "color" value
 * @method Grupoprod           setProductos()      Sets the current record's "Productos" collection
 * @method Grupoprod           setDetFactCompra()  Sets the current record's "DetFactCompra" collection
 * @method Grupoprod           setDetLisPrecio()   Sets the current record's "DetLisPrecio" collection
 * @method Grupoprod           setListadoVentas()  Sets the current record's "ListadoVentas" collection
 * @method Grupoprod           setListadoCompras() Sets the current record's "ListadoCompras" collection
 * @method Grupoprod           setControlStock()   Sets the current record's "ControlStock" collection
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseGrupoprod extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('grupoprod');
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
        $this->hasColumn('color', 'string', 7, array(
             'type' => 'string',
             'length' => 7,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Producto as Productos', array(
             'local' => 'id',
             'foreign' => 'grupoprod_id'));

        $this->hasMany('DetFactCompra', array(
             'local' => 'id',
             'foreign' => 'grupoprod_id'));

        $this->hasMany('DetLisPrecio', array(
             'local' => 'id',
             'foreign' => 'grupoprod_id'));

        $this->hasMany('ListadoVentas', array(
             'local' => 'id',
             'foreign' => 'grupoprod_id'));

        $this->hasMany('ListadoCompras', array(
             'local' => 'id',
             'foreign' => 'grupoprod_id'));

        $this->hasMany('ControlStock', array(
             'local' => 'id',
             'foreign' => 'grupoprod_id'));
    }
}