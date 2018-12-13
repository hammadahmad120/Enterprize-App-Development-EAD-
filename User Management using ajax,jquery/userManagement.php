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
		settings.data={'act':"getCountries"};
		settings.success=function(obj){
			 
                //console.log(obj);
				var cmb = $("#cmbCountries");
				var opt="<option value='0'>--select--</option>";
				cmb.append(opt);
                for(var i=0;i<obj.length;i++)
                {
                    var opt=$("<option>").attr("value",obj[i]["id"]).text(obj[i]["name"]);
                    cmb.append(opt);
                }
		}
		settings.error=function(){
			alert("error occured");
		}
		
		$.ajax(settings);
		
	$("#cmbCountries").change(function(){
		

                    var citycmb = $("#cmbCities");

                    //Remove all child elements (e.g. options)
                    citycmb.empty();

                    var settings={};
				settings.type="GET";
				settings.dataType="json";
				settings.url="Api.php";
				var v= $("#cmbCountries").val();
				settings.data={'val':v , 'act':"getCities"};
				settings.success=function(obj){
			 
                for(var i=0;i<obj.length;i++)
                {
                    var opt=$("<option>").attr("value",obj[i]["id"]).text(obj[i]["name"]);
                    citycmb.append(opt);
                }
		}
		settings.error=function(){
			alert("error occured");
		}
		
		$.ajax(settings);


                });//end of onchange
				
		
		
		$(".del").click(function(){
			
			if(confirm("Are you Sure to delete Role?")){
       var id=$(this).closest("tr").find(":first").text();
	   settings.type="GET";
				settings.dataType="json";
				settings.url="Api.php";
				
				settings.data={'val':id , 'act':"delUser"};
				settings.success=function(obj){
			 
                alert("User Successfully deleted");
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
				
				settings.data={'val':id , 'act':"getUser"};
				settings.success=function(obj){
			 $("#Ulogin").val(obj[0]["login"]);
				$("#Upass").val(obj[0]["password"]);
				$("#Uname").val(obj[0]["name"]);
				$("#Uemail").val(obj[0]["email"]);
				
				 $("#cmbCountries").find('option[value="' +obj[0]["countryid"]+ '"]').attr("selected", "selected").change();
				 
				  //$("#cmbCities").find('option[value="' +obj[0]["cityid"]+ '"]').attr("selected", "selected");
				 if(obj[0]["isadmin"]==1)
				 {
					 $("#Isadm").prop("checked",true);
				 }
				 else{
					 $("#Isadm").prop("checked",false);
				 }
				 myBool=true;
				 gid=id;
		}
		settings.error=function(){
			alert("error occured");
		}
		
		$.ajax(settings);
	   return false;

});


$("#submit").click(function(){
	
	
       var bol=validateFields();
	   if(bol==false)
	   {
		   return;
	   }
	   			var l= $("#Ulogin").val();
				var p=$("#Upass").val();
				var n=$("#Uname").val();
				var e=$("#Uemail").val();
				var co=$("#cmbCountries").val();
				var ci= $("#cmbCities").val();
				var adm="";
				if($("#Isadm").is(':checked'))
				{
					adm=1;
				}
				else{
					adm=0;
				}
					
	   if(myBool==true) //edit user
	   {
		  
		   
				settings.type="GET";
				settings.dataType="json";
				settings.url="Api.php";
				settings.data={'id':gid,'log':l ,'email':e, 'act':"validateLEI"};
				settings.success=function(obj){
					console.log(obj);
				if(obj=="exist")
				{
				alert("username or email already taken");
					return;
				}
				else{
					
					editUser();
				}
		}
		settings.error=function(){
			alert("error occured123");
		}
		
		$.ajax(settings);
	   }
	   else
	   {
				
				settings.type="GET";
				settings.dataType="json";
				settings.url="Api.php";
				settings.data={'log':l ,'email':e,'act':"validateLE"};
				settings.success=function(obj){
					console.log(obj);
				if(obj=="exist")
				{
				alert("username or email already taken");
					return;
				}
				else{
					insertUser();
				}
		}
		settings.error=function(){
			alert("error occured123");
		}
		
		$.ajax(settings);
	   }
	   

});


 function editUser(){
		  var l= $("#Ulogin").val();
				var p=$("#Upass").val();
				var n=$("#Uname").val();
				var e=$("#Uemail").val();
				var co=$("#cmbCountries").val();
				var ci= $("#cmbCities").val();
				var adm="";
				if($("#Isadm").is(':checked'))
				{
					adm=1;
				}
				else{
					adm=0;
				}
				
				var settings={};
				settings.type="GET";
				settings.dataType="json";
				settings.url="Api.php";
				settings.data={'id':gid,'log':l ,'pass':p,'name':n,'email':e,'cont':co,'city':ci,'adm':adm, 'act':"editUser"};
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

	function insertUser()
	{
		var l= $("#Ulogin").val();
				var p=$("#Upass").val();
				var n=$("#Uname").val();
				var e=$("#Uemail").val();
				var co=$("#cmbCountries").val();
				var ci= $("#cmbCities").val();
				var adm="";
				if($("#Isadm").is(':checked'))
				{
					adm=1;
				}
				else{
					adm=0;
				}
				var settings={};
				settings.type="GET";
				settings.dataType="json";
				settings.url="Api.php";
				settings.data={'id':gid,'log':l ,'pass':p,'name':n,'email':e,'cont':co,'city':ci,'adm':adm, 'act':"addUser"};
				settings.success=function(obj){
				alert("Successfully Added");
				 myBuildTable();
		}
		settings.error=function(){
			alert("error occured");
		}
		
		$.ajax(settings);
		   
	   
	}
				
		});
		
     		
	function myBuildTable()
	{
	 //var ary1= SecurityManager.GetAllUsers();
	 
	 
	 var settings={};
				settings.type="GET";
				settings.dataType="json";
				settings.url="Api.php";
				
				settings.data={'act':"getUsers"};
				settings.success=function(ary1){
			 
                 var myTable= "<table id='tblMain' style='border:1px solid; border-collapse: collapse;'><tr><th style='width: 100px; color: black; text-align: center; border-collapse: collapse;border:1px solid;height:50px;'>ID</th>";
    myTable+= "<th style='width: 100px; color: black; text-align: center; border-collapse: collapse;border:1px solid;height:50px;'>Name</th>";
    myTable+="<th style='width: 100px; color: black; text-align: center; border-collapse: collapse;border:1px solid;height:50px;'>Email</th>";
myTable+="<th style='width: 100px; color: black; text-align: center; border-collapse: collapse;border:1px solid;height:50px;'>Edit</th>";
myTable+="<th style='width: 100px; color: black; text-align: center; border-collapse: collapse;border:1px solid;height:50px;'>Delete</th></tr>";
    

  for (var i=0; i<ary1.length; i++) {
    myTable+="<tr><td style='width: 100px; text-align: center;height:50px; border-collapse: collapse;border:1px solid;'>"+ ary1[i].userid +"</td>";
    
    myTable+="<td style='width: 100px; text-align: center;height:50px; border-collapse: collapse;border:1px solid;'>"+ary1[i].name+"</td>";
    myTable+="<td style='width: 200px; text-align: center;height:50px; border-collapse: collapse;border:1px solid;'>"+ary1[i].email+"</td>";
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
	var log = document.forms["userForm"]["Ulogin"].value;
	var pas = document.forms["userForm"]["Upass"].value;
	var nam = document.forms["userForm"]["Uname"].value;
	var em= document.forms["userForm"]["Uemail"].value;
	var con = document.forms["userForm"]["Ucont"].value;
	var cit = document.forms["userForm"]["Ucity"].value;

	var alphaExp = /^[a-zA-Z ]+$/;
	var numExp = /^[0-9]+$/;
	var alphanumExp = /^[0-9a-zA-Z]+$/;
	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	if(log==""||pas==""||nam==""||em==""||con==""||cit=="")
	{
		alert("Invalid Form Entries");
		return false;
	}
	else if(!(nam.match(alphaExp)) || !(em.match(mailformat)))
		{
			alert("Invalid Name or mail format");
			return false;
		}
	
	else{ return true;}
	
	
	
	}
	
function clearText()
{
	 document.forms["userForm"]["Ulogin"].value="";
	 document.forms["userForm"]["Upass"].value="";
	document.forms["userForm"]["Uname"].value="";
	 document.forms["userForm"]["Uemail"].value="";
	 document.forms["userForm"]["Ucont"].value="";
	 document.forms["userForm"]["Ucity"].value="";
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
 margin-left:100px; border: 1px solid black; height:680px;width:400px; text-align:left;background-color:#404040;

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
 
 margin-right:30px;
 margin-bottom:30px;
 margin-left:20px;
 
 
 
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

<h1 style="padding-left:30px;"> User Management </h1>

<div class="btn-group">

<form name="userForm" method="get" >
	<div style="width:370px;padding-left:30px;background-color:white;">
	<br><br>
	<label style="color:black;">login:</label><br>
	<input class="box" type="text" name="Ulogin" id="Ulogin" > 
	<br><br>
	<label style="color:black;">password:</label><br>
	<input class="box" type="password" name="Upass" id="Upass"  >
	<br><br>
	<label style="color:black;">Name:</label><br>
	<input class="box" type="text" name="Uname" id="Uname" > 
	<br><br>
	<label style="color:black;">Email:</label><br>
	<input class="box" type="text" name="Uemail" id="Uemail" > 
	<br><br>
	<label style="color:black;">Country:</label><br>
	   <select name="Ucont" id="cmbCountries" style="width:300px;height:30px;">

    </select>
	<br><br>
	<label style="color:black;">City:</label><br>
    <select name="Ucity" id="cmbCities" style="width:300px;height:30px;">


    </select> 
	<br><br>
	<label style="color:black;">isadmin</label>
    <input name="Isadm" id="Isadm" type="checkbox" value="1">
	<br><br><br><br>
	</div>
	<br><br>
	<table>
	<tr>
<td><input class="submit" id="submit" type="button" value="Save"  ></td>
<td><input class="submit" type="button" value="Clear" onclick="clearText();"  ></td></tr></table>


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