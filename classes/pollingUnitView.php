<?php 

	class PollingUnitView extends PollingUnit {
		
		public function getPartys() {
			$results = $this->getAllParty();
			foreach ($results as $result) {
				$party_id = $result['id'];
				$partyid = $result['partyid'];
				$partyname = $result['partyname'];
				
				echo '
					<input type="hidden" name="party_names" class="form-group m-2 party_names" value="'.$partyid.'" readonly="readonly">
					'.$partyid.': <input type="text" name="party_scores" class="form-group m-2 party_scores" placeholder="Enter Score" >
					';
				
			}
			
		}

		public function getWardByLga($lga_id) {
			$results = $this->getLgaWard($lga_id);
			foreach ($results as $result) {
				$ward_name = $result['ward_name'];
				$unique_ward_id = $result['uniqueid'];
				$ward_id = $result['ward_id'];
				
				echo '<option value='.$unique_ward_id.'>'.$ward_name.'</option>';
			}
		}

		// Q2
		public function getLgaPollingUnits($lga_id) {
			// get partys
			$partys = $this->getAllParty();
			foreach ($partys as $party) {
				$party_score_arr = []; // array to store party results
				$party_id = $party['id'];
				$partyid = $party['partyid'];
				$partyname = $party['partyname'];

				$results = $this->getPollingUnitsByLga($lga_id);
				foreach ($results as $result) {
					$polling_unit_name = $result['polling_unit_name'];
					$polling_unit_id = $result['uniqueid'];
					// echo '<h5>'.$polling_unit_name.'</h5>';
					//get polling units results by party
					$result2 = $this->getPollingUnitResultWithParty($polling_unit_id, $partyname);
					foreach ($result2 as $res) {
						$party_score = $res['party_score'];
						// echo $res['party_score'];
						// push party_score into party_score_array
						array_push($party_score_arr, $party_score);
					}
				}
				// add all party_score_array and print
				echo '<p>'. $partyname .': '.array_sum($party_score_arr) .'</p>';
				// clear all values of array 
				// to be empty before the next party
				unset($party_score_arr);
			}
		}

		public function getAllLga() {
			$results = $this->getlgas();
			foreach ($results as $result) {
				$lga_name = $result['lga_name'];
				$lga_id = $result['uniqueid'];
				
				echo '<option value='.$lga_id.'>'.$lga_name.'</option>';
			}
		}

		public function showTotalPollingUnitResult($lga_id) {
			$results = $this->getlgaById($lga_id);
			foreach ($results as $result) {
				$lga_name = $result['lga_name'];
				$lga_id = $result['uniqueid'];
				
				echo '<h3>LGA Name: '.$lga_name.'</h3>';
				//get polling units in lga
				$this->getLgaPollingUnits($lga_id);
			}
		}
		// Q1
		public function getPollingResult($polling_unit_id) {
			$results = $this->getPollingUnitResult($polling_unit_id);
			foreach ($results as $result) {
				$party_abbreviation = $result['party_abbreviation'];
				$party_score = $result['party_score'];

				echo '<h6>'.$party_abbreviation.': '.$party_score.'</h6>';
			}
		}

		public function showPollingUnitResult() {
			$results = $this->getPollingUnits();
			foreach ($results as $result) {
				$polling_unit_name = $result['polling_unit_name'];
				$polling_unit_id = $result['uniqueid'];

				echo '<h3>'.$polling_unit_name.'</h3>';
				$this->getPollingResult($polling_unit_id);
			}
		}


	}