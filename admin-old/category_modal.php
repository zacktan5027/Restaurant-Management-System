<!-- Edit Product -->
<div class="modal fade" id="editcategory<?php echo $row['CategoryID']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" onclick="document.getElementById('editcategory<?php echo $row['CategoryID']; ?>').style.display='none'">&times;</button>
            <center>
                <h4 class="modal-title" id="myModalLabel">Edit Category</h4>
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
                                <input type="text" class="form-control" value="<?php echo $row['CategoryName']; ?>" name="cname">
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" onclick="document.getElementById('editcategory<?php echo $row['CategoryID']; ?>').style.display='none'">Close</button>
            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span> Update</button>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Delete Category -->
<div class="modal fade" id="deletecategory<?php echo $row['CategoryID']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" onclick="document.getElementById('deletecategory<?php echo $row['CategoryID']; ?>').style.display='none'">&times;</button>
            <center>
                <h4 class="modal-title" id="myModalLabel">Delete Category</h4>
            </center>
        </div>
        <div class="modal-body">
            <h3 class="text-center"><?php echo $row['CategoryName']; ?></h3>
        </div>
        <div class="modal-footer">
            <button type="button" onclick="document.getElementById('deletecategory<?php echo $row['CategoryID']; ?>').style.display='none'">Close</button>
            <a href="delete_category.php?category=<?php echo $row['CategoryID']; ?>" class="btn btn-danger"><button>Yes</button></a>
        </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>