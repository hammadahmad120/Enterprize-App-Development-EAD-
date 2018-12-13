<html>  
    <head>
       <script src="jquery-3.2.1.min.js" ></script>
        <script>
		var myBool=false;
		var gid=0;
		//var myID=0;
		myBuildTable();
		$(document).ready(function(){
			
			
			var settings={};
			$(".del").click(function(){
	if(confirm("Are you Sure to delete Permission?")){
       var id=$(this).closest("tr").find(":first").text();
	   settings.type="GET";
				settings.dataType="json";
				settings.url="Api.php";
				
				settings.data={'val':id , 'act':"delPerm"};
				settings.success=function(obj){
			 
                alert("Permission Successfully deleted");
				myBuildTable();
		}
		settings.error=function(){
			alert("error occured");
		}
		
		$.ajax(settings);
				
				}
	   

});


$(".edit").click(function(){
	
       var id=$(this).closest("tr").find(":first").text();
			var settings={};
			settings.type="GET";
				settings.dataType="json";
				settings.url="Api.php";
				
				settings.data={'val':id , 'act':"getPerm"};
				settings.success=function(obj){
			 $("#Uperm").val(obj[0]["name"]);
				$("#Udes").val(obj[0]["description"]);
				 myBool=true;
				 gid=id;
		}
		settings.error=function(){
			alert("error occured");
		}
		
		$.ajax(settings);
	   

});



$("#submit").click(function(){
	
	
       var bol=validateFields();
	   if(bol==false)
	   {
		   return;
	   }
	   			var per=$("#Uperm").val();
				var des=$("#Udes").val();
					
	   if(myBool==true) //edit role
	   {
		  
		   
				settings.type="GET";
				settings.dataType="json";
				settings.url="Api.php";
				settings.data={'id':gid,'per':per , 'act':"validatePI"};
				settings.success=function(obj){
					console.log(obj);
				if(obj=="exist")
				{
				alert("Permission already exist");
					return;
				}
				else{
					
					editPerm();
				}
		}
		settings.error=function(){
			alert("error occured");
		}
		
		$.ajax(settings);
	   }
	   else 
	   {
				
				settings.type="GET";
				settings.dataType="json";
				settings.url="Api.php";
				settings.data={'per':per ,'act':"validateP"};
				settings.success=function(obj){
					console.log(obj);
				if(obj=="exist")
				{
				alert("Permission already exist");
					return;
				}
				else{
					insertPerm();
				}
		}
		settings.error=function(){
			alert("error occured");
		}
		
		$.ajax(settings);
	   }
	   

});

function editPerm(){
	
		    var per=$("#Uperm").val();
			var des=$("#Udes").val();
				
				var settings={};
				settings.type="GET";
				settings.dataType="json";
				settings.url="Api.php";
				settings.data={'id':gid,'per':per ,'des':des,'act':"editPerm"};
				settings.success=function(obj){
				alert("Successfully Updated");
				myBuildTable();
				myBool=false;
				gid=0;
				 
		}
		settings.error=function(){
			alert("error occured");
		}
		
		$.ajax(settings);
	  }		


function insertPerm()
	{
		
		    var per=$("#Uperm").val();
			var des=$("#Udes").val();
				var settings={};
				settings.type="GET";
				settings.dataType="json";
				settings.url="Api.php";
				settings.data={'id':gid,'per':per ,'des':des , 'act':"addPerm"};
				settings.success=function(obj){
				alert("Successfully Added");
				 myBuildTable();
		}
		settings.error=function(){
			alert("error occured");
		}
		
		$.ajax(settings);
		   
	   
	}
		  

			
			
		});  //end of Dom ready			
	function myBuildTable()
	{
	 
				var settings={};
				settings.type="GET";
				settings.dataType="json";
				settings.url="Api.php";
				
				settings.data={'act': "getPerms"};
				settings.success=function(ary1){
		

    var myTable= "<table id='tblMain' style='border:1px solid; border-collapse: collapse;'><tr><th style='width: 100px; color: black; text-align: center; border-collapse: collapse;border:1px solid;height:50px;'>ID</th>";
    myTable+= "<th style='width: 100px; color: black; text-align: center; border-collapse: collapse;border:1px solid;height:50px;'>Name</th>";
    myTable+="<th style='width: 100px; color: black; text-align: center; border-collapse: collapse;border:1px solid;height:50px;'>Description</th>";
myTable+="<th style='width: 100px; color: black; text-align: center; border-collapse: collapse;border:1px solid;height:50px;'>Edit</th>";
myTable+="<th style='width: 100px; color: black; text-align: center; border-collapse: collapse;border:1px solid;height:50px;'>Delete</th></tr>";
    

  for (var i=0; i<ary1.length; i++) {
    myTable+="<tr><td style='width: 100px; text-align: center;height:50px; border-collapse: collapse;border:1px solid;'>"+ ary1[i].permissionid +"</td>";
    
    myTable+="<td style='width: 100px; text-align: center;height:50px; border-collapse: collapse;border:1px solid;'>"+ary1[i].name+"</td>";
    myTable+="<td style='width: 200px; text-align: center;height:50px; border-collapse: collapse;border:1px solid;'>"+ary1[i].description+"</td>";
 myTable+="<td style='width: 100px; text-align: center;height:50px; border-collapse: collapse;border:1px solid;'><button  class='edit' >Edit</button></td>";

myTable+="<td style='width: 100px; text-align: center;height:50px; border-collapse: collapse;border:1px solid;'><button class='del'>Delete</button></td></tr>"; 
  }  
   myTable+="</table>";
   
   
   $("#myDiv").html(myTable);

	}
	
			settings.error=function(){
			alert("error occured");
		}
		
		$.ajax(settings);
	
	
	}

	function validateFields()
	{
	var rol = document.forms["userForm"]["Uperm"].value;
	var desp = document.forms["userForm"]["Udes"].value;

	var alphanumExp = /^[0-9a-zA-Z ]+$/;
	if(rol==""||desp=="")
	{
		alert("Invalid Form Entries");
		return false;
	}
	else if(!(rol.match(alphanumExp))||!(desp.match(alphanumExp)))
		{
			alert("Invalid Permission or description Entry");
		}
	else{ return true;}
	
	}
	
function clearText()
{
	 document.forms["userForm"]["Uperm"].value="";
	 document.forms["userForm"]["Udes"].value="";
	 
	 myBool=false;
		gid=0;
	
	
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
<body >

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

<h1 style="padding-left:30px;"> Permission Management </h1>

<div class="btn-group">

<form name="userForm" method="get" >
	<div style="width:370px;padding-left:30px;background-color:white;">
	<br><br>
	<label style="color:black;">Role Name:</label><br>
	<input class="box" type="text" name="Uperm" id="Uperm" > 
	<br><br>
	<label style="color:black;">Description:</label><br>
	<input class="box" type="text" name="Udes" id="Udes"  >
	<br><br><br>
	
<input class="submit" id="submit" type="button" value="Save" >



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