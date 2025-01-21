<!-- Add restaurant -->
<div class="modal" id="addres" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">
        <div style="display:block;text-align: right;">
            <button class="btn btn-dark" type="button" onclick="document.getElementById('addres').style.display='none'"><i class="fas fa-times"></i></button>
            <center>
                <h2 class="modal-title" id="myModalLabel">Add New Restaurant</h2>
                <hr>
            </center>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <form method="POST" action="addRestaurant.php" enctype="multipart/form-data">
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Restaurant Name:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="RestaurantName" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Restaurant Address 1:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="RestaurantAddress1" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Restaurant Address 2:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="RestaurantAddress2" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Postcode:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="RestaurantPostcode" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Restaurant City:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="RestaurantCity" required>
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
                                    <option value="">Please choose one</option>
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
                                <input class="form-control" type="number" name="table2" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Table for 4 :</label>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" type="number" name="table4" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Table for 8 :</label>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" type="number" name="table8" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Photo:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="file" style="width:100%" name="image" required>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-dark" type="button" onclick="document.getElementById('addres').style.display='none'"></span> Close</button>
            <button class="btn btn-main" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Add</button>
            </form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>