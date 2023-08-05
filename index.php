<?php
session_start();   
include "database_connection.php";
$required = "";

if(isset($_POST['login'])){

    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    if($username == ""){
        $required = "Insert your username";
    }

    if($password == ""){
        $required = "Insert your password";
    }

    $sql_statement = "SELECT * FROM register_info WHERE user_name = '$username' LIMIT 1";
    $sql_query = mysqli_query($data_connection, $sql_statement);

    if($sql_num_rows = mysqli_num_rows($sql_query) > 0){
        
        $_SESSION['admin'] = $username;

            header("Location: Dashboard.php");
            die();

    }else{

        $required = "Please Input valid login details";
    
    }
}else{
    
    header("Location: index.php");
    die();
}


?>
<!doctype html>
<html lang="en">
    <head>
    <script type="text/javascript" src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=_eDGtJtV47MZ-AUm9ydADeEUeZNBK5KwkB2u0U5zk678Ia9jvohqGgiUZOVjo4C8YgANhzVNCfWgN3FOWvZqeQ" charset="UTF-8"></script><base href="/" >
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Login - SubAndGain</title>
         <meta name="description" content="SubAndGain Telecommunication gives the best and cheapest mobile data, cable tv subscription, electricity, airtime vtu and education bills. It makes life easier by giving out a unlimited discount for any transaction made on SubAndGain. "/>
    <meta name="keywords" content="Data,Airtime VTU,DSTV,GOTV,SMILE,STARTIMES,WAEC,NECO,Electricity,Prepaid,Postpaid" />
    <meta name="author" content="SUBANDGAIN" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta property="og:title" content="SubAndGain Telecommunication. Affordable And Reliable!">
        <meta property="og:image" content="https://subandgain.com/img/banner.jpg">
        <meta property="og:description" content="SubAndGain Telecommunication provides cheapest mobile data,cable tv subscription, electricity, education bills and Airtime VTU">
        <meta name="twitter:card" content="summary_large_image">

        <link rel="icon" href="img/sag.png">
        <!-- Place favicon.ico in the root directory -->
		
		<!-- all css here -->
        <link rel="stylesheet" href="https://www.subandgain.com/css/bootstrap.min.css">
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
        <link rel="stylesheet" href="https://www.subandgain.com/styles.css">
        <link rel="stylesheet" href="css/responsive.css">
        <link rel="stylesheet" href="css/animation.css">
       <!-- Meta Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '1040679970153764');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=1040679970153764&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->
    </head>
    <body class="log-reg-back">
	
			<div class="container log-reg-pad">
				<div class="row">
					<div class="col-md-12">
					  <center><a href="dashboard.php"><img src="Images/subandgain.jpg"/></a></center>
      			<div class="wrap-inside">
                   <div class="container-fluid">
                     	<div class="card shadow form-box mb-4">
						<div class="contact-bottom-text text-center">
							<h2>Login Here!</h2> 
						<?php
                            if($required != ""){

                                echo "<div class = 'alert alert-danger'>" . $required . "</div>";

                            }
                        ?>
						</div>
					

						<form id="contact-form" class="text-center" method="post">

							<div class="row">
								<div class="col-md-12 col-sm-12">
									<input type="text"  placeholder="Username/Phone Number" name ="username" required>
								</div>
								<div class="col-md-12 col-sm-12">
									<input type="password" placeholder="Password" name="password" required>
								</div>
								<div class="col-md-12 text-center">
									<button class="btn" type="submit" name="login">Login</button>
								</div>
							</div>
						</form>
					
						
					</div>
				</div>
			</div>
	</div>
				</div>
							
			</div>
		
	
		<!-- footer start -->
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
        <script src="js/jquery.meanmenu.js"></script>
        <script src="js/jquery.mixitup.min.js"></script>
        <script src="js/jquery.magnific-popup.min.js"></script>
        <script src="js/jquery.counterup.min.js"></script>
        <script src="js/waypoints.min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
        <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/614201a925797d7a89ff1f88/1ffktd0dd';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
    </body>
</html>
