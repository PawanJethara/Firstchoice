<?php include("index.php"); ?>
<?php  include("connection.php");
$level_res = mysqli_query($conn, "SELECT * FROM level");
$board_res = mysqli_query($conn, "SELECT * FROM board"); 
?>
<div class="page-content">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Form Submittion</h4>
                    <p class="card-description">This is the <a href="https://jqueryvalidation.org/"
                            target="_blank">Family Information </a>of Students.</p>
                    <form class="cmxform" id="signupForm" method="POST" action="#">
                        <fieldset>
                            <div class="form-group">
                                <label for="name">Level:</label>
                                <select name="level" class="">
                                    <option></option>
                                    <?php while($level = mysqli_fetch_array($level_res)){?>
                                    <option value="<?php echo $level['l_id'];?>"><?php echo $level['l_name'];?></option>
                                    <?php }?>
                                </select>
                                <!-- <input id="name" class="form-control" name="lname" type="text"> -->
                            </div>

                            <div class="form-group">
                <label>Board</label>
                <select name="board" class="">
                    <option></option>
                    <?php while($board = mysqli_fetch_array($board_res)){?>
                    <option value="<?php echo $board['bo_id'];?>"><?php echo $board['bo_name'];?></option>
                    <?php }?>
                </select>
            </div>

                            <div class="form-group">
                                <label for="name">Passerd_Year:</label>
                                <input id="name" class="form-control" name="passed" type="text">
                            </div>

                            <div class="form-group">
                                <label for="name">Percentage:</label>
                                <input id="name" class="form-control" name="percentage" type="text">
                            </div>

                            <input class="btn btn-primary" type="submit" value="Submit" name="submit">
                        </fieldset>
                    </form>
                    <?php 

if(isset($_POST['submit'])){
  $s_id = $_SESSION["person_id"];
  $level     = $_POST['level'];
  $board     = $_POST['board'];
  $passed    = $_POST['passed'];
  $percentage     = $_POST['percentage'];

  $query1 = "INSERT INTO equalification (l_id, bo_id,passed_year,percentage,s_id)
  VALUES ('$level',$board, $passed, $percentage,$s_id)";
  $data1 = mysqli_query($conn,$query1);
  // var_dump($_POST['submit']); die();
  if($data1){
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