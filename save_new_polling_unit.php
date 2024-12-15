<?php  
	
	include 'classes/dbh.php';
	include 'classes/pollingUnit.php';
	include 'classes/pollingUnitView.php';
	include 'classes/pollingUnitContr.php';
	
	
	$partyScoreArry = $_REQUEST['partyScoreArry'];
	$partyNameArry = $_REQUEST['partyNameArry'];
	// string to array conversions
	$partyNameArry = explode(',', $partyNameArry);
	$partyScoreArry = explode(',', $partyScoreArry);
	
	$polling_unit_id = $_POST['polling_unit_id'];
    $ward_id = $_POST['polling_unit_ward_id'];
    $lga_id = $_POST['lga_id'];
	$uniquewardid = $_POST['uniquewardid'];
    $polling_unit_number = $_POST['polling_unit_number'];    
	$polling_unit_name = $_POST['polling_unit_name'];
	$polling_unit_description = $_POST['polling_unit_description'];
	
	if(empty($partyNameArry) || empty($partyScoreArry) || empty($polling_unit_id) || empty($ward_id) || empty($lga_id) || empty($uniquewardid) || empty($polling_unit_number) || empty($polling_unit_name) || empty($polling_unit_description)){
		return 0;
	}else{
		// controller call
		$pollingUnit = new PollingUnitContr($polling_unit_id, $ward_id, $lga_id, $uniquewardid, $polling_unit_number, $polling_unit_name, $polling_unit_description);
		$pollingUnit->savePollingUnit($partyNameArry, $partyScoreArry);
			
	}
	
?>