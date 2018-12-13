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
$pid="";
if(isset($_REQUEST["Uid"]))
 {
	
	 $rolid=$_REQUEST["Uid"];
	 $que = "select * from role_permission where id = '".$rolid."' ";
	 $result=mysqli_query($conn, $que);
	$row=mysqli_fetch_assoc($result);
	$rid=$row["roleid"];
	$pid=$row["permissionid"];
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
	$perm=$_REQUEST["permissions"];
	
	   if($_SESSION["func"]=="edit")
	   {
		   
			$id=$_SESSION["Rid"];
		$sql = "UPDATE role_permission SET  roleid='$role', permissionid='$perm'  WHERE id='$id'";
		mysqli_query($conn, $sql);
		//$records = mysqli_num_rows($result);
		$error="Successfully Updated";
		$_SESSION["Rid"]="";
		$_SESSION["func"]="";
		header('location:RolePermissionList.php');
	   }
	else
	{
			
		$sql = "Insert into role_permission (roleid,permissionid) values('$role','$perm')";
		mysqli_query($conn, $sql);
		//$records = mysqli_num_rows($result);
		$error="Successfully Added";
		header('location:RolePermissionList.php');
		
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

<h1 style="padding-left:30px;"> RolePermission Management </h1>

<div class="btn-group">

<form name="userForm" method="get" action="RolePermission.php"   >
	<div style="width:370px;padding-left:30px;background-color:white;">
	<br><br>
	Role:<br> <select name="roles" id="roles" class="box" >
	<?php
$sql = "SELECT * FROM roles";
					
			$result = mysqli_query($conn, $sql);
			$recordsFound = mysqli_num_rows($result);			
			echo $pid;
			echo $rid;
			echo "in other";
			if ($recordsFound > 0) {
				//echo $recordsFound;
				while($row = mysqli_fetch_assoc($result)) {
				
					$id = $row["roleid"];
					$name = $row["name"];
					if(empty($rid)==false && $rid==$id)
					{
						$v="selected";
						echo "selected";
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
	Permissions:<br> <select name="permissions" id="permissions" class="box" >
	<?php
		$sql = "SELECT * FROM permissions";
					
			$result = mysqli_query($conn, $sql);
			$recordsFound = mysqli_num_rows($result);			
			
			if ($recordsFound > 0) {
				//echo $recordsFound;
				while($row = mysqli_fetch_assoc($result)) {
				
					$id = $row["permissionid"];
					$name = $row["name"];
					
					if(empty($pid)==false&&$pid==$id)
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