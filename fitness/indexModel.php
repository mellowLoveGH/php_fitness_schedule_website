<?php
	$servername = "localhost";
	$username = "root";
	$password = "1234";
	$DB = "fitness";
	$tablename = "user";

	 // connect server
	 function connectDB($servername, $username, $password){		 
		$conn = new mysqli($servername, $username, $password);
		if ($conn->connect_error) {
			die("cannot connect server: " . $conn->connect_error);
			echo '<br>';
		} 
		 
		 return $conn;
	 }	 
	 
	 //
	 function join_insertDB($conn, $tablename, $n1,$n2,$n3,$n4){
		$p1 = "id";
		//
		$p2 = "name";
		$p3 = "password";
		$p4 = "email";
		$p5 = "date";
		
		//insert into user (name, password, email, date) values ('abc','123','000@gmail.com',1903232000);
		//$sql = "insert into user ($p1, $p2, $p3, $p4) values ('$n1','$n2','$n3',$n4);";
		$sql = "insert into ".$tablename." ($p2, $p3, $p4, $p5) values ('$n1','$n2','$n3',$n4);";
		
		if ($conn->query($sql) === TRUE) {
			echo "insert successfully!";
			echo '<br>';
		}else{
			echo "bug";
			echo '<br>';
		}
	 }
	
	 //
	 function signin_selectDB($conn, $tablename, $n1,$n2){
		$sql = "SELECT * FROM user where name='".$n1."' and password='".$n2."'";
		$result = $conn->query($sql);
		if ($result->num_rows <= 0) {
			return false;
		}
		return true;
	 }	 
	
	 //
	 function visitor_insertDB($conn, $tablename, $n1,$n2,$n3,$n4){
		$p1 = "id";
		//
		$p2 = "email";
		$p3 = "subject";
		$p4 = "comment";
		$p5 = "date";
		
		//insert into user (name, password, email, date) values ('abc','123','000@gmail.com',1903232000);
		$sql = "insert into ".$tablename." ($p2, $p3, $p4, $p5) values ('$n1','$n2','$n3',$n4)";		
		if ($conn->query($sql) === TRUE) {
			echo "insert successfully!";
			echo '<br>';
		}
	 }
	 
	 //close DB
	 function closeDB($conn){
		 $conn->close();
	 }
?>