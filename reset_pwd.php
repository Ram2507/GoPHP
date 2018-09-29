<?php 
if(isset($_REQUEST['userid']))
{
	$id=base64_decode($_REQUEST['userid']);
	include("connect.php");
	include("header.php");
	?>
		<div class='container'>
			<h1 class="mt-4 mb-3">Reset
        <small>Password</small>
      </h1>
	  <?php 
	  if(isset($_POST['submit']))
	  {
		  $pwd=md5($_POST['pwd']);
		  $cpwd=md5($_POST['cpwd']);
		  if($pwd==$cpwd)
		  {
			  mysqli_query($con,"update register set password='$pwd' where id=$id");
			  if(mysqli_affected_rows($con)==1)
			  {
				  echo "<p class='alert alert-success'>Password chnaged successfully.please <a href='login.php'>Login Now</a></p>";
			  }
		  }
		  else
		  {
			echo "<p class='alert alert-danger'>Password Does not Matched</p>";
		  }
	  }
	  
	  ?>
		<form method="POST" action="">
			<div class="form-group">
				<label>Enter New Password</label>
				<input type="password"
				name='pwd'
				class="form-control">
			</div>
			<div class="form-group">
				<label>Confirm New Password</label>
				<input type="password"
				name='cpwd'
				class="form-control">
			</div>
			<div class="form-group">
				
				<input type="submit"
				name='submit'
				class="btn btn-success"
				value="Update">
			</div>
		</form>
		</div>
	<?php
	include("footer.php");
	
}
else
{
	exit('Wrong Window');
}
?>