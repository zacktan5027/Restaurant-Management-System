<!-- Edit Product -->
<div class="modal" id="editManager<?php echo $res['StaffID']; ?>" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">
        <div style="display:block;text-align: right;">
            <button class="btn btn-dark" type="button" onclick="document.getElementById('editManager<?php echo $res['StaffID']; ?>').style.display='none'"><i class="fas fa-times"></i></button>
            <center>
                <h2 class="modal-title" id="myModalLabel">Edit Dish</h2>
                <hr>
            </center>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <form method="POST" action="editManager.php" enctype="multipart/form-data">
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Restaurant to Assign:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="hidden" name="managerID" value="<?= $res['StaffID'] ?>">
                                <select class="form-control" name="restaurantID" id="restaurant" required>
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
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-dark" type="button" onclick="document.getElementById('editManager<?php echo $res['StaffID']; ?>').style.display='none'"></span> Close</button>
            <button class="btn btn-main" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span>Edit</button>
            </form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>

<!-- Deactive Manager -->
<div class="modal" id="deactiveManager<?php echo $res['StaffID']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">
        <div style="display:block;text-align: right;">
            <button class="btn btn-dark" type="button" onclick="document.getElementById('deactiveManager<?php echo $res['StaffID']; ?>').style.display='none'"><i class="fas fa-times"></i></button>
            <center>
                <h2 class="modal-title" id="myModalLabel">Deactive Account</h2>
                <hr>
            </center>
        </div>
        <div class="modal-body">
            <h3 class="text-center"><?php echo $res['StaffName']; ?></h3>
        </div>
        <div class="modal-footer">
            <button class="btn btn-dark" type="button" class="btn btn-default" onclick="document.getElementById('deactiveManager<?php echo $res['StaffID']; ?>').style.display='none'"><span class="glyphicon glyphicon-remove"></span> Close</button>
            <?php if ($res['active']) { ?>
                <a class="btn btn-main" href="deactiveManager.php?manager=<?php echo $res['StaffID']; ?>&active=1" class="btn btn-danger">Deactive</a>
            <?php } else { ?>
                <a class="btn btn-main" href="deactiveManager.php?manager=<?php echo $res['StaffID']; ?>&active=0" class="btn btn-danger">Active</a>
            <?php } ?> </form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>