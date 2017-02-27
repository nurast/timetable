<?php

/**
 * CycleTeacher form base class.
 *
 * @method CycleTeacher getObject() Returns the current form's model object
 *
 * @package    timetable
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCycleTeacherForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'cycle_id'   => new sfWidgetFormInputHidden(),
      'teacher_id' => new sfWidgetFormInputHidden(),
      'subject_id' => new sfWidgetFormInputHidden(),
      'theory'     => new sfWidgetFormInputText(),
      'practice'   => new sfWidgetFormInputText(),
      'i_half'     => new sfWidgetFormInputText(),
      'ii_half'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'cycle_id'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('cycle_id')), 'empty_value' => $this->getObject()->get('cycle_id'), 'required' => false)),
      'teacher_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('teacher_id')), 'empty_value' => $this->getObject()->get('teacher_id'), 'required' => false)),
      'subject_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('subject_id')), 'empty_value' => $this->getObject()->get('subject_id'), 'required' => false)),
      'theory'     => new sfValidatorInteger(array('required' => false)),
      'practice'   => new sfValidatorInteger(array('required' => false)),
      'i_half'     => new sfValidatorInteger(array('required' => false)),
      'ii_half'    => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cycle_teacher[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CycleTeacher';
  }

}
