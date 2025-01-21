<?php
require_once 'DbConnect.php';

$response = array();

if (isset($_GET['apicall'])) {
	switch ($_GET['apicall']) {
		case 'signup':
			if (isTheseParametersAvailable(array('username', 'email', 'password', 'gender'))) {
				$username = $_POST['username'];
				$email = $_POST['email'];
				$password = md5($_POST['password']);
				$gender = $_POST['gender'];
				$stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
				$stmt->bind_param("ss", $username, $email);
				$stmt->execute();
				$stmt->store_result();
				if ($stmt->num_rows > 0) {
					$response['error'] = true;
					$response['message'] = 'User already registered';
					$stmt->close();
				} else {
					$stmt = $conn->prepare("INSERT INTO users (username, email, password, gender) VALUES (?, ?, ?, ?)");
					$stmt->bind_param("ssss", $username, $email, $password, $gender);
					if ($stmt->execute()) {
						$stmt = $conn->prepare("SELECT id, id, username, email, gender FROM users WHERE username = ?");
						$stmt->bind_param("s", $username);
						$stmt->execute();
						$stmt->bind_result($userid, $id, $username, $email, $gender);
						$stmt->fetch();
						$user = array(
							'id' => $id,
							'username' => $username,
							'email' => $email,
							'gender' => $gender
						);
						$stmt->close();
						$response['error'] = false;
						$response['message'] = 'User registered successfully';
						$response['user'] = $user;
					}
				}
			} else {
				$response['error'] = true;
				$response['message'] = 'required parameters are not available';
			}
			break;
		case 'login':
			if (isTheseParametersAvailable(array('username', 'password'))) {
				$username = $_POST['username'];
				$password = $_POST['password'];
				$stmt = $conn->prepare("SELECT StaffPassword, StaffID, RestaurantID FROM staff WHERE StaffUsername = ?");
				$stmt->bind_param("s", $username);
				$stmt->execute();
				$stmt->store_result();
				if ($stmt->num_rows > 0) {
					$stmt->bind_result($passworddb, $id, $restaurant);
					$stmt->fetch();
					if (password_verify($password, $passworddb)) {
						$user = array(
							'id' => $id,
							'restaurant' => $restaurant,
						);
						$response['error'] = false;
						$response['message'] = 'Login successfull';
						$response['user'] = $user;
					} else {
						$response['error'] = false;
						$response['message'] = 'Invalid username or password';
					}
				} else {
					$response['error'] = false;
					$response['message'] = 'Invalid username or password';
				}
			}
			break;
		case 'getOrders':
			if (isTheseParametersAvailable(array('restaurantID'))) {
				$restaurantID = $_POST['restaurantID'];
				// $stmt = $conn->prepare("SELECT OrderID,AccountName,Destination FROM orders NATURAL JOIN account WHERE DeliveryStatus='done prepared' AND RestaurantID=?");
				$stmt = $conn->prepare("SELECT * FROM orders WHERE DeliveryStatus='Done Prepared' AND RestaurantID=?");
				$stmt->bind_param("i", $restaurantID);
				$stmt->execute();
				$emptyOrder = true;
				$orders = null;
				$orderdb = mysqli_stmt_get_result($stmt);
				while ($row = mysqli_fetch_assoc($orderdb)) {
					$orders[] = array(
						'orderID' => $row['OrderID'],
						'accountName' => $row['AccountName'],
						'accountMobile' => $row['AccountPhoneNumber'],
						'orderTime' => $row['OrderTime'],
						'totalCost' => $row['TotalCost'],
						'destination' => $row['Destination'],
						'paymentMethod' => $row['PaymentMethod'],
						'notes' => $row['Notes']
					);
					$emptyOrder = false;
				}
				$response['error'] = false;
				$response['message'] = 'Load successful';
				if ($emptyOrder) {
					$response['empty'] = true;
					$response['orders'] = $orders;
				} else {
					$response['empty'] = false;
					$response['orders'] = $orders;
				}
			} else {
				$response['error'] = false;
				$response['message'] = 'Fail to load orders';
			}
			break;
		case 'getOrderDetail':
			if (isTheseParametersAvailable(array('orderID'))) {
				$orderID = $_POST['orderID'];
				$stmt = $conn->prepare("SELECT DishName, Quantity FROM `orderdetail` natural join dish natural join orders WHERE OrderID=?");
				$stmt->bind_param("i", $orderID);
				$stmt->execute();
				$orderDetaildb = mysqli_stmt_get_result($stmt);
				while ($row = mysqli_fetch_assoc($orderDetaildb)) {
					$orderDetails[] = array(
						'dishName' => $row['DishName'],
						'quantity' => $row['Quantity'],
					);
				}
				$response['error'] = false;
				$response['message'] = 'Successfully Loaded';
				$response['orderDetail'] = $orderDetails;
			} else {
				$response['error'] = false;
				$response['message'] = 'Failed to load';
			}
			break;
		case 'completeDelivery':
			if (isTheseParametersAvailable(array('orderID'))) {
				$orderID = $_POST['orderID'];
				$stmt = $conn->prepare("UPDATE `orders` SET `DeliveryStatus`='Delivered' WHERE OrderID=?");
				$stmt->bind_param("i", $orderID);
				$stmt->execute();
				$response['error'] = false;
				$response['message'] = 'Delivered successfully';
			} else {
				$response['error'] = false;
				$response['message'] = 'Fail to update to server, please contact you supervisor';
			}
			break;
		default:
			$response['error'] = true;
			$response['message'] = 'Invalid Operation Called';
	}
} else {
	$response['error'] = true;
	$response['message'] = 'Invalid API Call';
}

echo json_encode($response);

function isTheseParametersAvailable($params)
{
	foreach ($params as $param) {
		if (!isset($_POST[$param])) {
			return false;
		}
	}
	return true;
}
