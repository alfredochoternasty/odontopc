<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('PagoComision', 'doctrine');

/**
 * BasePagoComision
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property date $fecha
 * @property integer $revendedor_id
 * @property integer $moneda_id
 * @property decimal $monto
 * @property integer $tipo_id
 * @property integer $banco_id
 * @property string $referencia
 * @property date $fecha_vto
 * @property string $observacion
 * @property integer $nro_recibo
 * @property Cliente $Revendedor
 * @property TipoCobroPago $Tipo
 * @property TipoMoneda $Moneda
 * @property Banco $Banco
 * @property Resumen $Resumen
 * 
 * @method integer       getId()            Returns the current record's "id" value
 * @method date          getFecha()         Returns the current record's "fecha" value
 * @method integer       getRevendedorId()  Returns the current record's "revendedor_id" value
 * @method integer       getMonedaId()      Returns the current record's "moneda_id" value
 * @method decimal       getMonto()         Returns the current record's "monto" value
 * @method integer       getTipoId()        Returns the current record's "tipo_id" value
 * @method integer       getBancoId()       Returns the current record's "banco_id" value
 * @method string        getReferencia()    Returns the current record's "referencia" value
 * @method date          getFechaVto()      Returns the current record's "fecha_vto" value
 * @method string        getObservacion()   Returns the current record's "observacion" value
 * @method integer       getNroRecibo()     Returns the current record's "nro_recibo" value
 * @method Cliente       getRevendedor()    Returns the current record's "Revendedor" value
 * @method TipoCobroPago getTipo()          Returns the current record's "Tipo" value
 * @method TipoMoneda    getMoneda()        Returns the current record's "Moneda" value
 * @method Banco         getBanco()         Returns the current record's "Banco" value
 * @method Resumen       getResumen()       Returns the current record's "Resumen" value
 * @method PagoComision  setId()            Sets the current record's "id" value
 * @method PagoComision  setFecha()         Sets the current record's "fecha" value
 * @method PagoComision  setRevendedorId()  Sets the current record's "revendedor_id" value
 * @method PagoComision  setMonedaId()      Sets the current record's "moneda_id" value
 * @method PagoComision  setMonto()         Sets the current record's "monto" value
 * @method PagoComision  setTipoId()        Sets the current record's "tipo_id" value
 * @method PagoComision  setBancoId()       Sets the current record's "banco_id" value
 * @method PagoComision  setReferencia()    Sets the current record's "referencia" value
 * @method PagoComision  setFechaVto()      Sets the current record's "fecha_vto" value
 * @method PagoComision  setObservacion()   Sets the current record's "observacion" value
 * @method PagoComision  setNroRecibo()     Sets the current record's "nro_recibo" value
 * @method PagoComision  setRevendedor()    Sets the current record's "Revendedor" value
 * @method PagoComision  setTipo()          Sets the current record's "Tipo" value
 * @method PagoComision  setMoneda()        Sets the current record's "Moneda" value
 * @method PagoComision  setBanco()         Sets the current record's "Banco" value
 * @method PagoComision  setResumen()       Sets the current record's "Resumen" value
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePagoComision extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('pago_comision');
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
        $this->hasColumn('revendedor_id', 'integer', 4, array(
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
        $this->hasColumn('referencia', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('fecha_vto', 'date', 25, array(
             'type' => 'date',
             'length' => 25,
             ));
        $this->hasColumn('observacion', 'string', 200, array(
             'type' => 'string',
             'length' => 200,
             ));
        $this->hasColumn('nro_recibo', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Cliente as Revendedor', array(
             'local' => 'revendedor_id',
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

        $this->hasOne('Resumen', array(
             'local' => 'id',
             'foreign' => 'pago_comision_id'));
    }
}