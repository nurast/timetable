<?php

/**
 * TeacherRefTable
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class TeacherRefTable extends Doctrine_Table {

	/**
	 * Returns an instance of this class.
	 *
	 * @return object TeacherRefTable
	 */
	public static function getInstance() {
		return Doctrine_Core::getTable('TeacherRef');
	}

	public function getSelect() {
		return $this->createQuery('tr')
				->select('tr.id, tr.name')
				->where('tr.to_delete = 0')
				->andWhere('tr.name != ""')
				->orderBy('tr.name')
				->fetchArray();
	}

	public function getContraction($iTeacherId, $iTimetableId) {
		$sContraction = null;
		$iNumber = 1;

		$aContractions = TimetableCycleSubjectTable::getInstance()
			->findBy('timetable_id', $iTimetableId);

		foreach ($aContractions as $oContraction) {

			if ($oContraction->teacher_id == $iTeacherId) {
				$sContraction = $oContraction->teacher_contraction;
				break;
			} else {
				$iCurrentNumber = ltrim($oContraction->teacher_contraction, " \t\n\r\0\x0B№");

				if ($iCurrentNumber > $iNumber) {
					$iNumber = $iCurrentNumber;
				}
			}
		}

		if (isset($sContraction)) {
			return $sContraction;
		} else {
			$iNumber++;
			return '№' . $iNumber;
		}
	}

}
