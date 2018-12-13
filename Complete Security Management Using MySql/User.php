<?php require('conn.php');
session_start();
if(empty($_SESSION["logId"])==true || $_SESSION["chk"]!="1")
 {
	 header('location:login.php');
 }
 ?>
 
 
 
 <?php

$log="";
$pass="";
$name="";
$em="";
if(isset($_REQUEST["Uid"]))
 {
	
	 $usrid=$_REQUEST["Uid"];
	 
	 $que = "select * from users where userid = '".$usrid."' ";
	 $result=mysqli_query($conn, $que);
	$row=mysqli_fetch_assoc($result);
	$log=$row["login"];
	$pass=$row["password"];
	$name=$row["name"];
	$em=$row["email"];
	$_SESSION["func"]="edit";
	$_SESSION["id"]=$usrid;
	
	//header('location: UserList.php');
 }
 
 
?>

<?php
$error=""; 
  $usr="";
   if(isset($_REQUEST["subBtn"])==true)
   {
	   	$log=$_REQUEST["Ulogin"];
	   $pass=$_REQUEST["Upass"];
	$name=$_REQUEST["Uname"];
	$em=$_REQUEST["Uemail"];
	$coun=$_REQUEST["country"];
	$date = date('Y-m-d H:i:s');
	$createid=$_SESSION["logId"];
	if(isset($_REQUEST["adm"]))
	{
		$adm="1";
	}
	else
		$adm="0";
	   if($_SESSION["func"]=="edit")
	   {
			$userid=$_SESSION["id"];
			$sql="select * from users where (login='$log' OR email='$em') and userid<>'$userid'";
		$result=mysqli_query($conn, $sql);
		$records = mysqli_num_rows($result);
		if($records>0)
		{
			$error="Login or email Already Exist";
			
		}
		else{
	    
		$sql = "UPDATE users SET login='$log', password='$pass', name='$name', email='$em', countryid='$coun',isadmin='$adm'   WHERE userid='$userid'";
		mysqli_query($conn, $sql);
		//$records = mysqli_num_rows($result);
		$error="Successfully Updated";
		$_SESSION["id"]="";
		$_SESSION["func"]="";
		header('location:UserList.php');
		}
	   }
	else
	{
		$sql="select * from users where login='$log' OR email='$em'";
		$result=mysqli_query($conn, $sql);
		$records = mysqli_num_rows($result);
		if($records>0)
		{
			$error="Login or email Already Exist";
			
		}
		
		else{
			
			$sql = "Insert into users(login,password,name,email,countryid,createdon,createdby,isadmin) values('$log','$pass','$name','$em','$coun','$date' , '$createid', '$adm')";
		mysqli_query($conn, $sql);
		//$records = mysqli_num_rows($result);
		$error="Successfully Added";
		header('location:UserList.php');
		}
   }
   }
?>
 

<html>  
    <head>
        
        <script>
			

	function validateFields()
	{
	var log = document.forms["userForm"]["Ulogin"].value;
	var pas = document.forms["userForm"]["Upass"].value;
	var nam = document.forms["userForm"]["Uname"].value;
	var em= document.forms["userForm"]["Uemail"].value;
	var con = document.forms["userForm"]["country"].value;
	var isad = document.forms["userForm"]["isadm"].value;
//alert(isad);
	var alphaExp = /^[a-zA-Z ]+$/;
	var numExp = /^[0-9]+$/;
	var alphanumExp = /^[0-9a-zA-Z]+$/;
	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	if(log==""||pas==""||nam==""||em==""||con=="")
	{
		alert("Invalid Form Entries");
		return false;
	}
	else if(!(nam.match(alphaExp)) || !(em.match(mailformat)))
	{
		
		
			alert("Invalid Name or mail format");
			return false;
	}
		
	
	else
	{
		return true;
	}
	
	}
	
	
	
