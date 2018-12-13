<?php require('conn.php');
session_start();

 if(empty($_SESSION["logId"])==true)
 {
	 header('location:login.php');
 }
 ?>

<html>
<head>
<title>Task6</title>

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
b{
	margin-left:100px;font-size:50px;font-family: 'Shrikhand';
}


</style>
</head>
<body  >
	<ul>
  <li><a  href="home.php">Home</a></li>
  <?php if($_SESSION["chk"]=="1") {?>
  <li><a  href="userManagement.php">User Management</a></li>
  <li><a  href="roleManagement.php">Role Management</a></li>
  <li><a  href="permManagement.php">Permission Management</a></li>
  <li><a  href="RPmanagement.php">Role-Permission Management</a></li>
  <li><a href="URmanagement.php">User Role Management</a></li>
  <li><a href="loginHistory.php">login History</a></li>  <?php } ?>
  <li><a href="logout.php">logout</a></li>
</ul>
<?php if($_SESSION["chk"]=="1") {?>
	<b>Welcome Admin</b>
	<?php }
else {	?>
<b>Welcome User</b>

  <?php
				$id=$_SESSION["logId"];
  $sql="select r.roleid id,r.name name from user_role ur  INNER JOIN roles r ON ur.roleid=r.roleid where ur.userid='$id'";
 
		$result=mysqli_query($conn, $sql);
		$records = mysqli_num_rows($result);
		if($records>0){
   for ( $i=0; $i<$records; $i++) { 
$row=mysqli_fetch_assoc($result);
	$rid=$row["id"];
	$rname=$row["name"];
	
	
	
	echo "<h1 id='data' style='margin-left:200px;'>$rname</h1>";
		$sql1="select p.name name from role_permission rp  INNER JOIN permissions p ON rp.permissionid=p.permissionid where rp.roleid='$rid' ";
		$result1=mysqli_query($conn, $sql1);
		$records1 = mysqli_num_rows($result1);
		if($records1>0)
		{
			
			for ( $j=0; $j<$records1; $j++)
			{
				$row=mysqli_fetch_assoc($result1);
				$pname=$row["name"];
				echo "<h2 id='data' style='margin-left:250px;'>  >$pname</h2>";
			}
		}
		else
		{
			echo "<h2 id='data' style='margin-left:250px;'>No Permission</h2>";
		}
   }
   
		}
		else
		{
			echo "<h1 id='data' style='margin-left:200px;'>No Role</h1>";
		}
		?>

<?php } ?>
	
</body>
</html>