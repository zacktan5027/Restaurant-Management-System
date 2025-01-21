<!-- Add restaurant -->
<div class="modal" id="addManager" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">
        <div style="display:block;text-align: right;">
            <button class="btn btn-dark" type="button" onclick="document.getElementById('addManager').style.display='none'"><i class="fas fa-times"></i></button>
            <center>
                <h2 class="modal-title" id="myModalLabel">Add New Manager</h2>
                <hr>
            </center>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <form method="POST" action="addManager.php" enctype="multipart/form-data">
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Username:</label>
                            </div>
                            <div class="col-md-9">
                                <input id="username" type="text" class="form-control" name="ManagerUsername" placeholder="Enter Username" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Password:</label>
                            </div>
                            <div class="col-md-9">
                                <input id="pwd" type="password" class="form-control" placeholder="Enter Password" name="ManagerPassword" minlength="8" maxlength="12" required>
                                <div id="message">
                                    <h3>Password must contain the following:</h3>
                                    <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                                    <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                                    <p id="number" class="invalid">A <b>number</b></p>
                                    <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Confirm Address 2:</label>
                            </div>
                            <div class="col-md-9">
                                <input id="pwd2" type="password" class="form-control" placeholder="Confirm Password" name="ManagerPassword2" minlength="8" maxlength="12" required>
                                <div id="message2">
                                    <h3>Password must match with the previous password:</h3>
                                    <p id="letter2" class="invalid"><b>Match</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Name:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="ManagerName" placeholder="Enter Name" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Restaurant to Assign:</label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control" name="restaurantID" id="restaurant">
                                    <option value="">Please choose one restaurant</option>
                                    <?php
                                    $sql = "select * from restaurant";
                                    $query = $conn->query($sql);
                                    while ($row = $query->fetch_array()) {
                                    ?>
                                        <option value="<?php echo $row['RestaurantID']; ?>"><?php echo $row['RestaurantName']; ?> - <?php echo $row['RestaurantAddress1'] . ',' . $row['RestaurantAddress2'] . ',' . $row['RestaurantPostcode'] . ' ' . $row['RestaurantCity'] . ',' . $row['RestaurantState']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Email:</label>
                            </div>
                            <div class="col-md-9">
                                <input id="email" type="text" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{3}" name="ManagerEmail" maxlength="30" placeholder="Enter Email" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Phone Number: <span style="color:red" id="phone_error_msg"></span></label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="phoneNumber" class="form-control" placeholder="Enter Phone Number" name="ManagerPhoneNumber" pattern=".{10,11}" maxlength="11" required>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-dark" type="button" onclick="document.getElementById('addManager').style.display='none'"></span> Close</button>
            <button class="btn btn-main" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Add</button>
            </form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>