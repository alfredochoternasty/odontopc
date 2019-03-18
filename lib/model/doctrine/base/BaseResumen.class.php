<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Resumen', 'doctrine');

/**
 * BaseResumen
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property date $fecha
 * @property integer $tipo_venta_id
 * @property integer $cliente_id
 * @property integer $remito_id
 * @property integer $lista_id
 * @property integer $moneda_id
 * @property string $observacion
 * @property integer $pagado
 * @property integer $pedido_id
 * @property integer $nro_factura
 * @property integer $tipofactura_id
 * @property integer $usuario
 * @property integer $afip_estado
 * @property string $afip_mensaje
 * @property date $afip_vto_cae
 * @property string $pto_vta
 * @property string $afip_envio
 * @property string $afip_respuesta
 * @property Doctrine_Collection $Detalle
 * @property Doctrine_Collection $Remito
 * @property Cliente $Cliente
 * @property Venta $Venta
 * @property Doctrine_Collection $Cobros
 * @property ListaPrecio $Lista
 * @property TipoMoneda $Moneda
 * @property TipoVenta $TipoVenta
 * @property Pedido $Pedido
 * @property TipoFactura $TipoFactura
 * @property sfGuardUser $sfGuardUser
 * @property Resumen $Resumen
 * @property Doctrine_Collection $DevProducto
 * @property Doctrine_Collection $CobroResumen
 * @property Doctrine_Collection $FacturasAfip
 * 
 * @method integer             getId()             Returns the current record's "id" value
 * @method date                getFecha()          Returns the current record's "fecha" value
 * @method integer             getTipoVentaId()    Returns the current record's "tipo_venta_id" value
 * @method integer             getClienteId()      Returns the current record's "cliente_id" value
 * @method integer             getRemitoId()       Returns the current record's "remito_id" value
 * @method integer             getListaId()        Returns the current record's "lista_id" value
 * @method integer             getMonedaId()       Returns the current record's "moneda_id" value
 * @method string              getObservacion()    Returns the current record's "observacion" value
 * @method integer             getPagado()         Returns the current record's "pagado" value
 * @method integer             getPedidoId()       Returns the current record's "pedido_id" value
 * @method integer             getNroFactura()     Returns the current record's "nro_factura" value
 * @method integer             getTipofacturaId()  Returns the current record's "tipofactura_id" value
 * @method integer             getUsuario()        Returns the current record's "usuario" value
 * @method integer             getAfipEstado()     Returns the current record's "afip_estado" value
 * @method string              getAfipMensaje()    Returns the current record's "afip_mensaje" value
 * @method date                getAfipVtoCae()     Returns the current record's "afip_vto_cae" value
 * @method string              getPtoVta()         Returns the current record's "pto_vta" value
 * @method string              getAfipEnvio()      Returns the current record's "afip_envio" value
 * @method string              getAfipRespuesta()  Returns the current record's "afip_respuesta" value
 * @method Doctrine_Collection getDetalle()        Returns the current record's "Detalle" collection
 * @method Doctrine_Collection getRemito()         Returns the current record's "Remito" collection
 * @method Cliente             getCliente()        Returns the current record's "Cliente" value
 * @method Venta               getVenta()          Returns the current record's "Venta" value
 * @method Doctrine_Collection getCobros()         Returns the current record's "Cobros" collection
 * @method ListaPrecio         getLista()          Returns the current record's "Lista" value
 * @method TipoMoneda          getMoneda()         Returns the current record's "Moneda" value
 * @method TipoVenta           getTipoVenta()      Returns the current record's "TipoVenta" value
 * @method Pedido              getPedido()         Returns the current record's "Pedido" value
 * @method TipoFactura         getTipoFactura()    Returns the current record's "TipoFactura" value
 * @method sfGuardUser         getSfGuardUser()    Returns the current record's "sfGuardUser" value
 * @method Resumen             getResumen()        Returns the current record's "Resumen" value
 * @method Doctrine_Collection getDevProducto()    Returns the current record's "DevProducto" collection
 * @method Doctrine_Collection getCobroResumen()   Returns the current record's "CobroResumen" collection
 * @method Doctrine_Collection getFacturasAfip()   Returns the current record's "FacturasAfip" collection
 * @method Resumen             setId()             Sets the current record's "id" value
 * @method Resumen             setFecha()          Sets the current record's "fecha" value
 * @method Resumen             setTipoVentaId()    Sets the current record's "tipo_venta_id" value
 * @method Resumen             setClienteId()      Sets the current record's "cliente_id" value
 * @method Resumen             setRemitoId()       Sets the current record's "remito_id" value
 * @method Resumen             setListaId()        Sets the current record's "lista_id" value
 * @method Resumen             setMonedaId()       Sets the current record's "moneda_id" value
 * @method Resumen             setObservacion()    Sets the current record's "observacion" value
 * @method Resumen             setPagado()         Sets the current record's "pagado" value
 * @method Resumen             setPedidoId()       Sets the current record's "pedido_id" value
 * @method Resumen             setNroFactura()     Sets the current record's "nro_factura" value
 * @method Resumen             setTipofacturaId()  Sets the current record's "tipofactura_id" value
 * @method Resumen             setUsuario()        Sets the current record's "usuario" value
 * @method Resumen             setAfipEstado()     Sets the current record's "afip_estado" value
 * @method Resumen             setAfipMensaje()    Sets the current record's "afip_mensaje" value
 * @method Resumen             setAfipVtoCae()     Sets the current record's "afip_vto_cae" value
 * @method Resumen             setPtoVta()         Sets the current record's "pto_vta" value
 * @method Resumen             setAfipEnvio()      Sets the current record's "afip_envio" value
 * @method Resumen             setAfipRespuesta()  Sets the current record's "afip_respuesta" value
 * @method Resumen             setDetalle()        Sets the current record's "Detalle" collection
 * @method Resumen             setRemito()         Sets the current record's "Remito" collection
 * @method Resumen             setCliente()        Sets the current record's "Cliente" value
 * @method Resumen             setVenta()          Sets the current record's "Venta" value
 * @method Resumen             setCobros()         Sets the current record's "Cobros" collection
 * @method Resumen             setLista()          Sets the current record's "Lista" value
 * @method Resumen             setMoneda()         Sets the current record's "Moneda" value
 * @method Resumen             setTipoVenta()      Sets the current record's "TipoVenta" value
 * @method Resumen             setPedido()         Sets the current record's "Pedido" value
 * @method Resumen             setTipoFactura()    Sets the current record's "TipoFactura" value
 * @method Resumen             setSfGuardUser()    Sets the current record's "sfGuardUser" value
 * @method Resumen             setResumen()        Sets the current record's "Resumen" value
 * @method Resumen             setDevProducto()    Sets the current record's "DevProducto" collection
 * @method Resumen             setCobroResumen()   Sets the current record's "CobroResumen" collection
 * @method Resumen             setFacturasAfip()   Sets the current record's "FacturasAfip" collection
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseResumen extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('resumen');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('fecha', 'date', 25, array(
             'type' => 'date',
             'notnull' => true,
             'length' => 25,
             ));
        $this->hasColumn('tipo_venta_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('cliente_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('remito_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('lista_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('moneda_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('observacion', 'string', 200, array(
             'type' => 'string',
             'length' => 200,
             ));
        $this->hasColumn('pagado', 'integer', 1, array(
             'type' => 'integer',
             'length' => 1,
             ));
        $this->hasColumn('pedido_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('nro_factura', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('tipofactura_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('usuario', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('afip_estado', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('afip_mensaje', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('afip_vto_cae', 'date', 25, array(
             'type' => 'date',
             'length' => 25,
             ));
        $this->hasColumn('pto_vta', 'string', 4, array(
             'type' => 'string',
             'length' => 4,
             ));
        $this->hasColumn('afip_envio', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('afip_respuesta', 'string', null, array(
             'type' => 'string',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('DetalleResumen as Detalle', array(
             'local' => 'id',
             'foreign' => 'resumen_id'));

        $this->hasMany('Resumen as Remito', array(
             'local' => 'remito_id',
             'foreign' => 'id'));

        $this->hasOne('Cliente', array(
             'local' => 'cliente_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('Venta', array(
             'local' => 'id',
             'foreign' => 'resumen_id'));

        $this->hasMany('Cobro as Cobros', array(
             'local' => 'id',
             'foreign' => 'resumen_id'));

        $this->hasOne('ListaPrecio as Lista', array(
             'local' => 'lista_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('TipoMoneda as Moneda', array(
             'local' => 'moneda_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('TipoVenta', array(
             'local' => 'tipo_venta_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('Pedido', array(
             'local' => 'pedido_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('TipoFactura', array(
             'local' => 'tipofactura_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('sfGuardUser', array(
             'local' => 'usuario',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('Resumen', array(
             'local' => 'id',
             'foreign' => 'remito_id'));

        $this->hasMany('DevProducto', array(
             'local' => 'id',
             'foreign' => 'resumen_id'));

        $this->hasMany('CobroResumen', array(
             'local' => 'id',
             'foreign' => 'resumen_id'));

        $this->hasMany('FacturasAfip', array(
             'local' => 'id',
             'foreign' => 'id'));
    }
}