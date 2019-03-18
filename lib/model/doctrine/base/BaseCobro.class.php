<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Cobro', 'doctrine');

/**
 * BaseCobro
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property date $fecha
 * @property integer $cliente_id
 * @property integer $resumen_id
 * @property integer $moneda_id
 * @property decimal $monto
 * @property integer $tipo_id
 * @property integer $banco_id
 * @property integer $numero
 * @property date $fecha_vto
 * @property integer $devprod_id
 * @property string $observacion
 * @property integer $usuario
 * @property integer $nro_recibo
 * @property Resumen $Resumen
 * @property Cliente $Cliente
 * @property TipoCobroPago $Tipo
 * @property TipoMoneda $Moneda
 * @property Banco $Banco
 * @property sfGuardUser $sfGuardUser
 * @property Doctrine_Collection $CobroResumen
 * 
 * @method integer             getId()           Returns the current record's "id" value
 * @method date                getFecha()        Returns the current record's "fecha" value
 * @method integer             getClienteId()    Returns the current record's "cliente_id" value
 * @method integer             getResumenId()    Returns the current record's "resumen_id" value
 * @method integer             getMonedaId()     Returns the current record's "moneda_id" value
 * @method decimal             getMonto()        Returns the current record's "monto" value
 * @method integer             getTipoId()       Returns the current record's "tipo_id" value
 * @method integer             getBancoId()      Returns the current record's "banco_id" value
 * @method integer             getNumero()       Returns the current record's "numero" value
 * @method date                getFechaVto()     Returns the current record's "fecha_vto" value
 * @method integer             getDevprodId()    Returns the current record's "devprod_id" value
 * @method string              getObservacion()  Returns the current record's "observacion" value
 * @method integer             getUsuario()      Returns the current record's "usuario" value
 * @method integer             getNroRecibo()    Returns the current record's "nro_recibo" value
 * @method Resumen             getResumen()      Returns the current record's "Resumen" value
 * @method Cliente             getCliente()      Returns the current record's "Cliente" value
 * @method TipoCobroPago       getTipo()         Returns the current record's "Tipo" value
 * @method TipoMoneda          getMoneda()       Returns the current record's "Moneda" value
 * @method Banco               getBanco()        Returns the current record's "Banco" value
 * @method sfGuardUser         getSfGuardUser()  Returns the current record's "sfGuardUser" value
 * @method Doctrine_Collection getCobroResumen() Returns the current record's "CobroResumen" collection
 * @method Cobro               setId()           Sets the current record's "id" value
 * @method Cobro               setFecha()        Sets the current record's "fecha" value
 * @method Cobro               setClienteId()    Sets the current record's "cliente_id" value
 * @method Cobro               setResumenId()    Sets the current record's "resumen_id" value
 * @method Cobro               setMonedaId()     Sets the current record's "moneda_id" value
 * @method Cobro               setMonto()        Sets the current record's "monto" value
 * @method Cobro               setTipoId()       Sets the current record's "tipo_id" value
 * @method Cobro               setBancoId()      Sets the current record's "banco_id" value
 * @method Cobro               setNumero()       Sets the current record's "numero" value
 * @method Cobro               setFechaVto()     Sets the current record's "fecha_vto" value
 * @method Cobro               setDevprodId()    Sets the current record's "devprod_id" value
 * @method Cobro               setObservacion()  Sets the current record's "observacion" value
 * @method Cobro               setUsuario()      Sets the current record's "usuario" value
 * @method Cobro               setNroRecibo()    Sets the current record's "nro_recibo" value
 * @method Cobro               setResumen()      Sets the current record's "Resumen" value
 * @method Cobro               setCliente()      Sets the current record's "Cliente" value
 * @method Cobro               setTipo()         Sets the current record's "Tipo" value
 * @method Cobro               setMoneda()       Sets the current record's "Moneda" value
 * @method Cobro               setBanco()        Sets the current record's "Banco" value
 * @method Cobro               setSfGuardUser()  Sets the current record's "sfGuardUser" value
 * @method Cobro               setCobroResumen() Sets the current record's "CobroResumen" collection
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCobro extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('cobro');
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
        $this->hasColumn('resumen_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('moneda_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 1,
             'length' => 4,
             ));
        $this->hasColumn('monto', 'decimal', 10, array(
             'type' => 'decimal',
             'notnull' => true,
             'default' => 1,
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('tipo_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('banco_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('numero', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('fecha_vto', 'date', 25, array(
             'type' => 'date',
             'length' => 25,
             ));
        $this->hasColumn('devprod_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('observacion', 'string', 200, array(
             'type' => 'string',
             'length' => 200,
             ));
        $this->hasColumn('usuario', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('nro_recibo', 'integer', 4, array(
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

        $this->hasOne('Cliente', array(
             'local' => 'cliente_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('TipoCobroPago as Tipo', array(
             'local' => 'tipo_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('TipoMoneda as Moneda', array(
             'local' => 'moneda_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('Banco', array(
             'local' => 'banco_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('sfGuardUser', array(
             'local' => 'usuario',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasMany('CobroResumen', array(
             'local' => 'id',
             'foreign' => 'cobro_id'));
    }
}