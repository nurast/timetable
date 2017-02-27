<?php

/**
 * CycleRef form base class.
 *
 * @method CycleRef getObject() Returns the current form's model object
 *
 * @package    timetable
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCycleRefForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'name'           => new sfWidgetFormInputText(),
      'instruction_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('InstructionRef'), 'add_empty' => false)),
      'course_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CourseRef'), 'add_empty' => false)),
      'duration'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'           => new sfValidatorString(array('max_length' => 255)),
      'instruction_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('InstructionRef'))),
      'course_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CourseRef'), 'required' => false)),
      'duration'       => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cycle_ref[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CycleRef';
  }

}
