<?php
include("includes/header.php");
include("includes/config.php");
include("includes/functions.php");
$msg1=''; $msg2=''; $msg3=''; $msg4=''; $msg5=''; $msg6=''; $msg7=''; $msg8='';$msg9='';
$registeredname='';$formofbusiness='';$email='';$date='';$password='';$c_password='';$image='';
$id=$_GET['user'];
if(isset($id))
{
$result=mysqli_query($con,"SELECT registered_name,business_form,dor,mail FROM users WHERE id='$id'");
$retrive=mysqli_fetch_array($result);
$name=$retrive['registered_name'];
$form=$retrive['business_form'];
$dor=$retrive['dor'];
$mail=$retrive['mail'];
}
if(isset($_POST['submit']))
{
$registeredname=($_POST['rname']); //$registeredname=mysql_real_escape_string($_POST['rname']);
$formofbusiness=($_POST['fobusiness']); //$formofbusiness=mysql_real_escape_string($_POST['fobusiness']);
$email=($_POST['mail2']); //$email=mysql_real_escape_string($_POST['mail']);
$date=$_POST['dor2'];
//echo $registeredname."</br>".$formofbusiness."</br>".$email."</br>".$date."</br>".$password."</br>".$c_password."</br>".$image."</br>".$checkbox;
if(strlen($registeredname)<1)
{
    $msg1="<div class='error'>Please provide the 'Registered Name'</div>";
}
else if(strlen($formofbusiness)<1)
{
    $msg2="<div class='error'>Please provide the 'Form of Business'</div>";
}
else if (!filter_var($email,FILTER_VALIDATE_EMAIL))
{
  $msg3="<div class='error'>Please provide a valid email</div>";
}

else if (empty($date))
{
  $msg4="<div class='error'>Please provide the Date of Registration</div>";
}
else
{
  mysqli_query($con,"UPDATE users SET
    registered_name='$registeredname',business_form='$formofbusiness',mail='$email',dor='$date' WHERE id='$id'");
  header("location:admin-panel.php");
  $registeredname='';$formofbusiness='';$email='';$date='';$password='';$c_password='';$image='';
}
}
?>
<title>Offer~Notifier - Update User Details</title>
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
    <div class='jumbotron' style='margin-top:20px;padding-top:20px;padding-bottom:20px;'>
<h3 align='center'>Update User Details</h3></br>
<?php echo $msg9;?>
</br>
<form method='post'>
  <div class="form-group">
<label>Registered Name: </label>
<input type="text" name='rname' placeholder="Must contain at least 1 character" class='form-control' value='<?php echo $name;?>'>
<?php echo $msg1;?>
</div>
<div class="form-group">
<label>Form of Business: </label>
<input type="text" name='fobusiness' placeholder="Ex: Private Limited Liability" class='form-control' value='<?php echo $form;?>'>
<?php echo $msg2;?>
</div>
<div class="form-group">
<label>Business Email Address: </label>
<input type="email" name='mail2' placeholder="example@abc.com" class='form-control' value='<?php echo $mail;?>'>
<?php echo $msg3;?>
</div>
<div class="form-group">
<label>Date of Registration: </label>
<input type="date" name='dor2' placeholder="abcd@hotmail.com" class='form-control' value='<?php echo $dor;?>'>
<?php echo $msg4;?>
</div>
<center><input type="submit" value='Update' name='submit' class='btn btn-success' /></center></br>
</form>
</div>
</div>
</div>
</body>
</html>
