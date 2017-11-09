<?php 
if(isset($_REQUEST['did']))
{
	include("connect.php");
	$id=$_REQUEST['did'];
	mysqli_query($con,"delete from employees where eid=$id");
	if(mysqli_affected_rows($con)==1)
	{
		setcookie("del_success","1",time()+3);
		header("Location:view_employees.php");
	}
	else{
		
		if(mysqli_errno($con)==1146)
		{
			echo "Sorry Unable to Delete.";
		}
		else
		{
			echo "Sorry Unable to Delete.";
		}
	}
}
else
{
	header("Location:view_employees.php");
}
?>