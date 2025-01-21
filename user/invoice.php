<?php
require('../fpdf181/fpdf.php');
require_once "conn.php";
session_start();

$id = $_GET['order'];

$sql = "SELECT * FROM orders WHERE OrderID=$id";
$result = mysqli_query($conn, $sql);
$count = 0;
$totalcost = 0;
$subtotal = 0;
$userID = $_SESSION['user']['id'];
$name = $_SESSION['user']['name'];
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $date = $row['OrderDate'];
    $time = $row['OrderTime'];
    $total = $row['TotalCost'];
    $status = $row['DeliveryStatus'];
}

$pdf = new FPDF('P', 'mm', 'A4');

$pdf->AddPage();

$pdf->SetFont('Arial', '', 40);

$pdf->Cell(200, 20, "Delish Dream", 0, 1, 'C');

$pdf->SetFont('Arial', '', 12);

$pdf->Cell(200, 5, '', 0, 1);
$pdf->Cell(55, 8, "Reference ID", 0, 0);
$pdf->Cell(58, 8, ": $id", 0, 0);
$pdf->Cell(25, 8, 'Date', 0, 0);
$pdf->Cell(52, 8, ": " . $date . " " . $time . "", 0, 1);

$pdf->Cell(55, 8, 'Channel', 0, 0);
$pdf->Cell(52, 8, ': Online', 0, 1);

$pdf->Cell(55, 8, 'Status', 0, 0);
$pdf->Cell(58, 8, ': ' . $status . '', 0, 1);

$pdf->Line(10, 31, 200, 31);
$pdf->Ln(10);
$pdf->Cell(20, 8, 'No.', 0, 0);
$pdf->Cell(70, 8, 'Dish Name', 0, 0);
$pdf->Cell(30, 8, 'Unit Price', 0, 0);
$pdf->Cell(30, 8, 'Quantity', 0, 0);
$pdf->Cell(30, 8, 'Cost', 0, 1);
$pdf->Ln(5);

$products = "SELECT * FROM orders NATURAL JOIN orderdetail NATURAL JOIN dish WHERE OrderID='$id'";
$productGet = mysqli_query($conn, $products);
if (mysqli_num_rows($productGet) > 0) {
    while ($row = mysqli_fetch_assoc($productGet)) {
        $count++;
        $pdf->Cell(20, 8, "$count", 0, 0);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(70, 8, "" . $row['DishName'] . "", 0, 0);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(30, 8, "RM " . sprintf('%0.2f', $row['DishPrice']) . "", 0, 0);
        $pdf->Cell(30, 8, "" . $row['Quantity'] . "", 0, 0);
        $pdf->Cell(30, 8, "RM " . sprintf('%0.2f', $row['DishPrice'] * $row['Quantity']) . "", 0, 1);
        $subtotal += $row['DishPrice'] * $row['Quantity'];
    }
}

$totalcost = $total / 1.06;
if ($subtotal > 40) {
    $shipping = 0;
} else {
    $shipping = 5;
}
$shipping = number_format($shipping, 2);
$pdf->Cell(120, 8, '', 0, 0);
$pdf->Cell(30, 8, 'Total', 0, 0);
$pdf->Cell(30, 8, "RM " . sprintf('%0.2f', $subtotal) . "", 0, 1);

$pdf->Ln(15);
$pdf->Cell(55, 8, 'Service Tax', 0, 0);
$pdf->Cell(58, 8, ": 6 %", 0, 1);

$pdf->Cell(55, 8, 'After tax', 0, 0);
$pdf->Cell(58, 8, ": RM " . sprintf('%0.2f', $subtotal * 1.06) . "", 0, 1);

$pdf->Cell(55, 8, 'Delivery fee', 0, 0);
$pdf->Cell(58, 8, ": RM " . sprintf('%0.2f', $shipping) . "", 0, 1);

$pdf->Cell(55, 8, 'Total paid', 0, 0);
$pdf->Cell(58, 8, ": RM " . sprintf('%0.2f', $total) . "", 0, 1);

$pdf->Line(10, 65, 200, 65);
$pdf->Ln(10); //Line break
$pdf->Cell(55, 8, 'Paid by', 0, 0);
$pdf->Cell(58, 8, ": $name", 0, 1);


$pdf->Ln(5); //Line break
$pdf->Output('D', 'receipt.pdf');
