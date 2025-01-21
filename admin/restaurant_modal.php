<!-- Edit Product -->
<div class="modal" id="editres<?php echo $row['RestaurantID']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">
        <div style="display:block;text-align: right;">
            <button class="btn btn-dark" type="button" onclick="document.getElementById('editres<?php echo $row['RestaurantID']; ?>').style.display='none'"><i class="fas fa-times"></i></button>
            <center>
                <h2 class="modal-title" id="myModalLabel">Edit Restaurant</h2>
                <hr>
            </center>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <form method="POST" action="editRestaurant.php?restaurant=<?php echo $row['RestaurantID']; ?>" enctype="multipart/form-data">
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Restaurant Name:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="<?php echo $row['RestaurantName']; ?>" name="RestaurantName" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Restaurant Address 1:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="<?php echo $row['RestaurantAddress1']; ?>" name="RestaurantAddress1" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Restaurant Addreess 2:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="<?php echo $row['RestaurantAddress2']; ?>" name="RestaurantAddress2" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Restaurant Postcode :</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="<?php echo $row['RestaurantPostcode']; ?>" name="RestaurantPostcode" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Restaurant City :</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="<?php echo $row['RestaurantCity']; ?>" name="RestaurantCity" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Restaurant State:</label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control" id="state" name="RestaurantState" required>
                                    <option value="<?= $row['RestaurantState'] ?>"><?= $row['RestaurantState'] ?></option>
                                    <option value="Kedah">Kedah</option>
                                    <option value="Pulau Penang">Pulau Penang</option>
                                    <option value="Perlis">Perlis</option>
                                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                                    <option value="Malacca">Malacca</option>
                                    <option value="Selangor">Selangor</option>
                                    <option value="Perak">Perak</option>
                                    <option value="Johor">Johor</option>
                                    <option value="Terengganu">Terengganu</option>
                                    <option value="Kelantan">Kelantan</option>
                                    <option value="Pahang">Pahang</option>
                                    <option value="Sabah">Sabah</option>
                                    <option value="Sarawak">Sarawak</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Table for 2 :</label>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" type="text" value="<?php echo $row['table2']; ?>" name="table2" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Table for 4 :</label>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" type="text" value="<?php echo $row['table4']; ?>" name="table4" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Table for 8 :</label>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" type="text" value="<?php echo $row['table8']; ?>" name="table8" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Photo:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="file" style="width:100%" name="image">
                            </div>
                        </div>
                    </div>
            </div>
        </div>

        <div class="modal-footer">
            <button class="btn btn-dark" type="button" onclick="document.getElementById('editres<?php echo $row['RestaurantID']; ?>').style.display='none'"></span> Close</button>
            <button class="btn btn-main" type="submit" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span> Update</button>
            </form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>

<!-- Delete Dish -->
<div class="modal" id="deleteres<?php echo $row['RestaurantID']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">
        <div style="display:block;text-align: right;">
            <button class="btn btn-dark" type="button" onclick="document.getElementById('deleteres<?php echo $row['RestaurantID']; ?>').style.display='none'"><i class="fas fa-times"></i></button>
            <center>
                <h2 class="modal-title" id="myModalLabel">Delete Restaurant</h2>
                <hr>
            </center>
        </div>
        <div class="modal-body">
            <h3 class="text-center"><?php echo $row['RestaurantName']; ?></h3>
        </div>
        <div class="modal-footer">
            <button class="btn btn-dark" type="button" class="btn btn-default" onclick="document.getElementById('deleteres<?php echo $row['RestaurantID']; ?>').style.display='none'"><span class="glyphicon glyphicon-remove"></span> Close</button>
            <a class="btn btn-main" href="deleteRestaurant.php?restaurant=<?php echo $row['RestaurantID']; ?>" class="btn btn-danger">Yes</a>
            </form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>