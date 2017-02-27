<?php

/**
 * Cycle form base class.
 *
 * @method Cycle getObject() Returns the current form's model object
 *
 * @package    timetable
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCycleForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'cycle_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CycleRef'), 'add_empty' => false)),
      'place_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PlaceRef'), 'add_empty' => false)),
      'brigade'      => new sfWidgetFormInputText(),
      'manager_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TeacherRef'), 'add_empty' => false)),
      'brigade_est'  => new sfWidgetFormInputText(),
      'brigade_est2' => new sfWidgetFormInputText(),
      'group_est'    => new sfWidgetFormInputText(),
      'group_est2'   => new sfWidgetFormInputText(),
      'budget_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('BudgetRef'), 'add_empty' => true)),
      'staff_est'    => new sfWidgetFormInputText(),
      'staff_est2'   => new sfWidgetFormInputText(),
      'all_est'      => new sfWidgetFormInputText(),
      'all_est2'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'cycle_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CycleRef'))),
      'place_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PlaceRef'), 'required' => false)),
      'brigade'      => new sfValidatorInteger(array('required' => false)),
      'manager_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TeacherRef'), 'required' => false)),
      'brigade_est'  => new sfValidatorInteger(array('required' => false)),
      'brigade_est2' => new sfValidatorInteger(array('required' => false)),
      'group_est'    => new sfValidatorInteger(array('required' => false)),
      'group_est2'   => new sfValidatorInteger(array('required' => false)),
      'budget_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('BudgetRef'), 'required' => false)),
      'staff_est'    => new sfValidatorInteger(array('required' => false)),
      'staff_est2'   => new sfValidatorInteger(array('required' => false)),
      'all_est'      => new sfValidatorInteger(array('required' => false)),
      'all_est2'     => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cycle[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Cycle';
  }

}
