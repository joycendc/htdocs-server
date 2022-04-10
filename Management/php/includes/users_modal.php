	<!-- Add Modal HTML -->
    <div id="addUserModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="userForm" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title">Add User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" class="form-control addForm" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" id="password" name="password" class="form-control addForm" required>
                        </div>
                        <div class="form-group">
                            <label for="level">Level</label>
                            <select type="text" id="level" name="level" class="form-control addForm" required>
                                <option value="1">User</option>
                                <option value="2">Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" value="1" name="type">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <button type="submit" class="btn btn-success" id="userAdd">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Modal HTML -->
    <div id="editUserModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="userUpdate_form">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id_u" name="id" class="form-control userEditForm" required>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username_u" name="username" class="form-control userEditForm" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" id="password_u" name="password" class="form-control userEditForm" required>
                        </div>
                        <div class="form-group">
                            <label for="level">Level</label>
                            <select type="text" id="level_u" name="level" class="form-control addForm" required>
                                <option value="1">User</option>
                                <option value="2">Admin</option>
                            </select>
                        </div>
                    
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" value="2" name="type">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <button type="submit" class="btn btn-info" id="userUpdate">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete Modal HTML -->
    <div id="deleteUserModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Delete User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="uid_d" name="id_d" class="form-control">
                        <p>Are you sure you want to delete this user?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" value="3" name="type">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <button type="button" class="btn btn-danger" id="userDelete">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>