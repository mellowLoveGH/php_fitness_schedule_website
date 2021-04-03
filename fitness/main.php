<?php
	error_reporting( E_ALL&~E_NOTICE );
	session_start();
	//
	$email = $_SESSION["email"];
	$date = $_SESSION["date"];
	$n1 = $_SESSION["name"];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>start page</title>
<script src='jquery-1.7.2.min.js'></script>

<style type="text/css"> 
<!-- 
<link rel="stylesheet" type="text/css" href="mainstyle.css">
--> 
	.{
		padding:0;
		margin:0;
	}
	.div1{
		height:120px;
		border:5px solid grey;
	}
	.div2{
		height:50px;
		border:5px solid grey;
	}
	.div3{
		height:260px;
		border:5px solid grey;
	}
	.div4{
		height:160px;
		border:5px solid grey;
	}
	.div5{
		height:70px;
		border:5px solid grey;
	}
	.div6{
		height:30px;
		border:5px solid grey;
	}
	
	.div21{
		position:relative;
		width:20%;
		height:100%;
		float:left;
		border:5px solid grey;
	}
	.div22{
		position:relative;
		width:75%;
		height:100%;
		float:right;
		border:5px solid grey;
	}
	.div31{
		position:relative;
		width:20%;
		height:100%;
		float:left;
		border:5px solid grey;
	}
	.div32{
		position:relative;
		width:75%;
		height:100%;
		float:right;
		border:5px solid grey;
	}	
	.div321{
		top:6%;
		left:0.5%;
		position:relative;
		float:left;
		width:90%;
		height:85%;
		overflow-y:auto;
	}
	.div322{
		top:6%;
		background-color:pink;
		position:relative;
		float:right;
		width:8%;
		height:85%;
		overflow-y:auto;
	}
	.div41{
		position:relative;
		width:20%;
		height:100%;
		float:left;
		border:5px solid grey;
	}
	.div42{
		position:relative;
		width:75%;
		height:100%;
		float:right;
		border:5px solid grey;
	}
	.div421{
		position:relative;
		width:100%;
		height:60%;
		overflow-y:auto;
	}
	.div51{
		position:relative;
		width:20%;
		height:100%;
		float:left;
		border:5px solid grey;
	}
	.div52{
		position:relative;
		width:75%;
		height:100%;
		float:right;
		border:5px solid grey;
	}
</style>
</head>

<body>
<div class="div1">
	<img src="img/picture01.jpg" alt="" style="width:18%; height:119px; float:left;">
	<img src="img/picture06.png" alt="" style="width:12%; height:119px; float:left;">
	<video src="vid/video01.mp4" controls="controls" style="width:20%; height:119px; float:left;">your browser does not support the video</video>
	<img src="img/picture06.png" alt="" style="width:12%; height:119px; float:left;">
	<video src="vid/video01.mp4" controls="controls" style="width:20%; height:119px; float:left;">your browser does not support the video</video>
	<img src="img/picture01.jpg" alt="" style="width:18%; height:119px; float:left;">
</div>

<!-- sign-in, join, fitness -->
<div class="div2">
	<div id="scorediv" class="div21"> 
	
	</div>	
	<div class="div22"> 
		<div style="float: left; height:90%; width:30%;font-size:30px;margin-left:20%;" align="center">
			<strong>Fitness</strong>
		</div>
	
		<div style="float: right; height:100%; width:30%;">
			<button type="button" onclick="signOut()">Log out</button>
			<button type="button" onclick="unsubscribe()">Unsubscribe</button>
		</div>
	</div>
</div>

<!-- about us, picture -->
<div class="div3">
	<div class="div31"> 
	<img src="img/picture04.png" alt="" style="width:100%; height:260px; float:right;">
	</div>
	
	<div class="div32"> 	
	<div class="div321" id='fplan'>	
	
	</div>
	
	<div class="div322" id='planbtn'>
	<button type="button" style="float: right;" onclick="createTable()">Create</button><br/><br/>
	<button type="button" style="float: right;" onclick="deleteTable()">Delete</button><br/><br/>
	<button type="button" style="float: right;" onclick="changeTable()">Change</button><br/><br/>
	</div>
	
	</div>
</div>

<!-- visitor area -->
<div class="div4">
	<div class="div41"> 
	<img src="img/picture05.jpg" alt="" style="width:100%; height:160px; float:right;">
	</div>
	
	<div class="div42" id="slideContent"> 
	comment <br/>
		<div class="div421" id="commentdiv">
	
		</div>	  
	Subject: <input id="sbj" type='text' name='subject' value=""/>
	Comment: <input id="com" type='text' name='comment' value=""/>
	<button type="button" style="" onclick="comment()">submit</button>
	</div>
</div>

<!-- business hour information -->
<div class="div5">
	<div class="div51"> 
	business hour
	</div>
	<div class="div52"> 
	information
	</div>
