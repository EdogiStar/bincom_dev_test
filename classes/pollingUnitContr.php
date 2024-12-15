<?php 

	/**
	 * 
	 */
	class PollingUnitContr extends PollingUnit
	{
		private $polling_unit_id;
		private $ward_id;
		private $lga_id;
		private $uniquewardid;
		private $polling_unit_number;
		private $polling_unit_name;
		private $polling_unit_description;
		
		public function __construct($polling_unit_id, $ward_id, $lga_id, $uniquewardid, $polling_unit_number, $polling_unit_name, $polling_unit_description)
		{
			$this->polling_unit_id = $polling_unit_id;
			$this->ward_id = $ward_id;
			$this->lga_id = $lga_id;
			$this->uniquewardid = $uniquewardid;
			$this->polling_unit_number = $polling_unit_number;
			$this->polling_unit_name = $polling_unit_name;
			$this->polling_unit_description = $polling_unit_description;
		}

		public function savePollingUnit($partyNameArry, $partyScoreArry){
			if ($this->emptyInputs() == false) {
				$error = 'All fields are required';
				header('location: ../q3.php?error='.$error);
				exit();
			}			
			// no errors save polling unit and retrieve its ID
			$result = $this->saveNewPollingUnit($this->polling_unit_id, $this->ward_id, $this->lga_id, $this->uniquewardid, $this->polling_unit_number, $this->polling_unit_name, $this->polling_unit_description);
			if ($result == true) {				
				// get last inserted polling unit ID
				$getLastIds = $this->getInsertedPollingUnit();
				foreach($getLastIds as $getLastId){
					$pollingUnitID = $getLastId['uniqueid'];
				}
				// iterate over partyNames and scores
				for($i = 0; $i < count($partyNameArry); $i++){
					for($j = 0; $j < count($partyScoreArry); $j++){
						if($i === $j){
							// save in announced_polling_result table
							$this->savePollingUnitResult($pollingUnitID, $partyNameArry[$i], $partyScoreArry[$j]);
						}
					}
				}
				return 1;
				// $success = 'Polling Unit Created';
				// header('location: ../q3.php?success='.$success);
				exit();
			}else{
				$error = 'Failed, try again';
				header('location: ../q3.php?error='.$error);
				exit();
			}
		}

		private function emptyInputs() {
			$result;
			if(empty($this->polling_unit_id) || empty($this->ward_id) || empty($this->lga_id) || empty($this->uniquewardid) || empty($this->polling_unit_number) || empty($this->polling_unit_name) || empty($this->polling_unit_description)){
				$result = false; 
			}else{
				$result = true;
			}
			return $result;
		}

		
	}