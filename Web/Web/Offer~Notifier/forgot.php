<?php
include("includes/header.php");
include("includes/config.php");
include("includes/functions.php");
$msg='';$msg1=''; $msg2=''; $msg3=''; $msg4=''; $email=''; $date=''; $password=''; $cpassword='';
if (isset($_POST['submit']))
{
  $email=$_POST['email'];
  $date=$_POST['dor'];
  $password=$_POST['pass'];
  $cpassword=$_POST['cpass'];
  if(empty($email))
  {
    $msg1="<div class='error'>Please provide the Business Email Address</div>";
  }
  else  if (!filter_var($email,FILTER_VALIDATE_EMAIL))
  {
    $msg1="<div class='error'>Please provide a valid email</div>";
  }
  else if(empty($date))
  {
    $msg2="<div class='error'>Please provide the Date of Registration</div>";
  }
  else if(empty($password))
  {
    $msg3="<div class='error'>Please provide the New Password</div>";
  }
  else if(strlen($password)<5)
  {
    $msg3="<div class='error'>Password must contain at least 5 characters</div>";
  }
  else if(empty($cpassword))
  {
    $msg4="<div class='error'>Please confirm the New Password</div>";
  }
  else if($password!=$cpassword)
  {
    $msg4="<div class='error'>Password is not matched</div>";
  }
  else if(email_exists($email,$con))
  {
     $result=mysqli_query($con, "SELECT dor FROM users WHERE mail='$email'");
     $retrive=mysqli_fetch_array($result);
     $DOR=$retrive['dor'];
     if ($date==$DOR)
     {
       $pass=md5($password);
       mysqli_query($con,"UPDATE users SET password='$pass'");
       $msg="<div class='success'>Password changed successfully</div>";
     }
     else
     {
       $msg2="<div class='error'>Wrong DOR</div>";
     }
  }
  else
  {
    $msg1="<div class='error'>Email does not exists</div>";
  }
}
?>
<title>Offer~Notifier - Forgot Password</title>
</head>
<style type='text/css'>
#body-bg
{
  background: url("images/bg.jpg");
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
.error
{
  color:red;
}
.success
{
  color:green;
  font-weight:bold;
}
</style>
<body id='body-bg'>
<div class='container'>
  <div class='login-form col-md-4 offset-md-4'>
    <div class='jumbotron' style='margin-top:20px;padding-top:20px;padding-bottom:30px;'>
<h3 align='center'>Forgot Password?</h3></br>
</br><center><?php echo $msg; ?></center></br>
<form method='post' >
<div class='form-group'>
  <label>Business Email Address: </label>
  <input type='email' name='email' value="<?php echo $email;?>" class='form-control' placeholder='example@abc.com'>
<?php echo $msg1; ?>
</div>
<div class='form-group'>
  <label>Date of Registration: </label>
  <input type='date' name='dor' value="<?php echo $date;?>" class='form-control'>
  <?php echo $msg2; ?>
</div>
<div class='form-group'>
  <label>New Password: </label>
  <input type='password' name='pass' value="<?php echo $password;?>" class='form-control' placeholder='Must contain at least 5 characters'>
<?php echo $msg3; ?>
</div>
<div class='form-group'>
  <label>Confirm Password: </label>
  <input type='password' name='cpass' value="<?php echo $cpassword;?>" class='form-control' placeholder='Re-enter New Password'>
<?php echo $msg4; ?>
</div></br>
<center><button class='btn btn-success' name='submit'>Submit</button></center></br>
<center><a href='login.php'>&#8592; Back to Login Dashboard</a></center>
</form>
</div>
</div>
</div>
</body>
</html>
