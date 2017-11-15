<?php 
class Users
{
	public $con;
	public function __construct()
	{
		$this->con=mysqli_connect("localhost","root","","9am");
	}
	public function getAllUsers()
	{
		
		$res=mysqli_query($this->con,"select *from register order by id desc");
		if(mysqli_num_rows($res)>0)
		{
			?>
			<table>
				<tr>
					<th>Id</th>
					<th>Name</th>
					<th>Email</th>
					<th>Mobile</th>
					<th>City</th>
				</tr>
				<?php 
				while($row=mysqli_fetch_object($res))
				{
					?>
						<tr>
							<td><?php echo $row->id;?></td>
							<td><?php echo $row->username;?></td>
							<td><?php echo $row->email;?></td>
							<td><?php echo $row->mobile;?></td>
							<td><?php echo $row->city;?></td>
						</tr>
					<?php
				}
				?>
			</table>
			<?php
		}
		else
		{
			echo "No Records Found";
		}
	}
	
	public function latestUser()
	{
		
		$res=mysqli_query($this->con,"select id,username,email,city,mobile
		from register order by id desc limit 1");
		$row=mysqli_fetch_assoc($res);
		return $row;
	}
	public function selectUser($id)
	{
		
		$res=mysqli_query($this->con,"select id,username,email,city,mobile
		from register where id=$id");
		$row=mysqli_fetch_assoc($res);
		return $row;
		
	}
	public function __destruct()
	{
		mysqli_close($this->con);
	}
}

$obj=new Users();
$obj->getAllUsers();
print_r($obj->latestUser());
print_r($obj->selectUser(7));
?>





