<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('DetalleResumen', 'doctrine');

/**
 * BaseDetalleResumen
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $resumen_id
 * @property integer $producto_id
 * @property decimal $precio
 * @property integer $cantidad
 * @property decimal $total
 * @property integer $bonificados
 * @property string $observacion
 * @property string $nro_lote
 * @property date $fecha_vto
 * @property decimal $iva
 * @property decimal $sub_total
 * @property integer $usuario
 * @property integer $lista_id
 * @property integer $moneda_id
 * @property integer $cant_vend_remito
 * @property integer $lote_id
 * @property integer $det_remito_id
 * @property Resumen $Resumen
 * @property Producto $Producto
 * @property sfGuardUser $sfGuardUser
 * @property Lote $Lote
 * @property ListaPrecio $Lista
 * @property TipoMoneda $Moneda
 * @property DetalleResumen $DetalleRemito
 * @property Doctrine_Collection $DetalleResumen
 * @property Doctrine_Collection $ListadoVentas
 * @property Doctrine_Collection $VentasZona
 * 
 * @method integer             getId()               Returns the current record's "id" value
 * @method integer             getResumenId()        Returns the current record's "resumen_id" value
 * @method integer             getProductoId()       Returns the current record's "producto_id" value
 * @method decimal             getPrecio()           Returns the current record's "precio" value
 * @method integer             getCantidad()         Returns the current record's "cantidad" value
 * @method decimal             getTotal()            Returns the current record's "total" value
 * @method integer             getBonificados()      Returns the current record's "bonificados" value
 * @method string              getObservacion()      Returns the current record's "observacion" value
 * @method string              getNroLote()          Returns the current record's "nro_lote" value
 * @method date                getFechaVto()         Returns the current record's "fecha_vto" value
 * @method decimal             getIva()              Returns the current record's "iva" value
 * @method decimal             getSubTotal()         Returns the current record's "sub_total" value
 * @method integer             getUsuario()          Returns the current record's "usuario" value
 * @method integer             getListaId()          Returns the current record's "lista_id" value
 * @method integer             getMonedaId()         Returns the current record's "moneda_id" value
 * @method integer             getCantVendRemito()   Returns the current record's "cant_vend_remito" value
 * @method integer             getLoteId()           Returns the current record's "lote_id" value
 * @method integer             getDetRemitoId()      Returns the current record's "det_remito_id" value
 * @method Resumen             getResumen()          Returns the current record's "Resumen" value
 * @method Producto            getProducto()         Returns the current record's "Producto" value
 * @method sfGuardUser         getSfGuardUser()      Returns the current record's "sfGuardUser" value
 * @method Lote                getLote()             Returns the current record's "Lote" value
 * @method ListaPrecio         getLista()            Returns the current record's "Lista" value
 * @method TipoMoneda          getMoneda()           Returns the current record's "Moneda" value
 * @method DetalleResumen      getDetalleRemito()    Returns the current record's "DetalleRemito" value
 * @method Doctrine_Collection getDetalleResumen()   Returns the current record's "DetalleResumen" collection
 * @method Doctrine_Collection getListadoVentas()    Returns the current record's "ListadoVentas" collection
 * @method Doctrine_Collection getVentasZona()       Returns the current record's "VentasZona" collection
 * @method DetalleResumen      setId()               Sets the current record's "id" value
 * @method DetalleResumen      setResumenId()        Sets the current record's "resumen_id" value
 * @method DetalleResumen      setProductoId()       Sets the current record's "producto_id" value
 * @method DetalleResumen      setPrecio()           Sets the current record's "precio" value
 * @method DetalleResumen      setCantidad()         Sets the current record's "cantidad" value
 * @method DetalleResumen      setTotal()            Sets the current record's "total" value
 * @method DetalleResumen      setBonificados()      Sets the current record's "bonificados" value
 * @method DetalleResumen      setObservacion()      Sets the current record's "observacion" value
 * @method DetalleResumen      setNroLote()          Sets the current record's "nro_lote" value
 * @method DetalleResumen      setFechaVto()         Sets the current record's "fecha_vto" value
 * @method DetalleResumen      setIva()              Sets the current record's "iva" value
 * @method DetalleResumen      setSubTotal()         Sets the current record's "sub_total" value
 * @method DetalleResumen      setUsuario()          Sets the current record's "usuario" value
 * @method DetalleResumen      setListaId()          Sets the current record's "lista_id" value
 * @method DetalleResumen      setMonedaId()         Sets the current record's "moneda_id" value
 * @method DetalleResumen      setCantVendRemito()   Sets the current record's "cant_vend_remito" value
 * @method DetalleResumen      setLoteId()           Sets the current record's "lote_id" value
 * @method DetalleResumen      setDetRemitoId()      Sets the current record's "det_remito_id" value
 * @method DetalleResumen      setResumen()          Sets the current record's "Resumen" value
 * @method DetalleResumen      setProducto()         Sets the current record's "Producto" value
 * @method DetalleResumen      setSfGuardUser()      Sets the current record's "sfGuardUser" value
 * @method DetalleResumen      setLote()             Sets the current record's "Lote" value
 * @method DetalleResumen      setLista()            Sets the current record's "Lista" value
 * @method DetalleResumen      setMoneda()           Sets the current record's "Moneda" value
 * @method DetalleResumen      setDetalleRemito()    Sets the current record's "DetalleRemito" value
 * @method DetalleResumen      setDetalleResumen()   Sets the current record's "DetalleResumen" collection
 * @method DetalleResumen      setListadoVentas()    Sets the current record's "ListadoVentas" collection
 * @method DetalleResumen      setVentasZona()       Sets the current record's "VentasZona" collection
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseDetalleResumen extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('detalle_resumen');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('resumen_id', 'integer', 4, array(
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
        $this->hasColumn('bonificados', 'integer', 1, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             'length' => 1,
             ));
        $this->hasColumn('observacion', 'string', 200, array(
             'type' => 'string',
             'length' => 200,
             ));
        $this->hasColumn('nro_lote', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('fecha_vto', 'date', 25, array(
             'type' => 'date',
             'notnull' => true,
             'length' => 25,
             ));
        $this->hasColumn('iva', 'decimal', 10, array(
             'type' => 'decimal',
             'default' => 0,
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('sub_total', 'decimal', 10, array(
             'type' => 'decimal',
             'default' => 0,
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('usuario', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('lista_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('moneda_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('cant_vend_remito', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('lote_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('det_remito_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Resumen', array(
             'local' => 'resumen_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Producto', array(
             'local' => 'producto_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('sfGuardUser', array(
             'local' => 'usuario',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('Lote', array(
             'local' => 'lote_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('ListaPrecio as Lista', array(
             'local' => 'lista_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('TipoMoneda as Moneda', array(
             'local' => 'moneda_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('DetalleResumen as DetalleRemito', array(
             'local' => 'det_remito_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasMany('DetalleResumen', array(
             'local' => 'id',
             'foreign' => 'det_remito_id'));

        $this->hasMany('ListadoVentas', array(
             'local' => 'id',
             'foreign' => 'id'));

        $this->hasMany('VentasZona', array(
             'local' => 'id',
             'foreign' => 'detalle_resumen_id'));
    }
}