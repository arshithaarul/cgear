
<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login & Registration Form</title>
  <!---Custom CSS File--->
  <?php include 'DBconnect.php' ?>
  
<style>
    /* Import Google font - Poppins */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
body{
  min-height: 100vh;
  width: 100%;
  background: #009579;
}
.container{
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
  max-width: 430px;
  width: 100%;
  background: #fff;
  border-radius: 7px;
  box-shadow: 0 5px 10px rgba(0,0,0,0.3);
}
.container .registration{
  display: none;
}
#check:checked ~ .registration{
  display: block;
}
#check:checked ~ .login{
  display: none;
}
#check{
  display: none;
}
.container .form{
  padding: 2rem;
}
.form header{
  font-size: 2rem;
  font-weight: 500;
  text-align: center;
  margin-bottom: 1.5rem;
}
 .form input{
   height: 60px;
   width: 100%;
   padding: 0 15px;
   font-size: 17px;
   margin-bottom: 1.3rem;
   border: 1px solid #ddd;
   border-radius: 6px;
   outline: none;
 }
 .form input:focus{
   box-shadow: 0 1px 0 rgba(0,0,0,0.2);
 }
.form a{
  font-size: 16px;
  color: #009579;
  text-decoration: none;
}
.form a:hover{
  text-decoration: underline;
}
.form input.button{
  color: #fff;
  background: #009579;
  font-size: 1.2rem;
  font-weight: 500;
  letter-spacing: 1px;
  margin-top: 1.7rem;
  cursor: pointer;
  transition: 0.4s;
}
.form input.button:hover{
  background: #006653;
}
.signup{
  font-size: 17px;
  text-align: center;
}
.signup label{
  color: #009579;
  cursor: pointer;
}
.signup label:hover{
  text-decoration: underline;
}
</style>
</head>

<?php
if(isset($_POST['submit']))
{
    $username = mysqli_real_escape_string($conn, $_POST['nusername']);
    $email = mysqli_real_escape_string($conn, $_POST['nemail']);
    $mobile = mysqli_real_escape_string($conn, $_POST['nphone']);
    $password = mysqli_real_escape_string($conn, $_POST['npassword']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['ncpassword']);

	$pass = md5($password);
	$cpass = md5($password);

    $emailquery = "select * from signup where Email = '$email'"; 
    $emailquery_run = mysqli_query($conn, $emailquery);
    $emailquery_num = mysqli_num_rows($emailquery_run);
    if($emailquery_num > 0)
    {
		?>
		<script>
			alert("Email Already Exists");
		</script>
		<?php
    }
	else 
	{
		if($password === $cpassword)
		{
			$insertquery = "insert into signup (Name, Email, Contact, Password, Cpassword) values ('$username', '$email', '$mobile', '$pass', '$cpass')";
			$iquery = mysqli_query($conn, $insertquery);
			if($iquery)
            {
				?>
				<script>
					alert("Account Created Successfully");
				</script>
				<?php
            }
            else
            {
               ?>
			   <script>
				alert("Error Occured");
				</script>
				<?php
            }
		}
		else
		{
			?>
			<script>
				alert("Passwords do not match");
			</script>
			<?php
		}
	}
}
?>
<?php
if(isset($_POST['login']))
{
    $email = $_POST['nemail'];
	$password = $_POST['npassword'];

	$loginquery = "select * from signup where Email = '$email'";
	$query = mysqli_query($conn, $loginquery);
	
	$count = mysqli_num_rows($query);
	
	if($count)
	{
		$pass = mysqli_fetch_assoc($query);

		if(md5($password) === $pass["Password"])
		{
			?>
		    <script>
			   alert("Login Successfull");
		    </script>
		    <?php
		}
		else
		{
			?>
		    <script>
			  alert("Invalid Password");
		    </script>
		    <?php
		}	
	}
	else
	{
		?>
		<script>
			alert("Invalid Email");
		</script>
		<?php
	}	
}
?>

<body>
  <div class="container">
     <input type="checkbox" id="check">
    <div class="login form">
     <header>Login</header>
      <form action="#" method="post">
        <input type="text" placeholder="Enter Email" name="nemail"required>
        <input type="password" placeholder="Enter Password" name="npassword"required>
        <a href="forgot.php">Forgot password?</a>
        <input type="submit" class="button" value="Login" name="login">
      </form>
      <div class="signup">
        <span class="signup">Don't have an account?
         <label for="check">Signup</label>
        </span>
      </div>
    </div> 
    <div class="registration form">
      <header>Signup</header>
      <form action="#" method="post">
        <input type="text" placeholder="Enter your Name" name="nusername" required>
        <input type="email" placeholder="Enter your Email" name="nemail" required>
        <input type="tel" placeholder="Enter your Contact" name="nphone" required>
        <input type="password" placeholder="Enter password" name="npassword" required>
        <input type="password" placeholder="Confirm password" name="ncpassword" required>        
        <input type="submit" class="button" value="Signup" name="submit">
      </form>
      <div class="signup">
        <span class="signup">Already have an account?
         <label for="check">Login</label>
        </span>
      </div>
    </div>
  </div>
</body>
</html>