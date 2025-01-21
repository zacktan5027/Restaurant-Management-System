<!-- Edit Product -->
<div class="modal" id="editDish<?php echo $res['DishID']; ?>" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">
        <div style="display:block;text-align: right;">
            <button class="btn btn-dark" type="button" onclick="document.getElementById('editDish<?php echo $res['DishID']; ?>').style.display='none'"><i class="fas fa-times"></i></button>
            <center>
                <h2 class="modal-title" id="myModalLabel">Edit Dish</h2>
                <hr>
            </center>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <form method="POST" action="editDish.php?dish=<?php echo $res['DishID']; ?>" enctype="multipart/form-data">
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Dish Name:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="<?php echo $res['DishName']; ?>" name="DishName" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Category:</label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control" name="categoryid" required>
                                    <option value="<?php echo $res['CategoryID']; ?>"><?php echo $res['CategoryName']; ?></option>
                                    <?php
                                    $sql = "select * from category where CategoryID != '" . $res['CategoryID'] . "'";
                                    $cquery = $conn->query($sql);
                                    while ($crow = $cquery->fetch_array()) {
                                    ?>
                                        <option value="<?php echo $crow['CategoryID']; ?>"><?php echo $crow['CategoryName']; ?></option>
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
                                <label class="control-label">Dish PerPax: <span style="color:red" class="editPax_error_msg"></label>
                            </div>
                            <div class="col-md-9">
                                <input class="editPax form-control" type="text" value="<?php echo $res['DishPerPax']; ?>" maxlength="1" name="DishPerPax" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Dish Description:</label>
                            </div>
                            <div class="col-md-9">
                                <textarea class="form-control" rows="5" name="DishDescription" required><?= $res['DishDescription']; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Dish Spiciness:</label>
                            </div>
                            <div class="col-md-9">
                                <div style="display: flex;justify-content:space-evenly">
                                    <?php
                                    for ($i = 1; $i < 6; $i++) {
                                        if ($i == $res['DishSpiciness']) {
                                    ?>
                                            <div>
                                                <input type="radio" value="<?= $res['DishSpiciness'] ?>" name="DishSpiciness" checked required>
                                                <label><?= $res['DishSpiciness'] ?></label>
                                            </div>
                                        <?php
                                        } else {
                                        ?>
                                            <div>
                                                <input type="radio" value="<?= $i ?>" name="DishSpiciness" required>
                                                <label><?= $i ?></label>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Price: <span style="color:red" class="editPrice_error_msg"></span></label>
                            </div>
                            <div class="col-md-9">
                                <input class="editPrice  form-control" type="text" value="<?php echo $res['DishPrice']; ?>" maxlength="6" name="DishPrice" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Photo:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="file" style="width: 100%;" name="image">
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-dark" type="button" onclick="document.getElementById('editDish<?php echo $res['DishID']; ?>').style.display='none'"></span> Close</button>
            <button class="btn btn-danger" type="submit">Update</button>
        </div>
        </form>

    </div>
    <!-- /.modal-content -->
</div>

<!-- Delete Dish -->
<div class="modal" id="deactiveDish<?php echo $res['DishID']; ?>" onclick="document.getElementById('deactiveDish<?php echo $res['DishID']; ?>').style.display='none'">
    <div class="modal-content">
        <div style="display:block;text-align: right">
            <button class="btn btn-dark" type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fas fa-times"></i></button>
            <center>
                <h2 class="modal-title" id="myModalLabel">Deactive Dish</h2>
            </center>
            <hr>
        </div>
        <div class="modal-body">
            <h3 class="text-center"><?php echo $res['DishName']; ?></h3>
        </div>
        <div class="modal-footer">
            <button class="btn btn-dark" type="button" onclick="document.getElementById('deactiveDish<?php echo $res['DishID']; ?>').style.display='none'"></span> Close</button>
            <?php if ($res['active']) { ?>
                <a class="btn btn-main" href="deactiveDish.php?dish=<?php echo $res['DishID']; ?>&active=1" class="btn btn-danger">Deactive</a>
            <?php } else { ?>
                <a class="btn btn-main" href="deactiveDish.php?dish=<?php echo $res['DishID']; ?>&active=0" class="btn btn-danger">Active</a>
            <?php } ?>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>