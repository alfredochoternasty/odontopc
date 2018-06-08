<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('CompFact', 'doctrine');

/**
 * BaseCompFact
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property date $fecha
 * @property integer $producto_id
 * @property string $nombre_prod
 * @property integer $cantidad
 * @property Producto $Producto
 * 
 * @method integer  getId()          Returns the current record's "id" value
 * @method date     getFecha()       Returns the current record's "fecha" value
 * @method integer  getProductoId()  Returns the current record's "producto_id" value
 * @method string   getNombreProd()  Returns the current record's "nombre_prod" value
 * @method integer  getCantidad()    Returns the current record's "cantidad" value
 * @method Producto getProducto()    Returns the current record's "Producto" value
 * @method CompFact setId()          Sets the current record's "id" value
 * @method CompFact setFecha()       Sets the current record's "fecha" value
 * @method CompFact setProductoId()  Sets the current record's "producto_id" value
 * @method CompFact setNombreProd()  Sets the current record's "nombre_prod" value
 * @method CompFact setCantidad()    Sets the current record's "cantidad" value
 * @method CompFact setProducto()    Sets the current record's "Producto" value
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCompFact extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('comp_fact');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('fecha', 'date', 25, array(
             'type' => 'date',
             'length' => 25,
             ));
        $this->hasColumn('producto_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('nombre_prod', 'string', 200, array(
             'type' => 'string',
             'length' => 200,
             ));
        $this->hasColumn('cantidad', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Producto', array(
             'local' => 'producto_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));
    }
}