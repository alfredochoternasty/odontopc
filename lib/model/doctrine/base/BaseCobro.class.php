<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Cobro', 'doctrine');

/**
 * BaseCobro
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $concepto
 * @property integer $numero
 * @property date $fecha
 * @property integer $cliente_id
 * @property integer $moneda_id
 * @property decimal $debe
 * @property decimal $haber
 * @property string $observacion
 * @property Cliente $Cliente
 * @property TipoMoneda $Moneda
 * @property Banco $Banco
 * @property TipoCobroPago $TipoCobroPago
 * @property Resumen $Resumen
 * @property Doctrine_Collection $CobroResumen
 * 
 * @method integer             getId()            Returns the current record's "id" value
 * @method string              getConcepto()      Returns the current record's "concepto" value
 * @method integer             getNumero()        Returns the current record's "numero" value
 * @method date                getFecha()         Returns the current record's "fecha" value
 * @method integer             getClienteId()     Returns the current record's "cliente_id" value
 * @method integer             getMonedaId()      Returns the current record's "moneda_id" value
 * @method decimal             getDebe()          Returns the current record's "debe" value
 * @method decimal             getHaber()         Returns the current record's "haber" value
 * @method string              getObservacion()   Returns the current record's "observacion" value
 * @method Cliente             getCliente()       Returns the current record's "Cliente" value
 * @method TipoMoneda          getMoneda()        Returns the current record's "Moneda" value
 * @method Banco               getBanco()         Returns the current record's "Banco" value
 * @method TipoCobroPago       getTipoCobroPago() Returns the current record's "TipoCobroPago" value
 * @method Resumen             getResumen()       Returns the current record's "Resumen" value
 * @method Doctrine_Collection getCobroResumen()  Returns the current record's "CobroResumen" collection
 * @method Cobro               setId()            Sets the current record's "id" value
 * @method Cobro               setConcepto()      Sets the current record's "concepto" value
 * @method Cobro               setNumero()        Sets the current record's "numero" value
 * @method Cobro               setFecha()         Sets the current record's "fecha" value
 * @method Cobro               setClienteId()     Sets the current record's "cliente_id" value
 * @method Cobro               setMonedaId()      Sets the current record's "moneda_id" value
 * @method Cobro               setDebe()          Sets the current record's "debe" value
 * @method Cobro               setHaber()         Sets the current record's "haber" value
 * @method Cobro               setObservacion()   Sets the current record's "observacion" value
 * @method Cobro               setCliente()       Sets the current record's "Cliente" value
 * @method Cobro               setMoneda()        Sets the current record's "Moneda" value
 * @method Cobro               setBanco()         Sets the current record's "Banco" value
 * @method Cobro               setTipoCobroPago() Sets the current record's "TipoCobroPago" value
 * @method Cobro               setResumen()       Sets the current record's "Resumen" value
 * @method Cobro               setCobroResumen()  Sets the current record's "CobroResumen" collection
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
        $this->setTableName('cta_cte');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('concepto', 'string', 200, array(
             'type' => 'string',
             'length' => 200,
             ));
        $this->hasColumn('numero', 'integer', 4, array(
             'type' => 'integer',
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
        $this->hasColumn('moneda_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('debe', 'decimal', 10, array(
             'type' => 'decimal',
             'notnull' => true,
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('haber', 'decimal', 10, array(
             'type' => 'decimal',
             'notnull' => true,
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('observacion', 'string', 200, array(
             'type' => 'string',
             'length' => 200,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Cliente', array(
             'local' => 'cliente_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('TipoMoneda as Moneda', array(
             'local' => 'moneda_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('Banco', array(
             'local' => 'banco_id',
             'foreign' => 'id'));

        $this->hasOne('TipoCobroPago', array(
             'local' => 'tipo_id',
             'foreign' => 'id'));

        $this->hasOne('Resumen', array(
             'local' => 'resumen_id',
             'foreign' => 'id'));

        $this->hasMany('CobroResumen', array(
             'local' => 'id',
             'foreign' => 'cobro_id'));
    }
}