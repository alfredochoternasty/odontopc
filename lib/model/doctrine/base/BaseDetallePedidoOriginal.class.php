<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('DetallePedidoOriginal', 'doctrine');

/**
 * BaseDetallePedidoOriginal
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $pedido_id
 * @property integer $producto_id
 * @property decimal $precio
 * @property integer $cantidad
 * @property decimal $total
 * @property string $observacion
 * @property string $nro_lote
 * @property string $asignacion_lote
 * @property Pedido $Pedido
 * @property Producto $Producto
 * 
 * @method integer               getId()              Returns the current record's "id" value
 * @method integer               getPedidoId()        Returns the current record's "pedido_id" value
 * @method integer               getProductoId()      Returns the current record's "producto_id" value
 * @method decimal               getPrecio()          Returns the current record's "precio" value
 * @method integer               getCantidad()        Returns the current record's "cantidad" value
 * @method decimal               getTotal()           Returns the current record's "total" value
 * @method string                getObservacion()     Returns the current record's "observacion" value
 * @method string                getNroLote()         Returns the current record's "nro_lote" value
 * @method string                getAsignacionLote()  Returns the current record's "asignacion_lote" value
 * @method Pedido                getPedido()          Returns the current record's "Pedido" value
 * @method Producto              getProducto()        Returns the current record's "Producto" value
 * @method DetallePedidoOriginal setId()              Sets the current record's "id" value
 * @method DetallePedidoOriginal setPedidoId()        Sets the current record's "pedido_id" value
 * @method DetallePedidoOriginal setProductoId()      Sets the current record's "producto_id" value
 * @method DetallePedidoOriginal setPrecio()          Sets the current record's "precio" value
 * @method DetallePedidoOriginal setCantidad()        Sets the current record's "cantidad" value
 * @method DetallePedidoOriginal setTotal()           Sets the current record's "total" value
 * @method DetallePedidoOriginal setObservacion()     Sets the current record's "observacion" value
 * @method DetallePedidoOriginal setNroLote()         Sets the current record's "nro_lote" value
 * @method DetallePedidoOriginal setAsignacionLote()  Sets the current record's "asignacion_lote" value
 * @method DetallePedidoOriginal setPedido()          Sets the current record's "Pedido" value
 * @method DetallePedidoOriginal setProducto()        Sets the current record's "Producto" value
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseDetallePedidoOriginal extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('detalle_pedido_original');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('pedido_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('producto_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('precio', 'decimal', 10, array(
             'type' => 'decimal',
             'notnull' => true,
             'default' => 0,
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('cantidad', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 1,
             'length' => 4,
             ));
        $this->hasColumn('total', 'decimal', 10, array(
             'type' => 'decimal',
             'notnull' => true,
             'default' => 0,
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('observacion', 'string', 200, array(
             'type' => 'string',
             'length' => 200,
             ));
        $this->hasColumn('nro_lote', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('asignacion_lote', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Pedido', array(
             'local' => 'pedido_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Producto', array(
             'local' => 'producto_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));
    }
}