<?php include("index.php"); ?>
<?php  include("connection.php");
$class_res = mysqli_query($conn, "SELECT * FROM class");
$batch_res = mysqli_query($conn, "SELECT * FROM batch");
$subject_res = mysqli_query($conn, "SELECT * FROM subject");  
?>

<?php
    $college_id =$_GET['id'];
    $res = mysqli_query($conn, "SELECT  coinformation.*,batch.bname,class.cl_name,subject.sub_name FROM coinformation 
    join batch ON coinformation.ba_id =batch.ba_id join class on coinformation.cl_id=class.cl_id
    join subject ON coinformation.sub_code =subject.sub_code where co_id=$college_id");
    ?>
<div class="page-content">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Form Submittion</h4>
                    <p class="card-description">This is the <a href="https://jqueryvalidation.org/"
                            target="_blank">College Information </a>of Students.</p>
                    <form class="cmxform" id="signupForm" method="POST" action="#">
                        <fieldset>
                        <?php while($coinformation = mysqli_fetch_array($res)){?>
                            <div class="form-group">
                                <label for="name">College Name:</label>
                                <input id="name" class="form-control" name="coname" type="text" value="<?php echo $coinformation['coname'];?>">
                            </div>

                            <div class="form-group">
                                <label for="name">Batch:</label>
                                <select name="batch" class="">
                                    <?php while($batch = mysqli_fetch_array($batch_res)){?>
                                    <option <?php if($coinformation['ba_id']==$batch['ba_id']){echo 'selected';}?> value="<?php echo $batch['ba_id'];?>"><?php echo $batch['bname'];?></option>
                                    <?php }?>
                                </select> 
                            </div>

                            <div class="form-group">
                            <label for="name">Class:</label>
                            <select name="class" class="">
                            <?php while($class = mysqli_fetch_array($class_res)){?>
                                    <option <?php if($coinformation['cl_id']==$class['cl_id']){echo 'selected';}?> value="<?php echo $class['cl_id'];?>"><?php echo $class['cl_name'];?></option>
                                    <?php }?>
                            </select>
                            </div>

                            <div class="form-group">
                                <label for="name">Subject:</label>
                                <select name="subject" class="">
                                <?php while($subject = mysqli_fetch_array($subject_res)){?>
                                    <option <?php if($coinformation['sub_code']==$subject['sub_code']){echo 'selected';}?> value="<?php echo $subject['sub_code'];?>"><?php echo $subject['sub_name'];?></option>
                                    <?php }?>
                                </select> 
                            </div>

                            <div class="form-group">
                                <label for="email">Roll No:</label>
                                <input id="email" class="form-control" name="rollno" type="text" value="<?php echo $coinformation['rollno'];?>">
                            </div>
                            <input class="btn btn-primary" type="submit" value="update" name="update">
                        </fieldset>
                        <?php }?>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6 grid-margin stretch-card">

        </div>
    </div>

    <?php
if(isset($_POST['update'])){
$co_id = $_GET['id'];
$coname = $_POST['coname'];
$batch = $_POST['batch'];
$class = $_POST['class'];
$subject =  $_POST['subject'];
$rollno =$_POST['rollno'];	
$result = mysqli_query($conn, "UPDATE coinformation SET coname ='$coname', rollno=$rollno, ba_id='$batch', cl_id='$class', sub_code='$subject' WHERE co_id=$college_id");
}
?>