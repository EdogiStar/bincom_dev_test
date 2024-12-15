<?php
	
  include 'classes/dbh.php';
  include 'classes/pollingUnit.php';
  include 'classes/pollingUnitView.php';
  include 'classes/pollingUnitContr.php';
  
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/style.css">

    <title>LGA Summed Result - Bincom Test</title>
  </head>
  <body>
<?php
  include('includes/header.php');
?>

<div class="m-5">
<h4>LGA Summed Total Result</h4>

          <select name="lga" id="lga" onchange="showTotalPollingUnitResult()">
              <option class="bg-primary text-white" value="">Select LGA</option>
              <?php 
              $pollingUnit = new PollingUnitView();
                $pollingUnit->getAllLga();
                
              ?>
          </select>
          <div id="result">
            
          </div>
</div>

<script>
    function showTotalPollingUnitResult(){
        var lga_id = document.getElementById("lga").value;
        // alert(lga_id);
            var dataString = 'lga_id=' + lga_id;
            $.ajax({
              type: "POST", crossDomain: true, cache: false,
              url: "lga.php",
              dataType: 'text',
              data: dataString,
              catch: false,
              success: function(data) {
                document.getElementById("result").innerHTML=data;
              }
            });
    }
</script>

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