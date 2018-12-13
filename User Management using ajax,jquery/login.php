<?php require('conn.php');
session_start();
 ?>
<?php
   $error=""; 
   $usr="";
   if(isset($_REQUEST["subbtn"])==true)
   {
	   
	   
	   
	   
	   $usr=$_REQUEST["Aname"];
	   $pass=$_REQUEST["Apass"];
	    
		$sql="select * from users where login='$usr' and password='$pass'";
		$result=mysqli_query($conn, $sql);
		$records = mysqli_num_rows($result);
		if($records>0)
		{
			$row=mysqli_fetch_assoc($result);
			
			if($row["isadmin"]!="1")
			{
			$localIP = gethostbyname(trim(exec("hostname")));
			$userid=$row["userid"];
			$date = date('Y-m-d H:i:s');
			 $sql = "Insert into loginhistory(userid,login,logintime,machineip) values('$userid','$usr','$date' , '$localIP')";
			 mysqli_query($conn, $sql);
			}
			
			
				$_SESSION["chk"]=$row["isadmin"];
				$_SESSION["logId"]=$row["userid"];
				header('location:home.php');
			
		}
	else
	{
		$error="invalid username or password";
   }
   }
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<!--link for special icons in footer-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script>
function validateAdmin()
{
	
	var usr = document.forms["adminForm"]["Aname"];
	var pas = document.forms["adminForm"]["Apass"];
	if (usr.value== ""||pas.value=="") {
	
        alert("fields not properly filled.");
		
        return false;
    }
	
}


</script>
<style>
@import url(https://fonts.googleapis.com/css?family=Shrikhand);

#nameStyle{
color: 	#404040;
font-family: 'Shrikhand';

font-size: 80px;
margin-top:60px;
margin-left:60px;


}

.div1 {
 margin-left:60px; border: 1px solid black; height:400px;width:400px; text-align:left;background-color:#404040;

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
background-color:white;
color:#404040;
font-family:arial;
 border:none;
 float:right;
 margin-right:150px;
 margin-bottom:30px;
 
 
 
 }




</style>
</head>

<body style="background-color:#F0F8FF">
<div >
<span id="nameStyle">Security Manager</span>
</div>


<table>
<tr>
<td>
<div class="images">
<div class="div1">

<h1 style="padding-left:30px;"> Login </h1>

<div class="btn-group">

<form name="adminForm" method="get" action="login.php" >
	<div style="width:370px;padding-left:30px;background-color:white;">
	<br><br>
	<label style="color:black;">username:</label><br>
	<input class="box" type="text" name="Aname" value="<?php echo $usr?>" > 
	<br><br>
	<label style="color:black;">password:</label><br>
	<input class="box" type="password" name="Apass"  >

	<br>
	<?php
if($error!="")
{?>
<label style="color:red;">
<?php
echo $error;

}?>
</label>	
	<br><br><br>
	</div>
	<br><br>
	
<input class="submit" type="submit" value="Login" name="subbtn" onclick="return validateAdmin();"  >

</form>


</div>
</div>
</div>
</td>
</tr>
</table>



</body>
</head>

</html>