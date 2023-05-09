<?php include("index.php"); ?>
<?php  include("connection.php");
$level_res = mysqli_query($conn, "SELECT * FROM level");
$board_res = mysqli_query($conn, "SELECT * FROM board");
$education_id =$_GET['id'];
$sql = mysqli_query ($conn, "SELECT equalification.*,level.l_name,board.bo_name
FROM equalification join level on equalification.l_id=level.l_id join board on equalification.bo_id=board.bo_id where e_id=$education_id");
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
                        <?php while($education = mysqli_fetch_array($sql)){?>
                            <div class="form-group">
                                <label for="name">Level:</label>
                                <select name="level" class="">
                                    <?php while($level = mysqli_fetch_array($level_res)){?>
                                    <option <?php if($education['l_id']==$level['l_id']){echo 'selected';}?> value="<?php echo $level['l_id'];?>"><?php echo $level['l_name'];?></option>
                                    <?php }?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Board</label>
                                <select name="board" class="">
                                    <?php while($board = mysqli_fetch_array($board_res)){?>
                                    <option <?php if($education['bo_id']==$board['bo_id']){echo 'selected';}?> value="<?php echo $board['bo_id'];?>"><?php echo $board['bo_name'];?></option>
                                    <?php }?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="name">Passerd_Year:</label>
                                <input id="name" class="form-control" name="year" type="text" value="<?php echo $education['passed_year'];?>">
                            </div>

                            <div class="form-group">
                                <label for="name">Percentage:</label>
                                <input id="name" class="form-control" name="percentage" type="text" value="<?php echo $education['percentage'];?>">
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
$e_id = $_GET['id'];
$level = $_POST['level'];
$board = $_POST['board'];
$year = $_POST['year'];
$percentage =  $_POST['percentage'];	
 $result = mysqli_query($conn, "UPDATE equalification SET passed_year ='$year', percentage=$percentage, bo_id=$board, l_id=$level WHERE e_id=$education_id");
}
?>