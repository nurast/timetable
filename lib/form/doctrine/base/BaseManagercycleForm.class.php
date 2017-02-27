<?php

/**
 * Managercycle form base class.
 *
 * @method Managercycle getObject() Returns the current form's model object
 *
 * @package    timetable
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseManagercycleForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'cycle_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CycleRef'), 'add_empty' => true)),
      'start'         => new sfWidgetFormDate(),
      'finish'        => new sfWidgetFormDate(),
      'students'      => new sfWidgetFormInputText(),
      'students_comm' => new sfWidgetFormInputText(),
      'five'          => new sfWidgetFormInputText(),
      'four'          => new sfWidgetFormInputText(),
      'three'         => new sfWidgetFormInputText(),
      'two'           => new sfWidgetFormInputText(),
      'notpassed'     => new sfWidgetFormInputText(),
      'budjet_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('BudgetRef'), 'add_empty' => true)),
      'month'         => new sfWidgetFormInputText(),
      'plan_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PlanRef'), 'add_empty' => true)),
      'manager_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TeacherRef'), 'add_empty' => true)),
      'joint1'        => new sfWidgetFormInputText(),
      'joint2'        => new sfWidgetFormInputText(),
      'place_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PlaceRef'), 'add_empty' => true)),
      'table_month'   => new sfWidgetFormInputText(),
      'satisfaction'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'cycle_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CycleRef'), 'required' => false)),
      'start'         => new sfValidatorDate(array('required' => false)),
      'finish'        => new sfValidatorDate(array('required' => false)),
      'students'      => new sfValidatorInteger(array('required' => false)),
      'students_comm' => new sfValidatorInteger(array('required' => false)),
      'five'          => new sfValidatorInteger(array('required' => false)),
      'four'          => new sfValidatorInteger(array('required' => false)),
      'three'         => new sfValidatorInteger(array('required' => false)),
      'two'           => new sfValidatorInteger(array('required' => false)),
      'notpassed'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'budjet_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('BudgetRef'), 'required' => false)),
      'month'         => new sfValidatorInteger(array('required' => false)),
      'plan_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PlanRef'), 'required' => false)),
      'manager_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TeacherRef'), 'required' => false)),
      'joint1'        => new sfValidatorInteger(array('required' => false)),
      'joint2'        => new sfValidatorInteger(array('required' => false)),
      'place_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PlaceRef'), 'required' => false)),
      'table_month'   => new sfValidatorInteger(array('required' => false)),
      'satisfaction'  => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('managercycle[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Managercycle';
  }

}
