<?php 
$servername = "localhost";
$username = "root";
$password = "1234";
$DB = "fitness";
$tablename = "suggestion";
//
$current_date = date('Ymd');
if (empty($_POST['page'])) {
	echo "<script>alert('".$current_date."');</script>";
	include("index.php");
}else{
	$page = $_POST['page'];
	require('Model.php');
	$conn  = connectDB($servername, $username, $password);
	$sql = "use ".$DB;
	$conn->query($sql);
	//
	if($page == 'visitor'){
		echo "<script>alert('visitor');</script>";
		//require('index_model/visitor_model.php');
		//
		$n1 = $_POST['email'];
		$n2 = $_POST['subject'];
		$n3 = $_POST['comment'];
		$n4 = $current_date;
		//	
		visitor_insertDB($conn, $tablename, $n1,$n2,$n3,$n4);
		//
		
		echo "<script>alert('comment successfully!');</script>";
		header('Location:index_controller.php');
		
	}else if($page == 'signIn'){
		$tablename = "user";
		echo "<script>alert('signIn');</script>";
		//require('index_model/signIn_model.php');
		//
		$n1 = $_POST['name'];
		$n2 = $_POST['password'];
		$n2 = md5($n2);
		if(signin_selectDB($conn, $tablename, $n1,$n2)){
			session_start();
			$_SESSION["name"] = $n1;
			$_SESSION["password"] = $n2;
			
			//
			$email = "";
			$date = "";
			$sql = "SELECT * FROM user where name='".$_SESSION["name"]."'";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				// output data
				$p1 = "id";
				//
				$p2 = "name";
				$p3 = "password";
				$p4 = "email";
				$p5 = "date";
				//
				while($row = $result->fetch_assoc()) {
					$email = $row[$p4];
					$date = $row[$p5];
				}
			}
			$_SESSION["email"] = $email;
			$_SESSION["date"] = $date;
			//		
			echo "<script>alert('login successfully!');</script>";	
			echo $_SESSION["name"]."<br/>";
			echo $_SESSION["password"]."<br/>";
			echo $_SESSION["email"]."<br/>";
			echo $_SESSION["date"]."<br/>";
			//closeDB($conn);	
			header('Location:main_controller.php');
		}
		//
		//closeDB($conn);	
		//
		echo "<script>alert('username or password is not correct!');</script>";	
		
	}else if($page == 'join'){
		echo "<script>alert('join');</script>";
		//require('index_model/join_model.php');
		//
		$n1 = $_POST['name'];
		$n2 = $_POST['password'];
		$n2 = md5($n2);
		$n3 = $_POST['email'];
		$n4 = $current_date;
		//
		join_insertDB($conn, $tablename, $n1,$n2,$n3,$n4);
		//
		//closeDB($conn);	
		//	
		header('Location:index_controller.php');
		echo "<script>alert('join successfully!');</script>";
	}else{
		//
		include ('index.php');	
		//
	}
	closeDB($conn);		
}


?>