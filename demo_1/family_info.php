
<?php include("index.php"); ?>
<div class="page-content">
<div class="row">
					<div class="col-lg-12 grid-margin stretch-card">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Form Submittion</h4>
								<p class="card-description">This is the <a href="https://jqueryvalidation.org/" target="_blank">Family Information </a>of Students.</p>
								<form class="cmxform" id="signupForm" method="POST" action="#">
									<fieldset>
										<div class="form-group">
											<label for="name">Father Name:</label>
											<input id="name" class="form-control" name="faname" type="text">
										</div>
										<div class="form-group">
											<label for="name">Father Number:</label>
											<input id="name" class="form-control" name="fnumber" type="text">
										</div>
										<div class="form-group">
											<label for="name">Mother Name:</label>
											<input id="name" class="form-control" name="moname" type="text">
										</div>
										<div class="form-group">
											<label for="name">Mother Number:</label>
											<input id="name" class="form-control" name="mnumber" type="text">
										</div>
										<div class="form-group">
											<label for="email">Guardian Name:</label>
											<input id="email" class="form-control" name="gname" type="text">
										</div>
										<div class="form-group">
											<label for="password">Guardian Number:</label>
											<input id="password" class="form-control" name="gnumber" type="text">
										</div>
										<input class="btn btn-primary" type="submit" value="Submit" name="submit">
									</fieldset>
								</form>
								<?php 
 include("connection.php");
if(isset($_POST['submit'])){
    $s_id = $_SESSION["person_id"];
	$faname      = $_POST['faname'];
    $fnumber     = $_POST['fnumber'];
    $moname      = $_POST['moname'];
    $mnumber     = $_POST['mnumber'];
    $gname       = $_POST['gname'];
    $gnumber     = $_POST['gnumber'];

    $query = "INSERT INTO finformation (fathername, fathernumber, mothername, mothernumber, guardianname, guardiannumber,s_id)
    VALUES ('$faname', '$fnumber', '$moname', '$mnumber', '$gname','$gnumber',$s_id)";
    $data3 = mysqli_query($conn,$query);

    if($data3){
      echo "Data inserted into database";
  }
  else{
      echo "Data are not inserted into database";	
  }
}
?>
							</div>
						</div>
					</div>
					<div class="col-lg-6 grid-margin stretch-card">
				</div>
</div>
<?php include("footer.php"); ?>
 