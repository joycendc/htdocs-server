<?php
    // require "./php/operation.php";
    require "./php/init.php";

    // Initialize the session
    session_start();
    
    // Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
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
    <title>Product Management</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="./styles/fontawesome.min.css">
	<link rel="stylesheet" href="./styles/bootstrap.min.css">
	<link rel="stylesheet" href="./styles/style.css">
	<script src="./js/jquery.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<script src="./js/ajax.js"></script>
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
</head>
<body>
<div class="">
	<p id="success"></p>
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2><b>Manage Products</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addProductModal" class="btn btn-success" data-toggle="modal"><i class="material-icons"></i> <span>Add New Product</span></a>
					</div>
                </div>
            </div>
		
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
						<th>
							<!-- <span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span> -->
						</th>
                        <th>IMAGE</th>
                        <th>NAME</th>
                        <th>DESCRIPTION</th>
						<th>PRICE</th>
                        <th>CATEGORY</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
				<tbody>
				
				<?php
				$products = $db->query("SELECT * FROM items")->fetchAll();
                 
                if (!empty($products)) {
                    foreach ($products as $product){
				?>
				<tr id="<?php echo $product["id"]; ?>">
					<td>
						<!-- <span class="custom-checkbox">
							<input type="checkbox" class="user_checkbox" data-user-id="<?php echo $row["id"]; ?>">
							<label for="checkbox2"></label>
						</span> -->
					</td>
					<td><img class="foodImg" src="../Giligans/images/<?php echo $product["url"]; ?>" alt="Food"/></td>
					<td><?php echo $product["name"]; ?></td>
					<td><?php echo $product["description"]; ?></td>
					<td><?php echo $product["price"]; ?></td>
					<td><?php echo $product["cat_id"]; ?></td>
					<td>
						<a href="#editProductModal" class="edit" data-toggle="modal">
							<i class="material-icons update" data-toggle="tooltip" 
							data-id="<?php echo $product["id"]; ?>"
							data-name="<?php echo $product["name"]; ?>"
							data-desc="<?php echo $product["description"]; ?>"
							data-price="<?php echo $product["price"]; ?>"
							data-cat="<?php echo $product["cat_id"]; ?>"
							title="Edit"></i>
						</a>
						<a href="#deleteProductModal" class="delete" data-id="<?php echo $product["id"]; ?>" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" 
						 title="Delete"></i></a>
                    </td>
				</tr>
				<?php
                    }
				}
				?>
				</tbody>
			</table>
			
        </div>
    </div>
	<!-- Add Modal HTML -->
	<div id="addProductModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="product_form" enctype="multipart/form-data">
					<div class="modal-header">						
						<h4 class="modal-title">Add Product</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">	
						<div class="form-group">
							<label>Upload Image</label>
							<div class="input-group">
								<input type="text" id="url" name="url" class="form-control" readonly>
								<span class="input-group-btn">
									<span class="btn btn-default btn-file">
										Browse… <input type="file" id="image" name="image" class="form-control">
									</span>
								</span>
							</div>
							<img class="center" id='img-upload'/>
						
						</div>
						<div class="form-group">
							<label>Name</label>
							<input type="text" id="name" name="name" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Description</label>
							<input type="email" id="desc" name="desc" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Price</label>
							<input type="phone" id="price" name="price" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Category</label>
							<select type="text" id="cat" name="cat" class="form-control" required>
                            <?php
                            $categories = $db->query("SELECT * FROM category;")->fetchAll(); 
        
                            foreach ($categories as $category) {
                                echo "<option value='" . $category['id'] . "'>" . $category['name'] . "</option>";
                            }
                          ?>
                            </select>
						</div>					
					</div>
					<div class="modal-footer">
					    <input type="hidden" value="1" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-success" id="btn-add">Add</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->
	<div id="editProductModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="update_form">
					<div class="modal-header">						
						<h4 class="modal-title">Edit Product</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="id_u" name="id" class="form-control" required>					
						<div class="form-group">
							<label>Name</label>
							<input type="text" id="name_u" name="name" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Description</label>
							<input type="desc" id="desc_u" name="desc" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Price</label>
							<input type="price" id="price_u" name="price" class="form-control" required>
						</div>
						<div class="form-group">
                      
							<label>Category</label>
							<select type="text" id="cat_u" name="cat" class="form-control" required>
                            <?php
                            $categories = $db->query("SELECT * FROM category;")->fetchAll(); 
        
                            foreach ($categories as $category) {
                                echo "<option value='" . $category['id'] . "'>" . $category['name'] . "</option>";
                            }
                          ?>
                            </select>
						
						</div>					
					</div>
					<div class="modal-footer">
					<input type="hidden" value="2" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-info" id="update">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Delete Modal HTML -->
	<div id="deleteProductModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
						
					<div class="modal-header">						
						<h4 class="modal-title">Delete Product</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="id_d" name="id" class="form-control">					
						<p>Are you sure you want to delete this Product?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-danger" id="delete">Delete</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<script>
	$(document).ready( function() {
    	$(document).on('change', '.btn-file :file', function() {
		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
		});
		$('.btn-file :file').on('fileselect', function(event, label) {	    
		    var input = $(this).parents('.input-group').find(':text'),
		        log = label;   
		    if( input.length ) {
		        input.val(log);
		    } else {
		        if( log ) alert(log);
		    }
		});
		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();	        
		        reader.onload = function (e) {
		            $('#img-upload').attr('src', e.target.result);
		        }	        
		        reader.readAsDataURL(input.files[0]);
		    }
		}
		$("#image").change(function(){
		    readURL(this);
		}); 	
	});
	</script>
</body>
</html>