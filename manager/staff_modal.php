<!-- Edit Product -->
<div class="modal" id="editStaff<?php echo $res['StaffID']; ?>" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">
        <div style="display:block;text-align: right;">
            <button class="btn btn-dark" type="button" onclick="document.getElementById('editStaff<?php echo $res['StaffID']; ?>').style.display='none'"><i class="fas fa-times"></i></button>
            <center>
                <h2 class="modal-title" id="myModalLabel">Edit Staff</h2>
                <hr>
            </center>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <form method="POST" action="editStaff.php" enctype="multipart/form-data">
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" name="staffID" value="<?= $res['StaffID'] ?>">
                                <div class="form-group" style="margin-top:10px;">
                                    <div class="row">
                                        <div class="col-md-3" style="margin-top:7px;">
                                            <label class="control-label">Name:</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="staffName" placeholder="Enter Name" value="<?= $res['StaffName'] ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-top:10px;">
                                    <div class="row">
                                        <div class="col-md-3" style="margin-top:7px;">
                                            <label class="control-label">Email:</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input id="email" type="text" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{3}" name="staffEmail" value="<?= $res['StaffEmail'] ?>" maxlength="30" placeholder="Enter Email" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-top:10px;">
                                    <div class="row">
                                        <div class="col-md-3" style="margin-top:7px;">
                                            <label class="control-label">Phone Number: <span style="color:red" id="phone_error_msg"></span></label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" id="phoneNumber" class="form-control" placeholder="Enter Phone Number" name="staffPhoneNumber" value="<?= $res['StaffPhoneNumber'] ?>" pattern=".{10,11}" maxlength="11" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-dark" type="button" onclick="document.getElementById('editStaff<?php echo $res['StaffID']; ?>').style.display='none'"></span> Close</button>
            <button class="btn btn-main" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span>Edit</button>
            </form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>

<!-- Deactive Manager -->
<div class="modal" id="deactiveStaff<?php echo $res['StaffID']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">
        <div style="display:block;text-align: right;">
            <button class="btn btn-dark" type="button" onclick="document.getElementById('deactiveStaff<?php echo $res['StaffID']; ?>').style.display='none'"><i class="fas fa-times"></i></button>
            <center>
                <h2 class="modal-title" id="myModalLabel">Deactive Account</h2>
                <hr>
            </center>
        </div>
        <div class="modal-body">
            <h3 class="text-center"><?php echo $res['StaffName']; ?></h3>
        </div>
        <div class="modal-footer">
            <button class="btn btn-dark" type="button" class="btn btn-default" onclick="document.getElementById('deactiveStaff<?php echo $res['StaffID']; ?>').style.display='none'"><span class="glyphicon glyphicon-remove"></span> Close</button>
            <?php if ($res['active']) { ?>
                <a class="btn btn-main" href="deactiveStaff.php?staff=<?php echo $res['StaffID']; ?>&active=1" class="btn btn-danger">Deactive</a>
            <?php } else { ?>
                <a class="btn btn-main" href="deactiveStaff.php?staff=<?php echo $res['StaffID']; ?>&active=0" class="btn btn-danger">Active</a>
            <?php } ?> </form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>