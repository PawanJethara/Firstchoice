<?php include("index.php"); ?>
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="add_personal_info.php">Add Personal Info</a></li>
            <li class="breadcrumb-item active" aria-current="page"></li>Personal Info List
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Students List</h6>
                    <p class="card-description">Student Personal Information table</p>

                    <form class="example" action="" method="POST">
                        <input type="text" placeholder="Search.." name="search">
                        <button type="submit" name="submit"><i class="fa fa-search"></i>Search</button>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>S.N.</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>DOB</th>
                                        <th>Gender</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  include("connection.php");?>

                                    <?php 
  $limit = 15;  
  if (isset($_GET["page"])) {
    $page  = $_GET["page"]; 
    } 
    else{ 
    $page=1;
    };  
  $start_from = ($page-1) * $limit;  
if(isset($_POST['submit'])){  
      $input=$_POST['search'];
      $res = mysqli_query($conn, "SELECT  studentd.*,name.fname,name.mname,name.lname FROM studentd join name ON studentd.n_id =name.n_id where fname like'$input' LIMIT $start_from, $limit");
    }else{
      $res = mysqli_query($conn, "SELECT  studentd.*,name.fname,name.mname,name.lname FROM studentd join name ON studentd.n_id =name.n_id  LIMIT $start_from, $limit");
    }
 

?>
                                    <tr>
                                        <?php
          while($row = mysqli_fetch_assoc($res)){
          ?>
                                        <td><?php echo ++$start_from;?></td>
                                        <td><?php echo $row['fname'].' '.$row['mname'].' '.$row['lname'];?></td>
                                        <td><?php echo $row['phone'];?></td>
                                        <td><?php echo $row['email'];?></td>
                                        <td><?php echo $row['dob'];?></td>
                                        <td><?php echo $row['gender'];?></td>
                                        <td bgcolor="">
                                            <a type="button" href="delete.php?id=<?php echo $row['s_id'];?>"
                                                onClick="return confirm('Are you sure you want to delete?')">Delete</a>

                                            <!-- <input type="button" name="update"  value="Update"> -->
                                            <a type="button"
                                                href="update_personal_info.php?id=<?php echo $row['s_id'];?>">Update</a>
                                        </td>
                                    </tr>
                                    <?php
          }
          ?>
                                </tbody>
                            </table>

                            <?php 
$result_db = mysqli_query($conn,"SELECT COUNT(s_id) FROM studentd"); 
// var_dump($result_db); die();
$row_db = mysqli_fetch_row($result_db);  
$total_records = $row_db[0];  
$total_pages = ceil($total_records / $limit); 
/* echo  $total_pages; */
$pagLink = "<ul class='pagination'>";  
for ($i=1; $i<=$total_pages; $i++) {
              $pagLink .= "<li class='page-item'><a class='page-link' href='personaltable.php?page=".$i."'>".$i."</a></li>";	
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