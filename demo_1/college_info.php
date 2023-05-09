<?php include("index.php"); ?>
<?php  include("connection.php");
$class_res = mysqli_query($conn, "SELECT * FROM class");
$batch_res = mysqli_query($conn, "SELECT * FROM batch");
$subject_res = mysqli_query($conn, "SELECT * FROM subject");  
?>
<script>
    function MyForm() {
        let w = document.forms["myForm"]["cname"].value;
        let x = document.forms["myForm"]["batch"].value;
        let y = document.forms["myForm"]["class"].value;
        let z = document.forms["myForm"]["subject"].value;
        let m = document.forms["myForm"]["rollno"].value;

        if (w == "") {
            alert("Where is the college name");
            return false;
        }
        if (x == "") {
            alert("Your batch field is empty");
            return false;
        }
        if (y == "") {
            alert("Class field is necessary to fill");
            return false;
        }
        if (z == "") {
            alert("Which Subject you want to choose");
            return false;
        }
        if (m == "") {
            alert("Rollno is necessary field");
            return false;
        }

    }
    </script>

<div class="page-content">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Form Submittion</h4>
                    <p class="card-description">This is the <a href="https://jqueryvalidation.org/"
                            target="_blank">College Information </a>of Students.</p>
                    <form class="cmxform" id="signupForm" method="POST" action="#" onsubmit="return MyForm()" name='myForm' >
                        <fieldset>
                            <div class="form-group">
                                <label for="name">College Name:</label>
                                <input id="name" class="form-control" name="cname" type="text">
                            </div>

                            <div class="form-group">
                                <label for="name">Batch:</label>
                                <select name="batch" class="">
                                    <option></option>
                                    <?php while($batch = mysqli_fetch_array($batch_res)){?>
                                    <option value="<?php echo $batch['ba_id'];?>"><?php echo $batch['bname'];?></option>
                                    <?php }?>
                                </select>
                                <!-- <input id="name" class="form-control" name="banme" type="text"> -->
                            </div>

                            <div class="form-group">
                                <label for="name">Class:</label>
                                <select name="class" class="">
                                    <option></option>
                                    <?php while($class = mysqli_fetch_array($class_res)){?>
                                    <option value="<?php echo $class['cl_id'];?>"><?php echo $class['cl_name'];?>
                                    </option>
                                    <?php }?>
                                </select>
                                <!-- <input id="name" class="form-control" name="class" type="text"> -->
                            </div>

                            <div class="form-group">
                                <label for="name">Subject:</label>
                                <select name="subject" class="">
                                    <option></option>
                                    <?php while($subject = mysqli_fetch_array($subject_res)){?>
                                    <option value="<?php echo $subject['sub_code'];?>">
                                        <?php echo $subject['sub_name'];?></option>
                                    <?php }?>
                                </select>
                                <!-- <input id="name" class="form-control" name="subject" type="text"> -->
                            </div>

                            <div class="form-group">
                                <label for="email">Roll No:</label>
                                <input id="email" class="form-control" name="rollno" type="text">
                            </div>
                            <input class="btn btn-primary" type="submit" value="Submit" name="submit">
                        </fieldset>
                    </form>


<?php 
if(isset($_POST['submit'])){
    $s_id = $_SESSION["person_id"];
	$cname     = $_POST['cname'];
    $batch     = $_POST['batch'];
    $class     = $_POST['class'];
    $subject   = $_POST['subject'];
    $rollno      = $_POST['rollno'];
    
    $query = "INSERT INTO coinformation (coname, ba_id, cl_id, sub_code, rollno,s_id)
    VALUES ('$cname',$batch, $class, $subject, $rollno,$s_id)";
    $data = mysqli_query($conn,$query);
    // var_dump($_POST['submit']); die();
    
     
    if($data){
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