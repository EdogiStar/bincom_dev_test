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
    <link rel="stylesheet" href="assets/css/style.css">

    <title>Polling Unit Result - Bincom Test</title>
  </head>
  <body>
<?php
  include('includes/header.php');
?>
<div class="m-5">
<h4>Polling Unit Result</h4>

<div class="card" style="width: 18rem;">
  <!-- <img src="data:image/jpeg;base64,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" class="card-img-top" alt="..."> -->
  <div class="card-body">
    <?php 
        $pollingUnit = new PollingUnitView();
        $pollingUnit->showPollingUnitResult();
    ?>
  </div>
</div>

</div>


<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
  <?php include('includes/footer.php'); ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>