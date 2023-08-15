<?php 
session_start();
include "database_connection.php";
$required = $success = $search = "";

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

if(isset($_POST['settings'])){

  $admin = filter_var($_POST['Admin-username'], FILTER_SANITIZE_STRING); 
  $contact = filter_var($_POST['Company-contact'], FILTER_SANITIZE_STRING); 
  $whatsapp = filter_var($_POST['Company-whatsapp'], FILTER_SANITIZE_STRING); 
  $address = filter_var($_POST['Company-address'], FILTER_SANITIZE_STRING); 
  $email = filter_var($_POST['Company-email'], FILTER_SANITIZE_STRING); 
  $link = filter_var($_POST['Group-link'], FILTER_SANITIZE_STRING); 
  $bank = filter_var($_POST['bank'], FILTER_SANITIZE_STRING); 
  $account = filter_var($_POST['Account-name'], FILTER_SANITIZE_STRING); 
  $account_number = filter_var($_POST['Account-number'], FILTER_SANITIZE_STRING); 

  if($admin == ""){

     $required = "Company Username is required"; 
  }
  if($contact == ""){

    $required = "Company Contact number is required"; 
 }
 if($whatsapp == ""){

    $required = "Company Whatsapp number is required"; 
 }
 if($address == ""){

    $required = "Company address is required"; 
 }
 if($email == ""){

    $required = "Company email is required"; 
 }
 if($link == ""){

    $required = "Company whatsapp link is required"; 
 }
 if($bank == ""){

    $required = "Company bank name is required"; 
 }
 if($account == ""){

    $required = "Company accountname is required"; 
 }
 if($account_number == ""){

    $required = "Company account number is required"; 
 }

}
/*
    $sql1 = "SELECT * FROM company_details";
    $con1 = mysqli_query($data_connection, $sql1);
    $num = mysqli_num_rows($con1);
    if($num > 0 ){
   
       $assoc1 = mysqli_fetch_assoc($con1);
       $admin = $assoc1['name']; 
       $email = $assoc1['email']; 
       $contact = $assoc1['phone']; 
       $whatsapp = $assoc1['whatsapp']; 
       $link = $assoc1['group_whatsapp']; 
       $bank = $assoc1['bank']; 
       $account = $assoc1['account_name']; 
       $account_number = $assoc1['account_number']; 
       $address = $assoc1['address']; 
      // echo "is set";
    }
*/
if($required == ""){    
    
    $sql2 = "UPDATE company_details SET name = '$admin', email = '$email', phone = '$contact', whatsapp = '$whatsapp', 
    group_whatsapp = '$link', bank = '$bank', account_name = '$account', account_number = '$account_number', address = '$address'";
    $con2 = mysqli_query($data_connection, $sql2);
/*
    $sql4 = "INSERT INTO company_details (name, email, phone, whatsapp, group_whatsapp, bank, account_name, account_number, address)
    VALUES('$admin', '$email', '$contact', '$whatsapp', '$link', '$bank', '$account', '$account_number', '$address')";
    $con4 = mysqli_query($data_connection, $sql4);
*/
    $success = "Your information has been updated";
}

$sql3 = "SELECT * FROM company_details";
$con3 = mysqli_query($data_connection, $sql3);
$num3 = mysqli_num_rows($con3);
if($num3 > 0 ){

   $assoc3 = mysqli_fetch_assoc($con3);
   $admin = $assoc3['name']; 
   $email = $assoc3['email']; 
   $contact = $assoc3['phone']; 
   $whatsapp = $assoc3['whatsapp']; 
   $link = $assoc3['group_whatsapp']; 
   $bank = $assoc3['bank']; 
   $account = $assoc3['account_name']; 
   $account_number = $assoc3['account_number']; 
   $address = $assoc3['address']; 
  // echo "is set";
}

include "header.php";
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Dashboard - SubAndGain</title>
         <meta name="description" content="SubAndGain Telecommunication gives the best and cheapest mobile data, cable tv subscription, electricity, airtime vtu and education bills. It makes life easier by giving out a certain dicount for any transaction made on the SubAndGain. "/>
    <meta name="keywords" content="Data,Airtime VTU,DSTV,GOTV,SMILE,STARTIMES,WAEC,NECO,Electricity,Prepaid,Postpaid" />
    <meta name="author" content="SUBANDGAIN" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="../images/favicon.png">
        <!-- Place favicon.ico in the root directory -->
		<!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <!-- Our Custom CSS -->
    

    <!-- Font Awesome JS -->
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/style3.css">
    
		<!-- all css here -->
         <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/bootstrap-grid.css">
        <link rel="stylesheet" href="css/bootstrap-grid.min.css">
        <link rel="stylesheet" href="css/bootstrap-reboot.css">
        <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/pe-icon-7-stroke.css">
        <link rel="stylesheet" href="css/owl.carousel.css">
		<link rel="stylesheet" href="css/magnific-popup.css">
		<link rel="stylesheet" href="css/meanmenu.css">
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="css/responsive.css">
        <link rel="stylesheet" href="css/animation.css">
        
       <!-- Font Awesome JS -->
    <script type="text/javascript" src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=3-9ylsT56cTQ24En3TfPhG-EV4IH2_nH3k7mZp-FSloJycIMIFAaUWAIvZurRq3XYEfURBuQSxEVdUzBxwaJxw" charset="UTF-8"></script><style>
       
        .mCSB_dragger_bar{
            width: 10px !important;;
        }
    </style>
    </head>
    <body>
     

        <!-- Add your site or application content here -->
		
		<div class="row">
			<div class="col-md-12 page-heading">
   <div class="breadcrumb-title text-center">
							<h4>DATA TRANSACTION </h4>
							<div class="breadcrumb-menu">
							<ul>
								<li><a href="dashboard.php"> Account / Data Transaction </a></li>
								<li>dashboard</li>
							</ul>
						</div>
			</div>
		</div>
	</div>
	
	
	<!-- 	 <script>
    alert('**NEW** \n Dear customer, in order to serve you better, we have improved our automated payment system. You now have a unique SUBANDGAIN account number which you can deposit or transfer fund into it and your wallet will get credited instantly. You can find your SUBANDGAIN account details below.');
    </script>-->
