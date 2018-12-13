<html>
<head>
<title>Task6</title>
<script type="text/javascript">
	function Main(){
	
	//Write your logic here
	alert("Main Function Call : Hammad Ahmad");
	
	
	}
	function myFun()
	{
	var b=document.getElementById("btnShow");
	b.onclick=function()
	{
	alert("myFun called: BCSF15M009");
	
	};
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
b{
	margin-left:100px;font-size:50px;font-family: 'Shrikhand';
}


</style>
</head>
<body  >
	<ul>
  <li><a  href="homeAdmin.php">Home</a></li>
  <li><a  href="userManagement.php">User Management</a></li>
  <li><a  href="roleManagement.php">Role Management</a></li>
  <li><a  href="permManagement.php">Permission Management</a></li>
  <li><a  href="RPmanagement.php">Role-Permission Management</a></li>
  <li><a href="URmanagement.php">User Role Management</a></li>
  <li><a href="login.php">logout</a></li>
</ul>
	<b>Welcome Admin</b>
</body>
</html>