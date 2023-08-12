<?php 
include "database_connection.php";
include "header.php"; 
?>
	<div class="container">
      <div class="row">
      	<div class="col-md-12">
      		<div class="wrapper-content">
      			<div class="wrap-inside">
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
                   
                   $sql5 = "SELECT * FROM transaction_history ORDER BY id ASC";
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
<?php include "footer.php"; ?>