</div>

<div class="div6">

<script type="text/javascript">
	
  function showTable(){
	  //alert("plan table");
	  var page = "showtable";
	  var email = "<?php echo $email;?>";
	  var date = "<?php echo $date;?>";
	  alert(email + ", " + date);
			$.ajax({
				url:'Controller.php',
				data:{"page":page, "email":email},
				dataType:'JSON',
				type:'post',
				success:function(data){
					sdata = data;
					//alert(data['email'] + ", " + data['score']);
					
					//scorediv
					var scorediv = document.getElementById("scorediv");
					var name = "<?php echo $_SESSION['name'];?>";
					scorediv.innerHTML = "hello " + name + "<br/>score: " + data['score'];
					//
					var str = data['plan'];
					var fplan = document.getElementById("fplan");
					fplan.innerHTML = str;
					//
					str = data['comment'];
					//commentdiv
					var commentdiv = document.getElementById("commentdiv");
					commentdiv.innerHTML = str;
					
				},
				error:function(response){
					//alert("error");
				}
			});
	  //alert(sdata + ", show table");
  }
  
  function createTable(){
	 
	  var str = "";
	  str = str + "<table border='1'>";
	  str = str + "<tr>";
	  str = str + "<th></th><th>Monday</th><th>Tuesday</th><th>Wednesday</th><th>Thursday</th><th>Friday</th><th>Saturday</th><th>Sunday</th>";
	  str = str + "</tr>";
	  
	  for(var i=0; i<4; i++){
		  str = str + "<tr>";		  
		  //
		  if(i == 0){
			  str = str + "<td>08:00-10:00</td>";
		  }else if(i == 1){
			  str = str + "<td>10:00-12:00</td>";
		  }else if(i == 2){
			  str = str + "<td>14:00-16:00</td>";
		  }else if(i == 3){
			  str = str + "<td>16:00-18:00</td>";
		  }else{
			  str = str + "<td></td>";
		  }
		  
		  for(var j=0; j<7; j++){
			  var id = i.toString() + j.toString() + "p";
			  str = str + "<td><input type='text' style='width:100px;' id='" + id + "' name='" + id + "' value=''\></td>";
		  }		  
		  //
		  str = str + "</tr>";
	  }
	  
	  str = str + "</table>";
	  
	  var fplan = document.getElementById("fplan");
	  fplan.innerHTML = str;
	  
	  var btn = "<button type='button' style='float: right;' onclick='submitPlan()'>submit</button>";
	  var planbtn = document.getElementById("planbtn");
	  planbtn.innerHTML = planbtn.innerHTML  + btn;
  }
  
  function submitPlan(){
	  var page = "addPlan";
	  //
	  var weekday = new Array();
	  for(var i=0; i<7; i++){
		  weekday[i] = new Array();
		  for(var j=0; j<4; j++){
			  weekday[i][j] = "";
		  }
	  }
	  
	  var email = "<?php echo $email;?>";
	  var str = "";
	  var number = 0;
	  for(var i=0; i<4; i++){
		  for(var j=0; j<7; j++){
			  var id = i.toString() + "" + j.toString() + "p";
			  var v = document.getElementById(id);
			  str = str + v.value;
			  weekday[j][i] = v.value;
			  
		  }
	  }
	  
	  //
	  var monday = "";
	  monday = weekday[0][0] + "::" + weekday[0][1] + "::" + weekday[0][2] + "::" + weekday[0][3];
	  //
	  var tuesday = "";
	  tuesday = weekday[1][0] + "::" + weekday[1][1] + "::" + weekday[1][2] + "::" + weekday[1][3];
	  //
	  var wednesday = "";
	  wednesday = weekday[2][0] + "::" + weekday[2][1] + "::" + weekday[2][2] + "::" + weekday[2][3];
	  //
	  var thursday = "";
	  thursday = weekday[3][0] + "::" + weekday[3][1] + "::" + weekday[3][2] + "::" + weekday[3][3];
	  //
	  var friday = "";
	  friday = weekday[4][0] + "::" + weekday[4][1] + "::" + weekday[4][2] + "::" + weekday[4][3];
	  //
	  var saturday = "";
	  saturday = weekday[5][0] + "::" + weekday[5][1] + "::" + weekday[5][2] + "::" + weekday[5][3];
	  //
	  var sunday = "";
	  sunday = weekday[6][0] + "::" + weekday[6][1] + "::" + weekday[6][2] + "::" + weekday[6][3];
	  //	  
	  alert("submit" + ", " + thursday + ", " + friday + ", " + sunday + ", ");			
			//
			$.ajax({
				url:'Controller.php',
				data:{"page":page, "email":email, "monday":monday, "tuesday":tuesday, "wednesday":wednesday, "thursday":thursday, "friday":friday, "saturday":saturday, "sunday":sunday},
				dataType:'JSON',
				type:'post',
				success:function(data){
					alert(data);
					//window.location.reload();
					showTable();
				},
				error:function(response){
					alert("error");
				}
			});		  
  }
  
  function deleteTable(){
	  var page = "deletePlan";
	  var email = "<?php echo $email;?>";
		$.ajax({
				url:'Controller.php',
				data:{"page":page, "email":email},
				dataType:'JSON',
				type:'post',
				success:function(data){
					//alert(data);
					//window.location.reload();
					showTable();
				},
				error:function(response){
					alert("error");
				}
			});	
	  
	  alert("delete");
  }
  
  function changeTable(){
	  var page = "updatePlan";
	  
	  var weekday = new Array();
	  for(var i=0; i<7; i++){
		  weekday[i] = new Array();
		  for(var j=0; j<4; j++){
			  weekday[i][j] = "";
		  }
	  }
	  
	  var email = "<?php echo $email;?>";
	  var str = "";
	  var number = 0;
	  for(var i=0; i<4; i++){
		  for(var j=0; j<7; j++){
			  var id = i.toString() + "" + j.toString() + "p";
			  var v = document.getElementById(id);
			  str = str + v.value;
			  //str = str + id;
			  weekday[j][i] = v.value;
			  
		  }
	  }
	  
	  //
	  var monday = "";
	  monday = weekday[0][0] + "::" + weekday[0][1] + "::" + weekday[0][2] + "::" + weekday[0][3];
	  var tuesday = "";
	  tuesday = weekday[1][0] + "::" + weekday[1][1] + "::" + weekday[1][2] + "::" + weekday[1][3];
	  var wednesday = "";
	  wednesday = weekday[2][0] + "::" + weekday[2][1] + "::" + weekday[2][2] + "::" + weekday[2][3];
	  var thursday = "";
	  thursday = weekday[3][0] + "::" + weekday[3][1] + "::" + weekday[3][2] + "::" + weekday[3][3];
	  var friday = "";
	  friday = weekday[4][0] + "::" + weekday[4][1] + "::" + weekday[4][2] + "::" + weekday[4][3];
	  var saturday = "";
	  saturday = weekday[5][0] + "::" + weekday[5][1] + "::" + weekday[5][2] + "::" + weekday[5][3];
	  var sunday = "";
	  sunday = weekday[6][0] + "::" + weekday[6][1] + "::" + weekday[6][2] + "::" + weekday[6][3];
	  alert("update" + ", " + thursday + ", " + friday + ", " + sunday + ", ");			
			//
			$.ajax({
				url:'Controller.php',
				data:{"page":page, "email":email, "monday":monday, "tuesday":tuesday, "wednesday":wednesday, "thursday":thursday, "friday":friday, "saturday":saturday, "sunday":sunday},
				dataType:'JSON',
				type:'post',
				success:function(data){
					alert(data);
					//window.location.reload();
					showTable();
				},
				error:function(response){
					alert("error");
				}
			});	
  }
  
  function comment(){
	  var page = "comment";
	  var name = "<?php echo $_SESSION["name"];?>";
	  var password = "<?php echo $_SESSION["password"];?>";
	  var email = "<?php echo $email;?>";
	  var date = "<?php echo $date;?>";
	  
	  var sbj = document.getElementById("sbj");
	  var com = document.getElementById("com");
	  
	  alert(email + ", " + sbj.value + ", " + com.value + ", " + date);
			$.ajax({
				url:'Controller.php',
				data:{"page":page, "email":email, "subject":sbj.value, "comment":com.value},
				dataType:'JSON',
				type:'post',
				success:function(data){
					//alert(data);
					//window.location.reload();
					showTable();
					sbj.value = "";
					com.value = "";
				},
				error:function(response){
					alert("error");
				}
			});	
  }
  
  function signOut(){
	  var page = "logOut";
	  alert("log out");
			$.ajax({
				url:'Controller.php',
				data:{"page":page},
				dataType:'JSON',
				type:'post',
				success:function(data){
					//alert(data);
				},
				error:function(response){
					//alert(response);
				}
			});	
	  window.location.href='index.php';
  }
  
  function unsubscribe(){
	  var page = "unsubscribe";
	  var name = "<?php echo $_SESSION["name"];?>";
	  var password = "<?php echo $_SESSION["password"];?>";
	  
	  var flag = confirm("Please make sure.");  
		if (flag == true) {  
			alert("You choose YES! Great!");  
			$.ajax({
				url:'Controller.php',
				data:{"page":page, "name":name, "password":password},
				dataType:'JSON',
				type:'post',
				success:function(data){
					//alert(data);
				},
				error:function(response){
					//alert("error");
				}
			});	
		} else {  
			
		}  
		window.location = "index.php";
  }  
  
  window.onload=showTable();
</script>
</div>
</body>
</html>