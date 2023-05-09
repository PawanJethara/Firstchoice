 <?php
 include'connection.php';
 $sql = "SELECT * FROM city
 WHERE dp_code LIKE '%".$_GET['id']."%'"; 


 $result = mysqli_query($conn,$sql);


 $json = [];
 while($row = $result->fetch_assoc()){
  $json[$row['ci_id']] = $row['ci_name'];
}
echo json_encode($json);
?> 