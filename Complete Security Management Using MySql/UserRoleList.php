<?php require('conn.php');
session_start();
if(empty($_SESSION["logId"])==true || $_SESSION["chk"]!="1")
 {
	 header('location:login.php');
 }
 ?>
 <?php 
 if(isset($_REQUEST["Uid"]))
 {
	 //echo "hello";
	 $id=$_REQUEST["Uid"];
	 $que = "delete from user_role where id = '".$id."' ";
	mysqli_query($conn, $que);
	
	header('location: UserRoleList.php');
 }
 ?>
<html>  
    <head>
        
        <script>
			
function Confirmation(){

var del=confirm("Are you sure you want to delete this record?");
if (del==true){
   return true;
}
return false;
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
	

width:200px;
height:40px;
background-color:black;
color:white;
font-family:arial;
 border:none;
 
 margin-right:30px;
 margin-bottom:30px;
 margin-left:20px;
 
 
 
 }

</style>

    </head>
<body >

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


	

    <table id='tblMain' style='border:1px solid; border-collapse: collapse;align:center;'><tr><th style='width: 100px; color: black; text-align: center; border-collapse: collapse;border:1px solid;height:50px;'>ID</th>
    <th style='width: 100px; color: black; text-align: center; border-collapse: collapse;border:1px solid;height:50px;'>Users</th>
    <th style='width: 100px; color: black; text-align: center; border-collapse: collapse;border:1px solid;height:50px;'>Roles</th>
<th style='width: 100px; color: black; text-align: center; border-collapse: collapse;border:1px solid;height:50px;'>Edit</th>
<th style='width: 100px; color: black; text-align: center; border-collapse: collapse;border:1px solid;height:50px;'>Delete</th></tr>
    
<?php 

$usr=1;
$sql="select ur.id id,u.name uname,r.name rname from user_role ur INNER JOIN users u ON ur.userid=u.userid INNER JOIN roles r ON ur.roleid=r.roleid";
		$result=mysqli_query($conn, $sql);
		$records = mysqli_num_rows($result);
		

 ?>	
	

  <?php for ( $i=0; $i<$records; $i++) { 
$row=mysqli_fetch_assoc($result);
  ?>
    <tr><td style='width: 100px; text-align: center;height:50px; border-collapse: collapse;border:1px solid;'><?php echo $row["id"]?></td>
    
    <td style='width: 100px; text-align: center;height:50px; border-collapse: collapse;border:1px solid;'><?php echo $row["uname"]?></td>
    <td style='width: 200px; text-align: center;height:50px; border-collapse: collapse;border:1px solid;'><?php echo $row["rname"]?></td>
 <td style='width: 100px; text-align: center;height:50px; border-collapse: collapse;border:1px solid;'><a   href="UserRole.php?Uid=<?php echo $row["id"];?>" >Edit</a></td>
<td style='width: 100px; text-align: center;height:50px; border-collapse: collapse;border:1px solid;'><a  href="UserRoleList.php?Uid=<?php echo $row["id"];?>" onclick="return Confirmation();" >Delete</a></td></tr> 
  <?php } ?>  
   </table>


</tr>
</table>
<br><br>
<form action="UserRole.php">
<input type="submit" class="submit" value="Add UserRole" >
</form>
</body>

</html>