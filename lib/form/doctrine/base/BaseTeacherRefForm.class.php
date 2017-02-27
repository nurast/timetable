<?php

/**
 * TeacherRef form base class.
 *
 * @method TeacherRef getObject() Returns the current form's model object
 *
 * @package    timetable
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTeacherRefForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'name'         => new sfWidgetFormInputText(),
      'staff_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('StaffRef'), 'add_empty' => false)),
      'series'       => new sfWidgetFormInputText(),
      'number'       => new sfWidgetFormInputText(),
      'givenby'      => new sfWidgetFormInputText(),
      'givenwhen'    => new sfWidgetFormDate(),
      'birthday'     => new sfWidgetFormDate(),
      'zipcode'      => new sfWidgetFormInputText(),
      'city'         => new sfWidgetFormInputText(),
      'street'       => new sfWidgetFormInputText(),
      'house'        => new sfWidgetFormInputText(),
      'flat'         => new sfWidgetFormInputText(),
      'zipcode2'     => new sfWidgetFormInputText(),
      'city2'        => new sfWidgetFormInputText(),
      'street2'      => new sfWidgetFormInputText(),
      'house2'       => new sfWidgetFormInputText(),
      'flat2'        => new sfWidgetFormInputText(),
      'tel'          => new sfWidgetFormInputText(),
      'snils'        => new sfWidgetFormInputText(),
      'inn'          => new sfWidgetFormInputText(),
      'education'    => new sfWidgetFormInputText(),
      'experience'   => new sfWidgetFormInputText(),
      'place'        => new sfWidgetFormInputText(),
      'category'     => new sfWidgetFormInputText(),
      'title'        => new sfWidgetFormInputText(),
      'to_delete'    => new sfWidgetFormInputText(),
      'agreement_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AgreementRef'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'         => new sfValidatorString(array('max_length' => 255)),
      'staff_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('StaffRef'), 'required' => false)),
      'series'       => new sfValidatorString(array('max_length' => 4, 'required' => false)),
      'number'       => new sfValidatorString(array('max_length' => 6, 'required' => false)),
      'givenby'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'givenwhen'    => new sfValidatorDate(array('required' => false)),
      'birthday'     => new sfValidatorDate(array('required' => false)),
      'zipcode'      => new sfValidatorString(array('max_length' => 6, 'required' => false)),
      'city'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'street'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'house'        => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'flat'         => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'zipcode2'     => new sfValidatorString(array('max_length' => 6, 'required' => false)),
      'city2'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'street2'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'house2'       => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'flat2'        => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'tel'          => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'snils'        => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'inn'          => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'education'    => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'experience'   => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'place'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'category'     => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'title'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'to_delete'    => new sfValidatorInteger(array('required' => false)),
      'agreement_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AgreementRef'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('teacher_ref[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TeacherRef';
  }

}
