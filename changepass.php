<!DOCTYPE html>
<html>
<head>
<label style="text-align:center; font-family: Arial, sans-serif; color: #FFFFFF;"><title>Change Password</title>
    <body style="background-color: <?php echo '#FF0000'; ?>;">
</body>
    <?php include 'DBconnect.php' ?>
<style>
    body {
            background-image: url('<?php echo "cp.jpg"; ?>');
            background-repeat: no-repeat;
            background-size: cover;
        }

</style>
</head>

<?php
if(isset($_POST['submit'])){
    $email = $_POST['nemail'];
    $oldpassword = $_POST['noldpassword'];
    $newpassword = $_POST['nnewpassword'];
    $cpassword = $_POST['cpassword'];

    $sql="select * from signup where Email = '$email' AND Password = '".md5($oldpassword)."'";
    $result = mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $count = mysqli_num_rows($result); 

    if($count == 1){
       
        if($newpassword == $cpassword){
        $sql = "UPDATE signup SET Password = '".md5($newpassword)."' WHERE Email = '$email'";
        
        $result=mysqli_query($conn,$sql);
        
        if ($result){
            ?>
            <script>
                alert("Successful");
            </script>
            <?php
          
        }
        else{
            ?>
    <script>
        alert("Password do not match");
    </script>
    <?php
        }
      }
        else{
            ?>
            <script>
                alert("Error")
            </script>
            <?php
        }
    }
    else{
        ?>
            <script>
                alert("old password do not match");
            </script>
            <?php
    }
}
?>




<body>
    <h1>Change Password</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="username"><label style="font-family: Arial, sans-serif; color: #FFFFFF;">Username:</label>
        <input class="form-control" type="email" placeholder="Email"  name="nemail" required>
        <br><br>
        <label for="current_password"><label style="font-family: Arial, sans-serif; color: #FFFFFF;">Current Password:</label>
        <input class="form-control" type="password" placeholder="Old Password" name="noldpassword" required autocomplete="off">
        <br><br>
        <label for="new_password"><label style="font-family: Arial, sans-serif; color: #FFFFFF;">New Password:</label>
        <input class="form-control" type="password" placeholder="New Password" name="nnewpassword" required autocomplete="off">
        <br><br>
        <label for="new_password"><label style="font-family: Arial, sans-serif; color: #FFFFFF;">Confirm Password:</label>
        <input class="form-control" type="password" placeholder="New Password" name="cpassword" required autocomplete="off">
        <br><br>
      
        <input class=" btn" type="submit" value="Change" name="submit">
    </form>
</body>
</html>
