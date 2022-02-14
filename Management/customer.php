<?php
// require "./php/operation.php";
require "./php/init.php";

// Initialize the session
session_start();

// Check if the customer is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
	header("location: ../index.php");
	exit;
}
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="icon" type="image/png" sizes="192x192"  href="../../src/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../src/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../../src/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../src/favicon-16x16.png">
    <link rel="manifest" href="../../src/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="../../src/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
	<title>Customers Management</title>
    <link rel="stylesheet" href="./styles/all.css">
	<link rel="stylesheet" href="./styles/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./styles/style.css">
	<script src="./js/jquery.min.js"></script>
	<script src="./js/jquery.validate.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<script src="./js/ajax.js"></script>

</head>

<body>
	<?php
	    include('./php/includes/navbar.php');
	?>
	<div>
		<?php if($_SESSION['level'] && $_SESSION['level'] == '2'){ ?>
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2><b>Manage Customers</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addCustomerModal" class="btn btn-success" data-toggle="modal"><i class="fas fa-plus-circle"></i> <span>Add New Customer</span></a>
					</div>
				</div>
				
			</div>	
			<div class="headBottom">
				<div class="filter">
					<span>Search: </span>
					<input id="search" class="form-control" type="text" placeholder="Search anything..."/>		
				</div>
			</div>	
			<?php
				//$customers = $db->query("SELECT i.id, i.name, i.description, i.price, i.url, i.cat_id, c.name AS cat FROM items i JOIN category c ON c.id = i.cat_id ORDER BY ID DESC;")->fetchAll();
				$limit = 10;
				$page = (isset($_GET['page']) && is_numeric($_GET['page']) ) ? $_GET['page'] : 1;
				$start = ($page - 1) * $limit;

				$customers = $db->query("SELECT id, first_name, last_name, mobile_number FROM customer ORDER BY ID DESC LIMIT $start, $limit;")->fetchAll();
				//$orders = $db->query("SELECT id, date, queue_id, customer_id, customer_name, SUM(total) AS 'total' FROM transactions GROUP BY DATE_FORMAT(date,'%Y-%M-%d %H:%i');")->fetchAll();
				
				$sql = $db->query("SELECT count(id) AS id FROM customer")->fetchAll();
				$allRecrods = $sql[0]['id'];
				// Calculate total pages
				$totalPages = ceil($allRecrods / $limit); 

										
				// Prev + Next
				$prev = $page - 1;
				$next = $page + 1;
			?>
			<div id="results">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>
							<!--
								 <span class="custom-checkbox">
									<input type="checkbox" id="selectAll">
									<label for="selectAll"></label>
								</span> 
							-->
							</th> 
							<th>FIRST NAME</th>
							<th>LAST NAME NAME</th>
							<th>MOBILE NUMBER</th>
							<th>ACTION</th>
							
						</tr>
					</thead>
					<tbody>
						<?php
						//$products = $db->query("SELECT * FROM items")->fetchAll();
					   
						if (!empty($customers)) {
							foreach ($customers as $customer) {
						?>
							<tr id="<?php echo $customer["id"]; ?>">
								<td>
								<!--
								<span class="custom-checkbox">
								<input type="checkbox" class="customer_checkbox" data-customer-id="<?php echo $row["id"]; ?>">
								<label for="checkbox2"></label>
								</span> 
								-->
								</td>
								
								<td><b><?php echo $customer["first_name"]; ?></b></td>
								<td><b><?php echo $customer["last_name"]; ?></b></td>
								<td><b><?php echo $customer["mobile_number"]; ?></b></td>
							
								<td>
									<a href="#editCustomerModal" class="edit" data-toggle="modal">
										<i class="fas fa-edit customerUpdate" data-toggle="tooltip" data-id="<?php echo $customer["id"]; ?>" data-first_name="<?php echo $customer["first_name"]; ?>" data-last_name="<?php echo $customer["last_name"]; ?>" data-mobile_number="<?php echo $customer["mobile_number"]; ?>" title="Edit"></i>
									</a>
									<a href="#deleteCustomerModal" class="customerDelete" data-id="<?php echo $customer["id"]; ?>" data-toggle="modal"><i class="fas fa-trash" data-toggle="tooltip" title="Delete"></i></a>
								</td>
							</tr>
						<?php
							}
						}
						?>
					</tbody>
				</table>
			</div>	
				<nav aria-label="Page navigation example mt-5">
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
                            <a class="page-link"
                                href="<?php if($page <= 1){ echo '#'; } else { echo "?page=" . $prev; } ?>">Previous</a>
                        </li>
                
                        <?php for($i = 1; $i <= $totalPages; $i++ ): ?>
                        <li class="page-item <?php if($page == $i) {echo 'active'; } ?>">
                            <a class="page-link" href="customer.php?page=<?= $i; ?>"> <?= $i; ?> </a>
                        </li>
                        <?php endfor; ?>
                
                        <li class="page-item <?php if($page >= $totalPages) { echo 'disabled'; } ?>">
                            <a class="page-link"
                                href="<?php if($page >= $totalPages){ echo '#'; } else {echo "?page=". $next; } ?>">Next</a>
                        </li>
                    </ul>
                </nav>
		</div>
		<?php } else { ?>
			<h1 class="text-center">No access</h1>
		<?php } ?>
	</div>
	<!-- Add Modal HTML -->
	<div id="addCustomerModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="customerForm" method="POST" enctype="multipart/form-data">
					<div class="modal-header">
						<h4 class="modal-title">Add Customer</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">

						<div class="form-group">
							<label for="fname">First Name</label>
							<input type="text" id="fname" name="fname" class="form-control addForm" required>
						</div>
						<div class="form-group">
							<label for="lname">Last Name</label>
							<input type="text" id="lname" name="lname" class="form-control addForm" required>
						</div>
						<div class="form-group">
							<label for="number">Mobile Number</label>
							<input type="number" id="number" name="number" class="form-control addForm" required>
						</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" value="1" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="submit" class="btn btn-success" id="customerAdd">Add</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->
	<div id="editCustomerModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="customerUpdate_form">
					<div class="modal-header">
						<h4 class="modal-title">Edit Customer</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="id_u" name="id" class="form-control customerEditForm" required>
						<div class="form-group">
							<label for="fname">First Name</label>
							<input type="text" id="fname_u" name="fname" class="form-control customerEditForm" required>
						</div>
						<div class="form-group">
							<label for="lname">Last Name</label>
							<input type="text" id="lname_u" name="lname" class="form-control customerEditForm" required>
						</div>
						<div class="form-group">
							<label for="number">Mobile Number</label>
							<input type="number" id="number_u" name="number" class="form-control customerEditForm" required>
						</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" value="2" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="submit" class="btn btn-info" id="customerUpdate">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Delete Modal HTML -->
	<div id="deleteCustomerModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>

					<div class="modal-header">
						<h4 class="modal-title">Delete Customer</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="cid_d" name="id_d" class="form-control">
						<p>Are you sure you want to delete this customer?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="hidden" value="3" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-danger" id="customerDelete">Delete</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	

	<script>
		var search = document.getElementById('search');

		search.addEventListener("keyup", (e) => {	
			var text = e.target.value;
			
			console.log(text);
			$.ajax({
				type: "POST",
				url: "./php/searchCustomer.php",
				data: { value: text},
				success:function(data){
				$("#results").html(data);
				}
			});
		});
	</script>
</body>

</html>