function clearText()
{
	 document.forms["userForm"]["Ulogin"].value="";
	 document.forms["userForm"]["Upass"].value="";
	document.forms["userForm"]["Uname"].value="";
	 document.forms["userForm"]["Uemail"].value="";
	 document.forms["userForm"]["Ucont"].value="";
	 document.forms["userForm"]["country"].value="";
	 document.getElementById("isadm").setAttribute('checked', false);
	
}	
        </script>
		
		<style>
ul {
    list-style-type: none;
    overflow: hidden;
    background-color:#404040;
	height:60px;
	 text-align: center;
}

li {
    float: left;
	margin-right:15px;
	 text-align: center;
	 font-family: 'Shrikhand';
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
	height:80px;
	font-family: 'Shrikhand';
	
}

li a:hover:not(.active) {
    background-color: 	#6A5ACD;
}

.div1 {
 margin-left:100px; border: 1px solid black; height:640px;width:400px; text-align:left;background-color:#404040;

}
.div2 {
 margin-left:100px; text-align:left;

}
.images{
background: url(s2.jpg) no-repeat;
	background-size: cover;
    min-height: 100vh;
    color: white;
	background-position:center;
	padding-top: 30px;
}
.box{width:300px;height:30px;background-color:white;}
.submit{
	

width:150px;
height:30px;
background-color:white;
color:#404040;
font-family:arial;
 border:none;
 
 margin-right:30px;
 margin-bottom:30px;
 margin-left:20px;
 
 
 
 }

</style>

    </head>
<body onload="SelectCountry();">

<ul>
  <li><a  href="homeAdmin.php">Home</a></li>
  <li><a  href="UserList.php">User Management</a></li>
  <li><a  href="RoleList.php">Role Management</a></li>
  <li><a  href="PermissionList.php">Permission Management</a></li>
  <li><a  href="RolePermissionList.php">Role-Permission Management</a></li>
  <li><a href="UserRoleList.php">User Role Management</a></li>
  <li><a href="loginHistory.php">login History</a></li>
  <li><a href="logout.php">logout</a></li>
</ul>
    <table>
<tr>
<td>
<div class="images">
<div class="div1">

<h1 style="padding-left:30px;"> User Management </h1>

<div class="btn-group">

<form name="userForm" method="get" action="User.php"   >
	<div style="width:370px;padding-left:30px;background-color:white;">
	<br><br>
	<label style="color:black;">login:</label><br>
	<input class="box" type="text" name="Ulogin" value=<?php echo $log; ?> > 
	<br><br>
	<label style="color:black;">password:</label><br>
	<input class="box" type="password" name="Upass" value=<?php echo $pass; ?>  >
	<br><br>
	<label style="color:black;">Name:</label><br>
	<input class="box" type="text" name="Uname" value=<?php echo $name; ?> > 
	<br><br>
	<label style="color:black;">Email:</label><br>
	<input class="box" type="text" name="Uemail" value=<?php echo $em; ?> > 
	<br><br>
	Country:<br> <select name="country" id="country" class="box" >
		<?php $sql="select * from country";
		$result=mysqli_query($conn, $sql);
		$records = mysqli_num_rows($result);
		
	

   for ( $i=0; $i<$records; $i++) { 
$row=mysqli_fetch_assoc($result);
$id = $row["id"];
$name = $row["name"];
   echo "<option value='$id' >$name</option>";
   } ?>
  </select><br>
	<br><br>
	<label style="color:black;">isadmin</label>
    <input name="adm" id="adm" type="checkbox" value="1">


    </select> 
	<br><br><br><br>
	</div>
	<br><br>
	<table>
	<tr>
<td><input class="submit" name="subBtn" type="submit" value="Save" onclick="return validateFields();" ></td>
<td><input class="submit" type="button" value="Clear" onclick="clearText();"  ></td></tr></table>


</form>


</div>
</div>
</div>
</td>
<td>
<div class="div2" id="myDiv">
<?php
if($error!="")
{?>
<label style="color:red;">
<?php
echo $error;

}?>
	</div>
</td>
</tr>
</table>

</body>

</html>