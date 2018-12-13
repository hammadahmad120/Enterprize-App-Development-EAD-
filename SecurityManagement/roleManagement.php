<html>  
    <head>
        <script src="SecurityManager.js"></script>
        <script>
		var myBool=false;
		var myID=0;				
	function myBuildTable()
	{
	 var ary1= SecurityManager.GetAllRoles();
	var h="roleManagement.php";
	var f=.1;
	

    var myTable= "<table id='tblMain' style='border:1px solid; border-collapse: collapse;'><tr><th style='width: 100px; color: black; text-align: center; border-collapse: collapse;border:1px solid;height:50px;'>ID</th>";
    myTable+= "<th style='width: 100px; color: black; text-align: center; border-collapse: collapse;border:1px solid;height:50px;'>Name</th>";
    myTable+="<th style='width: 100px; color: black; text-align: center; border-collapse: collapse;border:1px solid;height:50px;'>Description</th>";
myTable+="<th style='width: 100px; color: black; text-align: center; border-collapse: collapse;border:1px solid;height:50px;'>Edit</th>";
myTable+="<th style='width: 100px; color: black; text-align: center; border-collapse: collapse;border:1px solid;height:50px;'>Delete</th></tr>";
    

  for (var i=0; i<ary1.length; i++) {
    myTable+="<tr><td style='width: 100px; text-align: center;height:50px; border-collapse: collapse;border:1px solid;'>"+ ary1[i].ID +"</td>";
    
    myTable+="<td style='width: 100px; text-align: center;height:50px; border-collapse: collapse;border:1px solid;'>"+ary1[i].role+"</td>";
    myTable+="<td style='width: 200px; text-align: center;height:50px; border-collapse: collapse;border:1px solid;'>"+ary1[i].descript+"</td>";
 myTable+="<td style='width: 100px; text-align: center;height:50px; border-collapse: collapse;border:1px solid;'><a  id="+ i+f +" href='#' onclick='EditRole(this);' >Edit</a></td>";
myTable+="<td style='width: 100px; text-align: center;height:50px; border-collapse: collapse;border:1px solid;'><a id="+i+" href='#' onclick='DeleteRole(this);'>Delete</a></td></tr>"; 
  }  
   myTable+="</table>";
   
   document.getElementById('myDiv').innerHTML = myTable;

	}

	function validateFields()
	{
	var rol = document.forms["userForm"]["Urole"].value;
	var desp = document.forms["userForm"]["Udes"].value;

	var alphanumExp = /^[0-9a-zA-Z ]+$/;
	if(rol==""||desp=="")
	{
		alert("Invalid Form Entries");
		return false;
	}
	else
	{
		if(!(rol.match(alphanumExp))||!(desp.match(alphanumExp)))
		{
			alert("Invalid role or description Entry");
		}
	
	else
	{
		var obj=new Object();
		
		if(myBool)
		{
			obj.ID=myID;
		}
		
		obj.role=rol;
		obj.descript=desp;
		var ary=SecurityManager.GetAllRoles();
		
		var bol=true;
		for(var i=0;i<ary.length;i++)
		{
			if(ary[i].role==rol&&ary[i].ID!=myID)
				bol=false;
		}
		
		if(bol==true)
		{
			SecurityManager.SaveRole(obj,Success,ErrorFind);
			document.forms["userForm"]["Urole"].value="";
	 document.forms["userForm"]["Udes"].value="";
			
			myBool=false;
			myID=0;
		}
		else
		{
			alert("Role name already exist");
		}
		
		myBuildTable();
	}
	
	}
	
	
	}
	
         function Success()
		 {
			 alert("Successfully Executed");
		 }	
		 function Success2()
		 {
		
		 }	
     function ErrorFind()
	 {
		 alert("there is Error");
	 }
function clearText()
{
	 document.forms["userForm"]["Urole"].value="";
	 document.forms["userForm"]["Udes"].value="";
	
	
}	

function DeleteRole(vem)
{
	
	if(confirm("Are you Sure to delete Role?"))
	{
	var num=vem.id;
num=Number(num);
num++;
	var tbl = document.getElementById("tblMain");
 var em=tbl.rows[num].cells[0].innerText;
 em=Number(em);
 //alert(em);
 var ary2=SecurityManager.GetAllRoles();
 for (var i =0; i < ary2.length; i++){
   if (ary2[i].ID ==em) {
	   
      SecurityManager.DeleteRole(ary2[i].ID,Success,ErrorFind);
      break;
   }
 }
	myBuildTable(); 
 
   }
}

function EditRole(vem1)
{
	
  var num1=vem1.id;
  num1=parseInt(num1);
  num1=num1/10;
  
  num1++;
  var tb = document.getElementById("tblMain");
 var em1=tb.rows[num1].cells[1].innerText;
 var ary2=SecurityManager.GetAllRoles();
 for (var i =0; i < ary2.length; i++){
   if (ary2[i].role ==em1) {
	   myID=ary2[i].ID;
	   myBool=true;
	    
	  document.forms["userForm"]["Urole"].value=ary2[i].role;
	 document.forms["userForm"]["Udes"].value=ary2[i].descript;
	 //SecurityManager.DeleteRole(ary2[i].ID,Success,ErrorFind);
	 break;
   }
 
}
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
 margin-left:100px;margin-top:150px; border: 1px solid black; height:350px;width:400px; text-align:left;background-color:#404040;

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
 float:right;
 margin-right:30px;
 margin-top:30px;

 
 
 
 }

</style>

    </head>
<body onload="myBuildTable();">

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

<form name="userForm" method="get" >
	<div style="width:370px;padding-left:30px;background-color:white;">
	<br><br>
	<label style="color:black;">Role Name:</label><br>
	<input class="box" type="text" name="Urole" > 
	<br><br>
	<label style="color:black;">Description:</label><br>
	<input class="box" type="text" name="Udes"  >
	<br><br><br>
	
<input class="submit" type="button" value="Save" onclick="return validateFields();"  >



</form>


</div>
</div>
</div>
</td>
<td>
<div class="div2" id="myDiv">

	</div>
</td>
</tr>
</table>

</body>

</html>