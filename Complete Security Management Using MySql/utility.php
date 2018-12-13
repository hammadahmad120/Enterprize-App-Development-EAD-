

	 <?php
		function GetRoles($conn)
		{			
			$sql = "SELECT * FROM roles";
					
			$result = mysqli_query($conn, $sql);
			$recordsFound = mysqli_num_rows($result);			
			echo $pid;
			echo $rid;
			echo "in other";
			if ($recordsFound > 0) {
				//echo $recordsFound;
				while($row = mysqli_fetch_assoc($result)) {
				
					$id = $row["roleid"];
					$name = $row["name"];
					if(empty($rid)==false && $rid==$id)
					{
						$v="selected";
						echo "selected";
						echo "<option value='$id' $v >$name</option>";
					}
					else
					{
					echo "<option value='$id'>$name</option>";
					}
				}
			}	
		}
		function GetPermissions($conn)
		{			
			$sql = "SELECT * FROM permissions";
					
			$result = mysqli_query($conn, $sql);
			$recordsFound = mysqli_num_rows($result);			
			
			if ($recordsFound > 0) {
				//echo $recordsFound;
				while($row = mysqli_fetch_assoc($result)) {
				
					$id = $row["permissionid"];
					$name = $row["name"];
					
					if(empty($pid)==false&&$pid==$id)
					{
						$v="selected";
						echo "<option value='$id' $v >$name</option>";
					}
					else
					{
					echo "<option value='$id'>$name</option>";
					}
				}
			}	
		}
		
	?>

