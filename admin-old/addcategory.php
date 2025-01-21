<?php
include('conn.php');

$cname = $_POST['cname'];

$cname = strtoupper($cname);

$sql = "select * from category WHERE CategoryName = '" . $cname . "' order by CategoryID asc";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    echo ("<script>
            window.alert('Category name exist please use another one.');
            window.location.href='category.php';
            </script>");
} else {
    $sql = "insert into category (CategoryName) values ('$cname')";
    $conn->query($sql);
    echo ("<script>
            window.alert('Successfully added new category');
            window.location.href='category.php';
            </script>");
}
