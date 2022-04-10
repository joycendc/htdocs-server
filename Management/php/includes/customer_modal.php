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