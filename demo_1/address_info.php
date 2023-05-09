
<?php include("index.php"); ?>
<?php  include("connection.php");
$country_res = mysqli_query($conn, "SELECT * FROM country");
$district_res = mysqli_query($conn, "SELECT * FROM district");
$province_res = mysqli_query($conn, "SELECT * FROM province"); 
$city_res = mysqli_query($conn, "SELECT * FROM city"); 
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
                            <div class="form-group">
                                <label for="name">Address Type:</label>
                                <select name="address" class="">
                                    <option>Permanent</option>
                                    <option>Temporary</option>
                                </select>
                                <!-- <input id="name" class="form-control" name="address" type="text"> -->
                            </div>
                            <div class="form-group">
                                <label for="name">Country Name:</label>
                                <select name="country" class="">
                                    <option></option>
                                    <?php while($country = mysqli_fetch_array($country_res)){?>
                                    <option  value="<?php echo $country['c_code'];?>"><?php echo $country['cname'];?>
                                    </option>
                                    <?php }?>
                                </select>
                                <!-- <input id="name" class="form-control" name="country" type="text"> -->
                            </div>
                            <div class="form-group">
                                <label for="name">Province Name:</label>
                                <select name="province" class="">
                                    <option></option>
                                </select>
                                <!-- <input id="name" class="form-control" name="province" type="text"> -->
                            </div>

                            <div class="form-group">
                                <label for="name">District Name:</label>
                                <select name="district" class="">
                                    <option></option>
                                </select>
                                <!-- <input id="name" class="form-control" name="district" type="text"> -->
                            </div>

                            <div class="form-group">
                                <label for="email">City Name:</label>
                                <select name="city" class="">
                                    <option></option>
                                </select>
                                <!-- <input id="email" class="form-control" name="city" type="text"> -->
                            </div>

                            <div class="form-group">
                                <label for="password">Ward No.</label>
                                <input id="password" class="form-control" name="ward" type="text">
                            </div>
							
                            <input class="btn btn-primary" type="submit" value="Submit" name="submit">
                        </fieldset>
                    </form>

                    <?php 
include'connection.php';
if(isset($_POST['submit'])){
  $s_id =$_SESSION["person_id"]; 
  $address     = $_POST['address'];
  $country     = $_POST['country'];
  $province     = $_POST['province'];
  $district     = $_POST['district'];
  $city     = $_POST['city'];
  $ward     = $_POST['ward'];
// var_dump($address,$country,$province,$district); die();
  $query1 = "INSERT INTO address1 (s_id,address_type, c_code,dp_code,p_id,ci_id,ward_no)
  VALUES ($s_id,'$address',$country, $district, $province,$city,$ward)";
    // var_dump($query1); die();
  $data1 = mysqli_query($conn,$query1);
  
  if($data1){
    echo "Data inserted into database";
  }
  else{
    echo "Data are not inserted into database";	
  }
}
?>

                </div>
            </div>
        </div>
        <div class="col-lg-6 grid-margin stretch-card">

        </div>
    </div>

    <script>
    $("select[name='province']").change(function() {
        var p_id = $(this).val();
        if (p_id) {


            $.ajax({
                url: "ajax.php",
                dataType: 'Json',
                data: {
                    'id': p_id
                },
                success: function(data) {
                    $('select[name="district"]').empty();
                    $.each(data, function(key, value) {
                        $('select[name="district"]').append('<option value="' + key + '">' +
                            value + '</option>');
                    });
                }
            });


        } else {
            $('select[name="district"]').empty();
        }
    });

    $("select[name='country']").change(function() {
        console.log('gsfgdf');
        var p_id = $(this).val();
        console.log(p_id);
        if (p_id) {


            $.ajax({
                url: "country.php",
                dataType: 'Json',
                data: {
                    'id': p_id
                },
                success: function(data) {
                    $('select[name="province"]').empty();
                    $.each(data, function(key, value) {
                        $('select[name="province"]').append('<option value="' + key + '">' +
                            value + '</option>');
                    });
                }
            });


        } else {
            $('select[name="province"]').empty();
        }
    });

    $("select[name='district']").change(function() {
        var ci_id = $(this).val();
        if (ci_id) {


            $.ajax({
                url: "city.php",
                dataType: 'Json',
                data: {
                    'id': ci_id
                },
                success: function(data) {
                    $('select[name="city"]').empty();
                    $.each(data, function(key, value) {
                        $('select[name="city"]').append('<option value="' + key + '">' +
                            value + '</option>');
                    });
                }
            });


        } else {
            $('select[name="city"]').empty();
        }
    });
    </script>

    <?php include("footer.php"); ?>

