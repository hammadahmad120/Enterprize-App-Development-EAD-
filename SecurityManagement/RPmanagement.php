<html>  
    <head>
        <script src="SecurityManager.js"></script>
        <script>
		var myBool=false;
		var myID=0;	
		            function SelectRP(){
                var roles = SecurityManager.GetAllRoles();
                var cmb = document.getElementById('cmbRole')
                for(var i=0;i<roles.length;i++)
                {
                    var opt = document.createElement("option");
					//opt.style.width=150px;
                    opt.setAttribute("value",roles[i].role);
					//if (arg1 == roles[i].role) {opt.setAttribute("selected", true);}
					//
                    opt.innerText = roles[i].role;

                    cmb.appendChild(opt);
                }
				
			var permission = SecurityManager.GetAllPermissions();
                var cmb1 = document.getElementById('cmbPerm')
                for(var i=0;i<permission.length;i++)
                {
                    var opt1 = document.createElement("option");
					//opt.style.width=150px;
                    opt1.setAttribute("value",permission[i].perm);
                    opt1.innerText = permission[i].perm;

                    cmb1.appendChild(opt1);
                }


                
				
				myBuildTable();

            }//end ofMain
						
	function myBuildTable()
	{
	 var ary1= SecurityManager.GetAllRolePermissions();
	var h="RPManagement.php";
	var f=.1;
	

    var myTable= "<table id='tblMain' style='border:1px solid; border-collapse: collapse;'><tr><th style='width: 100px; color: black; text-align: center; border-collapse: collapse;border:1px solid;height:50px;'>ID</th>";
    myTable+= "<th style='width: 100px; color: black; text-align: center; border-collapse: collapse;border:1px solid;height:50px;'>Role</th>";
    myTable+="<th style='width: 100px; color: black; text-align: center; border-collapse: collapse;border:1px solid;height:50px;'>Permissions</th>";
myTable+="<th style='width: 100px; color: black; text-align: center; border-collapse: collapse;border:1px solid;height:50px;'>Edit</th>";
myTable+="<th style='width: 100px; color: black; text-align: center; border-collapse: collapse;border:1px solid;height:50px;'>Delete</th></tr>";
    

  for (var i=0; i<ary1.length; i++) {
    myTable+="<tr><td style='width: 100px; text-align: center;height:50px; border-collapse: collapse;border:1px solid;'>"+ ary1[i].ID +"</td>";
    
    myTable+="<td style='width: 100px; text-align: center;height:50px; border-collapse: collapse;border:1px solid;'>"+ary1[i].role+"</td>";
    myTable+="<td style='width: 200px; text-align: center;height:50px; border-collapse: collapse;border:1px solid;'>"+ary1[i].perm+"</td>";
 myTable+="<td style='width: 100px; text-align: center;height:50px; border-collapse: collapse;border:1px solid;'><a  id="+ ary1[i].ID +" href='#' onclick='EditRP(id);' >Edit</a></td>";
myTable+="<td style='width: 100px; text-align: center;height:50px; border-collapse: collapse;border:1px solid;'><a id="+i+" href='#' onclick='DeleteRP(this);'>Delete</a></td></tr>"; 
  }  
   myTable+="</table>";
   
   document.getElementById('myDiv').innerHTML = myTable;

	}

	function validateFields()
	{
	var rol = document.forms["userForm"]["Urole"].value;
	var per = document.forms["userForm"]["Uperm"].value;

	if(per==""||rol=="")
	{
		alert("Invalid Form Entries");
		return false;
	}	
	else
	{
		var obj=new Object();
		
		if(myBool)
		{
			obj.ID=myID;
		}
		
		obj.perm=per;
		obj.role=rol;
		
			SecurityManager.SaveRolePermission(obj,Success,ErrorFind);
			myBool=false;
		
		myBuildTable();
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
	 document.forms["userForm"]["Uperm"].value="";
	 document.forms["userForm"]["Udes"].value="";
	
	
}	

function DeleteRP(vem)
{
	
	if(confirm("Are you Sure to delete?"))
	{
	var num=vem.id;
num=Number(num);
num++;
	var tbl = document.getElementById("tblMain");
 var em=tbl.rows[num].cells[0].innerText;
 em=Number(em);
 //alert(em);
 var ary2=SecurityManager.GetAllRolePermissions();
 for (var i =0; i < ary2.length; i++){
   if (ary2[i].ID ==em) {
	   
      SecurityManager.DeleteRolePermission(ary2[i].ID,Success,ErrorFind);
      break;
   }
 }
	myBuildTable(); 
 
   }
}

function EditRP(vem1)
{
	var obj=SecurityManager.GetRolePermissionById(vem1);
	

  var roles = SecurityManager.GetAllRoles();
                var cmb = document.getElementById('cmbRole');
				cmb.innerHTML = '';
                for(var i=0;i<roles.length;i++)
                {
                    var opt = document.createElement("option");
					//opt.style.width=150px;
                    opt.setAttribute("value",roles[i].role);
					if (obj.role == roles[i].role) {opt.setAttribute("selected", true);}
					//
                    opt.innerText = roles[i].role;

                    cmb.appendChild(opt);
                }
				
			var permission = SecurityManager.GetAllPermissions();
                var cmb1 = document.getElementById('cmbPerm');
				cmb1.innerHTML = '';
                for(var i=0;i<permission.length;i++)
                {
                    var opt1 = document.createElement("option");
					//opt.style.width=150px;
                    opt1.setAttribute("value",permission[i].perm);
					if (obj.perm == permission[i].perm) {opt1.setAttribute("selected", true);}
                    opt1.innerText = permission[i].perm;

                    cmb1.appendChild(opt1);
                }
myID=vem1;
 myBool=true;				
				
//SecurityManager.DeleteRolePermission(obj.ID,Success,ErrorFind);
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
 margin-left:100px;margin-top:150px; border: 1px solid black; height:380px;width:400px; text-align:left;background-color:#404040;

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
<body onload="SelectRP();">

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

<h1 style="padding-left:30px;"> Role-Permissions Management </h1>

<div class="btn-group">

<form name="userForm" method="get" >
	<div style="width:370px;padding-left:30px;background-color:white;">
	<br><br>
	<label style="color:black;">Role:</label><br>
	<select name="Urole" id="cmbRole" style="width:300px;height:30px;">

    </select>
	<br><br>
	<label style="color:black;">Permissions:</label><br>
	<select name="Uperm" id="cmbPerm" style="width:300px;height:30px;">


    </select> 
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