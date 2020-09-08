<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Pedido', 'doctrine');

/**
 * BasePedido
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property date $fecha
 * @property integer $cliente_id
 * @property string $observacion
 * @property integer $vendido
 * @property date $fecha_venta
 * @property string $direccion_entrega
 * @property integer $forma_envio
 * @property integer $finalizado
 * @property integer $cliente_domicilio_id
 * @property integer $zona_id
 * @property integer $usuario_id
 * @property Doctrine_Collection $Detalle
 * @property Cliente $Cliente
 * @property Zona $Zona
 * @property Doctrine_Collection $Resumen
 * @property Doctrine_Collection $DetallePedidoOriginal
 * 
 * @method integer             getId()                    Returns the current record's "id" value
 * @method date                getFecha()                 Returns the current record's "fecha" value
 * @method integer             getClienteId()             Returns the current record's "cliente_id" value
 * @method string              getObservacion()           Returns the current record's "observacion" value
 * @method integer             getVendido()               Returns the current record's "vendido" value
 * @method date                getFechaVenta()            Returns the current record's "fecha_venta" value
 * @method string              getDireccionEntrega()      Returns the current record's "direccion_entrega" value
 * @method integer             getFormaEnvio()            Returns the current record's "forma_envio" value
 * @method integer             getFinalizado()            Returns the current record's "finalizado" value
 * @method integer             getClienteDomicilioId()    Returns the current record's "cliente_domicilio_id" value
 * @method integer             getZonaId()                Returns the current record's "zona_id" value
 * @method integer             getUsuarioId()             Returns the current record's "usuario_id" value
 * @method Doctrine_Collection getDetalle()               Returns the current record's "Detalle" collection
 * @method Cliente             getCliente()               Returns the current record's "Cliente" value
 * @method Zona                getZona()                  Returns the current record's "Zona" value
 * @method Doctrine_Collection getResumen()               Returns the current record's "Resumen" collection
 * @method Doctrine_Collection getDetallePedidoOriginal() Returns the current record's "DetallePedidoOriginal" collection
 * @method Pedido              setId()                    Sets the current record's "id" value
 * @method Pedido              setFecha()                 Sets the current record's "fecha" value
 * @method Pedido              setClienteId()             Sets the current record's "cliente_id" value
 * @method Pedido              setObservacion()           Sets the current record's "observacion" value
 * @method Pedido              setVendido()               Sets the current record's "vendido" value
 * @method Pedido              setFechaVenta()            Sets the current record's "fecha_venta" value
 * @method Pedido              setDireccionEntrega()      Sets the current record's "direccion_entrega" value
 * @method Pedido              setFormaEnvio()            Sets the current record's "forma_envio" value
 * @method Pedido              setFinalizado()            Sets the current record's "finalizado" value
 * @method Pedido              setClienteDomicilioId()    Sets the current record's "cliente_domicilio_id" value
 * @method Pedido              setZonaId()                Sets the current record's "zona_id" value
 * @method Pedido              setUsuarioId()             Sets the current record's "usuario_id" value
 * @method Pedido              setDetalle()               Sets the current record's "Detalle" collection
 * @method Pedido              setCliente()               Sets the current record's "Cliente" value
 * @method Pedido              setZona()                  Sets the current record's "Zona" value
 * @method Pedido              setResumen()               Sets the current record's "Resumen" collection
 * @method Pedido              setDetallePedidoOriginal() Sets the current record's "DetallePedidoOriginal" collection
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePedido extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('pedido');
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
        $this->hasColumn('cliente_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('observacion', 'string', 200, array(
             'type' => 'string',
             'length' => 200,
             ));
        $this->hasColumn('vendido', 'integer', 1, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             'length' => 1,
             ));
        $this->hasColumn('fecha_venta', 'date', 25, array(
             'type' => 'date',
             'notnull' => true,
             'length' => 25,
             ));
        $this->hasColumn('direccion_entrega', 'string', 200, array(
             'type' => 'string',
             'length' => 200,
             ));
        $this->hasColumn('forma_envio', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('finalizado', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('cliente_domicilio_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('zona_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('usuario_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('DetallePedido as Detalle', array(
             'local' => 'id',
             'foreign' => 'pedido_id'));

        $this->hasOne('Cliente', array(
             'local' => 'cliente_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('Zona', array(
             'local' => 'zona_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasMany('Resumen', array(
             'local' => 'id',
             'foreign' => 'pedido_id'));

        $this->hasMany('DetallePedidoOriginal', array(
             'local' => 'id',
             'foreign' => 'pedido_id'));
    }
}