<?php include("index.php"); ?>
<?php  include("connection.php");?>
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="education_info.php">Add education Info</a></li>
            <li class="breadcrumb-item active" aria-current="page"></li>Education Info List</a></li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Students List</h6>
                    <p class="card-description">Student Address Information table</p>

                    <form class="example" action="" method="POST">
                        <input type="text" placeholder="Search.." name="search">
                        <button type="submit" name="submit"><i class="fa fa-search"></i>Search</button>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Level</th>
                                    <th>Board</th>
                                    <th>Passed_Year</th>
                                    <th>Percentage</th>
                                    <th>Operation</th>
                                </tr>
                            </thead>
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
      $sql = mysqli_query ($conn, "SELECT equalification.*,level.l_name,board.bo_name
      FROM equalification join level on equalification.l_id=level.l_id join board on equalification.bo_id=board.bo_id WHERE passed_year like'$input' LIMIT $start_from, $limit");
    }else{
      $sql = mysqli_query ($conn, "SELECT equalification.*,level.l_name,board.bo_name
      FROM equalification join level on equalification.l_id=level.l_id join board on equalification.bo_id=board.bo_id LIMIT $start_from, $limit");
    }

?>

                            <tr>
                                <?php
          while ($row = mysqli_fetch_assoc($sql)){
          ?>
                                <td><?php echo $row['e_id'];?></td>
                                <td><?php echo $row['l_name'];?></td>
                                <td><?php echo $row['bo_name'];?></td>
                                <td><?php echo $row['passed_year'];?></td>
                                <td><?php echo $row['percentage'];?></td>
                                <td bgcolor="">
                                    <a type="button" href="updateeducation.php?id=<?php echo $row['e_id'];?>"
                                        onClick="return confirm('Are you sure you want to delete?')">Delete</a>
                                    <a type="button" href="update_education_info.php?id=<?php echo $row['e_id'];?>">Update</a>
                                </td>
                            </tr>
                            <?php
          }
          ?>
                        </table>

                        <?php 
$result_db = mysqli_query($conn,"SELECT COUNT(e_id) FROM equalification"); 
// var_dump($result_db); die();
$row_db = mysqli_fetch_row($result_db);  
$total_records = $row_db[0];  
$total_pages = ceil($total_records / $limit); 
/* echo  $total_pages; */
$pagLink = "<ul class='pagination'>";  
for ($i=1; $i<=$total_pages; $i++) {
              $pagLink .= "<li class='page-item'><a class='page-link' href='educationtable.php?page=".$i."'>".$i."</a></li>";	
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