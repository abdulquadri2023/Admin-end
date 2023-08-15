<?php
session_start();
include "database_connection.php";
$required = $success = "";

if(isset($_SESSION['adminend'])){

  $user_name = $_SESSION['adminend'];

  $sql = "SELECT * FROM dashboard_table WHERE user_name = '$user_name' LIMIT 1";
  $con = mysqli_query($data_connection, $sql);
  $num = mysqli_num_rows($con);
  if($num > 0 ){

    $assoc = mysqli_fetch_assoc($con);
    $wallet = $assoc['wallet'];
    $status = $assoc['status'];

  }else{
    header("Location: index.php");
    die();
  }
}else{
  header("Location: index.php");
  die();
}

if(isset($_GET['id']) && $_GET['id'] != ""){
  $uid = filter_var($_GET['id'], FILTER_SANITIZE_STRING);
  $sql = "SELECT * FROM register_info WHERE id = '$uid'";
  $res = mysqli_query($data_connection, $sql);
  if(mysqli_num_rows($res) > 0){
    $userdetails = mysqli_fetch_assoc($res);
    $username = $userdetails['user_name'];
    $phone = $userdetails['phone_number'];
    $email = $userdetails['email'];
  $fname = $userdetails['first_name'];
  $lastname = $userdetails['last_name'];
  $wallet = $userdetails['wallet'];

  }else{
    header("location: search.php");
    die();
  
  }
}else{
  echo "not set";
  //header("location: search.php");
  //die();
}


if(isset($_POST['update'])){

  $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING); 
  $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING); 
  $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING); 
  $lastname = filter_var($_POST['lalastname'], FILTER_SANITIZE_STRING); 
  $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING); 

  if($username == ""){

     $required = "Username is required"; 
  }
  if($phone == ""){

    $required = "Phone number is required"; 
 }
 if($firstname == ""){

    $required = "Firstname is required"; 
 }
 if($lastname == ""){

    $required = "Lastname is required"; 
 }
 if($email == ""){

    $required = "Email is required"; 
 }
 
$sql1 = "UPDATE register_info SET user_name = '$username', phone_number = '$phone', first_name = '$firstname', 
last_name = '$lastname', email = '$email' WHERE id = '$uid'"; 
$con1 = mysqli_query($data_connection, $sql1);
}


if(isset($_GET['id']) && $_GET['id'] != ""){
    $uid = filter_var($_GET['id'], FILTER_SANITIZE_STRING);
    $sql2 = "SELECT * FROM register_info WHERE id = '$uid'";
    $con2 = mysqli_query($data_connection, $sql2);
    if(mysqli_num_rows($con2) > 0 ){
    $assoc2 = mysqli_fetch_assoc($con2);
    $username = $assoc2['user_name'];
    $phone = $assoc2['phone_number'];
    $firstname = $assoc2['first_name'];
    $lastname = $assoc2['last_name'];
    $email = $assoc2['email'];
    $wallets = $assoc2['wallet'];

 }

}


include "header.php";
?>
<!-- welcome -->
<div class="row">
			<div class="col-md-12 page-heading">
   <div class="breadcrumb-title text-center">
							<h4>Update Users</h4>
							<div class="breadcrumb-menu">
							<ul>
								<li><a href="main.php">dashboard</a></li>
								<li> Update</li>
							</ul>
						</div>
			</div>
		</div>
	</div>
		<!-- welcome end -->
		<!-- dashbord home -->
    <div class="container">
      <div class="row">
      	<div class="col-md-12">
      		<div class="wrapper-content">
      			<div class="wrap-inside">
                   <div class="container-fluid">
                     	<div class="card shadow form-box mb-4">
   		<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
   			<h6 class="m-0 font-weight-bold" style="text-transform: capitalize;"><?php echo $username;?>'s Information </h6>
   		</div>

   		<form method="post">
   			<div class="card-body">
         
         <?php     include "alert.php"; ?>

           <label class="normal"> Username</label>
           <div class="input-group mb-3">
           <input type="text" name="username" class="form-control" value="<?php echo $username;?>" required>
         </div>
        
         <label class="normal"> Phone Number</label>
         <div class="input-group mb-3">
           <input type="number" class="form-control" name="phone" value="<?php echo $phone;?>" required>
         </div>
         <label class="normal"> First Name</label>
         <div class="input-group mb-3">
           <input type="text" class="form-control" name="firstname" value="<?php echo $firstname;?>" required>
         </div>
         <label class="normal"> Last Name</label>
         <div class="input-group mb-3">
           <input type="text" class="form-control" name="lastname" value="<?php echo $lastname;?>" required>
          </div>
         <label class="normal"> Email</label>
         <div class="input-group mb-3">
           <input type="email" class="form-control" name="email" value="<?php echo $email;?>" required>
         </div>
         <label class="normal"> Wallet </label>
         <div class="input-group mb-3">
           <input type="text" class="form-control" name="wallet" value="<?php echo $wallets;?>" readonly/>
         </div>
         
           <input type="submit" class="btnn btn-primary" name="update" value="Update">
           
       </div>
   </form>




                   </div>
               </div>

      			</div>
      		</div>
      	</div>
      </div>
  </div>
<?php include "footer.php"; ?>