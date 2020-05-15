<?php
include("includes/header.php");
include("includes/config.php");
include("includes/functions.php");
$id=$_GET['id'];
if(isset($id))
{
$msg=''; $msg1=''; $msg2='';
if (isset($_POST['submit']))
{
  $password=$_POST['pass'];
  $cpassword=$_POST['cpass'];
  if (empty($password))
  {
    $msg1='<div class="error">Please provide the New Password</div>';
  }
  else if (strlen($password)<5)
  {
    $msg1='<div class="error">Password must contain at least 5 characters</div>';
  }
  else if (empty($cpassword))
  {
    $msg2='<div class="error">Please confirm the New Password</div>';
  }
  elseif ($password!=$cpassword)
  {
    $msg2='<div class="error">Please is not matched</div>';
  }
  else
  {
    $pass=md5($password);
    mysqli_query($con,"UPDATE users SET password='$pass' WHERE id='$id'");
    $msg="<div class='success'>Password changed successfully</div>";
  }
}
?>
<title>Offer~Notifier - Change Password Portal</title>
<style type="text/css">
.error
{
  color:red;
}
.success
{
  color:green;
  font-weight:bold;
}
#body-bg
{
  background-image: linear-gradient(#000428, #bdc3c7);
}
.box
{
  border: 1px solid black;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 3px 3px 3px black;
  background-color: #bdc3c7;
}
</style>
</head>
<body id='body-bg'>
<div class='container' style='padding-top:50px;background-image: linear-gradient(180deg, #F1FFFD, #141e30); margin-top:20px;
margin-bottom:20px;width:1200px;height:640px'>
<a href='profile.php'><button class='btn btn-outline-danger'style='float: right'>Back</button></a>
<div class='col-md-4 offset-md-4'>
<div class='box'>
<h2 align='center'>Change Password</h2></br>
<center><?php echo $msg; ?></center>
</br>
<form method='post'>
  <div class='form-group'>
<label>New Password</label>
<input type='password' name='pass' class='form-control' Placeholder='Must contain at least 5 characters'>
<?php echo $msg1; ?>
</div>
<div class='form-group'>
<label>Confirm New Password</label>
<input type='password' name='cpass' class='form-control' Placeholder='Re-enter New Password'>
<?php echo $msg2; ?>
</div></br>
<center><button name='submit' class='btn btn-success'>Submit</button></center>
</form>
</div>
</div>
</div>
</body>
</html>
<?php
}
else
{
    header("location:login.php");
}
