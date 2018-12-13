<html>
<head>
<title>Task6</title>
<script src="SecurityManager.js"></script>
<script>
	function printData(){
		debugger;
	var url=new URL(window.location.href);
	var login=url.searchParams.get("log");
	//alert(login);
	var users = SecurityManager.GetAllUserRoles();
	var ary1= SecurityManager.GetAllRolePermissions();
	var rslt=document.getElementById("data");
	var str="";
	var bol=true;
		       for(var i=0;i<users.length;i++)
                {
				   if(users[i].user==login)
				   {
					   var rol=users[i].role;
					   str+="Role: ";
					   str+=users[i].role;
					   str+="<br>Permissions:<br>";
					   for(var j=0;j<ary1.length;j++)
					   {
						   if(ary1[j].role==rol)
						   {
							   bol=false;
							   str+=ary1[j].perm;
							   str+="<br>";
						   }
					   }
					   if(bol)
						   str+="None<br>";
					   bol=true;
					   
					   
					   
				   }
					   
						
					
				}
				
	rslt.innerHTML=str;
	
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
<body onload="printData();"  >
	<ul>
  <li><a  href="homeUser.php">Home</a></li>
  <li><a href="login.php">logout</a></li>
</ul>
	<b>Welcome User</b>
	<h2 id="data" style="margin-left:200px;"></h2>
</body>
</html>