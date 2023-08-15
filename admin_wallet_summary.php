<?php 
session_start();
include "database_connection.php";
$required = "";

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

$sql1 = "SELECT SUM(wallet) AS total_wallet FROM transaction_history ";
$con1 = mysqli_query($data_connection, $sql1);
$assoc1 = mysqli_fetch_assoc($con1);
$total_user_wallet = $assoc1['total_wallet'];

$sql2 = "SELECT * FROM transaction_history ORDER BY id DESC ";
$con2 = mysqli_query($data_connection, $sql2);
$assoc2 = mysqli_fetch_assoc($con2);
$amount = $assoc2['amount'];




include "header.php";
?> 
     

        <!-- Add your site or application content here -->
		
		<div class="row">
			<div class="col-md-12 page-heading">
   <div class="breadcrumb-title text-center">
							<h4>USER WALLET SUMMARY</h4>
							<div class="breadcrumb-menu">
							<ul>
								<li><a href="dashboard.php"> Account / User Wallet Summary </a></li>
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
          <div class="row">
            <div class="col-md-4">
              <div class="panel panel-default sect-page">
         <div class="sect-page panel-body">
              <div class="label label-succes">
              Total wallet Funding
              </div> 
              <div class="state-value">
                     &#8358;<?php echo $total_user_wallet; ?>           
              </div>
         </div>
                 
              </div>
            </div>
    </div>
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
                <th> Reference Number </th>
                 <th>  Amount </th>
                 <th>  Before </th>
                  <th> After </th>
                   <th> Date </th>
                 </tr>
            </thead>
             <tbody>
                <tr>
                <?php
                $after = $total_user_wallet - $amount;
                  
                  $sql2 = "SELECT * FROM transaction_history ORDER BY id DESC";
                  $con2 = mysqli_query($data_connection, $sql2);
                  while($summary = mysqli_fetch_assoc($con2)){ ?> 

                    <td> <?php echo $summary['transaction_id']; ?> </td>
                    <td> <?php echo $summary['amount']; ?> </td>
                    <td> <?php echo $summary['before_transaction']; ?> </td>
                    <td> <?php echo $summary['after']; ?> </td>
                    <td> <?php echo $summary['date']; ?> </td>
                </tr>
                <?php  }   ?>
                
             </tbody>
             </table>
             <a href="transaction.php"> <button type="submit" class="btnn btn-primary"> View All </button> </a>
           </div>
         </div>
   	</div>
   </div>
   	</div>
</div>
      	
      	</div>

      </div>
    </div>
</div>
</div>

<?php 
include "footer.php";
?> 