<!--	welcome end -->
		<!-- dashbord home -->
    <div class="container">
      <div class="row">
      	<div class="col-md-12">
      		<div class="wrapper-content">
      			<div class="wrap-inside">
      			
         
          <!-- wallet-->



          <div class="container log-reg-pad">
				<div class="row">
					
                   <div class="container-fluid">
                     	<div class="card shadow form-box mb-4">
					
            <form id="contact-form" class="" method="post">

                            <div class="row">

                            <div class="col-md-12 col-sm-4">
                              SETTINGS 
                            </div>
                            
                            <div class="col-md-12 col-sm-12">
                                <?php include "alert.php"; ?>
                                <label> Admin Username </label>
                                <input type="text"  placeholder="Admin" name="Admin-username" value ="<?php echo $admin; ?>" required>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <label> Company Contact Number </label>
                                <input type="text"  placeholder="+2348123456789" name="Company-contact" value = "<?php echo $contact; ?>" required>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <label> Company Whatsapp number </label>
                                <input type="text"  placeholder="+2348123456789" name="Company-whatsapp" value = "<?php echo $whatsapp; ?>" required>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <label> Company Address </label>
                                <input type="text"  placeholder="AZ 1 Abuja" name="Company-address" value = "<?php echo $address; ?>" required>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <label> Company Email </label>
                                <input type="text"  placeholder="SubandGain@gmail.com" name="Company-email" value = "<?php echo $email; ?>" required>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <label> Company Whatsapp Group Link </label>
                                <input type="text"  placeholder="Company Whatsapp Group Link" name="Group-link" value = "<?php echo $link; ?>" required>
                            </div>
                           
                            <div class="col-md-12 col-sm-12">
                            <label> Bank </label>
                                <select name = "bank" class = "form-control"> 
                                    <option value = ""> Select Bank </option>
                                    <option value = "Access Bank"> Access Bank </option>
                                    <option value = "Fidelity Bank"> Fidelity Bank </option>
                                    <option value = "Keystone Bank"> Keystone Bank </option>
                                </select>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <label> Account Name </label>
                                <input type="text"  placeholder="SubandGain" name="Account-name" value = "<?php echo $account; ?>" required>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <label> Account Number </label>
                                <input type="text"  placeholder="1234567890" name="Account-number" value = "<?php echo $account_number; ?>" required>
                            </div>

                            <div class="col-md-4 col-sm-4">
                                <input class="btn btn-primary" type="submit" name="settings" value = "Search">
                            </div>
                            
                            </div>
            </form>
       
					
						
					
			</div>
	    </div>
	</div>
							
	</div>
    <br/>
               
        
      	
   
      	
      	</div>

      </div>
    </div>
