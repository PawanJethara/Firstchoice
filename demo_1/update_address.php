
<?php include("index.php"); ?>
<?php  include("connection.php");?>
<?php
$country_res = mysqli_query($conn, "SELECT * FROM country");
?>

<?php include("connection.php");
    $address1_id =$_GET['id'];
    $sql = mysqli_query ($conn, "SELECT address1.*,country.cname,district.dname,province.pname,city.ci_name
  FROM address1 join country on address1.c_code=country.c_code join district on address1.dp_code=district.dp_code 
  join province on address1.p_id=province.p_id join city on address1.ci_id=city.ci_id where a_id=$address1_id ");
    ?>

<div class="page-content">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Form Submittion</h4>
                    <p class="card-description">This is the <a href="https://jqueryvalidation.org/"
                            target="_blank">Address Information </a>of Students.</p>
                    <form class="cmxform" id="signupForm" method="POST" action="#">
                        <fieldset>
                        <?php while($address1 = mysqli_fetch_array($sql)){?>
                            <div class="form-group">
                                <label for="name">Address Type:</label>
                                <select name="address" class="" value="<?php echo $address1['address_type'];?>">
                                    <option>Permanent</option>
                                    <option>Temporary</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="name">Country Name:</label>
                                <select name="country" class="">
                                    <?php while($country = mysqli_fetch_array($country_res)){?>
                                    <option value="<?php echo $country['c_code'];?>"></option>
                                    <option <?php if($address1['c_code']==$country['c_code']){echo 'selected';}?> value="<?php echo $country['c_code'];?>"><?php echo $country['cname'];?>
                                    </option>
                                    <?php }?>
                                </select>
                                <!-- <input type="hidden" name="c_code" value="<?php echo $address1['c_code']?>"> -->
                                
                            </div>

                            <div class="form-group">
                                <label for="name">Province Name:</label>
                                <select name="province" class="">
                                    <?php
                                    $country_id =$address1['c_code'];
                                     $province_res = mysqli_query($conn, "SELECT * FROM province where c_code = $country_id"); 
                                     while($province = mysqli_fetch_array($province_res)){
                                       ?>
                                    <option <?php if($address1['p_id']==$province['p_id']){echo 'selected';}?> value="<?php echo $province['p_id'];?>"><?php echo $province['pname'];?></option>
                                    <?php }?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="name">District Name:</label>
                                <select name="district" class="">
                                    <?php
                                    $province_id =$address1['p_id'];
                                     $district_res = mysqli_query($conn, "SELECT * FROM district where p_id = $province_id"); 
                                     while($district = mysqli_fetch_array($district_res)){
                                       ?>
                                    <option <?php if($address1['dp_code']==$district['dp_code']){echo 'selected';}?> value="<?php echo $district['dp_code'];?>"><?php echo $district['dname'];?></option>
                                    <?php }?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="email">City Name:</label>
                                <select name="city" class="">
                                    <?php
                                    $district_id =$address1['dp_code'];
                                     $city_res = mysqli_query($conn, "SELECT * FROM city where dp_code = $district_id"); 
                                     while($city = mysqli_fetch_array($city_res)){
                                       ?>
                                    <option <?php if($address1['ci_id']==$city['ci_id']){echo 'selected';}?> value="<?php echo $city['ci_id'];?>"><?php echo $city['ci_name'];?></option>
                                    <?php }?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="password">Ward No.</label>
                                <input id="password" class="form-control" name="ward" type="text"
                                value="<?php echo $address1['ward_no'];?>">
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
$a_id = $_GET['id'];
$address = $_POST['address'];
$country = $_POST['country'];
$district = $_POST['district'];
$province =  $_POST['province'];
$city =$_POST['city'];
$ward =$_POST['ward'];	
$result = mysqli_query($conn, "UPDATE address1 SET address_type ='$address', ward_no=$ward,c_code =$country,p_id=$province, dp_code=$district, ci_id=$city WHERE a_id=$a_id");
// header("Location: addresstable.php");
}
?>

    <?php include("footer.php"); ?>