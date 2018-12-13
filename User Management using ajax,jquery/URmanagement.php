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
				settings.type="GET";
				settings.dataType="json";
				settings.url="Api.php";
				
				settings.data={'act': "getRoles"};
				settings.success=function(obj){
			 
                //console.log(obj);
				var cmb = $("#cmbRole");
                for(var i=0;i<obj.length;i++)
                {
                    var opt=$("<option>").attr("value",obj[i]["roleid"]).text(obj[i]["name"]);
                    cmb.append(opt);
                }
		}
		settings.error=function(){
			alert("error occured");
		}
		
		$.ajax(settings);
		
		
		settings.type="GET";
				settings.dataType="json";
				settings.url="Api.php";
				
				settings.data={'act': "getUsers"};
				settings.success=function(obj){
			 
                //console.log(obj);
				var cmb = $("#cmbUser");
                for(var i=0;i<obj.length;i++)
                {
                    var opt=$("<option>").attr("value",obj[i]["userid"]).text(obj[i]["name"]);
                    cmb.append(opt);
                }
		}
		settings.error=function(){
			alert("error occured");
		}
		
		$.ajax(settings);
			
			
			
		



$("#submit").click(function(){
	
	
       var bol=validateFields();
	   if(bol==false)
	   {
		   return;
	   }
	   			
	   if(myBool==true) //edit role
	   {
		  
		  editUserRole();
		  return;
	   }
	   else 
	   {
				insertUserRole();
				return;
	   }
	   

});

function editUserRole(){
	
		   var rol=$("#cmbRole").val();
				var usr=$("#cmbUser").val();
					
				var settings={};
				settings.type="GET";
				settings.dataType="json";
				settings.url="Api.php";
				settings.data={'id':gid,'rol':rol ,'usr':usr,'act':"editUserRole"};
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
		return false;
	  }		


function insertUserRole()
	{
		
		    var rol=$("#cmbRole").val();
				var usr=$("#cmbUser").val();
					
				var settings={};
				settings.type="GET";
				settings.dataType="json";
				settings.url="Api.php";
				settings.data={'id':gid,'rol':rol ,'usr':usr,'act':"addUserRole"};
				settings.success=function(obj){
				alert("Successfully Inserted");
				myBuildTable();
				myBool=false;
				gid=0;
				 
		}
		settings.error=function(){
			alert("error occured");
		}
		
		$.ajax(settings);
		   
	   
	}
		  
			
			
		});  //end of Dom ready	

 
		function EditUR(this1){
	
		buildCombo();
       var id=$(this1).closest("tr").find(":first").text();
			var settings={};
			settings.type="GET";
				settings.dataType="json";
				settings.url="Api.php";
				settings.data={'val':id , 'act':"getUserRole"};
				settings.success=function(obj){
			 var  uid=obj[0]["userid"];
			 var rid=obj[0]["roleid"];
			  $("#cmbUser").find('option[value="' + uid + '"]').attr("selected", "selected");
			   $("#cmbRole").find('option[value="' + rid + '"]').attr("selected", "selected");
			   myBool=true;
			   gid=id;
		}
		settings.error=function(){
			alert("error occured");
		}
		
		$.ajax(settings);
	   return false;

}

		
			function DeleteUR(this1){
	if(confirm("Are you Sure to delete User-Role?")){
       var id=$(this1).closest("tr").find(":first").text();
	   var settings={};
	   settings.type="GET";
				settings.dataType="json";
				settings.url="Api.php";
				
				settings.data={'val':id , 'act':"delUserRole"};
				settings.success=function(obj){
			 
                alert("User-Role Successfully deleted");
				myBuildTable();
		}
		settings.error=function(){
			alert("error occured");
		}
		
		$.ajax(settings);
				return false;
				}
	   

}	

