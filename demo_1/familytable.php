<?php include("index.php"); ?>
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="family_info.php">Add family Info</a></li>
            <li class="breadcrumb-item active" aria-current="page"></li>Family Info List</a></li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Students List</h6>
                    <p class="card-description">Student Family Information table</p>

                    <form class="example" action="" method="POST">
                        <input type="text" placeholder="Search.." name="search">
                        <button type="submit" name="submit"><i class="fa fa-search"></i>Search</button>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>S.N.</th>
                                        <th>Father Name</th>
                                        <th>Father Number</th>
                                        <th>Mother Name</th>
                                        <th>Mother Number</th>
                                        <th>Guardian Name</th>
                                        <th>Guardian Number</th>
                                        <th>Operation</th>
                                    </tr>
                                </thead>
                                <?php  include("connection.php");?>

                                <?php 
$limit = 10;  
if (isset($_GET["page"])) {
  $page  = $_GET["page"]; 
  } 
  else{ 
  $page=1;
  };  
   $start_from = ($page-1) * $limit;  
if(isset($_POST['submit'])){
  
      $input=$_POST['search'];
      $sql = mysqli_query ($conn, "SELECT * from finformation where fathername like'$input' LIMIT $start_from, $limit");
    }else{
      $sql = mysqli_query ($conn, "SELECT * from finformation LIMIT $start_from, $limit");
    }
?>
                                <tr>
                                    <?php
          while ($row = mysqli_fetch_assoc($sql)){
          ?>
                                    <td><?php echo ++$start_from;?></td>
                                    <td><?php echo $row['fathername'];?></td>
                                    <td><?php echo $row['fathernumber'];?></td>
                                    <td><?php echo $row['mothername'];?></td>
                                    <td><?php echo $row['mothernumber'];?></td>
                                    <td><?php echo $row['guardianname'];?></td>
                                    <td><?php echo $row['guardiannumber'];?></td>
                                    <td bgcolor="red">
                                        <a type="button" href="updatecollege.php?id=<?php echo $row['f_id'];?>"
                                            onClick="return confirm('Are you sure you want to delete?')">Delete</a>

                                        <!-- <input type="button" name="update"  value="Update"> -->
                                        <a type="button"
                                            href="update_family_info.php?id=<?php echo $row['f_id'];?>">Update</a>
                                    </td>
                                </tr>
                                <?php
          }
          ?>


                            </table>

                            <?php
$result_db = mysqli_query($conn,"SELECT COUNT(f_id) FROM finformation"); 
// var_dump($result_db); die();
$row_db = mysqli_fetch_row($result_db);  
$total_records = $row_db[0];  
$total_pages = ceil($total_records / $limit); 
/* echo  $total_pages; */
$pagLink = "<ul class='pagination'>";  
for ($i=1; $i<=$total_pages; $i++) {
    $pagLink .= "<li class='page-item'><a class='page-link' href='familytable.php?page=".$i."'>".$i."</a></li>";	
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