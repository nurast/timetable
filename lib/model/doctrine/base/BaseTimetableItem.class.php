<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('TimetableItem', 'doctrine');

/**
 * BaseTimetableItem
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $timetable_id
 * @property integer $entity_id
 * @property integer $hour_count
 * @property date $date
 * @property boolean $is_lecture
 * @property integer $class
 * @property integer $brigade
 * @property integer $session
 * @property boolean $is_telecommunication
 * @property time $time_on
 * @property Timetable $Timetable
 * @property TimetableCycleSubject $TimetableCycleSubject
 * 
 * @method integer               getTimetableId()           Returns the current record's "timetable_id" value
 * @method integer               getEntityId()              Returns the current record's "entity_id" value
 * @method integer               getHourCount()             Returns the current record's "hour_count" value
 * @method date                  getDate()                  Returns the current record's "date" value
 * @method boolean               getIsLecture()             Returns the current record's "is_lecture" value
 * @method integer               getClass()                 Returns the current record's "class" value
 * @method integer               getBrigade()               Returns the current record's "brigade" value
 * @method integer               getSession()               Returns the current record's "session" value
 * @method boolean               getIsTelecommunication()   Returns the current record's "is_telecommunication" value
 * @method time                  getTimeOn()                Returns the current record's "time_on" value
 * @method Timetable             getTimetable()             Returns the current record's "Timetable" value
 * @method TimetableCycleSubject getTimetableCycleSubject() Returns the current record's "TimetableCycleSubject" value
 * @method TimetableItem         setTimetableId()           Sets the current record's "timetable_id" value
 * @method TimetableItem         setEntityId()              Sets the current record's "entity_id" value
 * @method TimetableItem         setHourCount()             Sets the current record's "hour_count" value
 * @method TimetableItem         setDate()                  Sets the current record's "date" value
 * @method TimetableItem         setIsLecture()             Sets the current record's "is_lecture" value
 * @method TimetableItem         setClass()                 Sets the current record's "class" value
 * @method TimetableItem         setBrigade()               Sets the current record's "brigade" value
 * @method TimetableItem         setSession()               Sets the current record's "session" value
 * @method TimetableItem         setIsTelecommunication()   Sets the current record's "is_telecommunication" value
 * @method TimetableItem         setTimeOn()                Sets the current record's "time_on" value
 * @method TimetableItem         setTimetable()             Sets the current record's "Timetable" value
 * @method TimetableItem         setTimetableCycleSubject() Sets the current record's "TimetableCycleSubject" value
 * 
 * @package    timetable
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTimetableItem extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('timetable_item');
        $this->hasColumn('timetable_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('entity_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('hour_count', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('date', 'date', null, array(
             'type' => 'date',
             'notnull' => true,
             ));
        $this->hasColumn('is_lecture', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => true,
             ));
        $this->hasColumn('class', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('brigade', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('session', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('is_telecommunication', 'boolean', null, array(
             'type' => 'boolean',
             'default' => 0,
             ));
        $this->hasColumn('time_on', 'time', null, array(
             'type' => 'time',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Timetable', array(
             'local' => 'timetable_id',
             'foreign' => 'id'));

        $this->hasOne('TimetableCycleSubject', array(
             'local' => 'entity_id',
             'foreign' => 'id'));
    }
}