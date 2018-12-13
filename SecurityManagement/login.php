<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<!--link for special icons in footer-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="SecurityManager.js">
</script>
<script>
function validateAdmin()
{
	
	var usr = document.forms["adminForm"]["Aname"];
	var pas = document.forms["adminForm"]["Apass"];
	if (usr.value== ""||pas.value=="") {
	
        alert("fields not properly filled.");
		
        return false;
    }
	else{
		var rslt=SecurityManager.ValidateAdmin(usr.value,pas.value);
	if(rslt==true)
	{
		window.location.href="homeAdmin.php";
	}
	else
	{
		alert("invalid username or password");
	}
	
	}
	
	
	
}

function validateUser()
{
	
	var usr1 = document.forms["userForm"]["Uname"];
	var pas1 = document.forms["userForm"]["Upass"];
	if (usr1.value== ""||pas1.value=="") {
	
        alert("fields not properly filled.");
		
        return false;
    }
	else{
		var users = SecurityManager.GetAllUsers();
		var bol=true;
		       for(var i=0;i<users.length;i++)
                {
					
                    if(users[i].login==usr1.value&&users[i].password==pas1.value)
					{
						//alert(users[i].password);
						users[i].sess=true;
						bol=false;
						window.location.href="homeUser.php?log="+usr1.value;
						
					}
                }
				if(bol)
				alert("invalid username or password");
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

<h1 style="padding-left:30px;"> Admin Login </h1>

<div class="btn-group">

<form name="adminForm" method="get" >
	<div style="width:370px;padding-left:30px;background-color:white;">
	<br><br>
	<label style="color:black;">username:</label><br>
	<input class="box" type="text" name="Aname" > 
	<br><br>
	<label style="color:black;">password:</label><br>
	<input class="box" type="password" name="Apass"  > 
	<br><br><br><br>
	</div>
	<br><br>
<input class="submit" type="button" value="Login" onclick="return validateAdmin();"  >

</form>


</div>
</div>
</div>
</td>

<td>
<div class="images">
<div class="div1">

<h1 style="padding-left:30px;"> User Login </h1>

<div class="btn-group">

<form method="post" name="userForm">
	<div style="width:370px;padding-left:30px;background-color:white;">
	<br><br>
	<label style="color:black;">username:</label><br>
	<input class="box" type="text" name="Uname" > 
	<br><br>
	<label style="color:black;">password:</label><br>
	<input class="box" type="password" name="Upass"  > 
	<br><br><br><br>
	</div>
	<br><br>
<input class="submit" type="button" value="Login" onclick="return validateUser();"  >
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