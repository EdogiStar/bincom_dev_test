<?php 

	/**
	 * 
	 */
	class PollingUnit extends Dbh
	{
		protected function savePollingUnitResult($polling_unit_uniqueid, $party_abbreviation, $party_score) {
			$sql = 'INSERT INTO announced_pu_results(polling_unit_uniqueid, party_abbreviation, party_score, entered_by_user) VALUES(?, ?, ?, ?)';
			$stmt = $this->connect()->prepare($sql);
			$status = $stmt->execute([$polling_unit_uniqueid, $party_abbreviation, $party_score, 'MuqsitX']);
			$result;
			if ($status) {
				$result = true;
			}else{
				$result = false;
			}
			return $result;
		}

		protected function getInsertedPollingUnit() {
			$sql = 'SELECT * FROM polling_unit ORDER BY uniqueid DESC LIMIT 1';
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([]);
			$result = $stmt->fetchAll();
			return $result;
		}

		protected function saveNewPollingUnit($polling_unit_id, $ward_id, $lga_id, $uniquewardid, $polling_unit_number, $polling_unit_name, $polling_unit_description) {
			$sql = 'INSERT INTO polling_unit(polling_unit_id, ward_id, lga_id, uniquewardid, polling_unit_number, polling_unit_name, polling_unit_description) VALUES(?, ?, ?, ?, ?, ?, ?)';
			$stmt = $this->connect()->prepare($sql);
			$status = $stmt->execute([$polling_unit_id, $ward_id, $lga_id, $uniquewardid, $polling_unit_number, $polling_unit_name, $polling_unit_description]);
			$result;
			if ($status) {
				$result = true;
			}else{
				$result = false;
			}
			return $result;
		}
		
		protected function getAllParty() {
			$sql = 'SELECT * FROM party';
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([]);
			$result = $stmt->fetchAll();
			return $result;
		}

		protected function getPollingUnitsByLga($lga_id) {
			$sql = 'SELECT * FROM polling_unit WHERE lga_id = ?';
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([$lga_id]);
			$result = $stmt->fetchAll();
			return $result;
		}

		protected function getlgas() {
			$sql = 'SELECT * FROM lga';
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([]);
			$result = $stmt->fetchAll();
			return $result;
		}
		
		protected function getLgaWard($lga_id) {
			$sql = 'SELECT * FROM ward WHERE lga_id = ?';
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([$lga_id]);
			$result = $stmt->fetchAll();
			return $result;
		}

		protected function getlgaById($lga_id) {
			$sql = 'SELECT * FROM lga WHERE uniqueid = ?';
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([$lga_id]);
			$result = $stmt->fetchAll();
			return $result;
		}

		protected function getPollingUnitResultWithParty($polling_unit_id, $partyname) {
			$sql = 'SELECT * FROM announced_pu_results WHERE polling_unit_uniqueid = ? AND party_abbreviation = ?';
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([$polling_unit_id, $partyname]);
			$result = $stmt->fetchAll();
			return $result;
		}
		
		protected function getPollingUnitResult($polling_unit_id) {
			$sql = 'SELECT * FROM announced_pu_results WHERE polling_unit_uniqueid = ?';
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([$polling_unit_id]);
			$result = $stmt->fetchAll();
			return $result;
		}
		protected function getPollingUnits() {
			$sql = 'SELECT * FROM polling_unit LIMIT 1';
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([]);
			$result = $stmt->fetchAll();
			return $result;
		}

	}