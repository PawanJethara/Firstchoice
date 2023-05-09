<?php 
 include'connection.php';
 session_start();
 function generateRandomString($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}
 $error='';
 $email1="";
 $error1="";
 $Phone="";
 
 if(isset($_POST['submit'])){
     $fname     = $_POST['fname'];
     $mname     = $_POST['mname'];
     $lname     = $_POST['lname'];
     $phone     = $_POST['phone']; 
     $email     = $_POST['email'];
     $dob     = $_POST['dob'];
     $gender     = $_POST['gender'];
     $password =md5(generateRandomString());
     
    
      if(!empty($fname) && !empty($mname) && filter_var($email, FILTER_VALIDATE_EMAIL)){
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
           header("Location: index.php");
           die();
       }
       else{
           $message = "Data are not inserted into database";    
     }
      }else{
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
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Personal Information</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <div class="title">Personal Information</div>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="personal_detail_form" method="POST">
        <div class="form-group">
            <label>First Name:</label>
            <input type="text" placeholder="Enter first name" name="fname"><?php echo $error;?> 
        </div>
        <div class="form-group">
            <label>Midddle Name:</label>
            <input type="text" placeholder="Enter middle name" name="mname">
        </div>
        <div class="form-group">
            <label>Last Name:</label>
            <input type="text" placeholder="Enter Last Name" name="lname"><?php echo $error1;?>
        </div>
        <div class="form-group">
            <label>Phone:</label>
            <input type="text" placeholder="Enter phone number" name="phone"><?php echo $Phone;?>
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="text" placeholder="Enter Email" name="email"><?php echo $email1;?>
        </div> 
        <div class="form-group">
            <label>DOB:</label>
            <input type="date" placeholder="Enter date of borth" name="dob">
        </div>
        <div class="form-group">
            <label>Gender:</label>
            <select name="gender">
                <option></option>
                <option>Male</option>
                <option>Female</option>
            </select>
            <!-- <input type="text" placeholder="Enter your gender" name="gender"> -->
            <!-- <?php echo $message;?>  -->
        </div>
     <!--    <div class="button">
            <input type="submit" name="submit">
        </div> -->
        <div class="button1">
            <button type="submit" name="submit">Next</button>
        </div>
    </form>
</div>
</body>

</html>
