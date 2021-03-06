<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('CursoMailEnviado', 'doctrine');

/**
 * BaseCursoMailEnviado
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $curso_id
 * @property date $fecha
 * @property string $e_mail
 * @property string $lo_vio
 * @property string $se_inscribio
 * @property string $observacion
 * @property Curso $Curso
 * 
 * @method integer          getId()           Returns the current record's "id" value
 * @method integer          getCursoId()      Returns the current record's "curso_id" value
 * @method date             getFecha()        Returns the current record's "fecha" value
 * @method string           getEMail()        Returns the current record's "e_mail" value
 * @method string           getLoVio()        Returns the current record's "lo_vio" value
 * @method string           getSeInscribio()  Returns the current record's "se_inscribio" value
 * @method string           getObservacion()  Returns the current record's "observacion" value
 * @method Curso            getCurso()        Returns the current record's "Curso" value
 * @method CursoMailEnviado setId()           Sets the current record's "id" value
 * @method CursoMailEnviado setCursoId()      Sets the current record's "curso_id" value
 * @method CursoMailEnviado setFecha()        Sets the current record's "fecha" value
 * @method CursoMailEnviado setEMail()        Sets the current record's "e_mail" value
 * @method CursoMailEnviado setLoVio()        Sets the current record's "lo_vio" value
 * @method CursoMailEnviado setSeInscribio()  Sets the current record's "se_inscribio" value
 * @method CursoMailEnviado setObservacion()  Sets the current record's "observacion" value
 * @method CursoMailEnviado setCurso()        Sets the current record's "Curso" value
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCursoMailEnviado extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('curso_mail_enviado');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('curso_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('fecha', 'date', 25, array(
             'type' => 'date',
             'notnull' => true,
             'length' => 25,
             ));
        $this->hasColumn('e_mail', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             ));
        $this->hasColumn('lo_vio', 'string', 2, array(
             'type' => 'string',
             'length' => 2,
             ));
        $this->hasColumn('se_inscribio', 'string', 2, array(
             'type' => 'string',
             'length' => 2,
             ));
        $this->hasColumn('observacion', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Curso', array(
             'local' => 'curso_id',
             'foreign' => 'id'));
    }
}