<?php
 
$db_con = new mysqli("eu-cdbr-west-02.cleardb.net", "bee6630976934c", "67b57fa6", "heroku_76623c7ddff3ae5");
 
if ($db_con->connect_error) {
    die("DataBase Connection failed: " . $db_con->connect_error);
}
 
$res_output = array('error' => false, 'email'=> false, 'password' => false);
 
$do_act = 'read';
 
if(isset($_GET['do_act'])){
	$do_act = $_GET['do_act'];
}
 
 
if($do_act == 'read'){
	$sql = "select * from customers";
	$query = $db_con->query($sql);
	$Customers = array();
 
	while($row = $query->fetch_array()){
		array_push($Customers, $row);
	}
 
	$res_output['Customers'] = $Customers;
}
 
if($do_act == 'register'){
 
	function checkStr($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
 
	$email = checkStr($_POST['email']);
	$password = checkStr($_POST['password']);
 
	if($email==''){
		$res_output['email'] = true;
		$res_output['message'] = "Client Email is required";
	}
 
	elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$res_output['email'] = true;
		$res_output['message'] = "Invalid Client Email Format";
	}
 
	elseif($password==''){
		$res_output['password'] = true;
		$res_output['message'] = "Client Password is required";
	}
 
	else{
		$sql="select * from customers where email='$email'";
		$query=$db_con->query($sql);
 
		if($query->num_rows > 0){
			$res_output['email'] = true;
			$res_output['message'] = "client Email already exist";
		}
 
		else{
			$sql = "insert into customers (email, password) values ('$email', '$password')";
			$query = $db_con->query($sql);
 
			if($query){
				$res_output['message'] = "Client Added Successfully";
			}
			else{
				$res_output['error'] = true;
				$res_output['message'] = "Could not add Client";
			}
		}
	}
}
 
$db_con->close();
//simple pass a json format data in php 
header("Content-type: application/json");
echo json_encode($res_output);
die();
?>