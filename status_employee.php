<?php 
if(isset($_REQUEST['key']))
{
	$id=$_REQUEST['key'];
	include("connect.php");
	$res=mysqli_query($con,"select status from employees where eid=$id");
	$row=mysqli_fetch_assoc($res);
	if($row['status']=="Active")
	{
		//update status to inactive
		mysqli_query($con,"update employees set status='InActive' where eid=$id");
		header("Location:view_employees.php");
		
	}
	else
	{
		//update statis to active
		mysqli_query($con,"update employees set status='Active' where eid=$id");
		header("Location:view_employees.php");
	}
}
else
{
	header("Location:view_employees.php");
}

?>