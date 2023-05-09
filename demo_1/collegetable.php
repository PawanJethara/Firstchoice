<?php include("index.php"); ?>
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="college_info.php">Add college Info</a></li>
            <li class="breadcrumb-item active" aria-current="page"></li>College Info List</a></li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Students List</h6>
                    <p class="card-description">Student College Information table</p>

                    <form class="example" action="" method="POST">
                        <input type="text" placeholder="Search.." name="search">
                        <button type="submit" name="submit"><i class="fa fa-search"></i>Search</button>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                        <th>S.N.</th>
                                        <th>College</th>
                                        <th>Batch</th>
                                        <th>Class</th>
                                        <th>Subject</th>
                                        <th>Rollno</th>
                                        <th>Operation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  include("connection.php");?>

                                    <?php 
$limit = 4;  
if (isset($_GET["page"])) {
  $page  = $_GET["page"]; 
  } 
  else{ 
  $page=1;
  };  
$start_from = ($page-1) * $limit;
if(isset($_POST['submit'])){
  
      $input=$_POST['search'];
      $res = mysqli_query($conn, "SELECT  coinformation.*,batch.bname,class.cl_name,subject.sub_name FROM coinformation 
      join batch ON coinformation.ba_id =batch.ba_id join class on coinformation.cl_id=class.cl_id
      join subject ON coinformation.sub_code =subject.sub_code WHERE coname like'$input'");
    }else{
      $res = mysqli_query($conn, "SELECT  coinformation.*,batch.bname,class.cl_name,subject.sub_name FROM coinformation 
    join batch ON coinformation.ba_id =batch.ba_id join class on coinformation.cl_id=class.cl_id
    join subject ON coinformation.sub_code =subject.sub_code LIMIT $start_from, $limit");
    }

?>

                                    <tr>
                                        <?php
          while($row = mysqli_fetch_assoc($res)){
          ?>
                                        <td><?php echo $row['co_id'];?></td>
                                        <td><?php echo $row['coname'];?></td>
                                        <td><?php echo $row['bname'];?></td>
                                        <td><?php echo $row['cl_name'];?></td>
                                        <td><?php echo $row['sub_name'];?></td>
                                        <td><?php echo $row['rollno'];?></td>
                                        <td bgcolor="red">
                                            <a type="button" href="updatecollege.php?id=<?php echo $row['s_id'];?>"
                                                onClick="return confirm('Are you sure you want to delete?')">Delete</a>

                                            <!-- <input type="button" name="update"  value="Update"> -->
                                            <a type="button"
                                                href="update_college_info.php?id=<?php echo $row['co_id'];?>">Update</a>
                                        </td>
                                    </tr>
                                    <?php
          }
          ?>
                                    </tbody>
                            </table>
                            <?php 
$result_db = mysqli_query($conn,"SELECT COUNT(co_id) FROM coinformation"); 
// var_dump($result_db); die();
$row_db = mysqli_fetch_row($result_db);  
$total_records = $row_db[0];  
$total_pages = ceil($total_records / $limit); 
/* echo  $total_pages; */
$pagLink = "<ul class='pagination'>";  
for ($i=1; $i<=$total_pages; $i++) {
              $pagLink .= "<li class='page-item'><a class='page-link' href='collegetable.php?page=".$i."'>".$i."</a></li>";	
}
echo $pagLink . "</ul>";  
?>

</form>
                        </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php include("footer.php"); ?>