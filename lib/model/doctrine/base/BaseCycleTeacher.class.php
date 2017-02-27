<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('CycleTeacher', 'doctrine');

/**
 * BaseCycleTeacher
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $cycle_id
 * @property integer $teacher_id
 * @property integer $subject_id
 * @property integer $theory
 * @property integer $practice
 * @property integer $i_half
 * @property integer $ii_half
 * @property Cycle $Cycle
 * @property TeacherRef $TeacherRef
 * @property SubjectRef $SubjectRef
 * 
 * @method integer      getCycleId()    Returns the current record's "cycle_id" value
 * @method integer      getTeacherId()  Returns the current record's "teacher_id" value
 * @method integer      getSubjectId()  Returns the current record's "subject_id" value
 * @method integer      getTheory()     Returns the current record's "theory" value
 * @method integer      getPractice()   Returns the current record's "practice" value
 * @method integer      getIHalf()      Returns the current record's "i_half" value
 * @method integer      getIiHalf()     Returns the current record's "ii_half" value
 * @method Cycle        getCycle()      Returns the current record's "Cycle" value
 * @method TeacherRef   getTeacherRef() Returns the current record's "TeacherRef" value
 * @method SubjectRef   getSubjectRef() Returns the current record's "SubjectRef" value
 * @method CycleTeacher setCycleId()    Sets the current record's "cycle_id" value
 * @method CycleTeacher setTeacherId()  Sets the current record's "teacher_id" value
 * @method CycleTeacher setSubjectId()  Sets the current record's "subject_id" value
 * @method CycleTeacher setTheory()     Sets the current record's "theory" value
 * @method CycleTeacher setPractice()   Sets the current record's "practice" value
 * @method CycleTeacher setIHalf()      Sets the current record's "i_half" value
 * @method CycleTeacher setIiHalf()     Sets the current record's "ii_half" value
 * @method CycleTeacher setCycle()      Sets the current record's "Cycle" value
 * @method CycleTeacher setTeacherRef() Sets the current record's "TeacherRef" value
 * @method CycleTeacher setSubjectRef() Sets the current record's "SubjectRef" value
 * 
 * @package    timetable
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCycleTeacher extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('cycle_teacher');
        $this->hasColumn('cycle_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('teacher_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('subject_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('theory', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('practice', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('i_half', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('ii_half', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Cycle', array(
             'local' => 'cycle_id',
             'foreign' => 'id'));

        $this->hasOne('TeacherRef', array(
             'local' => 'teacher_id',
             'foreign' => 'id'));

        $this->hasOne('SubjectRef', array(
             'local' => 'subject_id',
             'foreign' => 'id'));
    }
}