<!-- Edit Product -->
<div class="modal" id="editcategory<?php echo $row['CategoryID']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">
        <div style="display:block;text-align: right;">
            <button class="btn btn-dark" type="button" onclick="document.getElementById('editcategory<?php echo $row['CategoryID']; ?>').style.display='none'"><i class="fas fa-times"></i></button>
            <center>
                <h2 class="modal-title" id="myModalLabel">Edit Category</h2>
                <hr>
            </center>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <form method="POST" action="editcategory.php?category=<?php echo $row['CategoryID']; ?>" enctype="multipart/form-data">
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Category Name:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="<?php echo $row['CategoryName']; ?>" name="cname" required>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-dark" type="button" onclick="document.getElementById('editcategory<?php echo $row['CategoryID']; ?>').style.display='none'">Close</button>
            <button class="btn btn-main" type="submit" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span>Update</button>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Delete Category -->
<div class="modal" id="deactivecategory<?php echo $row['CategoryID']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">
        <div style="display:block;text-align: right;">
            <button class="btn btn-dark" type="button" onclick="document.getElementById('deactivecategory<?php echo $row['CategoryID']; ?>').style.display='none'"><i class="fas fa-times"></i></button>
            <center>
                <h2 class="modal-title" id="myModalLabel">Delete Category</h2>
                <hr>
            </center>
        </div>
        <div class="modal-body">
            <h3 class="text-center"><?php echo $row['CategoryName']; ?></h3>
        </div>
        <div class="modal-footer">
            <button class="btn btn-dark" type="button" onclick="document.getElementById('deactivecategory<?php echo $row['CategoryID']; ?>').style.display='none'">Close</button>
            <?php if ($row['activeCategory']) { ?>
                <a class="btn btn-main" href="deactiveCategory.php?category=<?php echo $row['CategoryID']; ?>&active=1" class="btn btn-danger">Deactive</a>
            <?php } else { ?>
                <a class="btn btn-main" href="deactiveCategory.php?category=<?php echo $row['CategoryID']; ?>&active=0" class="btn btn-danger">Active</a>
            <?php } ?>
        </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>