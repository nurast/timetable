<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('TeacherRef', 'doctrine');

/**
 * BaseTeacherRef
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property integer $staff_id
 * @property string $series
 * @property string $number
 * @property string $givenby
 * @property date $givenwhen
 * @property date $birthday
 * @property string $zipcode
 * @property string $city
 * @property string $street
 * @property string $house
 * @property string $flat
 * @property string $zipcode2
 * @property string $city2
 * @property string $street2
 * @property string $house2
 * @property string $flat2
 * @property string $tel
 * @property string $snils
 * @property string $inn
 * @property string $education
 * @property string $experience
 * @property string $place
 * @property string $category
 * @property string $title
 * @property integer $to_delete
 * @property integer $agreement_id
 * @property AgreementRef $AgreementRef
 * @property StaffRef $StaffRef
 * @property Doctrine_Collection $Cycle
 * @property Doctrine_Collection $CycleTeacher
 * @property Doctrine_Collection $Managercycle
 * @property Doctrine_Collection $ManagercycleTeacher
 * @property Doctrine_Collection $TimetableCycleSubject
 * @property Doctrine_Collection $TimetableCycleAction
 * 
 * @method integer             getId()                    Returns the current record's "id" value
 * @method string              getName()                  Returns the current record's "name" value
 * @method integer             getStaffId()               Returns the current record's "staff_id" value
 * @method string              getSeries()                Returns the current record's "series" value
 * @method string              getNumber()                Returns the current record's "number" value
 * @method string              getGivenby()               Returns the current record's "givenby" value
 * @method date                getGivenwhen()             Returns the current record's "givenwhen" value
 * @method date                getBirthday()              Returns the current record's "birthday" value
 * @method string              getZipcode()               Returns the current record's "zipcode" value
 * @method string              getCity()                  Returns the current record's "city" value
 * @method string              getStreet()                Returns the current record's "street" value
 * @method string              getHouse()                 Returns the current record's "house" value
 * @method string              getFlat()                  Returns the current record's "flat" value
 * @method string              getZipcode2()              Returns the current record's "zipcode2" value
 * @method string              getCity2()                 Returns the current record's "city2" value
 * @method string              getStreet2()               Returns the current record's "street2" value
 * @method string              getHouse2()                Returns the current record's "house2" value
 * @method string              getFlat2()                 Returns the current record's "flat2" value
 * @method string              getTel()                   Returns the current record's "tel" value
 * @method string              getSnils()                 Returns the current record's "snils" value
 * @method string              getInn()                   Returns the current record's "inn" value
 * @method string              getEducation()             Returns the current record's "education" value
 * @method string              getExperience()            Returns the current record's "experience" value
 * @method string              getPlace()                 Returns the current record's "place" value
 * @method string              getCategory()              Returns the current record's "category" value
 * @method string              getTitle()                 Returns the current record's "title" value
 * @method integer             getToDelete()              Returns the current record's "to_delete" value
 * @method integer             getAgreementId()           Returns the current record's "agreement_id" value
 * @method AgreementRef        getAgreementRef()          Returns the current record's "AgreementRef" value
 * @method StaffRef            getStaffRef()              Returns the current record's "StaffRef" value
 * @method Doctrine_Collection getCycle()                 Returns the current record's "Cycle" collection
 * @method Doctrine_Collection getCycleTeacher()          Returns the current record's "CycleTeacher" collection
 * @method Doctrine_Collection getManagercycle()          Returns the current record's "Managercycle" collection
 * @method Doctrine_Collection getManagercycleTeacher()   Returns the current record's "ManagercycleTeacher" collection
 * @method Doctrine_Collection getTimetableCycleSubject() Returns the current record's "TimetableCycleSubject" collection
 * @method Doctrine_Collection getTimetableCycleAction()  Returns the current record's "TimetableCycleAction" collection
 * @method TeacherRef          setId()                    Sets the current record's "id" value
 * @method TeacherRef          setName()                  Sets the current record's "name" value
 * @method TeacherRef          setStaffId()               Sets the current record's "staff_id" value
 * @method TeacherRef          setSeries()                Sets the current record's "series" value
 * @method TeacherRef          setNumber()                Sets the current record's "number" value
 * @method TeacherRef          setGivenby()               Sets the current record's "givenby" value
 * @method TeacherRef          setGivenwhen()             Sets the current record's "givenwhen" value
 * @method TeacherRef          setBirthday()              Sets the current record's "birthday" value
 * @method TeacherRef          setZipcode()               Sets the current record's "zipcode" value
 * @method TeacherRef          setCity()                  Sets the current record's "city" value
 * @method TeacherRef          setStreet()                Sets the current record's "street" value
 * @method TeacherRef          setHouse()                 Sets the current record's "house" value
 * @method TeacherRef          setFlat()                  Sets the current record's "flat" value
 * @method TeacherRef          setZipcode2()              Sets the current record's "zipcode2" value
 * @method TeacherRef          setCity2()                 Sets the current record's "city2" value
 * @method TeacherRef          setStreet2()               Sets the current record's "street2" value
 * @method TeacherRef          setHouse2()                Sets the current record's "house2" value
 * @method TeacherRef          setFlat2()                 Sets the current record's "flat2" value
 * @method TeacherRef          setTel()                   Sets the current record's "tel" value
 * @method TeacherRef          setSnils()                 Sets the current record's "snils" value
 * @method TeacherRef          setInn()                   Sets the current record's "inn" value
 * @method TeacherRef          setEducation()             Sets the current record's "education" value
 * @method TeacherRef          setExperience()            Sets the current record's "experience" value
 * @method TeacherRef          setPlace()                 Sets the current record's "place" value
 * @method TeacherRef          setCategory()              Sets the current record's "category" value
 * @method TeacherRef          setTitle()                 Sets the current record's "title" value
 * @method TeacherRef          setToDelete()              Sets the current record's "to_delete" value
 * @method TeacherRef          setAgreementId()           Sets the current record's "agreement_id" value
 * @method TeacherRef          setAgreementRef()          Sets the current record's "AgreementRef" value
 * @method TeacherRef          setStaffRef()              Sets the current record's "StaffRef" value
 * @method TeacherRef          setCycle()                 Sets the current record's "Cycle" collection
 * @method TeacherRef          setCycleTeacher()          Sets the current record's "CycleTeacher" collection
 * @method TeacherRef          setManagercycle()          Sets the current record's "Managercycle" collection
 * @method TeacherRef          setManagercycleTeacher()   Sets the current record's "ManagercycleTeacher" collection
 * @method TeacherRef          setTimetableCycleSubject() Sets the current record's "TimetableCycleSubject" collection
 * @method TeacherRef          setTimetableCycleAction()  Sets the current record's "TimetableCycleAction" collection
 * 
 * @package    timetable
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTeacherRef extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('teacher_ref');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('staff_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('series', 'string', 4, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('number', 'string', 6, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 6,
             ));
        $this->hasColumn('givenby', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('givenwhen', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '1970-01-01',
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('birthday', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '1970-01-01',
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('zipcode', 'string', 6, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 6,
             ));
        $this->hasColumn('city', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('street', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('house', 'string', 25, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('flat', 'string', 25, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('zipcode2', 'string', 6, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 6,
             ));
        $this->hasColumn('city2', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('street2', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('house2', 'string', 25, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('flat2', 'string', 25, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('tel', 'string', 25, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('snils', 'string', 25, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('inn', 'string', 25, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('education', 'string', 25, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('experience', 'string', 25, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('place', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('category', 'string', 25, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('title', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('to_delete', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('agreement_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('AgreementRef', array(
             'local' => 'agreement_id',
             'foreign' => 'id'));

        $this->hasOne('StaffRef', array(
             'local' => 'staff_id',
             'foreign' => 'id'));

        $this->hasMany('Cycle', array(
             'local' => 'id',
             'foreign' => 'manager_id'));

        $this->hasMany('CycleTeacher', array(
             'local' => 'id',
             'foreign' => 'teacher_id'));

        $this->hasMany('Managercycle', array(
             'local' => 'id',
             'foreign' => 'manager_id'));

        $this->hasMany('ManagercycleTeacher', array(
             'local' => 'id',
             'foreign' => 'teacher_id'));

        $this->hasMany('TimetableCycleSubject', array(
             'local' => 'id',
             'foreign' => 'teacher_id'));

        $this->hasMany('TimetableCycleAction', array(
             'local' => 'id',
             'foreign' => 'teacher_id'));
    }
}