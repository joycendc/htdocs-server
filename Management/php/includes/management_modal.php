<!-- Add Modal HTML -->
<div id="addProductModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="product_form" method="POST" enctype="multipart/form-data">
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
                                    Browse… <input type="file" id="image" name="image" class="form-control addForm">
                                </span>
                            </span>
                        </div>
                        <img class="center" id='img-upload' />
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control addForm" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" id="desc" name="desc" class="form-control addForm" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" id="price" name="price" class="form-control addForm" required>
                    </div>
                    <div class="form-group">
                        <label for="cat">Category</label>
                        <select type="text" id="cat" name="cat" class="form-control addForm" required>
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
                    <button type="submit" class="btn btn-success" id="btn-add">Add</button>
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
                    <div class="form-group">
                        <label>Image</label>
                        <div class="input-group">
                            <input type="text" id="url" name="url" class="form-control dont_serialize" readonly>
                            <span class="input-group-btn">
                                <span class="btn btn-default btn-file">
                                    Browse… <input type="file" id="imageEdit" name="imageEdit" class="form-control dont_serialize">
                                </span>
                            </span>
                        </div>
                        <img class="center" id='img-edit' />
                    </div>
                    <input type="hidden" id="id_u" name="id" class="form-control editForm" required>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name_u" name="name" class="form-control editForm" required>
                    </div>
                    <div class="form-group">
                        <label for="desc">Description</label>
                        <input type="desc" id="desc_u" name="desc" class="form-control editForm" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" id="price_u" name="price" class="form-control editForm" required>
                    </div>
                    <div class="form-group">
                        <label for="cat">Category</label>
                        <select type="text" id="cat_u" name="cat" class="form-control editForm" required>
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
                    <button type="submit" class="btn btn-info" id="update">Update</button>
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
                    <input type="hidden" id="id_d" name="id_d" class="form-control">
                    <input type="hidden" id="url_d" name="url_d" class="form-control">
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