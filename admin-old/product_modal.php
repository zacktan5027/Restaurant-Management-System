<!-- Edit Product -->
<div class="modal fade" id="editproduct<?php echo $row['DishID']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" onclick="document.getElementById('editproduct<?php echo $row['DishID']; ?>').style.display='none'">&times;</button>
                <center>
                    <h4 class="modal-title" id="myModalLabel">Edit Dish</h4>
                </center>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" action="editproduct.php?dish=<?php echo $row['DishID']; ?>" enctype="multipart/form-data">
                        <div class="form-group" style="margin-top:10px;">
                            <div class="row">
                                <div class="col-md-3" style="margin-top:7px;">
                                    <label class="control-label">Dish Name:</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" value="<?php echo $row['DishName']; ?>" name="DishName">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3" style="margin-top:7px;">
                                    <label class="control-label">Category:</label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-control" name="categoryid">
                                        <option value="<?php echo $row['CategoryID']; ?>"><?php echo $row['CategoryName']; ?></option>
                                        <?php
                                        $sql = "select * from category where CategoryID != '" . $row['CategoryID'] . "'";
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
                                    <label class="control-label">Dish PerPax:</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" value="<?php echo $row['DishPerPax']; ?>" name="DishPerPax" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top:10px;">
                            <div class="row">
                                <div class="col-md-3" style="margin-top:7px;">
                                    <label class="control-label">Dish Description:</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" value="<?php echo $row['DishDescription']; ?>" name="DishDescription" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top:10px;">
                            <div class="row">
                                <div class="col-md-3" style="margin-top:7px;">
                                    <label class="control-label">Dish Spiciness:</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" value="<?php echo $row['DishSpiciness']; ?>" name="DishSpiciness" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3" style="margin-top:7px;">
                                    <label class="control-label">Price:</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" value="<?php echo $row['DishPrice']; ?>" name="DishPrice">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3" style="margin-top:7px;">
                                    <label class="control-label">Photo:</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="file" name="image">
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="document.getElementById('editproduct<?php echo $row['DishID']; ?>').style.display='none'"></span> Close</button>
                <button type="submit">Update</button>
            </div>
            </form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>

<!-- Delete Dish -->
<div class="modal fade" id="deleteproduct<?php echo $row['DishID']; ?>" onclick="document.getElementById('deleteproduct<?php echo $row['DishID']; ?>').style.display='none'">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <center>
                <h4 class="modal-title" id="myModalLabel">Delete Dish</h4>
            </center>
        </div>
        <div class="modal-body">
            <h3 class="text-center"><?php echo $row['DishName']; ?></h3>
        </div>
        <div class="modal-footer">
            <button type="button" onclick="document.getElementById('deleteproduct<?php echo $row['DishID']; ?>').style.display='none'"></span> Close</button>
            <?php if ($row['active']) { ?>
                <a href="delete_product.php?dish=<?php echo $row['DishID']; ?>&active=1" class="btn btn-danger"><button>Deactive</button></a>
            <?php } else { ?>
                <a href="delete_product.php?dish=<?php echo $row['DishID']; ?>&active=0" class="btn btn-danger"><button>Active</button></a>
            <?php } ?>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>