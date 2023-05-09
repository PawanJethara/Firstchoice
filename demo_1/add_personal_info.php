

<?php include("index.php"); ?>
<?php 
 include'connection.php';
 $error='';
 $email1="";
 $error1="";
 $Phone="";
 $phone="";
 $email="";
 if(isset($_POST['submit'])){
    $fname     = $_POST['fname'];
    $mname     = $_POST['mname'];
    $lname     = $_POST['lname'];
    $phone     = $_POST['phone']; 
    $email     = $_POST['email'];
    $dob     = $_POST['dob'];
    $gender     = $_POST['gender'];
        if(empty($fname)){
            $error="Please fill up the First Name ";
          }
          if(empty($lname)){
            $error1="Please fill up the Last Name ";
          }
          if(strlen($phone)<=9){
            $Phone="Number should be greather than 9 character";
          }
          if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $email1="Invalid Email Format ";
          }
        }
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
                            <div class="form-group">
                                <label for="name">First Name:</label>
                                <input id="name" class="form-control" name="fname" type="text" ><?php echo $error;?>
                            </div>
                            <div class="form-group">
                                <label for="name">Middle Name:</label>
                                <input id="name" class="form-control" name="mname" type="text">
                            </div>
                            <div class="form-group">
                                <label for="name">Last Name:</label>
                                <input id="name" class="form-control" name="lname" type="text"><?php echo $error1;?>
                            </div>
                            <div class="form-group">
                                <label for="name">Phone:</label>
                                <input id="name" class="form-control" name="phone" type="text"><?php echo $Phone;?>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" class="form-control" name="email" type="text"><?php echo $email1;?>
                            </div>
                            <div class="form-group">
                                <label for="password">DOB</label>
                                <input id="password" class="form-control" name="dob" type="text">
                            </div>
                            <div class="form-group">
                                <label for="name">Gender:</label>
                                <select name="gender">
                                    <option></option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                <!--  <input id="name" class="form-control" name="gender" type="text"> -->
                            </div>
                            <input class="btn btn-primary" type="submit" value="Submit" name="submit">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6 grid-margin stretch-card">
        </div>
    </div>

    <?php 
 include'connection.php'; 
 if(isset($_POST['submit'])){
     $fname     = $_POST['fname'];
     $mname     = $_POST['mname'];
     $lname     = $_POST['lname'];
     $phone     = $_POST['phone']; 
     $email     = $_POST['email'];
     $dob     = $_POST['dob'];
     $gender     = $_POST['gender'];
     
        $query = "INSERT INTO name (fname, mname, lname)
        VALUES ('$fname', '$mname', '$lname')";
        $data = mysqli_query($conn,$query);
        $n_id = mysqli_insert_id($conn);
    
        $query1 = "INSERT INTO studentd (n_id, phone, email,dob,gender,password)
        VALUES ($n_id,$phone, '$email', '$dob','$gender','$password')";

        $data1 = mysqli_query($conn,$query1);
        $s_id = mysqli_insert_id($conn);
        $_SESSION["person_id"] = $s_id;
        if($data1){
         $message = "Data inserted into database";
        header("Location: add_peronal_info.php");
        die();
       }
       else{
           $message = "Data are not inserted into database";    
     }
      }
?>
    <?php include("footer.php"); ?>

    