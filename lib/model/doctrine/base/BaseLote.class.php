<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Lote', 'doctrine');

/**
 * BaseLote
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $producto_id
 * @property string $nro_lote
 * @property integer $stock
 * @property date $fecha_vto
 * @property integer $compra_id
 * @property string $observacion
 * @property integer $usuario_id
 * @property integer $zona_id
 * @property integer $activo
 * @property Compra $Compra
 * @property Producto $Producto
 * @property Zona $Zona
 * @property Doctrine_Collection $DetalleCompra
 * @property Doctrine_Collection $DetalleResumen
 * @property Doctrine_Collection $DevProducto
 * 
 * @method integer             getId()             Returns the current record's "id" value
 * @method integer             getProductoId()     Returns the current record's "producto_id" value
 * @method string              getNroLote()        Returns the current record's "nro_lote" value
 * @method integer             getStock()          Returns the current record's "stock" value
 * @method date                getFechaVto()       Returns the current record's "fecha_vto" value
 * @method integer             getCompraId()       Returns the current record's "compra_id" value
 * @method string              getObservacion()    Returns the current record's "observacion" value
 * @method integer             getUsuarioId()      Returns the current record's "usuario_id" value
 * @method integer             getZonaId()         Returns the current record's "zona_id" value
 * @method integer             getActivo()         Returns the current record's "activo" value
 * @method Compra              getCompra()         Returns the current record's "Compra" value
 * @method Producto            getProducto()       Returns the current record's "Producto" value
 * @method Zona                getZona()           Returns the current record's "Zona" value
 * @method Doctrine_Collection getDetalleCompra()  Returns the current record's "DetalleCompra" collection
 * @method Doctrine_Collection getDetalleResumen() Returns the current record's "DetalleResumen" collection
 * @method Doctrine_Collection getDevProducto()    Returns the current record's "DevProducto" collection
 * @method Lote                setId()             Sets the current record's "id" value
 * @method Lote                setProductoId()     Sets the current record's "producto_id" value
 * @method Lote                setNroLote()        Sets the current record's "nro_lote" value
 * @method Lote                setStock()          Sets the current record's "stock" value
 * @method Lote                setFechaVto()       Sets the current record's "fecha_vto" value
 * @method Lote                setCompraId()       Sets the current record's "compra_id" value
 * @method Lote                setObservacion()    Sets the current record's "observacion" value
 * @method Lote                setUsuarioId()      Sets the current record's "usuario_id" value
 * @method Lote                setZonaId()         Sets the current record's "zona_id" value
 * @method Lote                setActivo()         Sets the current record's "activo" value
 * @method Lote                setCompra()         Sets the current record's "Compra" value
 * @method Lote                setProducto()       Sets the current record's "Producto" value
 * @method Lote                setZona()           Sets the current record's "Zona" value
 * @method Lote                setDetalleCompra()  Sets the current record's "DetalleCompra" collection
 * @method Lote                setDetalleResumen() Sets the current record's "DetalleResumen" collection
 * @method Lote                setDevProducto()    Sets the current record's "DevProducto" collection
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLote extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('lote');
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
        $this->hasColumn('nro_lote', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('stock', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('fecha_vto', 'date', 25, array(
             'type' => 'date',
             'length' => 25,
             ));
        $this->hasColumn('compra_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('observacion', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('usuario_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('zona_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('activo', 'integer', 1, array(
             'type' => 'integer',
             'length' => 1,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Compra', array(
             'local' => 'compra_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('Producto', array(
             'local' => 'producto_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('Zona', array(
             'local' => 'zona_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasMany('DetalleCompra', array(
             'local' => 'id',
             'foreign' => 'lote_id'));

        $this->hasMany('DetalleResumen', array(
             'local' => 'id',
             'foreign' => 'lote_id'));

        $this->hasMany('DevProducto', array(
             'local' => 'id',
             'foreign' => 'lote_id'));
    }
}