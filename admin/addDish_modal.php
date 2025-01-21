<!-- Add Product -->
<div class="modal" id="addproduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">
        <div style="display:block;text-align: right;">
            <button class="btn btn-dark" type="button" onclick="document.getElementById('addproduct').style.display='none'"><i class="fas fa-times"></i></button>
            <center>
                <h2 class="modal-title" id="myModalLabel">Add New Dish</h2>
                <hr>
            </center>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <form method="POST" action="addDish.php" enctype="multipart/form-data">
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
                                <label class="control-label">Dish PerPax: <span style="color:red" class="addPax_error_msg"></label>
                            </div>
                            <div class="col-md-9">
                                <input class="addPax  form-control" type="text" maxlength="1" name="DishPerPax" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Dish Description:</label>
                            </div>
                            <div class="col-md-9">
                                <textarea class="form-control" rows="5" name="DishDescription" required></textarea>
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
                                    ?>
                                        <div>
                                            <input id="<?= $i ?>" type="radio" value="<?= $i ?>" name="DishSpiciness" required>
                                            <label for="<?= $i ?>"><?= $i ?></label>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Category:</label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control" name="categoryID" required>
                                    <option value="">Please choose one category</option>
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
                                <label class="control-label">Price: <span style="color:red" class="addPrice_error_msg"></span></label>
                            </div>
                            <div class="col-md-9">
                                <input class="addPrice form-control" type="text" name="DishPrice" maxlength="6" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Photo:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="file" style="width: 100%;" name="image" required>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-dark" type="button" onclick="document.getElementById('addproduct').style.display='none'"></span> Close</button>
            <button type="submit" class="btn btn-main"><span class="glyphicon glyphicon-floppy-disk"></span> Add</button>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>