</div>
</div>

		<!-- dashboard home end -->
		<script>
		       function showema(){
              
               document.getElementById("wemadetail").style.display = 'block';
               document.getElementById("sterlingdetail").style.display = 'none';
               document.getElementById("gtbdetail").style.display = 'none';
                document.getElementById("vfddetail").style.display = 'none';
               
                document.getElementById("wema").setAttribute('disabled', 'disabled');
                document.getElementById("sterling").removeAttribute('disabled');
                document.getElementById("gtb").removeAttribute('disabled');
                 document.getElementById("vfd").removeAttribute('disabled');
                 
                 document.getElementById("wema").classList.remove("btn-primary");
                 document.getElementById("sterling").classList.add("btn-primary");
                   document.getElementById("gtb").classList.add("btn-primary");
               
                 document.getElementById("vfd").classList.add("btn-primary");
                 
                 document.getElementById("vfdfeedetail").style.display = 'none';
                 document.getElementById("monnidetail").style.display = 'block';
               
          }
          function showsterling(){
              
               document.getElementById("sterlingdetail").style.display = 'block';
               document.getElementById("wemadetail").style.display = 'none';
                 document.getElementById("gtbdetail").style.display = 'none';
                 document.getElementById("vfddetail").style.display = 'none';
               
                document.getElementById("sterling").setAttribute('disabled', 'disabled');
                document.getElementById("wema").removeAttribute('disabled');
                document.getElementById("gtb").removeAttribute('disabled');
                 document.getElementById("vfd").removeAttribute('disabled');
                 
                 document.getElementById("sterling").classList.remove("btn-primary");
                 document.getElementById("wema").classList.add("btn-primary");
                 document.getElementById("gtb").classList.add("btn-primary");
                      document.getElementById("vfd").classList.add("btn-primary");
                      
                      document.getElementById("vfdfeedetail").style.display = 'none';
                 document.getElementById("monnidetail").style.display = 'block';
               
          }
                 function showgtb(){
                document.getElementById("gtbdetail").style.display = 'block';
               document.getElementById("sterlingdetail").style.display = 'none';
               document.getElementById("wemadetail").style.display = 'none';
               document.getElementById("vfddetail").style.display = 'none';
               
                document.getElementById("sterling").removeAttribute('disabled');
                document.getElementById("wema").removeAttribute('disabled');
                document.getElementById("gtb").setAttribute('disabled','disabled');
                 document.getElementById("vfd").removeAttribute('disabled');
                 
                 document.getElementById("sterling").classList.add("btn-primary");
                 document.getElementById("wema").classList.add("btn-primary");
                 document.getElementById("gtb").classList.remove("btn-primary");
                      document.getElementById("vfd").classList.add("btn-primary");
                      
                      document.getElementById("vfdfeedetail").style.display = 'none';
                 document.getElementById("monnidetail").style.display = 'block';
               
          }
          
                   function showvfd(){
                document.getElementById("gtbdetail").style.display = 'none';
               document.getElementById("sterlingdetail").style.display = 'none';
               document.getElementById("wemadetail").style.display = 'none';
               document.getElementById("vfddetail").style.display = 'block';
               
                document.getElementById("sterling").removeAttribute('disabled');
                document.getElementById("wema").removeAttribute('disabled');
                document.getElementById("gtb").removeAttribute('disabled','disabled');
                 document.getElementById("vfd").setAttribute('disabled','disabled');
                 
            document.getElementById("sterling").classList.add("btn-primary");
                 document.getElementById("wema").classList.add("btn-primary");
                 document.getElementById("gtb").classList.add("btn-primary");
            document.getElementById("vfd").classList.remove("btn-primary");
            
            document.getElementById("vfdfeedetail").style.display = 'block';
                 document.getElementById("monnidetail").style.display = 'none';
               
          }
		</script>
		<!-- footer start -->
		<footer>
			<div class="footer-bottom-area">
				<div class="container">
					<div class="social-icons text-center">
						<label>Find Us:</label>
						<a href="https://facebook.com/subandgain"><i class="fa fa-facebook"></i></a>
						<a href="https://twitter.com/@subandgain"><i class="fa fa-twitter"></i></a>
						
					</div>
					<div class="copyright text-center">
						<p>SubAndGain - All rights reserved - 2020 ©. </p>
						<a href="#"></a>
					</div>
				</div>
			</div>
		</footer>
		<!-- footer end -->
		<script src="changess.js"></script>
		<script src="js/settings.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.js"></script>
        <script src="clipboard/dist/clipboard.min.js"></script>
		    <script>

function toggleElement(id,uid)
{
    if(document.getElementById(id).style.display == 'none')
    {
        document.getElementById(id).style.display = '';
        document.getElementById(uid).innerHTML = 
    " <i class='fa fa-minus'></i> ";
    }
    else
    {
        document.getElementById(id).style.display = 'none';
        document.getElementById(uid).innerHTML = 
    " <i class='fa fa-plus'></i> ";
    }
}


</script>
		<!-- all js here -->
		<script src="js/modernizr-2.8.3.min.js"></script>
        <script src="js/jquery-1.12.0.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/bootstrap.bundle.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.meanmenu.js"></script>
        <script src="js/jquery.mixitup.min.js"></script>
        <script src="js/jquery.magnific-popup.min.js"></script>
        <script src="js/jquery.counterup.min.js"></script>
        <script src="js/waypoints.min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
   
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#dismiss, .overlay').on('click', function () {
                $('#sidebar').removeClass('active');
                $('.overlay').removeClass('active');
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').addClass('active');
                $('.overlay').addClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });

        function copyText(){
    var clipboard = new ClipboardJS('#referral_link');
    clipboard.on('success', function(e){
      alert("Referral Link Copied!")
    });
    
}



function copyApi(){
    var clipboard = new ClipboardJS('#api_link');
    clipboard.on('success', function(e){
      alert("API Key Copied!")
    });
    
}
    </script>
     <script src="datacheck.js"></script>
    <script src="billcheck.js"></script>
    <script src="electcheck.js"></script>
     <script src="epinchecks.js"></script>
    

    </body>
</html>