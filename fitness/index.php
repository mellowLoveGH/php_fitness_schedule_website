<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>start page</title>

<style type="text/css"> 
<!-- 
<link rel="stylesheet" type="text/css" href="indexstyle.css">
--> 
	.{
		padding:0;
		margin:0;
	}
	.div1{
		height:50px;
		border:5px solid grey;
		
	}
	.div2{
		height:120px;
		border:5px solid grey;
	}
	.div3{
		height:160px;
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
<div class="div1" style="background-color:#00FFFF;">
	<div style="float: left; height:90%; width:30%;font-size:32px;margin-left:32%;" align="center">
			<strong>F I T N E S S</strong>
	</div>
</div>

<!-- sign-in, join, fitness -->
<div class="div2">
	<div class="div21"> 
	<img src="img/picture07.jpg" alt="" style="width:70%; height:119px; float:left;">
	<button type="button" onclick="signIn()">Sign In</button>
	<button type="button" onclick="join()">Join</button>
	</div>
	
	<div class="div22"> 
	<img src="img/picture08.jpg" alt="" style="width:20%; height:119px; float:left;">
	<img src="img/picture09.jpg" alt="" style="width:20%; height:119px; float:left;">
	<img src="img/picture10.jpg" alt="" style="width:20%; height:119px; float:left;">
	<img src="img/picture11.jpg" alt="" style="width:20%; height:119px; float:left;">
	<img src="img/picture12.jpg" alt="" style="width:20%; height:119px; float:left;">
	</div>
</div>

<!-- about us, picture -->
<div class="div3">
	<div class="div31"> 
	<img src="img/picture13.jpg" alt="" style="width:100%; height:100%; float:left;">
	</div>
	
	<div class="div32"> 
		<video src="vid/video01.mp4" controls="controls" style="width:32%; height:100%; float:left;">your browser does not support the video</video>
		<img src="img/picture14.jpg" alt="" style="width:36%; height:100%; float:left;">
		<video src="vid/video01.mp4" controls="controls" style="width:32%; height:100%; float:left;">your browser does not support the video</video>
	</div>
</div>

<!-- visitor area -->
<div class="div4">
	<div class="div41"> 
	<img src="img/picture05.jpg" alt="" style="width:100%; height:160px; float:right;">
	</div>
	
	<div class="div42" id="slideContent"> 
	comment	
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
  
  window.onload=function(){
	  var page = "visitor.php";
	  page = "Controller.php";
	  
	  var sc = document.getElementById("slideContent");
	  var str = "";
	  str = str + "<form action='" + page + "' method='post'>";
	  //
	  str = str + "<input type='hidden' name='page' value='visitor' />";
	  str = str + "Subject: <input type='text' name='subject' /> <br/>";
	  str = str + "Email: <input type='text' name='email' /> <br/>";
	  str = str + "Comment: <input type='text' name='comment' /> <br/>";
	  //str = str + "Date: <input type='text' name='date' /> <br/>";
	  str = str + "<input type='submit' value='Submit' /> <br/>";
	  str = str + "</form>";
	  sc.innerHTML = sc.innerHTML + str;
  }
  
  function signIn(){
	  var page = "signIn.php";
	  page = "Controller.php";
	  
	  var sc = document.getElementById("slideContent");
	  var str = "";
	  str = str + "<form action='" + page + "' method='post'>";
	  //
	  str = str + "<input type='hidden' name='page' value='signIn' />";
	  str = str + "name: <input type='text' name='name' /> <br/>";
	  str = str + "Password: <input type='text' name='password' /> <br/>";
	  str = str + "<input type='submit' value='Submit' /> <br/>";
	  str = str + "</form>";
	  sc.innerHTML = str;
  }
  
  function join(){
	  var page = "join.php";
	  page = "Controller.php";
	  
	  var sc = document.getElementById("slideContent");
	  var str = "";
	  str = str + "<form action='" + page + "' method='post'>";
	  //
	  str = str + "<input type='hidden' name='page' value='join' />";
	  str = str + "Name: <input type='text' name='name' /> <br/>";
	  str = str + "Password: <input type='text' name='password' /> <br/>";
	  str = str + "Email: <input type='text' name='email' /> <br/>";
	  //str = str + "Date: <input type='text' name='date' /> <br/>";
	  str = str + "<input type='submit' value='Submit' /> <br/>";
	  str = str + "</form>";
	  sc.innerHTML = str;
  }  
</script>
</div>
</body>
</html>