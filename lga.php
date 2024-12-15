<?php  
	include 'classes/dbh.php';
	include 'classes/pollingUnit.php';
	include 'classes/pollingUnitView.php';
	include 'classes/pollingUnitContr.php';
	
	$lga_id = $_REQUEST['lga_id'];
	$pollingUnit = new PollingUnitView();
    $pollingUnit->showTotalPollingUnitResult($lga_id);
    
?>