<?php 
include("connect.php");
include("header.php");
?>
<div class="container">
	<h1 class="mt-4 mb-3">Forgot
        <small>Password</small>
      </h1>
	  <?php 
	  if(isset($_POST['submit']))
	  {
		  $email=$_POST['email'];
		  $res=mysqli_query($con,"select email,id,username from register where email='$email'");
		  $row=mysqli_fetch_assoc($res);
		 if(mysqli_num_rows($res)==1) 
		 {
			$id=base64_encode($row['id']);
			$to=$email;
			$subject="Forgot Password Request-gophp";
			$message="Hi ".$row['username'].",<br><br>your forgot password request has been received
			please click the below link to reset your password.<br><br>
			<a href='http://localhost/company/reset_pwd.php?userid=$id'>Reset Password</a><br><br>Thanks<br>team";
			//echo $message;
			$mheaders="Content-Type:text/html";
			if(mail($to,$email,$message,$mheaders))
			{
				echo "<p class='alert alert-success'>Reset Password link sent to your Email.please check</p>";
			}
			else
			{
				 echo "<p class='alert alert-danger'>Sorry! Network Error tray gaian</p>";
			}
		 }
		 else
		 {
			 echo "<p class='alert alert-danger'>Email does not exists</p>";
		 }
	  }
	  ?>
	  
	<form method="POST" action="">
		<div class='form-group'>
			<label>Enter Recovery Email</label>
			<input type="text" name="email"
			class="form-control" id="email">
		</div>
		<div class='form-group'>
			
			<input type="submit" name="submit"
			class="btn btn-danger" value="Submit">
		</div>
		
	</form>
</div>


<?php 
include("footer.php");
?>