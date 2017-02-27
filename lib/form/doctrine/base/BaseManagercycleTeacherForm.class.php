<?php

/**
 * ManagercycleTeacher form base class.
 *
 * @method ManagercycleTeacher getObject() Returns the current form's model object
 *
 * @package    timetable
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseManagercycleTeacherForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'managercycle_id' => new sfWidgetFormInputHidden(),
      'teacher_id'      => new sfWidgetFormInputHidden(),
      'budget_theory'   => new sfWidgetFormInputText(),
      'budget_practice' => new sfWidgetFormInputText(),
      'com_theory'      => new sfWidgetFormInputText(),
      'com_practice'    => new sfWidgetFormInputText(),
      'budget_telecom'  => new sfWidgetFormInputText(),
      'com_telecom'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'managercycle_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('managercycle_id')), 'empty_value' => $this->getObject()->get('managercycle_id'), 'required' => false)),
      'teacher_id'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('teacher_id')), 'empty_value' => $this->getObject()->get('teacher_id'), 'required' => false)),
      'budget_theory'   => new sfValidatorInteger(array('required' => false)),
      'budget_practice' => new sfValidatorInteger(array('required' => false)),
      'com_theory'      => new sfValidatorInteger(array('required' => false)),
      'com_practice'    => new sfValidatorInteger(array('required' => false)),
      'budget_telecom'  => new sfValidatorInteger(array('required' => false)),
      'com_telecom'     => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('managercycle_teacher[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ManagercycleTeacher';
  }

}
