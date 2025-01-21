<!-- Add restaurant -->
<div class="modal" id="addStaff" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">
        <div style="display:block;text-align: right;">
            <button class="btn btn-dark" type="button" onclick="document.getElementById('addStaff').style.display='none'"><i class="fas fa-times"></i></button>
            <center>
                <h2 class="modal-title" id="myModalLabel">Add New Staff</h2>
                <hr>
            </center>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <form method="POST" action="addStaff.php" enctype="multipart/form-data">
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Username:</label>
                            </div>
                            <div class="col-md-9">
                                <input id="username" type="text" class="form-control" name="staffUsername" placeholder="Enter Username" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Password:</label>
                            </div>
                            <div class="col-md-9">
                                <input id="pwd" type="password" class="form-control" placeholder="Enter Password" name="staffPassword" minlength="8" maxlength="12" required>
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
                                <input id="pwd2" type="password" class="form-control" placeholder="Confirm Password" name="staffPassword2" minlength="8" maxlength="12" required>
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
                                <input type="text" class="form-control" name="staffName" placeholder="Enter Name" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Email:</label>
                            </div>
                            <div class="col-md-9">
                                <input id="email" type="text" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{3}" name="staffEmail" maxlength="30" placeholder="Enter Email" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Phone Number: <span style="color:red" id="phone_error_msg"></span></label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="phoneNumber" class="form-control" placeholder="Enter Phone Number" name="staffPhoneNumber" pattern=".{10,11}" maxlength="11" required>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-dark" type="button" onclick="document.getElementById('addStaff').style.display='none'"></span> Close</button>
            <button class="btn btn-main" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Add</button>
            </form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>