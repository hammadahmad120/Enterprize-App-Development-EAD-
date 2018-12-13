<?php require('conn.php');
require('utility.php');
session_start();
if(empty($_SESSION["logId"])==true || $_SESSION["chk"]!="1")
 {
	 header('location:login.php');
 }
 ?>
 
 
 
 <?php


$name="";
$desc="";
$v="";
$rid="";
$uid="";
if(isset($_REQUEST["Uid"]))
 {
	
	 $rolid=$_REQUEST["Uid"];
	 $que = "select * from user_role where id = '".$rolid."' ";
	 $result=mysqli_query($conn, $que);
	$row=mysqli_fetch_assoc($result);
	$rid=$row["roleid"];
	$uid=$row["userid"];
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
	   	
	$role=$_REQUEST["roles"];
	$user=$_REQUEST["users"];
	
	   if($_SESSION["func"]=="edit")
	   {
		   
			$id=$_SESSION["Rid"];
			
		$sql = "UPDATE user_role SET  userid='$user', roleid='$role'  WHERE id='$id'";
		mysqli_query($conn, $sql);
		//$records = mysqli_num_rows($result);
		$error="Successfully Updated";
		$_SESSION["Rid"]="";
		$_SESSION["func"]="";
		header('location:UserRoleList.php');
	   }
	else
	{
			
		$sql = "Insert into user_role (userid,roleid) values('$user','$role')";
		mysqli_query($conn, $sql);
		//$records = mysqli_num_rows($result);
		$error="Successfully Added";
		header('location:UserRoleList.php');
		
   }
   }
?>
 

<html>  
    <head>
        
        <script>
			

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
 margin-left:100px; border: 1px solid black; height:420px;width:400px; text-align:left;background-color:#404040;

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

<h1 style="padding-left:30px;"> UserRole Management </h1>

<div class="btn-group">

<form name="userForm" method="get" action="UserRole.php"   >
	<div style="width:370px;padding-left:30px;background-color:white;">
	<br><br>
	Users:<br> <select name="users" id="users" class="box" >
	<?php
	$adm="0";
$sql = "SELECT * FROM users where isadmin='$adm'";
					
			$result = mysqli_query($conn, $sql);
			$recordsFound = mysqli_num_rows($result);			
			//echo $pid;
			//echo $rid;
			//echo "in other";
			if ($recordsFound > 0) {
				//echo $recordsFound;
				while($row = mysqli_fetch_assoc($result)) {
				
					$id = $row["userid"];
					$name = $row["name"];
					if(empty($uid)==false && $uid==$id)
					{
						$v="selected";
						//echo "selected";
						echo "<option value='$id' $v >$name</option>";
					}
					else
					{
					echo "<option value='$id'>$name</option>";
					}
				}
			}
	?>
		
	
  </select><br><br>
	Roles:<br> <select name="roles" id="roles" class="box" >
	<?php
		$sql = "SELECT * FROM roles";
					
			$result = mysqli_query($conn, $sql);
			$recordsFound = mysqli_num_rows($result);			
			
			if ($recordsFound > 0) {
				//echo $recordsFound;
				while($row = mysqli_fetch_assoc($result)) {
				
					$id = $row["roleid"];
					$name = $row["name"];
					
					if(empty($rid)==false&&$rid==$id)
					{
						$v="selected";
						echo "<option value='$id' $v >$name</option>";
					}
					else
					{
					echo "<option value='$id'>$name</option>";
					}
				}
			}
	?>
		
	
  </select>
	<br><br><br><br>
	</div>
	<br><br>
	<table>
	<tr>
<td><input class="submit" name="subBtn" type="submit" value="Save" ></td>
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