<?php 
require_once('../class/Sales.php');
$sales = new sales(); // <-- IMPORTANT
if(isset($_GET['date'])){
	$date = $_GET['date']; 

	$reports = $sales->daily_sales($date);
	// echo '<pre>';
	// print_r($reports);
	// echo '</pre>';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-theme.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

    <link href="../assets/css/dataTables.bootstrap.min.css" rel="stylesheet">

  </head>
  <body>
 <center>
	<h1>Daily Sales Report</h1>
 	<h2>as of</h2>
 	<h3><?= $date; ?></h3>
 </center>
<br />
<div class="table-responsive">
        <table id="myTable-report" class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Customer Name</th>
                    <th><center>Type</center></th>
                    <th><center>Laundry Received</center></th>
                    <th><center>Date Paid</center></th>
                    <th><center>Amount</center></th>
                </tr>
            </thead>
            <tbody>
            	<?php 
            		$total = 0;
            		foreach($reports as $r): 
            		$total += $r['sale_amount'];
            	?>   <tr align="center">
	                    <td align="left"><?= $r['sale_customer_name']; ?></td>
	                    <td><?= $r['sale_type_desc']; ?></td>
	                    <td><?= $r['sale_laundry_received']; ?></td>
	                    <td><?= $r['sale_date_paid']; ?></td>
	                    <td><?= '₱ '.number_format($r['sale_amount'], 2); ?></td>
	                </tr>
	            <?php endforeach; ?>
            </tfoot>
	            <tr>
	            	<td></td>
	            	<td></td>
	            	<td></td>
	            	<td align="right"><strong>TOTAL:</strong></td>
	            	<td align="center"><strong><?='₱'.number_format($total,2); ?></strong></td>
	            </tr>
                    </tfoot>
                </div>
 <!-- JS LIBRARIES -->
 <script src="../assets/js/jquery.min.js"> </script>
<script src="../assets/js/jquery.datatables.min.js"></script>
<script src="../assets/js/datatables.bootstrap.min.js"></script>

<!-- for the datatable of employee -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#myTable-report').DataTable();
    });
</script>
</body>
</html>
<script> window.onload=function () {window.print();}
</script>
<?php
}//end isset?