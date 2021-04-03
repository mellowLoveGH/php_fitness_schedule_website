<?php
	$servername = "localhost";
	$username = "root";
	$password = "1234";
	$DB = "fitness";
	$tablename = "suggestion";	 
	
	//	
	error_reporting( E_ALL&~E_NOTICE );
	
		// connect server
		 function connectDB($servername, $username, $password){		 
			$conn = new mysqli($servername, $username, $password);
			if ($conn->connect_error) {
				
			} 
			return $conn;
		 }
		
		//close DB
		 function closeDB($conn){
			 $conn->close();
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
		 
		//
		function subPlan($str, $num){
			$var = explode("::",$str);
			return $var[$num];
		}
		
		function tableData($conn, $email){
			$str = "";
			$planData = false;
			//
			$weekday = array("","","","","","","");
			for($i=0; $i<7; $i++){
				$weekday[$i] = "";
			}
			//
			
			$tablename = "plan";
			$sql = "SELECT * FROM plan where email='".$email."'";
			//$sql = "SELECT * FROM plan where id=6";
			//
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				$planData = true;			
				// output data
				$p1 = "email";
				$p2 = "monday";
				$p3 = "tuesday";
				$p4 = "wednesday";		
				$p5 = "thursday";
				$p6 = "friday";
				$p7 = "saturday";
				$p8 = "sunday";
				
				while($row = $result->fetch_assoc()) {					
					$weekday[0] = $row[$p2];
					$weekday[1] = $row[$p3];
					$weekday[2] = $row[$p4];
					$weekday[3] = $row[$p5];
					$weekday[4] = $row[$p6];
					$weekday[5] = $row[$p7];
					$weekday[6] = $row[$p8];
				}
			}
			//
			if($planData){
				//
				$n1 = "Monday";
				$n2 = "Tuesday";
				$n3 = "Wednesday";
				$n4 = "Thursday";
				$n5 = "Friday";
				$n6 = "Saturday";
				$n7 = "Sunday";
			
				
				//first line
				$str = $str."<table border='1'>";
				$str = $str."<tr><th></th>"."<th>$n1</th>"."<th>$n2</th>"."<th>$n3</th>"."<th>$n4</th>"."<th>$n5</th>"."<th>$n6</th>"."<th>$n7</th>"."</tr>";
				
				//
				$loop = 0;
				while($loop < 4){
								
					$str = $str."<tr>";
					
					if($loop == 0){
						$str = $str."<td>08:00-10:00</td>";
					}else if($loop == 1){
						$str = $str."<td>10:00-12:00</td>";
					}else if($loop == 2){
						$str = $str."<td>14:00-16:00</td>";
					}else if($loop == 3){
						$str = $str."<td>16:00-18:00</td>";
					}else{
						$str = $str."<td></td>";
					}
					
					//
					$inloop = 0;
					while($inloop < 7){
						$id = $loop."".$inloop."p";
						$plan = subPlan($weekday[$inloop], $loop);
						$str = $str."<td><input type='text' style='width:100px;' id='$id' name='$id' value='".$plan."'\></td>";
						$inloop++;
					}
								
					$str = $str."</tr>";
					$loop++;
				}
				$str = $str."</table>";	
				//echo $str;			
			}else{
				$str = $str."<h2>you have not established your fitness plan</h2>";		
				//echo $str;			
			}
			return $str;
		}
		
		//
	 //
	 function addPlan_insertDB($conn, $tablename, $n1,$n2,$n3,$n4, $n5,$n6,$n7,$n8){
		//
		$p1 = "email";
		$p2 = "monday";
		$p3 = "tuesday";
		$p4 = "wednesday";		
		$p5 = "thursday";
		$p6 = "friday";
		$p7 = "saturday";
		$p8 = "sunday";		
		//insert into user (name, password, email, date) values ('abc','123','000@gmail.com',1903232000);
		$sql = "insert into ".$tablename." ($p1,$p2, $p3, $p4, $p5,$p6, $p7, $p8) 
			values ('$n1','$n2','$n3','$n4','$n5','$n6','$n7','$n8');";		
		if ($conn->query($sql) === TRUE) {
			
		}
	 }	 
		
	 //
	 function updatePlan_insertDB($conn, $tablename, $n1,$n2,$n3,$n4, $n5,$n6,$n7,$n8){
		//
		$p1 = "email";
		$p2 = "monday";
		$p3 = "tuesday";
		$p4 = "wednesday";		
		$p5 = "thursday";
		$p6 = "friday";
		$p7 = "saturday";
		$p8 = "sunday";
		
		//insert into user (name, password, email, date) values ('abc','123','000@gmail.com',1903232000);
		$sql = "insert into ".$tablename." ($p1,$p2, $p3, $p4, $p5,$p6, $p7, $p8) 
			values ('$n1','$n2','$n3','$n4','$n5','$n6','$n7','$n8')";		
		if ($conn->query($sql) === TRUE) {			
		}
	 }
	 function updatePlan_updateDB($conn, $tablename, $n1,$n2,$n3,$n4, $n5,$n6,$n7,$n8){
		 //
		$p1 = "email";
		$p2 = "monday";
		$p3 = "tuesday";
		$p4 = "wednesday";		
		$p5 = "thursday";
		$p6 = "friday";
		$p7 = "saturday";
		$p8 = "sunday";		 
		$sql = "delete FROM ".$tablename." where email='".$n1."'";
		if ($conn->query($sql) === TRUE) {
			updatePlan_insertDB($conn, $tablename, $n1,$n2,$n3,$n4, $n5,$n6,$n7,$n8);			
		}
	 }	
		
	 //
	 function deletePlan_deleteDB($conn, $tablename, $n1){
		$sql = "delete FROM ".$tablename." where email='".$n1."'";
		if ($conn->query($sql) === TRUE) {
			
		}
	 }
	 
	 //
	 function comment_insertDB($conn, $tablename, $n1,$n2,$n3,$n4){
		$p1 = "id";
		//
		$p2 = "email";
		$p3 = "subject";
		$p4 = "comment";
		$p5 = "date";
		
		//insert into user (name, password, email, date) values ('abc','123','000@gmail.com',1903232000);
		$sql = "insert into ".$tablename." ($p2, $p3, $p4, $p5) values ('$n1','$n2','$n3',$n4)";
		if ($conn->query($sql) === TRUE) {
			
		}
	 }	
	 
	 //
	 function unsubscribe_deleteDB($conn, $tablename, $n1,$n2){
		$sql = "delete FROM ".$tablename." where name='".$n1."'";
		if ($conn->query($sql) === TRUE) {
			
		}
	 }	
?>