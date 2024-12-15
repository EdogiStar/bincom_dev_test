<?php
	include 'classes/dbh.php';
  include 'classes/pollingUnit.php';
  include 'classes/pollingUnitView.php';
  include 'classes/pollingUnitContr.php';
  

  $msg = '';
	if (isset($_GET['error'])) {
		$error = $_GET['error'];
		$msg = '<div class="alert alert-danger" role="alert">'.$error.'</div>';
	}

	if (isset($_GET['success'])) {
		$success = $_GET['success'];
		$msg = '<div class="alert alert-success" role="alert">'.$success.'</div>';
	}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">

    <title>Add Polling Unit - Bincom Test</title>
  </head>
  <body>
<?php
  include('includes/header.php');
?>


<div class="m-5">
  <?php echo $msg; ?>

<h4>Add Polling Unit</h4>
<div>
    <div class="form-group">
        <label for="lga">Select LGA</label>
        <select class="m-2" name="lga" id="lga" onchange="getWardsInLga()">
            <option class="bg-primary text-white" value="">Select LGA</option>
            <?php 
                $pollingUnit = new PollingUnitView();
                $pollingUnit->getAllLga();
            ?>
        </select>
        <label for="ward">Select Ward</label>
        <select class="m-2" name="ward" id="ward" onchange="">
            <option class="bg-primary text-white" value="">Select Ward</option>
        </select><br>
        <!-- <div id="result"> -->
          <div class="row">
            <div class="col">
              <input type="text" class="m-2" name="polling_unit_name" id="polling_unit_name" placeholder="Enter Polling Unit Name">
              <input type="number" class="m-2" name="polling_unit_id" id="polling_unit_id" placeholder="Enter Polling Unit ID" >              
              <input type="text" class="m-2" name="polling_unit_number" id="polling_unit_number" placeholder="Enter Polling Unit Number" >  
              <input type="number" class="m-2" name="polling_unit_ward_id" id="polling_unit_ward_id" placeholder="Enter Polling Unit Ward ID" >
              <textarea class="m-2" rows="5" cols="50" name="polling_unit_description" id="polling_unit_description" placeholder="Enter Polling Unit Description" ></textarea>
            </div>
            <div class="col">
            <h6>Party Scores</h6>
              <?php 
                  $pollingUnit = new PollingUnitView();
                  $pollingUnit->getPartys();
              ?>
              <button type="submit" name="saveNewPollingUnitBtn" class="btn btn-secondary" onclick="saveNewPollingUnit()">Save</button>
              <div id="result"></div>
            </div>
          </div>
    </div>
</div>

</div>
</section>
<script>
    function saveNewPollingUnit(){
      var partyScoreArry = [];
      var partyNameArry = [];
      var polling_unit_id = document.getElementById("polling_unit_id").value;
      var polling_unit_ward_id = document.getElementById("polling_unit_ward_id").value;      
      var lga_id = document.getElementById("lga").value;
      var uniquewardid = document.getElementById("ward").value;
      var polling_unit_number = document.getElementById("polling_unit_number").value;      
      var polling_unit_name = document.getElementById("polling_unit_name").value;
      var polling_unit_description = document.getElementById("polling_unit_description").value;
                
      var party_names = document.getElementsByClassName("party_names");    
      var party_scores = document.getElementsByClassName("party_scores");
      // save party scores in array
      for (let index = 0; index < party_scores.length; index++) {
        partyScoreArry.push(party_scores[index].value);
      }
      // save party names in array
      for (let index = 0; index < party_names.length; index++) {
        partyNameArry.push(party_names[index].value);
      }
      // validation
      if(lga_id === '' || polling_unit_number === '' || partyNameArry === '' || partyScoreArry === '' || polling_unit_id === '' || polling_unit_ward_id === '' || uniquewardid === '' || polling_unit_number === '' || polling_unit_name === '' || polling_unit_description === ''){
        document.getElementById("result").innerHTML='<div class="alert alert-danger" role="alert">All fields are required</div>';
      }else{
        var dataString = 'partyScoreArry=' + partyScoreArry + '&partyNameArry=' + partyNameArry + '&polling_unit_id=' + polling_unit_id + '&polling_unit_ward_id=' + polling_unit_ward_id + '&lga_id=' + lga_id + '&uniquewardid=' + uniquewardid + '&polling_unit_number=' + polling_unit_number + '&polling_unit_name=' + polling_unit_name + '&polling_unit_description=' + polling_unit_description;
        $.ajax({
          type: "POST", crossDomain: true, cache: false,
          url: "save_new_polling_unit.php",
          dataType: 'text',
          data: dataString,
          catch: false,
          success: function(data) {
              document.getElementById("result").innerHTML='<div class="alert alert-success" role="alert">Polling Unit Created Successfully!</div>';
              location.reload();       
          }
        });
      }

}

function getWardsInLga(){
var lga_id = document.getElementById("lga").value;
// alert(lga_id);
var dataString = 'lga_id=' + lga_id;
$.ajax({
  type: "POST", crossDomain: true, cache: false,
  url: "get_ward.php",
  dataType: 'text',
  data: dataString,
  catch: false,
  success: function(data) {
    document.getElementById("ward").innerHTML=data;
  }
});
}
</script>

</div>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
  <?php include('includes/footer.php'); ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript" src="assets/js/jquery.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
  </body>
</html>