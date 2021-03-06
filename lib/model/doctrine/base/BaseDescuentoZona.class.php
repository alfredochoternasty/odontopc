<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('DescuentoZona', 'doctrine');

/**
 * BaseDescuentoZona
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $producto_id
 * @property integer $grupoprod_id
 * @property integer $porc_desc
 * @property integer $precio_desc
 * @property integer $zona_id
 * @property integer $cliente_id
 * @property Zona $Zona
 * @property Producto $Producto
 * @property Grupoprod $Grupoprod
 * @property Cliente $Cliente
 * 
 * @method integer       getId()           Returns the current record's "id" value
 * @method integer       getProductoId()   Returns the current record's "producto_id" value
 * @method integer       getGrupoprodId()  Returns the current record's "grupoprod_id" value
 * @method integer       getPorcDesc()     Returns the current record's "porc_desc" value
 * @method integer       getPrecioDesc()   Returns the current record's "precio_desc" value
 * @method integer       getZonaId()       Returns the current record's "zona_id" value
 * @method integer       getClienteId()    Returns the current record's "cliente_id" value
 * @method Zona          getZona()         Returns the current record's "Zona" value
 * @method Producto      getProducto()     Returns the current record's "Producto" value
 * @method Grupoprod     getGrupoprod()    Returns the current record's "Grupoprod" value
 * @method Cliente       getCliente()      Returns the current record's "Cliente" value
 * @method DescuentoZona setId()           Sets the current record's "id" value
 * @method DescuentoZona setProductoId()   Sets the current record's "producto_id" value
 * @method DescuentoZona setGrupoprodId()  Sets the current record's "grupoprod_id" value
 * @method DescuentoZona setPorcDesc()     Sets the current record's "porc_desc" value
 * @method DescuentoZona setPrecioDesc()   Sets the current record's "precio_desc" value
 * @method DescuentoZona setZonaId()       Sets the current record's "zona_id" value
 * @method DescuentoZona setClienteId()    Sets the current record's "cliente_id" value
 * @method DescuentoZona setZona()         Sets the current record's "Zona" value
 * @method DescuentoZona setProducto()     Sets the current record's "Producto" value
 * @method DescuentoZona setGrupoprod()    Sets the current record's "Grupoprod" value
 * @method DescuentoZona setCliente()      Sets the current record's "Cliente" value
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseDescuentoZona extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('descuento_zona');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('producto_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('grupoprod_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('porc_desc', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('precio_desc', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('zona_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('cliente_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Zona', array(
             'local' => 'zona_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('Producto', array(
             'local' => 'producto_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('Grupoprod', array(
             'local' => 'grupoprod_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('Cliente', array(
             'local' => 'cliente_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));
    }
}