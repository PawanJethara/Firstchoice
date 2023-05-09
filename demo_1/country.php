 <?php
 include'connection.php';
 $sql = "SELECT * FROM province
 WHERE c_code LIKE '%".$_GET['id']."%'"; 


 $result = mysqli_query($conn,$sql);


 $json = [];
 while($row = $result->fetch_assoc()){
  $json[$row['p_id']] = $row['pname'];
}


echo json_encode($json);
?> 