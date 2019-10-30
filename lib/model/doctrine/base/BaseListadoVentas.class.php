<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('ListadoVentas', 'doctrine');

/**
 * BaseListadoVentas
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $resumen_id
 * @property integer $tipofactura_id
 * @property date $fecha
 * @property integer $cliente_id
 * @property integer $zona_id
 * @property integer $producto_id
 * @property integer $grupoprod_id
 * @property integer $orden_grupo
 * @property string $nombre
 * @property string $nro_lote
 * @property decimal $cantidad
 * @property decimal $bonificados
 * @property decimal $precio
 * @property decimal $iva
 * @property decimal $sub_total
 * @property decimal $total
 * @property integer $det_remito_id
 * @property DetalleResumen $DetalleResumen
 * @property Resumen $Resumen
 * @property Cliente $Cliente
 * @property Producto $Producto
 * @property Zona $Zona
 * @property Grupoprod $Grupo
 * @property TipoFactura $TipoFactura
 * 
 * @method integer        getId()             Returns the current record's "id" value
 * @method integer        getResumenId()      Returns the current record's "resumen_id" value
 * @method integer        getTipofacturaId()  Returns the current record's "tipofactura_id" value
 * @method date           getFecha()          Returns the current record's "fecha" value
 * @method integer        getClienteId()      Returns the current record's "cliente_id" value
 * @method integer        getZonaId()         Returns the current record's "zona_id" value
 * @method integer        getProductoId()     Returns the current record's "producto_id" value
 * @method integer        getGrupoprodId()    Returns the current record's "grupoprod_id" value
 * @method integer        getOrdenGrupo()     Returns the current record's "orden_grupo" value
 * @method string         getNombre()         Returns the current record's "nombre" value
 * @method string         getNroLote()        Returns the current record's "nro_lote" value
 * @method decimal        getCantidad()       Returns the current record's "cantidad" value
 * @method decimal        getBonificados()    Returns the current record's "bonificados" value
 * @method decimal        getPrecio()         Returns the current record's "precio" value
 * @method decimal        getIva()            Returns the current record's "iva" value
 * @method decimal        getSubTotal()       Returns the current record's "sub_total" value
 * @method decimal        getTotal()          Returns the current record's "total" value
 * @method integer        getDetRemitoId()    Returns the current record's "det_remito_id" value
 * @method DetalleResumen getDetalleResumen() Returns the current record's "DetalleResumen" value
 * @method Resumen        getResumen()        Returns the current record's "Resumen" value
 * @method Cliente        getCliente()        Returns the current record's "Cliente" value
 * @method Producto       getProducto()       Returns the current record's "Producto" value
 * @method Zona           getZona()           Returns the current record's "Zona" value
 * @method Grupoprod      getGrupo()          Returns the current record's "Grupo" value
 * @method TipoFactura    getTipoFactura()    Returns the current record's "TipoFactura" value
 * @method ListadoVentas  setId()             Sets the current record's "id" value
 * @method ListadoVentas  setResumenId()      Sets the current record's "resumen_id" value
 * @method ListadoVentas  setTipofacturaId()  Sets the current record's "tipofactura_id" value
 * @method ListadoVentas  setFecha()          Sets the current record's "fecha" value
 * @method ListadoVentas  setClienteId()      Sets the current record's "cliente_id" value
 * @method ListadoVentas  setZonaId()         Sets the current record's "zona_id" value
 * @method ListadoVentas  setProductoId()     Sets the current record's "producto_id" value
 * @method ListadoVentas  setGrupoprodId()    Sets the current record's "grupoprod_id" value
 * @method ListadoVentas  setOrdenGrupo()     Sets the current record's "orden_grupo" value
 * @method ListadoVentas  setNombre()         Sets the current record's "nombre" value
 * @method ListadoVentas  setNroLote()        Sets the current record's "nro_lote" value
 * @method ListadoVentas  setCantidad()       Sets the current record's "cantidad" value
 * @method ListadoVentas  setBonificados()    Sets the current record's "bonificados" value
 * @method ListadoVentas  setPrecio()         Sets the current record's "precio" value
 * @method ListadoVentas  setIva()            Sets the current record's "iva" value
 * @method ListadoVentas  setSubTotal()       Sets the current record's "sub_total" value
 * @method ListadoVentas  setTotal()          Sets the current record's "total" value
 * @method ListadoVentas  setDetRemitoId()    Sets the current record's "det_remito_id" value
 * @method ListadoVentas  setDetalleResumen() Sets the current record's "DetalleResumen" value
 * @method ListadoVentas  setResumen()        Sets the current record's "Resumen" value
 * @method ListadoVentas  setCliente()        Sets the current record's "Cliente" value
 * @method ListadoVentas  setProducto()       Sets the current record's "Producto" value
 * @method ListadoVentas  setZona()           Sets the current record's "Zona" value
 * @method ListadoVentas  setGrupo()          Sets the current record's "Grupo" value
 * @method ListadoVentas  setTipoFactura()    Sets the current record's "TipoFactura" value
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseListadoVentas extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('listado_ventas');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('resumen_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('tipofactura_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('fecha', 'date', 25, array(
             'type' => 'date',
             'length' => 25,
             ));
        $this->hasColumn('cliente_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('zona_id', 'integer', 4, array(
             'type' => 'integer',
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
        $this->hasColumn('orden_grupo', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('nombre', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('nro_lote', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('cantidad', 'decimal', 10, array(
             'type' => 'decimal',
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('bonificados', 'decimal', 10, array(
             'type' => 'decimal',
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('precio', 'decimal', 10, array(
             'type' => 'decimal',
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('iva', 'decimal', 10, array(
             'type' => 'decimal',
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('sub_total', 'decimal', 10, array(
             'type' => 'decimal',
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('total', 'decimal', 10, array(
             'type' => 'decimal',
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('det_remito_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('DetalleResumen', array(
             'local' => 'id',
             'foreign' => 'id'));

        $this->hasOne('Resumen', array(
             'local' => 'resumen_id',
             'foreign' => 'id'));

        $this->hasOne('Cliente', array(
             'local' => 'cliente_id',
             'foreign' => 'id'));

        $this->hasOne('Producto', array(
             'local' => 'producto_id',
             'foreign' => 'id'));

        $this->hasOne('Zona', array(
             'local' => 'zona_id',
             'foreign' => 'id'));

        $this->hasOne('Grupoprod as Grupo', array(
             'local' => 'grupoprod_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('TipoFactura', array(
             'local' => 'tipofactura_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));
    }
}