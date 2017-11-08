<?php 
if(isset($_REQUEST['key']))
{
	include("connect.php");
	$id=$_REQUEST['key'];
	$result=mysqli_query($con,"select *from employees where eid=$id");
	$row=mysqli_fetch_assoc($result);
	
}
else
{
	header("location:view_employees.php");
}
?>

<html>
	<head>
		<title>Add Employee</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<style>
		label.error{color:red;}
		</style>
		<link rel="stylesheet" href="css/jquery-ui.css">
		<script src="js/jquery-1.12.4.js"></script>
		<script src="js/jquery-ui.js"></script>
		<script src="js/jquery.validate.min.js"></script>
		 <script>
		  $( function() {
			$( "#datepicker" ).datepicker({
				yearRange: "1950:2007",
				changeMonth: true,
				changeYear: true,
				dateFormat:'yy-mm-dd'
			});
		  } );
		</script>
		
		
  
	</head>
	<body>
		<div class="container-fluid well">
			<nav class="navbar navbar-default">
				<ul class="navbar-nav nav">
					<li><a href="view_employees.php">View Employees</a></li>
					<li><a href="add_employee.php">Add Employee</a></li>
				</ul>
			</nav>
			<div class="row">
				<h2>Edit Employee</h2>
				
				<?php 
				if(isset($_POST['edit']))
				{
					$ename=filterFormData($_POST['name']);
					$email=filterFormData($_POST['email']);
					$mobile=filterFormData($_POST['mobile']);
					$gender=filterFormData($_POST['gender']);
					$dob=filterFormData($_POST['dob']);
					$addr=filterFormData($_POST['address']);
					$city=filterFormData($_POST['city']);
					$state=filterFormData($_POST['state']);
					$pin=filterFormData($_POST['pincode']);
					if(is_uploaded_file($_FILES['image']['tmp_name']))
					{
						$filename=$_FILES['image']['name'];
						move_uploaded_file($_FILES['image']['tmp_name'],"employees/$filename");
					}
					else
					{
						$filename=$row['image'];
					}
					
					$query="update employees set
					ename='$ename',
					email='$email',
					mobile='$mobile',
					gender='$gender',
					address='$addr',
					dob='$dob',
					city='$city',
					state='$state',
					pincode='$pin',
					image='$filename' where eid=$id";
					
					mysqli_query($con,$query);
					if(mysqli_affected_rows($con)>0)
					{
						setcookie("edit_success","1",time()+3);
						header("Location:view_employees.php");
					}
					else
					{
						echo mysqli_error($con);
					}
				}
				
				function filterFormData($data)
				{
					if(!empty($data))
					{
						return addslashes(strip_tags(trim($data)));
					}
				}
				
				?>
				
				
				<form id="emp" action="" method="POST" enctype="multipart/form-data">
				
					<div class="col-md-6">
						<div class="form-group">
						 <label for="cname">Name (required, at least 2 characters)</label>
						<input value="<?php echo $row['ename'];?>" id="cname" class="form-control" name="name" minlength="2" type="text" required>
						</div>
						
						<div class="form-group">
							<label>Email</label>
							<input value="<?php echo $row['email'];?>" id="email" type="email" class="form-control" name="email" required>
						</div>
						
						<div class="form-group">
							<label>Mobile</label>
							<input value="<?php echo $row['mobile'];?>" id="mobile" required minlength="10" maxlength="10" type="text" class="form-control" name="mobile">
						</div>
						
						<div class="form-group">
							<label>Gender:</label><br>
							<input <?php if($row['gender']=="Male") echo "checked"; ?> id="gender" required type="radio" value="Male" name="gender">Male &nbsp;
							<input <?php if($row['gender']=="Female") echo "checked"; ?> type="radio" value="Female" name="gender">Female
						</div>
						
						<div class="form-group">
							<label>Date of Birth</label>
							<input value="<?php echo $row['dob'];?>"  required type="text" id="datepicker" class="form-control" name="dob">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Address</label>
							<textarea  id="address" required class="form-control" name="address"><?Php echo $row['address']?></textarea>
						</div>
						
						<div class="form-group">
							<label>City</label>
							<input value="<?php echo $row['city'];?>" id="city" required type="text" class="form-control" name="city">
						</div>
						
						<div class="form-group">
							<label>State</label>
							<select id="state" required class="form-control" name="state">
								<option  value=''>--Select State--</option>
								<option <?php if($row['state']=="Andhrapradesh") echo "selected" ?> value='Andhrapradesh'>Andhrapradesh</option>
								<option <?php if($row['state']=="Telangana") echo "selected" ?> value='Telangana'>Telangana</option>
								<option <?php if($row['state']=="Odisha") echo "selected" ?> value='Odisha'>Odisha</option>
								<option <?php if($row['state']=="West Bengal") echo "selected" ?> value='West Bengal'>West Bengal</option>
								<option <?php if($row['state']=="Maharastra") echo "selected" ?> value='Maharastra'>Maharastra</option>
								<option <?php if($row['state']=="Tamilnadu") echo "selected" ?> value='Tamilnadu'>Tamilnadu</option>
							</select>
						</div>
						
						<div class="form-group">
							<label>Pincode</label>
							<input value="<?php echo $row['pincode'];?>" type="text" class="form-control" name="pincode">
						</div>
						
						<div class="form-group">
							<label>Upload Employee IMage</label>
							<input type="file" class="form-control" name="image"><br>
							<img src="employees/<?php echo $row['image'] ?>" height="50" width="50">
						</div>
						

					</div><br><br>
						<div class="form-group">
							<input type="submit" class="btn btn-primary" name="edit" value="Update Employee">
						</div>
				</form>
				
					<script>
						$("#emp").validate({
							rules:{
								ename:'required',
								email:{
									required:true,
									email:true,
								},
								mobile:{
									required:true,
									number:true,
								}
							}
						});
					</script>
				
			</div>
		</div>
	</body>
</html>