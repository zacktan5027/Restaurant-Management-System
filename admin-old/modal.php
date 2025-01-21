<!-- Add Product -->
<div class="modal fade" id="addproduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" onclick="document.getElementById('addproduct').style.display='none'">&times;</button>
                <center>
                    <h4 class="modal-title" id="myModalLabel">Add New Dish</h4>
                </center>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" action="addproduct.php" enctype="multipart/form-data">
                        <div class="form-group" style="margin-top:10px;">
                            <div class="row">
                                <div class="col-md-3" style="margin-top:7px;">
                                    <label class="control-label">Dish Name:</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="DishName" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top:10px;">
                            <div class="row">
                                <div class="col-md-3" style="margin-top:7px;">
                                    <label class="control-label">Dish PerPax:</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="DishPerPax" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top:10px;">
                            <div class="row">
                                <div class="col-md-3" style="margin-top:7px;">
                                    <label class="control-label">Dish Description:</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="DishDescription" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top:10px;">
                            <div class="row">
                                <div class="col-md-3" style="margin-top:7px;">
                                    <label class="control-label">Dish Spiciness:</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="DishSpiciness" required>
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
                                        <?php
                                        $sql = "select * from category order by categoryid asc";
                                        $query = $conn->query($sql);
                                        while ($row = $query->fetch_array()) {
                                        ?>
                                            <option value="<?php echo $row['CategoryID']; ?>"><?php echo $row['CategoryName']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3" style="margin-top:7px;">
                                    <label class="control-label">Price:</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="Dishprice" required>
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
                <button type="button" onclick="document.getElementById('addproduct').style.display='none'"></span> Close</button>
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Add Category -->
<div class="modal fade" id="addcategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" onclick="document.getElementById('addcategory').style.display='none'">&times;</button>
                <center>
                    <h4 class="modal-title" id="myModalLabel">Add New Category</h4>
                </center>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" action="addcategory.php" enctype="multipart/form-data">
                        <div class="form-group" style="margin-top:10px;">
                            <div class="row">
                                <div class="col-md-3" style="margin-top:7px;">
                                    <label class="control-label">Category Name:</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="cname" required>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="document.getElementById('addcategory').style.display='none'"></span> Close</button>
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>