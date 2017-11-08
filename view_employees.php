<html>
	<head>
		<title>Add Employee</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<style>
		label.error{color:red;}
		</style>
		<script src="js/jquery-1.12.4.js"></script>

	</head>
	<body>
		<div class="container-fluid well">
			<nav class="navbar navbar-default">
				<ul class="navbar-nav nav">
					<li class="active"><a href="view_employees.php">View Employees</a></li>
					<li><a href="add_employee.php">Add Employee</a></li>
				</ul>
			</nav>
			<div class="row">
			<h2>View Employees</h2>
			
			<?php
				if(isset($_COOKIE['edit_success']))
				{
					echo "<p class='alert alert-success'>Record Updated...</p>";
				}
			?>
			
			
			<?php 
			include("connect.php");//$con
			$result=mysqli_query($con,"select *from employees");
			if(mysqli_num_rows($result)>0)
			{
				?>
				
				<table class="table responsive">
					<tr>
						<th>EID</th>
						<th>Ename</th>
						<th>Avatar</th>
						<th>Email</th>
						<th>Mobile</th>
						<th>Gender</th>
						<th>DOB</th>
						<th>Address</th>
						
						<th>DOJ</th>
						<th>Action</th>
					</tr>
					<?php 
					while($row=mysqli_fetch_assoc($result))
					{
						?>
							<tr>
								<td><?php echo $row['eid']?></td>
								<td><?php echo $row['ename']?></td>
								<td><Img src="employees/<?php echo $row['image']?>" height="30" width="30"></td>
								<td><?php echo $row['email']?></td>
								<td><?php echo $row['mobile']?></td>
								<td><?php echo $row['gender']?></td>
								<td><?php echo $row['dob']?></td>
								<td>
									<?php echo $row['address'];?>
									<?php echo $row['city'];?>
									<?php echo $row['state'];?>
									<?php echo $row['pincode'];?>
									
								</td>
								
								<td><?php echo $row['date_of_join']?></td>
								<td>
									<a href="edit_employee.php?key=<?php echo $row['eid']?>"><i class="fa fa-pencil">Edit</i></a><br><br>
									<a href="delete_employee.php?key=<?php echo $row['eid'];?>" class="text-danger"><i class="fa fa-trash">Delete</i></a><br><br>
									<?php
										if($row['status']=="Active")
										{
											?>
												<a title="Active" href="status_employee.php?key=<?php echo $row['eid'];?>" class="text-success"><i class="fa fa-eye" aria-hidden="true"></i></a>
											<?php
										}
										else
										{
											?>
											<a title="In Active" href="status_employee.php?key=<?php echo $row['eid'];?>" class="text-danger"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
											<?php
										}
									?>
									
									
								</td>
							</tr>
						<?php
					}
					?>
				</table>
				<?php
			}
			else
			{
				echo "<p class='alert alert-warning'>
				Sorry No Records Found. please <a href='add_employee.php'>Add Employee</a></p>";
			}
			?>
			
			
			
				
				
			</div>
		</div>
	</body>
</html>