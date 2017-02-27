<?php

class TimetableCycleSubjectTable extends Doctrine_Table {

	public static function getInstance() {
		return Doctrine_Core::getTable('TimetableCycleSubject');
	}

	public function getSubjectsCountByCycleId($iCycleId) {
		return $this->createQuery()
				->select('COUNT(id)')
				->where('cycle_id = ?', $iCycleId)
				->fetchOne(array(), Doctrine_Core::HYDRATE_SINGLE_SCALAR);
	}

	public function getSubjects($iCycleId, $iTimetableId) {
		$aSubjects = $this->getSubjectsByTimetableId($iTimetableId);

		if (empty($aSubjects)) {
			$aTimetablesIds = $this->getTimetablesIds($iCycleId, $iTimetableId);

			if (empty($aTimetablesIds)) {
				$aSubjects = $this->getSubjectsByCycleId($iCycleId, $iTimetableId);
			} else {
				foreach ($aTimetablesIds as $aTimetableId) {
					$aSubjects = $this->getSubjectsByTimetableId($aTimetableId['id']);

					if (!empty($aSubjects)) {
						$aTeacherContraction = array();
						$iNumber = 1;

						foreach ($aSubjects as $aSubject) {
							$oSubject = $this->getInstance()->findOneBy('id', $aSubject['id']);

							if ($oSubject) {
								$oSubjectCopy = $oSubject->copy();
								$oSubjectCopy->timetable_id = $iTimetableId;

								$iKey = array_search($oSubjectCopy->teacher_id, $aTeacherContraction);
								if (!$iKey) {//если текущему преподу не был присвоен номер ранее
									$oSubjectCopy->teacher_contraction = '№' . $iNumber;
									$aTeacherContraction[$iNumber] = $oSubjectCopy->teacher_id;
									$iNumber++;
								} else {
									$oSubjectCopy->teacher_contraction = '№' . $iKey;
								}

								$oSubjectCopy->save();
							}
						}
						$aSubjects = $this->getSubjectsByTimetableId($iTimetableId);
						break;
					}
				}
				if (empty($aSubjects)) {
					$aSubjects = $this->getSubjectsByCycleId($iCycleId, $iTimetableId);
				}
			}
		}
		return $aSubjects;
	}

	public function getSubjectsByCycleId($iCycleId, $iTimetableId) {
		$aSubjects = $this->createQuery('tcs')
			->select('tcs.id AS id, tcs.subject_name AS subject_name, tr.id AS teacher_id, tr.name AS teacher_name, tcs.subject_contraction AS subject_contraction, tcs.teacher_contraction AS teacher_contraction')
			->leftJoin('tcs.TeacherRef tr')
			->where('tcs.cycle_id = ?', $iCycleId)
			->orderBy('subject_name')
			->fetchArray();

		$aTeacherContraction = array();
		$iNumber = 1;

		foreach ($aSubjects as $aSubject) {
			$oSubject = $this->getInstance()->findOneBy('id', $aSubject['id']);

			if ($oSubject) {
				$oSubjectCopy = $oSubject->copy();
				$oSubjectCopy->timetable_id = $iTimetableId;

				$iKey = array_search($oSubjectCopy->teacher_id, $aTeacherContraction);
				if (!$iKey) {//если текущему преподу не был присвоен номер ранее
					$oSubjectCopy->teacher_contraction = '№' . $iNumber;
					$aTeacherContraction[$iNumber] = $oSubjectCopy->teacher_id;
					$iNumber++;
				} else {
					$oSubjectCopy->teacher_contraction = '№' . $iKey;
				}

				$oSubjectCopy->save();
			}
		}

		return $this->getSubjectsByTimetableId($iTimetableId);
	}

	protected function getSubjectsByTimetableId($iTimetableId) {
		return $this->createQuery('tcs')
				->select('tcs.id AS id, tcs.subject_name AS subject_name, tr.id AS teacher_id, tr.name AS teacher_name, tcs.subject_contraction AS subject_contraction, tcs.teacher_contraction AS teacher_contraction')
				->leftJoin('tcs.TeacherRef tr')
				->where('tcs.timetable_id = ?', $iTimetableId)
				->orderBy('subject_name')
				->fetchArray();
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
		$aEntityIds = TimetableItemTable::getInstance()
			->getEntityIdsUnique($iTimetableId);
		if (!empty($aEntityIds)) {
			return $this->createQuery('cs')
					->select('cs.subject_contraction AS subject_contraction, cs.teacher_contraction AS teacher_contraction,'
						. 'cs.subject_name AS subject_name, t.name AS teacher_name')
					->leftJoin('cs.TeacherRef t')
					->whereIn('cs.id', $aEntityIds)
					->orderBy('subject_contraction')
					->addOrderBy('teacher_contraction')
					->fetchArray();
		}
		return array();
	}

}
