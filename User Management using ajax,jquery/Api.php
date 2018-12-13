<?php
require('conn.php');
session_start();
$act=$_REQUEST["act"];
$Uid=$_SESSION["logId"];
 
 if($act=="getCountries")
 {
	 $sql="select * from country";
		$result=mysqli_query($conn, $sql);
		$records = mysqli_num_rows($result);
		$ary=[];
	

   for ( $i=0; $i<$records; $i++) { 
	$row=mysqli_fetch_assoc($result);
	$ary[$i]=$row;

 }
 
 echo json_encode($ary);
 
 }
 
 else if($act=="getCities")
 {
	  $id = $_REQUEST["val"];
	 $sql="select id,name from city where countryId='$id'";
		$result=mysqli_query($conn, $sql);
		$records = mysqli_num_rows($result);
		$ary=[];
	

   for ( $i=0; $i<$records; $i++) { 
	$row=mysqli_fetch_assoc($result);
	$ary[$i]=$row;

 }
 
 echo json_encode($ary);
 
 }
 
 else if($act=="getUsers")
 {
	  
	 $sql="select * from users";
		$result=mysqli_query($conn, $sql);
		$records = mysqli_num_rows($result);
		$ary=[];
	

   for ( $i=0; $i<$records; $i++) { 
	$row=mysqli_fetch_assoc($result);
	$ary[$i]=$row;

 }
 
 echo json_encode($ary);
 
 }
 
 else if($act=="getRoles")
 {
	  
	 $sql="select * from roles";
		$result=mysqli_query($conn, $sql);
		$records = mysqli_num_rows($result);
		$ary=[];
	

   for ( $i=0; $i<$records; $i++) { 
	$row=mysqli_fetch_assoc($result);
	$ary[$i]=$row;

 }
 
 echo json_encode($ary);
 
 }
 
 
  else if($act=="getPerms")
 {
	  
	 $sql="select * from permissions";
		$result=mysqli_query($conn, $sql);
		$records = mysqli_num_rows($result);
		$ary=[];
	

   for ( $i=0; $i<$records; $i++) { 
	$row=mysqli_fetch_assoc($result);
	$ary[$i]=$row;

 }
 
 echo json_encode($ary);
 
 }
 
 
  else if($act=="getRolesPerms")
 {
	  
	$sql="select rp.id id,r.name rname,p.name pname from role_permission rp INNER JOIN roles r ON rp.roleid=r.roleid INNER JOIN permissions p ON rp.permissionid=p.permissionid";
		$result=mysqli_query($conn, $sql);
		$records = mysqli_num_rows($result);
if($records>0){
   for ( $i=0; $i<$records; $i++) { 
	$row=mysqli_fetch_assoc($result);
	$ary[$i]=$row;

 }
  echo json_encode($ary);
}
 else
	 echo json_encode("noData");

 
 }
 
   else if($act=="getUsersRoles")
 {
	  
	$sql="select ur.id id,u.name uname,r.name rname from user_role ur INNER JOIN users u ON ur.userid=u.userid INNER JOIN roles r ON ur.roleid=r.roleid";
		$result=mysqli_query($conn, $sql);
		$records = mysqli_num_rows($result);
if($records>0){
   for ( $i=0; $i<$records; $i++) { 
	$row=mysqli_fetch_assoc($result);
	$ary[$i]=$row;

 }
  echo json_encode($ary);
}
 else
	 echo json_encode("noData");

 
 }
 
 
 else if($act=="delUser")
 {
	   $id = $_REQUEST["val"];
	 $que = "delete from users where userid = '".$id."' ";
	mysqli_query($conn, $que);
	echo json_encode("Successfully Deleted");
 }
 
 else if($act=="delRole")
 {
	   $id = $_REQUEST["val"];
	 $que = "delete from roles where roleid = '".$id."' ";
	mysqli_query($conn, $que);
	echo json_encode("Successfully Deleted");
 }
  else if($act=="delPerm")
 {
	   $id = $_REQUEST["val"];
	 $que = "delete from permissions where permissionid = '".$id."' ";
	mysqli_query($conn, $que);
	echo json_encode("Successfully Deleted");
 }
 
 else if($act=="delRolePerm")
 {
	   $id = $_REQUEST["val"];
	 $que = "delete from role_permission where id = '".$id."' ";
	mysqli_query($conn, $que);
	echo json_encode("Successfully Deleted");
 }
 
 else if($act=="delUserRole")
 {
	   $id = $_REQUEST["val"];
	 $que = "delete from user_role where id = '".$id."' ";
	mysqli_query($conn, $que);
	echo json_encode("Successfully Deleted");
 }
 
 else if($act=="getUser")
 {
	  $id = $_REQUEST["val"];
	   $sql="select * from users where  userid = '".$id."' ";
		$result=mysqli_query($conn, $sql);
		$records = mysqli_num_rows($result);
		$ary=[];
	

   for ( $i=0; $i<$records; $i++) { 
	$row=mysqli_fetch_assoc($result);
	$ary[$i]=$row;

 }
 
 echo json_encode($ary);
 }
 
 else if($act=="getRole")
 {
	  $id = $_REQUEST["val"];
	   $sql="select * from roles where  roleid = '".$id."' ";
		$result=mysqli_query($conn, $sql);
		$records = mysqli_num_rows($result);
		$ary=[];
	

   for ( $i=0; $i<$records; $i++) { 
	$row=mysqli_fetch_assoc($result);
	$ary[$i]=$row;

 }
 
 echo json_encode($ary);
 }
 
  else if($act=="getPerm")
 {
	  $id = $_REQUEST["val"];
	   $sql="select * from permissions where  permissionid = '".$id."' ";
		$result=mysqli_query($conn, $sql);
		$records = mysqli_num_rows($result);
		$ary=[];
	

   for ( $i=0; $i<$records; $i++) { 
	$row=mysqli_fetch_assoc($result);
	$ary[$i]=$row;

 }
 
 echo json_encode($ary);
 }
 
  else if($act=="getRolePerm")
 {
	  $id = $_REQUEST["val"];
	   $sql="select * from role_permission where  id = '".$id."' ";
		$result=mysqli_query($conn, $sql);
		$records = mysqli_num_rows($result);
		$ary=[];
	

   for ( $i=0; $i<$records; $i++) { 
	$row=mysqli_fetch_assoc($result);
	$ary[$i]=$row;

 }
  echo json_encode($ary);
 }
 
  else if($act=="getUserRole")
 {
	  $id = $_REQUEST["val"];
	   $sql="select * from user_role where  id = '".$id."' ";
		$result=mysqli_query($conn, $sql);
		$records = mysqli_num_rows($result);
		$ary=[];
	

   for ( $i=0; $i<$records; $i++) { 
	$row=mysqli_fetch_assoc($result);
	$ary[$i]=$row;

 }
 
 echo json_encode($ary);
 }
 
 
 
 else if($act=="editUser")
 {
	 $userid=$_REQUEST["id"];
	 $log=$_REQUEST["log"];
	   $pass=$_REQUEST["pass"];
	$name=$_REQUEST["name"];
	$em=$_REQUEST["email"];
	$coun=$_REQUEST["cont"];
	$city=$_REQUEST["city"];
	$date = date('Y-m-d H:i:s');
	$adm=$_REQUEST["adm"];
	  $sql = "UPDATE users SET login='$log', password='$pass', name='$name', email='$em', countryid='$coun',cityid='$city',isadmin='$adm'   WHERE userid='$userid'";
		mysqli_query($conn, $sql);
 
 echo json_encode("successfully updated");
 }
 
 
 else if($act=="editRole")
 {
	 $id=$_REQUEST["id"];
	 $rol=$_REQUEST["rol"];
	   $des=$_REQUEST["des"];
	
	  $sql = "UPDATE roles SET name='$rol', description='$des'   WHERE roleid='$id'";
		mysqli_query($conn, $sql);
 
 echo json_encode("successfully updated");
 }
 
 
 else if($act=="editPerm")
 {
	 $id=$_REQUEST["id"];
	 $per=$_REQUEST["per"];
	   $des=$_REQUEST["des"];
	
	  $sql = "UPDATE permissions SET name='$per', description='$des'   WHERE permissionid='$id'";
		mysqli_query($conn, $sql);
 
 echo json_encode("successfully updated");
 }
 
  else if($act=="editRolePerm")
 {
	 $id=$_REQUEST["id"];
	 $rol=$_REQUEST["rol"];
	   $per=$_REQUEST["per"];
	
	  $sql = "UPDATE role_permission SET roleid='$rol', permissionid='$per'   WHERE id='$id'";
		mysqli_query($conn, $sql);
 
 echo json_encode("successfully updated");
 }
 
   else if($act=="editUserRole")
 {
	 $id=$_REQUEST["id"];
	 $rol=$_REQUEST["rol"];
	   $usr=$_REQUEST["usr"];
	
	  $sql = "UPDATE user_role SET roleid='$rol', userid='$usr'   WHERE id='$id'";
		mysqli_query($conn, $sql);
 
 echo json_encode("successfully updated");
 }
 
 else if($act=="validateLE")
 {
	  $log = $_REQUEST["log"];
	  $email = $_REQUEST["email"];
	  $msg="";
	  
	   $sql="select * from users where login='$log' OR email='$email'";
		$result=mysqli_query($conn, $sql);
		$records = mysqli_num_rows($result);
		if($records>0)
		{
			$msg="exist";
			
		}
		else
			$msg="notexist";
echo json_encode($msg);
 }
 
 else if($act=="validateR")
 {
	  $rol = $_REQUEST["rol"];
	 
	  $msg="";
	  
	   $sql="select * from roles where name='$rol'";
		$result=mysqli_query($conn, $sql);
		$records = mysqli_num_rows($result);
		if($records>0)
		{
			$msg="exist";
			
		}
		else
			$msg="notexist";
echo json_encode($msg);
 }
 
 
  else if($act=="validateP")
 {
	  $per = $_REQUEST["per"];
	 
	  $msg="";
	  
	   $sql="select * from permissions where name='$per'";
		$result=mysqli_query($conn, $sql);
		$records = mysqli_num_rows($result);
		if($records>0)
		{
			$msg="exist";
			
		}
		else
			$msg="notexist";
echo json_encode($msg);
 }
 
 
  else if($act=="validateLEI")
 {
	  $log = $_REQUEST["log"];
	  $email = $_REQUEST["email"];
	  $id=$_REQUEST["id"];
	  $msg="";
	  
	   $sql="select * from users where (login='$log' OR email='$email') and userid<>'$id'";
		$result=mysqli_query($conn, $sql);
		$records = mysqli_num_rows($result);
		if($records>0)
		{
			$msg="exist";
			
		}
		else
			$msg="notexist";
echo json_encode($msg);
 }
 
   else if($act=="validateRI")
 {
	  $rol = $_REQUEST["rol"];
	  $id=$_REQUEST["id"];
	  $msg="";
	  
	   $sql="select * from roles where name='$rol' and roleid<>'$id'";
		$result=mysqli_query($conn, $sql);
		$records = mysqli_num_rows($result);
		if($records>0)
		{
			$msg="exist";
			
		}
		else
			$msg="notexist";
echo json_encode($msg);
 }
 
    else if($act=="validatePI")
 {
	  $per = $_REQUEST["per"];
	  $id=$_REQUEST["id"];
	  $msg="";
	  
	   $sql="select * from permissions where name='$per' and permissionid<>'$id'";
		$result=mysqli_query($conn, $sql);
		$records = mysqli_num_rows($result);
		if($records>0)
		{
			$msg="exist";
			
		}
		else
			$msg="notexist";
echo json_encode($msg);
 }
 
 
 else if($act=="addUser")
 {
	 $userid=$_REQUEST["id"];
	 $log=$_REQUEST["log"];
	  $pass=$_REQUEST["pass"];
	$name=$_REQUEST["name"];
	$em=$_REQUEST["email"];
	$coun=$_REQUEST["cont"];
	$city=$_REQUEST["city"];
	$adm=$_REQUEST["adm"];
	$date = date('Y-m-d H:i:s');
	  $sql = "Insert into users(login,password,name,email,countryid,createdon,createdby,isadmin,cityid) values('$log','$pass','$name','$em','$coun','$date' , '$Uid', '$adm','$city')";
		mysqli_query($conn, $sql);
 
 echo json_encode("successfully updated");
 }
 
  else if($act=="addRole")
 {
	 $id=$_REQUEST["id"];
	 $rol=$_REQUEST["rol"];
	  $des=$_REQUEST["des"];
	$date = date('Y-m-d H:i:s');
	  $sql = "Insert into roles(name,description,createdon,createdby) values('$rol','$des','$date','$Uid')";
		mysqli_query($conn, $sql);
 
 echo json_encode("successfully updated");
 }
 
 else if($act=="addPerm")
 {
	 $id=$_REQUEST["id"];
	 $per=$_REQUEST["per"];
	  $des=$_REQUEST["des"];
	$date = date('Y-m-d H:i:s');
	  $sql = "Insert into permissions(name,description,createdon,createdby) values('$per','$des','$date','$Uid')";
		mysqli_query($conn, $sql);
 
 echo json_encode("successfully updated");
 }
 
  else if($act=="addRolePerm")
 {
	 $id=$_REQUEST["id"];
	 $rol=$_REQUEST["rol"];
	  $per=$_REQUEST["per"];
	  $sql = "Insert into role_permission(roleid,permissionid) values('$rol','$per')";
		mysqli_query($conn, $sql);
 
 echo json_encode("successfully updated");
 }
 
  else if($act=="addUserRole")
 {
	 $id=$_REQUEST["id"];
	 $rol=$_REQUEST["rol"];
	  $usr=$_REQUEST["usr"];
	  $sql = "Insert into user_role(userid,roleid) values('$usr','$rol')";
		mysqli_query($conn, $sql);
 
 echo json_encode("successfully updated");
 }
 
 
?>
