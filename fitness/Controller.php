<?php 
$servername = "localhost";
$username = "root";
$password = "1234";
$DB = "fitness";
$tablename = "";
//
$current_date = date('Ymd');
if (empty($_POST['page'])) {
	echo "<script>alert('".$current_date."');</script>";
	include("index.php");
}else{		
	require('Model.php');
	$page = $_POST['page'];
	$conn  = connectDB($servername, $username, $password);
	$sql = "use ".$DB;
	$conn->query($sql);	
	//
	if($page == 'addPlan'){
		$tablename = "plan";
		//require('main_model/addPlan_model.php');
		//
		$n1 = $_POST['email'];
		$n2 = $_POST['monday'];
		$n3 = $_POST['tuesday'];
		$n4 = $_POST['wednesday'];
		$n5 = $_POST['thursday'];
		$n6 = $_POST['friday'];
		$n7 = $_POST['saturday'];
		$n8 = $_POST['sunday'];	
		//
		addPlan_insertDB($conn, $tablename, $n1,$n2,$n3,$n4, $n5,$n6,$n7,$n8);	
		//
		closeDB($conn);		
		echo 1;
	}else if($page == 'updatePlan'){	
		$tablename = "plan";
		//require('main_model/updatePlan_model.php');
		//
		$n1 = $_POST['email'];
		$n2 = $_POST['monday'];
		$n3 = $_POST['tuesday'];
		$n4 = $_POST['wednesday'];
		$n5 = $_POST['thursday'];
		$n6 = $_POST['friday'];
		$n7 = $_POST['saturday'];
		$n8 = $_POST['sunday'];	
		//
		updatePlan_updateDB($conn, $tablename, $n1,$n2,$n3,$n4, $n5,$n6,$n7,$n8);	
		//
		closeDB($conn);		
		echo 2;
	}else if($page == 'deletePlan'){
		$tablename = "plan";
		//require('main_model/deletePlan_model.php');	 
		//
		$n1 = $_POST['email'];
		deletePlan_deleteDB($conn, $tablename, $n1);	
		//
		closeDB($conn);	
		//		
		echo 3;
	}else if($page == 'logOut'){
		session_destroy();
		echo 6;
	}else if($page == 'comment'){
		//require('main_model/comment_model.php');
		$tablename = "suggestion";	 
		//
		$n1 = $_POST['email'];
		$n2 = $_POST['subject'];
		$n3 = $_POST['comment'];
		$n4 = date('Ymd');
		
		comment_insertDB($conn, $tablename, $n1,$n2,$n3,$n4);
		//
		closeDB($conn);
		echo 7;
	}else if($page == 'unsubscribe'){
		//require('main_model/unsubscribe_model.php');
		$tablename = "user";	
		//
		$n1 = $_POST['name'];
		$n2 = $_POST['password'];
		//
		$email = "";
		$sql = "SELECT * FROM ".$tablename." where name='".$n1."'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			// output data
			$p1 = "id";
			//
			$p2 = "name";
			$p3 = "password";
			$p4 = "email";
			$p5 = "date";
			
			while($row = $result->fetch_assoc()) {
				$email = $row[$p4];
			}
		}	
		unsubscribe_deleteDB($conn, $tablename, $n1,$n2);
		//
		$sql = "delete FROM suggestion where email='".$email."'";
		$result = $conn->query($sql);
		//
		$sql = "delete FROM plan where email='".$email."'";
		$result = $conn->query($sql);	
		//
		 closeDB($conn);	
		//
		session_destroy();
		 echo 8;
	}else if($page == 'showtable'){
		$data = array();
		//require('main_model/planData_model.php');
		$email = $_POST['email'];
		//			
			$score = 0;
			$tablename = "suggestion";
			$sql = "SELECT count(comment) FROM ".$tablename." where email='".$email."'";
			$result = mysqli_query($conn, $sql);
			$res = mysqli_fetch_array($result);
			$score = $res[0] * 10;
			//closeDB($conn);
		$data['score'] = (string)$score;
		//
		$data['email'] = $email;
		//
		$str = tableData($conn, $email);
		$data['plan'] = $str;	
		//
		$str = "";
		$tablename = "suggestion";
		$sql = "SELECT * FROM ".$tablename;
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			// output data
			$p1 = "id";
			//
			$p2 = "email";
			$p3 = "subject";
			$p4 = "comment";
			$p5 = "date";			

			$str = "";
			$str = $str."<ul>";
			while($row = $result->fetch_assoc()) {								
				$str = $str. "<li>$p2: ".$row[$p2];
				$str = $str. ", $p3: ".$row[$p3];
				$str = $str. ", $p4: ".$row[$p4]."</li>";				
			}
			
			$str = $str. "</ul>";
		}
		$data['comment'] = $str;
		
		closeDB($conn);
		echo json_encode($data);
		//
	}	
	
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
			
			//closeDB($conn);	
			//header('Location:main_controller.php');
			include('main.php');
		}else{
			echo "<script>alert('username or password is not correct!');</script>";
		}
		//
		//closeDB($conn);	
		//
			
		
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