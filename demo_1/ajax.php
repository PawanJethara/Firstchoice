 <?php
 include'connection.php';
 $sql = "SELECT * FROM district
 WHERE p_id LIKE '%".$_GET['id']."%'"; 


 $result = mysqli_query($conn,$sql);


 $json = [];
 while($row = $result->fetch_assoc()){
  $json[$row['dp_code']] = $row['dname'];
}


echo json_encode($json);
?> 