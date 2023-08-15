<?php
session_start();
include "database_connection.php";
$required = "";

if(isset($_SESSION['adminend'])){

  $user_name = $_SESSION['adminend'];
  if($_SESSION['adminend']){
    //echo "nice work";
}
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
							<h4>AIRTIME VTU PRICES </h4>
							<div class="breadcrumb-menu">
							<ul>
								<li><a href="dashboard.php"> Account / Airtime Vtu Prices </a></li>
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
       
    <br/>
               
        
      	
   <div class="col-md-12">
   	<div class="card shadow mb-4" style="padding: 0;">
   		<div class="card-header py-3 bgcard-header">
   			<h5 class="m-0 font-weight-bold">Recent transaction </h5>
   		</div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
               <tr>
                <th> Service </th>
                 <th> Number </th>
                  <th> Price </th>
                   <th> Status </th>
                    <th> Trans. Id </th>
                   <th> Date </th>
                 </tr>
               </thead>
             <tbody>
              <tr>
                <?php 
                if(isset($_GET['pages']) && $_GET['pages'] != ""){ 
                  
                  $pages = $_GET['pages'];
                }else{
                  $pages = 1;
                 } 

                 $records = 10;
                 $offset = ($pages-1) * $records;
                 $previous = $pages - 1;
                 $next = $pages + 1;
                 $adjacents = "2"; 
               
                
                $con = mysqli_query($data_connection, "SELECT COUNT(*) AS total_records FROM transaction_history");
                $fetch = mysqli_fetch_array($con);
                $all_data = $fetch['total_records'];
                $total_pages = ceil($all_data/$records);
                $second_last = $total_pages -1;

                //$vtu = "MTN && GLO && 9MOBILE && AIRTEL";
                  $sql1 = "SELECT * FROM transaction_history ORDER BY id DESC LIMIT $offset, $records";
                  $con1 = mysqli_query($data_connection, $sql1);
                  while($transaction = mysqli_fetch_assoc($con1)) { ?>

                  <td> <?php echo $transaction['category']; ?> </td>
                  <td> <?php echo $transaction['phone_number']; ?> </td>
                  <td> <?php echo $transaction['amount']; ?> </td>
                  <td style = "color: red"> <b> <?php if($transaction['status'] == "pending" || $transaction['status'] == "cancelled"){ ?> 
                    <?php echo $transaction['status']; ?></b>
                  <?php } if($transaction['status'] == "Approved" || $transaction['status'] == "SUCCESSFUL"){ ?>
                  <b style = "color: green"> <?php echo $transaction['status']; ?> </b> </td>
                  <?php }?> </td>
                  <td> <?php echo $transaction['transaction_id']; ?> </td>
                  <td> <?php echo $transaction['date']; ?> </td>             

              </tr>
              <?php  } mysqli_close($data_connection); ?>               

             </tbody>
             </table>
             <a href="transaction.php"> <button type="submit" class="btnn btn-primary"> View All </button> </a>
           </div>
           <div style='padding: 10px 10px 0px; border-top: dotted 1px #CCC;'>
         </div>
            <ul class = "pagination"> 
                <?php //if($pages > 1){ echo "<li><a href = '$pages?=1'";} ?>
                  <li <?php if($pages <= 1 ){ echo "class= 'disabled'";} ?> >
                    <a <?php if($pages > 1 ){echo "href = '?pages=1'";} ?>>&lsaquo;&lsaquo; First </a>
                  </li>
                  <li <?php if($pages <= 1 ){ echo "class= 'disabled'";} ?> >
                    <a <?php if($pages > 1 ){echo "href = '?pages=$previous'";} ?>> Prev </a>
                  </li>
                  <?php 
                  if($total_pages <= 10 ){
                    for($count = 1; $count <= $total_pages; $count++){
                      if($count == $pages){
                        echo "<li class = 'active'> <a> $count </a></li>";
                      }else{
                        echo "<li><a href = '?pages=$count'> $count </a></li>";
                      }
                    }
                  }
                  elseif($total_pages > 10){
                    if($pages <= 4){
                    for($count = 1; $count < 8; $count++){
                      if($count == $pages ){
                        echo "<li class = 'active'> <a> $count </a></li>";
                      }else{
                        echo "<li><a href = '?pages=$count'> $count </a></li>";
                      }
                    }
                    echo "<li><a> .... </a> </li>";
                    echo "<li><a href = '?pages=$second_last'> $second_last </a> </li>";
                    echo "<li><a href = '?pages=$total_pages'> $total_pages </a> </li>";
                  }
                  elseif($pages > 4 && $pages < $total_pages - 4 ){
                    echo "<li><a href = '?pages=1'> 1 </a> </li>";
                    echo "<li><a href = '?pages=2'> 2 </a> </li>";
                    for($count = $pages - $adjacents; $count <= $pages + $adjacents; $count++){
                      if($count == $pages){
                        echo "<li class = 'active'> <a> $count </a></li>";
                      }else{
                        echo "<li><a href = '?pages=$count'> $count </a> </li>";
                      }
                    }
                    echo "<li><a> .... </a> </li>";
                    echo "<li><a href = '?pages=$second_last'> $second_last </a> </li>";
                    echo "<li><a href = '?pages=$total_pages'> $total_pages </a> </li>";
                  }
                  else {
                    echo "<li><a href='?pages=1'>1</a></li>";
                    echo "<li><a href='?pages=2'>2</a></li>";
                    echo "<li><a>...</a></li>";
            
                    for ($count = $total_pages - 6; $count <= $total_pages; $count++) {
                      if ($counter == $page_no) {
                   echo "<li class='active'><a>$count</a></li>";  
                    }else{
                       echo "<li><a href='?pages=$count'>$count</a></li>";
                    }                   
                   }
                  }
                }
              ?>
                  <li <?php if($pages >= $total_pages){ echo "class='disbled'"; } ?>>
                  <a <?php if($pages < $total_pages) { echo "href='?pages=$next'"; } ?>>Next</a>
                  </li>
                  <?php if($pages < $total_pages){
                    echo "<li><a href='?pages=$total_pages'>Last &rsaquo;&rsaquo;</a></li>";
                  } ?> 
            </ul>
   	</div>
   </div>
   	</div>
</div>
      	
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