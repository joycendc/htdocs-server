<?php
// require "./php/operation.php";
require './php/init.php';

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('location: ../index.php');
    exit();
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" sizes="192x192" href="../../src/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../src/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../../src/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../src/favicon-16x16.png">
    <link rel="manifest" href="../../src/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="../../src/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <title>Product Management</title>
    <link rel="stylesheet" href="./styles/all.css">
    <link rel="stylesheet" href="./styles/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./styles/style.css">
    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/ajax.js"></script>

</head>

<body>
    <?php
    include './php/includes/navbar.php';
    ?>
    <div>
        <?php if($_SESSION['level'] && $_SESSION['level'] == '2'){ ?>
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2><b>Manage Products</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="#addProductModal" class="btn btn-success" data-toggle="modal"><i
                                class="fas fa-plus-circle"></i> <span>Add New Product</span></a>
                    </div>
                </div>

            </div>
            <div class="headBottom">
                <div class="filter">
                    <span>Search: </span>
                    <input id="search" class="form-control" type="text" placeholder="Search anything..." />
                </div>

                <div class="filter">
                    <span>Category: </span>
                    <select class="form-control select" type="text" id="filter" name="filter"
                        onchange="filter(this.value)">
                        <?php
                        $categories = $db->query('SELECT * FROM category;')->fetchAll();
                        echo "<option value='0'>ALL</option>";
                        foreach ($categories as $category) {
                            echo "<option value='" . $category['id'] . "'>" . $category['name'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <?php
            //$products = $db->query("SELECT i.id, i.name, i.description, i.price, i.url, i.cat_id, c.name AS cat FROM items i JOIN category c ON c.id = i.cat_id ORDER BY ID DESC;")->fetchAll();
            $limit = 10;
            $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
            $start = ($page - 1) * $limit;
            
            $products = $db->query("SELECT i.id, i.name, i.description, i.price, i.url, i.cat_id, c.name AS cat FROM items i JOIN category c ON c.id = i.cat_id ORDER BY ID DESC LIMIT $start, $limit;")->fetchAll();
            
            $sql = $db->query('SELECT count(id) AS id FROM items')->fetchAll();
            $allRecords = $sql[0]['id'];
            // Calculate total pages
            $totalPages = ceil($allRecords / $limit);
            
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
						//$products = $db->query("SELECT * FROM items")->fetchAll();
					   
						if (!empty($products)) {
							foreach ($products as $product) {
						?>
                        <tr id="<?php echo $product['id']; ?>">
                            <td>
                                <!--
        <span class="custom-checkbox">
        <input type="checkbox" class="user_checkbox" data-user-id="<?php echo $row['id']; ?>">
        <label for="checkbox2"></label>
        </span>
        -->
                            </td>
                            <td><img class="foodImg" src="../API/images/<?php echo $product['url']; ?>" alt="Food" /></td>
                            <td><b><?php echo $product['name']; ?></b></td>
                            <td style="overflow: hidden;
        max-width: 40ch;"><b><?php echo $product['description']; ?></b></td>
                            <td><b>??? <?php echo $product['price']; ?></b></td>
                            <td><b><?php echo $product['cat']; ?></b></td>
                            <td>
                                <a href="#editProductModal" class="edit" data-toggle="modal">
                                    <i class="fas fa-edit update" data-toggle="tooltip" data-id="<?php echo $product['id']; ?>"
                                        data-url="<?php echo $product['url']; ?>" data-name="<?php echo $product['name']; ?>"
                                        data-desc="<?php echo $product['description']; ?>" data-price="<?php echo $product['price']; ?>"
                                        data-cat="<?php echo $product['cat_id']; ?>" title="Edit"></i>
                                </a>
                                <a href="#deleteProductModal" class="delete" data-id="<?php echo $product['id']; ?>"
                                    data-url="<?php echo $product['url']; ?>" data-toggle="modal"><i class="fas fa-trash"
                                        data-toggle="tooltip" title="Delete"></i></a>
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
                    <li class="page-item <?php if ($page <= 1) {
                        echo 'disabled';
                    } ?>">
                        <a class="page-link" href="<?php if ($page <= 1) {
                            echo '#';
                        } else {
                            echo '?page=' . $prev;
                        } ?>">Previous</a>
                    </li>

                    <?php for($i = 1; $i <= $totalPages; $i++ ): ?>
                    <li class="page-item <?php if ($page == $i) {
                        echo 'active';
                    } ?>">
                        <a class="page-link" href="management.php?page=<?= $i ?>"> <?= $i ?> </a>
                    </li>
                    <?php endfor; ?>

                    <li class="page-item <?php if ($page >= $totalPages) {
                        echo 'disabled';
                    } ?>">
                        <a class="page-link" href="<?php if ($page >= $totalPages) {
                            echo '#';
                        } else {
                            echo '?page=' . $next;
                        } ?>">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
        <?php } else { ?>
        <h1 class="text-center">No access</h1>
        <?php } ?>
    </div>
    <?php
    include './php/includes/management_modal.php';
    ?>
    <script>
        const filter = (item) => {
            $.ajax({
                type: "POST",
                url: "./php/filter.php",
                data: {
                    value: item
                },
                success: function(data) {
                    $("#results").html(data);
                }
            });
        };

        var search = document.getElementById('search');

        search.addEventListener("keyup", (e) => {
            var text = e.target.value;

            console.log(text);
            $.ajax({
                type: "POST",
                url: "./php/searchProduct.php",
                data: {
                    value: text
                },
                success: function(data) {
                    $("#results").html(data);
                }
            });
        });

        $(document).ready(function() {
            $(document).on('change', '.btn-file :file', function() {
                var input = $(this),
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                input.trigger('fileselect', [label]);
            });
            $('.btn-file :file').on('fileselect', function(event, label) {
                var input = $(this).parents('.input-group').find(':text'),
                    log = label;
                if (input.length) {
                    input.val(log);
                } else {
                    if (log) alert(log);
                }
            });

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#img-upload').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#image").change(function() {
                readURL(this);
            });

            function readURL2(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#img-edit').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#imageEdit").change(function() {
                readURL2(this);
            });

        });
    </script>
</body>

</html>
