<?php require('conn.php');
session_start();
if(empty($_SESSION["logId"])==true || $_SESSION["chk"]!="1")
 {
	 header('location:login.php');
 }
 ?>
 
 
 
 <?php


$name="";
$desc="";
if(isset($_REQUEST["Uid"]))
 {
	
	 $rolid=$_REQUEST["Uid"];
	 
	 $que = "select * from roles where roleid = '".$rolid."' ";
	 $result=mysqli_query($conn, $que);
	$row=mysqli_fetch_assoc($result);
	$name=$row["name"];
	$desc=$row["description"];
	$_SESSION["func"]="edit";
	$_SESSION["Rid"]=$rolid;
	
	//header('location: UserList.php');
 }
 
 
?>

<?php
$error=""; 
  $usr="";
   if(isset($_REQUEST["subBtn"])==true)
   {
	   	
	$name=$_REQUEST["Rname"];
	$descrpt=$_REQUEST["Rdescription"];
	$date = date('Y-m-d H:i:s');
	$createid=$_SESSION["logId"];
	
	   if($_SESSION["func"]=="edit")
	   {
			$roleid=$_SESSION["Rid"];
			$sql="select * from roles where name='$name' and roleid<>'$roleid'";
		$result=mysqli_query($conn, $sql);
		$records = mysqli_num_rows($result);
		if($records>0)
		{
			$error="Name Already Exist";
			
		}
	    
		$sql = "UPDATE roles SET  name='$name', description='$descrpt'  WHERE roleid='$roleid'";
		mysqli_query($conn, $sql);
		//$records = mysqli_num_rows($result);
		$error="Successfully Updated";
		$_SESSION["Rid"]="";
		$_SESSION["func"]="";
		header('location:RoleList.php');
	   }
	else
	{
		$sql="select * from roles where name='$name'";
		$result=mysqli_query($conn, $sql);
		$records = mysqli_num_rows($result);
		if($records>0)
		{
			$error="Name Already Exist";
			
		}
		
		else{
			
			$sql = "Insert into roles(name,description,createdon,createdby) values('$name','$descrpt','$date' , '$createid')";
		mysqli_query($conn, $sql);
		//$records = mysqli_num_rows($result);
		$error="Successfully Added";
		header('location:RoleList.php');
		}
   }
   }
?>
 

<html>  
    <head>
        
        <script>
			

	function validateFields()
	{
	
	var nam = document.forms["userForm"]["Rname"].value;
	var des= document.forms["userForm"]["Rdescription"].value;
//alert(isad);
	var alphaExp = /^[a-zA-Z ]+$/;
	var numExp = /^[0-9]+$/;
	var alphanumExp = /^[0-9a-zA-Z]+$/;
	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	if(nam==""||des=="")
	{
		alert("Fields should not be empty");
		return false;
	}
	else if(!(nam.match(alphanumExp)) || !(des.match(alphaExp)))
	{
		
		
			alert("Invalid Name or description format");
			return false;
	}
		
	
	else
	{
		return true;
	}
	
	}
	
	
	
function clearText()
{
	 document.forms["userForm"]["Rname"].value="";
	 document.forms["userForm"]["Rdescription"].value="";
	
	
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
	margin-right:30px;
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
 margin-left:100px; border: 1px solid black; height:380px;width:400px; text-align:left;background-color:#404040;

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
  <li><a  href="userManagement.php">User Management</a></li>
  <li><a  href="roleManagement.php">Role Management</a></li>
  <li><a  href="permManagement.php">Permission Management</a></li>
  <li><a  href="RPmanagement.php">Role-Permission Management</a></li>
  <li><a href="URmanagement.php">User Role Management</a></li>
  <li><a href="login.php">logout</a></li>
</ul>
    <table>
<tr>
<td>
<div class="images">
<div class="div1">

<h1 style="padding-left:30px;"> Role Management </h1>

<div class="btn-group">

<form name="userForm" method="get" action="Role.php"   >
	<div style="width:370px;padding-left:30px;background-color:white;">
	<br><br>
	<label style="color:black;">Name:</label><br>
	<input class="box" type="text" name="Rname" value=<?php echo $name; ?> > 
	<br><br>
	<label style="color:black;">Description:</label><br>
	<input class="box" type="text" name="Rdescription" value=<?php echo $desc; ?> > 
	<br><br><br><br>
	</div>
	<br><br>
	<table>
	<tr>
<td><input class="submit" name="subBtn" type="submit" value="Save" onclick="return validateFields();" ></td>
</tr></table>


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