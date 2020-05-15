<?php
include("includes/header.php");
include("includes/config.php");
include("includes/functions.php");
session_start();
$msg1=''; $msg2=''; $fname='';
if(isset($_POST['submit']))
{
  $fname=$_POST['name'];
  $password=$_POST['pass'];
  if(empty($fname))
  {
    $msg1='<div class="error">Please enter your name</div>';
  }
  else if(empty($password))
  {
    $msg2='<div class="error">Please enter your password</div>';
  }
  else
  {
    $pass=mysqli_query($con,"SELECT password FROM admin WHERE name='$fname'");
    $pass_w=mysqli_fetch_array($pass);
    $dpass=$pass_w['password'];
    if ($password!==$dpass)
    {
      $msg2='<div class="error">Incorrect password</div>';
    }
    else
    {
      $_SESSION['name']=$fname;
      header("location:admin-panel.php");
    }
  }
}
?>
<title>Offer~Notifier - Admin Login</title>
<style type="text/css">
#body-bg
{
  background: url("images/bg.jpg");
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
.error
{
  color: red;
}
</style>
</head>
<body id='body-bg'>
<div class='container'>
  <div class='login-form col-md-4 offset-md-4'>
    <div class='jumbotron' style='margin-top:50px;padding-top:20px;padding-bottom:10px;'>
      <h2 align='center'>Admin Login</h2></br>
      <form method='post'>
    <div class='form-group'>
      <label>Username: </label>
      <input type='text' name="name" class='form-control' value='<?php echo $fname ?>'/>
<?php echo $msg1; ?>
    </div>
    <div class='form-group'>
      <label>Password: </label>
      <input type='password' name="pass" class='form-control'/>
<?php echo $msg2; ?>
    </div>
    <div class='form-group'>
      <center><input type='submit' name='submit' value='Log In'class='btn btn-success'/></center>
    </div>
</form>
</div>
</div>
</div>
</body>
</html>