function buildCombo(){
	var settings={};
				settings.type="GET";
				settings.dataType="json";
				settings.url="Api.php";
				
				settings.data={'act': "getRoles"};
				settings.success=function(obj){
			 
                //console.log(obj);
				var cmb = $("#cmbRole");
				cmb.empty();
				
                for(var i=0;i<obj.length;i++)
                {
                    var opt=$("<option>").attr("value",obj[i]["roleid"]).text(obj[i]["name"]);
                    cmb.append(opt);
                }
		}
		settings.error=function(){
			alert("error occured");
		}
		
		$.ajax(settings);
		
		
		settings.type="GET";
				settings.dataType="json";
				settings.url="Api.php";
				
				settings.data={'act': "getUsers"};
				settings.success=function(obj){
			 
                //console.log(obj);
				var cmb = $("#cmbUser");
				cmb.empty();
				
                for(var i=0;i<obj.length;i++)
                {
                    var opt=$("<option>").attr("value",obj[i]["userid"]).text(obj[i]["name"]);
                    cmb.append(opt);
                }
		}
		settings.error=function(){
			alert("error occured");
		}
		
		$.ajax(settings);
			}	
	function myBuildTable()
	{
	 
				var settings={};
				settings.type="GET";
				settings.dataType="json";
				settings.url="Api.php";
				
				settings.data={'act': "getUsersRoles"};
				settings.success=function(ary1){
		

    var myTable= "<table id='tblMain' style='border:1px solid; border-collapse: collapse;'><tr><th style='width: 100px; color: black; text-align: center; border-collapse: collapse;border:1px solid;height:50px;'>ID</th>";
    myTable+= "<th style='width: 100px; color: black; text-align: center; border-collapse: collapse;border:1px solid;height:50px;'>User</th>";
    myTable+="<th style='width: 100px; color: black; text-align: center; border-collapse: collapse;border:1px solid;height:50px;'>Role</th>";
myTable+="<th style='width: 100px; color: black; text-align: center; border-collapse: collapse;border:1px solid;height:50px;'>Edit</th>";
myTable+="<th style='width: 100px; color: black; text-align: center; border-collapse: collapse;border:1px solid;height:50px;'>Delete</th></tr>";
    
if(ary1!="noData"){
  for (var i=0; i<ary1.length; i++) {
    myTable+="<tr><td style='width: 100px; text-align: center;height:50px; border-collapse: collapse;border:1px solid;'>"+ ary1[i]["id"] +"</td>";
    
    myTable+="<td style='width: 100px; text-align: center;height:50px; border-collapse: collapse;border:1px solid;'>"+ary1[i]["uname"]+"</td>";
    myTable+="<td style='width: 200px; text-align: center;height:50px; border-collapse: collapse;border:1px solid;'>"+ary1[i]["rname"]+"</td>";
 myTable+="<td style='width: 100px; text-align: center;height:50px; border-collapse: collapse;border:1px solid;'><button  class='edit' onclick='EditUR(this);' >Edit</button></td>";

myTable+="<td style='width: 100px; text-align: center;height:50px; border-collapse: collapse;border:1px solid;'><button class='del' onclick='DeleteUR(this);'>Delete</button></td></tr>"; 
  }  
}
   myTable+="</table>";
   
   
   $("#myDiv").html(myTable);

	}
	
			settings.error=function(){
			alert("error occured in getRoles");
		}
		
		$.ajax(settings);
	
	
	}

	function validateFields()
	{
	var rol = document.forms["userForm"]["cmbRole"].value;
	var desp = document.forms["userForm"]["cmbUser"].value;

	var alphanumExp = /^[0-9a-zA-Z ]+$/;
	if(rol==""||desp=="")
	{
		alert("Invalid Form Entries");
		return false;
	}
	else if(!(rol.match(alphanumExp))||!(desp.match(alphanumExp)))
		{
			alert("Invalid role or description Entry");
		}
	else{ return true;}
	
	}
	
function clearText()
{
	 document.forms["userForm"]["cmbRole"].value="";
	 document.forms["userForm"]["cmbUser"].value="";
	 
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
  <li><a  href="home.php">Home</a></li>
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

<h1 style="padding-left:30px;"> User-Role Management </h1>

<div class="btn-group">

<form name="userForm" method="get" >
	<div style="width:370px;padding-left:30px;background-color:white;">
	<label style="color:black;">User:</label><br>
	<select name="cmbUser" id="cmbUser" style="width:300px;height:30px;">

    </select>
	<br><br>
	<label style="color:black;">Role:</label><br>
	<select name="cmbRole" id="cmbRole" style="width:300px;height:30px;">


    </select> 
	<br><br><br>

	
<input class="submit" id="submit" type="button" value="Save" >



</form>

</div>
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