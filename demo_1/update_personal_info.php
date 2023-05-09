<?php include("index.php"); ?>
<?php include("connection.php");
    $student_id =$_GET['id'];
    $student_res = mysqli_query($conn, "SELECT studentd.*,name.fname,name.lname,name.mname FROM studentd join name on name.n_id = studentd.n_id  where studentd.s_id =$student_id");
?>
<div class="page-content">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Form Submittion</h4>
                    <p class="card-description">This is the <a href="https://jqueryvalidation.org/" target="_blank">
                            Personal Information </a>of Students.</p>
                    <form class="cmxform" id="signupForm" method="POST" action="#">
                        <fieldset>
                            <?php while($student = mysqli_fetch_array($student_res)){?>
                            <div class="form-group">
                                <label for="name">First Name:</label>
                                <input id="name" class="form-control" name="fname" type="text"
                                    value="<?php echo $student['fname'];?>">
                                <input type="hidden" name="n_id" value="<?php echo $student['n_id']?>">
                            </div>

                            <div class="form-group">
                                <label for="name">Middle Name:</label>
                                <input id="name" class="form-control" name="mname" type="text"
                                    value="<?php echo $student['mname'];?>">

                            </div>

                            <div class="form-group">
                                <label for="name">Last Name:</label>
                                <input id="name" class="form-control" name="lname" type="text"
                                    value="<?php echo $student['lname'];?>">
                            </div>

                            <div class="form-group">
                                <label for="name">Phone:</label>
                                <input id="name" class="form-control" name="phone" type="text"
                                    value="<?php echo $student['phone'];?>">
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" class="form-control" name="email" type="text"
                                    value="<?php echo $student['email'];?>">
                            </div>

                            <div class="form-group">
                                <label for="password">DOB</label>
                                <input id="password" class="form-control" name="dob" type="text"
                                    value="<?php echo $student['dob'];?>">
                            </div>

                            <div class="form-group">
                                <label for="name">Gender:</label>
                                <select name="gender">
                                    <option></option>
                                    <option <?php if($student['gender'] =="Male"){ echo 'selected';} ?>  value="Male">Male</option>
                                    <option <?php if($student['gender'] =="Female"){ echo 'selected';}?> value="Female">Female</option>
                                </select>
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
    ob_start();
if(isset($_POST['update'])){
$n_id = $_POST['n_id'];
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname =  $_POST['lname'];
$email =$_POST['email'];
$phone =$_POST['phone'];
$dob =$_POST['dob'];
$gender =$_POST['gender'];	
$result = mysqli_query($conn, "UPDATE studentd SET phone=$phone, email='$email', dob='$dob', gender='$gender' WHERE s_id=$student_id");
$result1 = mysqli_query($conn, "UPDATE name SET fname='$fname', mname='$mname', lname='$lname' WHERE n_id=$n_id");
// header("Location: address_info.php");
die();

}
?>