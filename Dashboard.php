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

if(isset($_GET['id']) && $_GET['id'] != ""){
  $uid = filter_var($_GET['id'], FILTER_SANITIZE_STRING);
  $sql1 = "SELECT * FROM register_info WHERE id = '$uid'";
  $con1 = mysqli_query($data_connection, $sql1);

  $sql2 = "DELETE FROM register_info WHERE id = '$uid'";
  $con2 = mysqli_query($data_connection, $sql2);  
  if($con2){
    echo "<script> alert('The use is delete successfully'); </script>";
  }
}


$request = "";
$param["username"] = "sulyman";
$param["apiKey"] = "sag1pyue8rg85adp7vraemu4gre0dubvw8onutri9hhuu254rcako";
//unique ID, you can use time()
foreach($param as $key=>$val) //traverse through each member of the param array
{
$request .= $key . "=" . urlencode($val); //we have to urlencode the values
$request .= '&'; //append the ampersand (&) sign after each parameter/value pair
}
$len = strlen($request) - 1;
$request = substr($request, 0, $len); //remove the final ampersand sign from the request

$url = "https://subandgain.com/api/balance.php?".$request; //The URL given in the documentation without parameters
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "$url");
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); //return as a variable
$response = curl_exec($ch);
curl_close($ch);
echo $response;

//decode response to get trans_ID,network,phone_number,amount,status and balance
$array = json_decode($response, true); //decode the JSON response

$sagbalance = $array['balance']; 

$sql3 = "SELECT SUM(wallet) as total_wallet FROM register_info";
$res3 = mysqli_query($data_connection, $sql3);
$result2 = mysqli_fetch_assoc($res3);
$totatluserwallet = $result2['total_wallet'];

$sql4 = "SELECT * FROM register_info";
$res4 = mysqli_query($data_connection, $sql4);
$totalcustomers = mysqli_num_rows($res4);

//print_r($_SESSION);

include "header.php";
?>


        <!-- Add your site or application content here -->
		
		
		

		<div class="row">
			<div class="col-md-12 page-heading">
   <div class="breadcrumb-title text-center">
							<h4>Welcome to admin dashboard</h4>
							<div class="breadcrumb-menu">
							<ul>
								<li><a href="dashboard.php"> Home / Dashboard </a></li>
								<li>dashboard</li>
							</ul>
						</div>
			</div>
		</div>
	</div>
	
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
              SubandGain Balance
              </div> 
              <div class="state-value">
                     &#8358; <?php echo $sagbalance;?>           
              </div>
         </div>
                 
              </div>
            </div>
            <div class="col-md-4">
              <div class="panel panel-default sect-page">
                  <div class="sect-page panel-body">
              <div class="label label-succes">
              Admin Balance
            </div>
            <div class="state-value">
                    &#8358; <?php echo $wallet; ?>           
                </div> 
          </div>
                 
              </div>
            </div>
            <div class="col-md-4">
              <div class="panel panel-default sect-page">
                  <div class="sect-page panel-body">
              <div class="label label-succes">
              Ambassador wallet
            </div>
            <div class="state-value">
                    &#8358;0            
                </div>  
          </div>
                 
              </div>
            </div>
          </div> <br/>
          <!-- wallet end -->



          <!-- referral set-->
          <div class="row">
            <div class="col-md-4">
              <div class="panel panel-default sect-page">
         <div class="sect-page panel-body">
              <div class="label label-succes">
              Total customer wallet
              </div> 
              <div class="state-value">
                     &#8358; <?php echo $totatluserwallet; ?>      
              </div>
         </div>
                 
              </div>
            </div>
            <div class="col-md-4">
              <div class="panel panel-default sect-page">
                  <div class="sect-page panel-body">
              <div class="label label-succes">
              Total customers
            </div>
            <div class="state-value">
                    &#8358;<?php echo $totalcustomers; ?>           
                </div> 
          </div>
                 
              </div>
            </div>
            <div class="col-md-4">
              <div class="panel panel-default sect-page">
                  <div class="sect-page panel-body">
              <div class="label label-succes">
              Site status
            </div>
            <div class="state-value">
                    &#8358; <?php if($status == "APPROVED"){
                      echo "<span style = 'color: green'> ACTIVE </span>";
                    }else{
                      echo "<span style = 'color: red'> PENDING </span>";
                    }?>            
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
                <th> Service </th>
                 <th> Number </th>
                  <th> Price </th>
                   <th> Status </th>
                    <th> Trans. Id </th>
                   <th> Date </th>
                 </tr>
               </thead>
             <tbody>
              <?php
                   
                   $sql5 = "SELECT * FROM transaction_history ORDER BY id DESC";
                   $con5 = mysqli_query($data_connection, $sql5);
                   while($transaction = mysqli_fetch_assoc($con5)) { ?>
                    
                   
                   <tr>
                    <td> <?php echo $transaction['category']; ?>
                    <td> <?php echo $transaction['phone_number']; ?>
                    <td> <?php echo $transaction['amount']; ?>
                    <td> <?php echo $transaction['status']; ?>
                    <td> <?php echo $transaction['transaction_id']; ?>
                    <td> <?php echo $transaction['date']; ?>
                   </tr>

                   <?php }?>           
              
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

	      
          <br/>
       
     
          <?php include "footer.php"; ?>