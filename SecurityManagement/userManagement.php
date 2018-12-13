<html>  
    <head>
        <script src="SecurityManager.js"></script>
        <script>
		var myBool=false;
		var myID=0;
            function SelectCountry(){
                var countries = SecurityManager.GetCountries();
                var cmb = document.getElementById('cmbCountries')
                for(var i=0;i<countries.length;i++)
                {
                    var opt = document.createElement("option");
					//opt.style.width=150px;
                    opt.setAttribute("value",countries[i].CountryID);
                    opt.innerText = countries[i].Name;

                    cmb.appendChild(opt);
                }


                cmb.onchange = function(){

                    var citycmb = document.getElementById('cmbCities');

                    //Remove all child elements (e.g. options)
                    citycmb.innerHTML = '';

                    var cities = SecurityManager.GetCitiesByCountryId(cmb.value);

                    for(var i=0;i<cities.length;i++)
                    {
                        var opt = document.createElement("option");
                        opt.setAttribute("value",cities[i].CityID);
                        opt.innerText = cities[i].Name;

                        citycmb.appendChild(opt);
                    }   


                }//end of onchange
				
				myBuildTable();

            }//end ofMain
			
	function myBuildTable()
	{
	 var ary1= SecurityManager.GetAllUsers();
	var h="userManagement.php";
	var f=.1;
	

    var myTable= "<table id='tblMain' style='border:1px solid; border-collapse: collapse;'><tr><th style='width: 100px; color: black; text-align: center; border-collapse: collapse;border:1px solid;height:50px;'>ID</th>";
    myTable+= "<th style='width: 100px; color: black; text-align: center; border-collapse: collapse;border:1px solid;height:50px;'>Name</th>";
    myTable+="<th style='width: 100px; color: black; text-align: center; border-collapse: collapse;border:1px solid;height:50px;'>Email</th>";
myTable+="<th style='width: 100px; color: black; text-align: center; border-collapse: collapse;border:1px solid;height:50px;'>Edit</th>";
myTable+="<th style='width: 100px; color: black; text-align: center; border-collapse: collapse;border:1px solid;height:50px;'>Delete</th></tr>";
    

  for (var i=0; i<ary1.length; i++) {
    myTable+="<tr><td style='width: 100px; text-align: center;height:50px; border-collapse: collapse;border:1px solid;'>"+ ary1[i].ID +"</td>";
    
    myTable+="<td style='width: 100px; text-align: center;height:50px; border-collapse: collapse;border:1px solid;'>"+ary1[i].name+"</td>";
    myTable+="<td style='width: 200px; text-align: center;height:50px; border-collapse: collapse;border:1px solid;'>"+ary1[i].email+"</td>";
 myTable+="<td style='width: 100px; text-align: center;height:50px; border-collapse: collapse;border:1px solid;'><a  id="+ i+f +" href='#' onclick='EditUser(this);' >Edit</a></td>";
myTable+="<td style='width: 100px; text-align: center;height:50px; border-collapse: collapse;border:1px solid;'><a id="+i+" href='#' onclick='DeleteUser(this);'>Delete</a></td></tr>"; 
  }  
   myTable+="</table>";
   
   document.getElementById('myDiv').innerHTML = myTable;

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
	else
	{
		if(!(nam.match(alphaExp)) || !(em.match(mailformat)))
		{
			alert("Invalid Name or mail format");
		}
	
	else
	{
		var obj=new Object();
		if(myBool)
		{
			obj.ID=myID;
		}
		
		
		obj.login=log;
		obj.password=pas;
		obj.name=nam;
		obj.email=em;
		obj.country=con;
		obj.city=cit;
		obj.sess=false;
		var ary=SecurityManager.GetAllUsers();
		
		var bol=true;
		if(myBool==false)
		{
		for(var i=0;i<ary.length;i++)
		{
			if(ary[i].login==log||ary[i].email==em)
				bol=false;
		}
		}
		if(bol==true)
		{
			SecurityManager.SaveUser(obj,Success,ErrorFind);
			myBool=false;
		}
		else
		{
			alert("login or email already exist");
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
	 document.forms["userForm"]["Ulogin"].value="";
	 document.forms["userForm"]["Upass"].value="";
	document.forms["userForm"]["Uname"].value="";
	 document.forms["userForm"]["Uemail"].value="";
	 document.forms["userForm"]["Ucont"].value="";
	 document.forms["userForm"]["Ucity"].value="";
	
}	

function DeleteUser(vem)
{
	
	if(confirm("Are you Sure to delete User?"))
	{
	var num=vem.id;
num=Number(num);
num++;
	var tbl = document.getElementById("tblMain");
 var em=tbl.rows[num].cells[2].innerText;
 //alert(em);
 var ary2=SecurityManager.GetAllUsers();
 for (var i =0; i < ary2.length; i++){
   if (ary2[i].email ==em) {
	   
      SecurityManager.DeleteUser(ary2[i].ID,Success,ErrorFind);
      break;
   }
 }
	myBuildTable(); 
 
   }
}

function EditUser(vem1)
{
	
  var num1=vem1.id;
  num1=parseInt(num1);
  num1=num1/10;
  
  num1++;
  var tb = document.getElementById("tblMain");
 var em1=tb.rows[num1].cells[2].innerText;
 var ary2=SecurityManager.GetAllUsers();
 for (var i =0; i < ary2.length; i++){
   if (ary2[i].email ==em1) {
	   myID=ary2[i].ID;
	   myBool=true;
	    
	  document.forms["userForm"]["Ulogin"].value=ary2[i].login;
	 document.forms["userForm"]["Upass"].value=ary2[i].password;
	 document.forms["userForm"]["Uname"].value=ary2[i].name;
	 document.forms["userForm"]["Uemail"].value=ary2[i].email;
	 //SecurityManager.DeleteUser(ary2[i].ID,Success2,ErrorFind);
	 //document.forms["userForm"]["Ucont"].value=ary2[i].country;
	 //document.forms["userForm"]["Ucity"].value=ary2[i].city;
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
<body onload="SelectCountry();">

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
	<input class="box" type="text" name="Ulogin" > 
	<br><br>
	<label style="color:black;">password:</label><br>
	<input class="box" type="password" name="Upass"  >
	<br><br>
	<label style="color:black;">Name:</label><br>
	<input class="box" type="text" name="Uname" > 
	<br><br>
	<label style="color:black;">Email:</label><br>
	<input class="box" type="text" name="Uemail" > 
	<br><br>
	<label style="color:black;">Country:</label><br>
	   <select name="Ucont" id="cmbCountries" style="width:300px;height:30px;">

    </select>
	<br><br>
	<label style="color:black;">City:</label><br>
    <select name="Ucity" id="cmbCities" style="width:300px;height:30px;">


    </select> 
	<br><br><br><br>
	</div>
	<br><br>
	<table>
	<tr>
<td><input class="submit" type="button" value="Save" onclick="return validateFields();"  ></td>
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