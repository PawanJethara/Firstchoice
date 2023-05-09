<?php include("index.php"); ?>
<div class="page-content">
<nav class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="address_info.php">Add address Info</a></li>
						<li class="breadcrumb-item active" aria-current="page">Address Info List</li>
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
                                        <th>Address_Type</th>
                                        <th>Cuontry</th>
                                        <th>Province</th>
                                        <th>District</th>
                                        <th>City</th>
                                        <th>Wardno</th>
                                        <th>Operation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php  include("connection.php");?>

<?php 
$limit = 5;  
if (isset($_GET["page"])) {
  $page  = $_GET["page"]; 
  } 
  else{ 
  $page=1;
  };  
$start_from = ($page-1) * $limit;
if(isset($_POST['submit'])){

$input=$_POST['search'];
$sql = mysqli_query ($conn, "SELECT address1.*,country.cname,district.dname,province.pname,city.ci_name
FROM address1 join country on address1.c_code=country.c_code join district on address1.dp_code=district.dp_code 
join province on address1.p_id=province.p_id join city on address1.ci_id=city.ci_id where ci_name like'$input' LIMIT $start_from, $limit");
}else{
$sql = mysqli_query ($conn, "SELECT address1.*,country.cname,district.dname,province.pname,city.ci_name
FROM address1 join country on address1.c_code=country.c_code join district on address1.dp_code=district.dp_code 
join province on address1.p_id=province.p_id join city on address1.ci_id=city.ci_id LIMIT $start_from, $limit");
}

?>
<tr>
    <?php
while ($row = mysqli_fetch_assoc($sql)){
?>
    <td><?php echo $row['a_id'];?></td>
    <td><?php echo $row['address_type'];?></td>
    <td><?php echo $row['cname'];?></td>
    <td><?php echo $row['pname'];?></td>
    <td><?php echo $row['dname'];?></td>
    <td><?php echo $row['ci_name'];?></td>
    <td><?php echo $row['ward_no'];?></td>
    <td bgcolor="red">
        <a type="button" href="?id=<?php echo $row['a_id'];?>"
            onClick="return confirm('Are you sure you want to delete?')">Delete</a>

        <!-- <input type="button" name="update"  value="Update"> -->
        <a type="button" href="update_address.php?id=<?php echo $row['a_id'];?>">Update</a>
    </td>
</tr>
<?php
}
?>
                                        </tbody>
                                    </table>
</form>
                                    <?php 
$result_db = mysqli_query($conn,"SELECT COUNT(a_id) FROM address1"); 
// var_dump($result_db); die();
$row_db = mysqli_fetch_row($result_db);  
$total_records = $row_db[0];  
$total_pages = ceil($total_records / $limit); 
/* echo  $total_pages; */
$pagLink = "<ul class='pagination'>";  
for ($i=1; $i<=$total_pages; $i++) {
              $pagLink .= "<li class='page-item'><a class='page-link' href='addresstable.php?page=".$i."'>".$i."</a></li>";	
}
echo $pagLink . "</ul>";  
?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</div>
<?php include("footer.php"); ?>
