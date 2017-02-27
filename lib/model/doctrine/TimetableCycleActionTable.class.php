<?php

class TimetableCycleActionTable extends Doctrine_Table {

	public static function getInstance() {
		return Doctrine_Core::getTable('TimetableCycleAction');
	}

	public function getActions($iCycleId, $iTimetableId) {
		$aActions = $this->getActionsByTimetableId($iTimetableId);
		if (empty($aActions)) {
			$aTimetablesIds = $this->getTimetablesIds($iCycleId, $iTimetableId);
			if (empty($aTimetablesIds)) {
				$aActions = $this->getActionsByCycleId($iCycleId, $iTimetableId);
			} else {
				foreach ($aTimetablesIds as $aTimetableId) {
					$aActions = $this->getActionsByTimetableId($aTimetableId['id']);
					if (!empty($aActions)) {
						foreach ($aActions as $aAction) {
							$oAction = $this->getInstance()->findOneBy('id', $aAction['id']);
							if ($oAction) {
								$oActionCopy = $oAction->copy();
								$oActionCopy->timetable_id = $iTimetableId;
								$oActionCopy->save();
							}
						}
						$aActions = $this->getActionsByTimetableId($iTimetableId);
						break;
					}
				}
				if (empty($aActions)) {
					$aActions = $this->getActionsByCycleId($iCycleId, $iTimetableId);
				}
			}
		}
		return $aActions;
	}

	protected function getTimetablesIds($iCycleId, $iTimetableId) {
		return Doctrine_Query::create()
				->select('t.id')
				->from('Timetable t')
				->where('t.cycle_id = ?', $iCycleId)
				->andWhere('t.id != ?', $iTimetableId)
				->orderBy('t.id DESC')
				->fetchArray();
	}

	public function getContractions($iTimetableId) {
		$aEntityIds = TimetableActionItemTable::getInstance()
			->getEntityIdsUnique($iTimetableId);
		if (!empty($aEntityIds)) {
			return $this->createQuery('ca')
					->select('a.contraction AS subject_contraction, ca.teacher_contraction AS teacher_contraction,'
						. 'a.name AS subject_name, t.name AS teacher_name')
					->leftJoin('ca.TimetableAction a')
					->leftJoin('ca.TeacherRef t')
					->whereIn('ca.id', $aEntityIds)
					->orderBy('subject_contraction')
					->addOrderBy('teacher_contraction')
					->fetchArray();
		}
		return array();
	}

	protected function getActionsByTimetableId($iTimetableId) {
		return $this->createQuery('tca')
				->select('tca.id AS timetable_cycle_action_id, tca.action_id AS action_id, tca.teacher_id AS teacher_id, ar.name AS action_name, tr.name AS teacher_name, ar.contraction AS action_contraction, tca.teacher_contraction AS teacher_contraction')
				->leftJoin('tca.TimetableAction ar')
				->leftJoin('tca.TeacherRef tr')
				->where('tca.timetable_id = ?', $iTimetableId)
				->orderBy('action_id')
				->fetchArray();
	}

	protected function getTimetableId($iCycleId, $iTimetableId) {
		return Doctrine_Query::create()
				->select('MAX(t.id)')
				->from('Timetable t')
				->where('t.cycle_id = ?', $iCycleId)
				->andWhere('t.id != ?', $iTimetableId)
				->orderBy('t.id DESC')
				->fetchArray();
	}

	protected function getActionsByCycleId($iCycleId, $iTimetableId) {
		$aActions = $this->createQuery('tca')
			->select('tca.id AS timetable_cycle_action_id, tca.action_id AS action_id, tca.teacher_id AS teacher_id, ar.name AS action_name, tr.name AS teacher_name, ar.contraction AS action_contraction, tca.teacher_contraction AS teacher_contraction')
			->leftJoin('tca.TimetableAction ar')
			->leftJoin('tca.TeacherRef tr')
			->where('tca.cycle_id = ?', $iCycleId)
			->orderBy('action_id')
			->fetchArray();
		foreach ($aActions as $aAction) {
			$oAction = $this->getInstance()->findOneBy('id', $aAction['id']);
			if ($oAction) {
				$oActionCopy = $oAction->copy();
				$oActionCopy->timetable_id = $iTimetableId;
				$oActionCopy->save();
			}
		}
		return $this->getActionsByTimetableId($iTimetableId);
	}

}
