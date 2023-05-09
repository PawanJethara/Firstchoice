
<?php include("index.php"); ?>
<?php include("connection.php");
    $family_id =$_GET['id'];
    $sql = mysqli_query ($conn, "SELECT * from finformation where f_id=$family_id");
    ?>
<div class="page-content">
<div class="row">
					<div class="col-lg-12 grid-margin stretch-card">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Form Submittion</h4>
								<p class="card-description">This is the <a href="https://jqueryvalidation.org/" target="_blank">Family Information </a>of Students.</p>
								<form class="cmxform" id="signupForm" method="POST" action="#">
									<fieldset>
                                    <?php while($family = mysqli_fetch_array($sql)){?>
										<div class="form-group">
											<label for="name">Father Name:</label>
											<input id="name" class="form-control" name="fname" type="text" value="<?php echo $family['fathername'];?>">
										</div>
										<div class="form-group">
											<label for="name">Father Number:</label>
											<input id="name" class="form-control" name="fnumber" type="text" value="<?php echo $family['fathernumber'];?>">
										</div>
										<div class="form-group">
											<label for="name">Mother Name:</label>
											<input id="name" class="form-control" name="mname" type="text" value="<?php echo $family['mothername'];?>">
										</div>
										<div class="form-group">
											<label for="name">Mother Number:</label>
											<input id="name" class="form-control" name="mnumber" type="text" value="<?php echo $family['mothernumber'];?>">
										</div>
										<div class="form-group">
											<label for="email">Guardian Name:</label>
											<input id="email" class="form-control" name="gname" type="text" value="<?php echo $family['guardianname'];?>">
										</div>
										<div class="form-group">
											<label for="password">Guardian Number:</label>
											<input id="password" class="form-control" name="gnumber" type="text" value="<?php echo $family['guardiannumber'];?>">
										</div>
										<input class="btn btn-primary" type="submit" value="update" name="update">
									</fieldset>
								</form>
                                <?php }?>
							</div>
						</div>
					</div>
					<div class="col-lg-6 grid-margin stretch-card">
				</div>
</div>

<?php
if(isset($_POST['update'])){
$f_id = $_GET['id'];
$fname = $_POST['fname'];
$fnumber = $_POST['fnumber'];
$mname = $_POST['mname'];
$mnumber = $_POST['mnumber']; 
$gname = $_POST['gname'];
$gnumber = $_POST['gnumber'];	
 $result = mysqli_query($conn, "UPDATE finformation SET fathername='$fname', fathernumber='$fnumber', mothername='$mname', mothernumber='$mnumber', guardianname='$gname', guardiannumber='$gnumber' WHERE f_id=$family_id");
// header("Location: familytable.php");
}
?>
<?php include("footer.php"); ?>
 